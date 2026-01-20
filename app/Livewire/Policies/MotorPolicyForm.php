<?php

namespace App\Livewire\Policies;

use Livewire\Component;
use App\Models\MotorPolicy;
use App\Models\ClientPolicies;
use Carbon\Carbon;
use App\Models\ProductNotes;
use Illuminate\Support\Facades\Auth;

class MotorPolicyForm extends Component
{
    public $policy_id,$policy;
    public $client_id, $start_date, $renewal_date, $end_date, $term, $motortype, $value, $insuretype, $curinsurer, 
           $propinsurer, $propinsurer_num, $make, $model, $year, $registration, $security, $parking, $license1, 
           $licenseyears, $noclaims, $claimdetails, $pricepledge1, $monthprem, $payfreq, $upfrontpay1, $numpay, 
           $needs_obj_text, $per_circ_text, $fin_sit_text, $risk_profile_text, $recommend_text;
    public $internal_status = 'New', $uw_status = 'Not Filed', $active;
    public $policy_type = 'motor_policy';
    public $type = 'Motor Insurance';
    public $isActive = 1;
    public $left_our_agency = 0;

    protected $rules = [
        'client_id' => 'required|max:255',
        'internal_status' => 'nullable|string',
        'uw_status' => 'nullable|string',
        'type' => 'required|string|max:255',
        'start_date'    => 'required|date_format:d-m-Y',
        'renewal_date' => 'nullable|date_format:d-m-Y',
        'end_date'     => 'nullable|date_format:d-m-Y',
        'term' => 'required|string|max:255',
        'motortype' => 'nullable|string|max:255',
        'value' => 'nullable|string|max:255',
        'insuretype' => 'nullable|string|max:255',
        'curinsurer' => 'nullable|string|max:255',
        'propinsurer' => 'required|string|max:255',
        'propinsurer_num' => 'nullable|string|max:255',
        'make' => 'nullable|string|max:255',
        'model' => 'nullable|string|max:255',
        'year' => 'nullable|string',
        'registration' => 'nullable|string|max:255',
        'security' => 'nullable|string|max:255',
        'parking' => 'nullable|string|max:255',
        'license1' => 'nullable|string|max:255',
        'licenseyears' => 'nullable|string|max:255',
        'noclaims' => 'nullable|string|max:255',
        'claimdetails' => 'nullable|text',
        'pricepledge1' => 'required|string|max:255',
        'monthprem' => 'required|string|max:255',
        'payfreq' => 'nullable|string|max:255',
        'upfrontpay1' => 'nullable|string|max:255',
        'numpay' => 'nullable|string|max:255',
        'needs_obj_text' => 'required|string',
        'per_circ_text' => 'required|string',
        'fin_sit_text' => 'required|string',
        'risk_profile_text' => 'required|string',
        'recommend_text' => 'required|string',
        'left_our_agency' => 'boolean',
    ];

    public function mount($client_id = null, $policy_id = null)
    {
        $this->client_id = $client_id;
        if (!empty($policy_id)) {
            $this->policy_id = $policy_id;
            $this->fetchPolicy();
        }
        $this->start_date = $this->start_date ?? now()->format('d-m-Y');
    }

    public function fetchPolicy()
    {
        $motorPolicy = MotorPolicy::findOrFail($this->policy_id);
        foreach ($this->rules as $field => $rule) {
        	if(isset($motorPolicy->$field)) {
                if (in_array($field, ['renewal_date', 'end_date', 'fdate']) && $motorPolicy->$field) {
                    $this->$field = Carbon::parse($motorPolicy->$field)->format('d-m-Y');
                } else {
                    $this->$field = $motorPolicy->$field;
                }
		    }
        }

        $clientPolicy = ClientPolicies::where('policy_id', $this->policy_id)
        ->where('policy_type', $this->policy_type)
        ->first();

        if ($clientPolicy) {
            $this->internal_status = $clientPolicy->internal_status;
            $this->uw_status = $clientPolicy->uw_status;
            $this->monthprem = $clientPolicy->monthprem;
            $this->propinsurer = $clientPolicy->propinsurer;
            $this->propinsurer_num = $clientPolicy->propinsurer_num;
            $this->left_our_agency  = (bool) $clientPolicy->left_our_agency;
            $this->start_date = Carbon::parse($clientPolicy->creation_date)->format('d-m-Y');
        }
    }

    public function savePolicy()
    {
        $this->validate($this->rules);

        $fields = $this->getFields();

        $creationDate = Carbon::createFromFormat('d-m-Y', $this->start_date)->format('Y-m-d');

        $activeStatus = in_array($this->internal_status, ['Cancelled', 'Closed']) ? 'Inactive' : 'Active';
        if ($this->policy_id) {
	        // UPDATE scenario
	        $clientPolicy = ClientPolicies::where('policy_id', $this->policy_id)
	            ->where('policy_type', $this->policy_type)
	            ->first();
	        if($clientPolicy) {
	        	$clientPolicy->update([
		            'client_id'        => $this->client_id,
		            'internal_status'  => $this->internal_status,
		            'uw_status'        => $this->uw_status,
		            'active'           => $activeStatus,
		            'monthprem'        => $this->monthprem,
		            'propinsurer'      => $this->propinsurer,
		            'propinsurer_num'  => $this->propinsurer_num,
                    'left_our_agency'  => $this->left_our_agency ? 1 : 0,
                    'creation_date'    => $creationDate,
		        ]);
	        } else {
	        	$clientPolicy = $this->createClientPolicy($activeStatus, $this->policy_id);
	        }
	        
	        $motorPolicy = MotorPolicy::updateOrCreate(['id' => $this->policy_id], $fields);
	    } else {
	        \DB::beginTransaction();
			try {
			    $clientPolicy = $this->createClientPolicy($activeStatus);
			    $this->policy_id = $clientPolicy->id;
			    $fields['id'] = $this->policy_id;
			    $motorPolicy = MotorPolicy::create($fields);
			    $clientPolicy->policy_id = $this->policy_id;
			    $clientPolicy->save();

			    \DB::commit();

                $this->dispatch('refreshActiveProducts')->to(\App\Livewire\Clienttabs\ActiveProductsTab::class);

			} catch (\Throwable $e) {
			    \DB::rollBack();
			    throw $e;
			}
	    }

        $prefix = (new MotorPolicy())->getPrefix();
        $policyCode = $prefix . $this->policy_id;

        $exists = ProductNotes::where('policy_id', $this->policy_id)->exists();
        if (! $exists) {
            $client = \App\Models\Client::find($this->client_id);
            $clientName = trim(($client->first_name ?? '') . ' ' . ($client->last_name ?? ''));
            $policyCreation = \Carbon\Carbon::parse($clientPolicy->creation_date)->format('d/m/Y H:i:s');
            $noteText = "{$policyCreation}\n".
                        "U/W Status Changed: {$this->uw_status}\n".
                        "Internal Status Changed: {$this->internal_status}";
            ProductNotes::create([
                'policy_id'     => $this->policy_id,
                'policy_type'   => $this->policy_type,
                'assigned_to'   => Auth::id(),
                'first_name'    => $client->first_name ?? '',
                'last_name'     => $client->last_name ?? '',
                'subject'       => "Motor Policy Notes - {$clientName}",
                'text'          => $noteText,
                'note_type'     => 'system',
                'created_by'    => Auth::id(),
            ]);
        }

        $message = $this->policy_id
            ? "Motor policy data updated successfully ({$policyCode})."
            : "Motor policy data created successfully ({$policyCode}).";

        session()->flash('addproduct_message', $message);
        
        if (!$this->policy_id) {
            $this->resetInputFields();
        }
    }

    private function createClientPolicy($activeStatus, $policyId = null) {
    	$clientPolicy = new ClientPolicies();
    	$cols = [
	        'id'               => $policyId,
	        'client_id'        => $this->client_id,
	        'policy_type'      => $this->policy_type,
	        'internal_status'  => $this->internal_status,
	        'uw_status'        => $this->uw_status,
	        'active'           => $activeStatus,
	        'creation_date'    => date('Y-m-d'),
	        'monthprem'        => $this->monthprem,
	        'propinsurer'      => $this->propinsurer,
	        'propinsurer_num'  => $this->propinsurer_num,
            'left_our_agency'  => $this->left_our_agency ? 1 : 0,
	    ];
	    if($policyId) {
	    	$cols['policy_id'] = $policyId;
	    }
	    $clientPolicy->fill($cols);
	    $clientPolicy->save();
	    return $clientPolicy;
    }

    public function render()
    {
        return view('livewire.policies.motor-policy-form');
    }

    private function getFields()
    {
        $dateFields = [
            'start_date',
            'renewal_date',
            'end_date',
        ];

        return collect($this->rules)->keys()->mapWithKeys(function ($field) use ($dateFields) {
            $value = $this->$field;

            // Empty string → NULL
            if ($value === '') {
                return [$field => null];
            }

            // Convert UI date → DB date
            if (in_array($field, $dateFields) && $value) {
                return [
                    $field => Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d')
                ];
            }

            return [$field => $value];
        })->toArray();
    }

    private function resetInputFields(){
        $fields = $this->getFields();
        foreach($fields as $key => $val) {
            $this->$key = '';
        }
    }

    private function formatDate($date)
    {
        if ($date && \DateTime::createFromFormat('d-m-Y', $date)) {
            return Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
        }
        return $date;
    }
}
