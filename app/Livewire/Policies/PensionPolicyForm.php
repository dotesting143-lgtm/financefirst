<?php

namespace App\Livewire\Policies;

use Livewire\Component;
use App\Models\PensionPolicy as PensionPolicyModel;
use App\Models\ClientPolicies;
use Carbon\Carbon;
use App\Models\ProductNotes;
use Illuminate\Support\Facades\Auth;

class PensionPolicyForm extends Component
{
    public $policy_id,$policy;
    public $client_id, $type, $start_date, $end_date, $term, $propinsurer, $propinsurer_num, $aptype, $sptype, 
           $intname, $intnum, $regcon, $sincon, $retage, $monthprem, $numpay, 
           $needs_obj_text, $per_circ_text, $fin_sit_text, $risk_profile_text, $recommend_text;
    public $internal_status = 'New', $uw_status = 'Not Filed', $active;
    public $policy_type = 'pension_policy';
    public $isActive = 1;
    public $left_our_agency = 0;

    protected $rules = [
        'client_id' => 'required|max:255',
        'internal_status' => 'nullable|string',
        'uw_status' => 'nullable|string',
        'type' => 'required|string|max:255',
        'start_date' => 'required|date_format:d-m-Y',
        'end_date' => 'date|date_format:d-m-Y',
        'term' => 'required|string|max:255',
        'propinsurer' => 'required|string|max:255',
        'propinsurer_num' => 'nullable|string|max:255',
        'aptype' => 'nullable|string|max:255',
        'sptype' => 'nullable|string|max:255',
        'intname' => 'nullable|string|max:255',
        'intnum' => 'nullable|string|max:255',
        'regcon' => 'nullable|string|max:255',
        'sincon' => 'nullable|string|max:255',
        'retage' => 'nullable|string|max:255',
        'monthprem' => 'required|string|max:255',
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
            $this->isActive = 0;
            $this->fetchPolicy();
        }
        $this->start_date = $this->start_date ?? now()->format('d-m-Y');
    }

    public function fetchPolicy()
    {
        $pensionPolicy = PensionPolicyModel::findOrFail($this->policy_id);
        foreach ($this->rules as $field => $rule) {
        	if(isset($pensionPolicy->$field)) {
                if (in_array($field, ['renewal_date', 'end_date', 'fdate']) && $pensionPolicy->$field) {
                    $this->$field = Carbon::parse($pensionPolicy->$field)->format('d-m-Y');
                } else {
                    $this->$field = $pensionPolicy->$field;
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
	        
	        $pensionPolicy = PensionPolicyModel::updateOrCreate(['id' => $this->policy_id], $fields);
	    } else {
	        \DB::beginTransaction();
			try {
			    $clientPolicy = $this->createClientPolicy($activeStatus);
			    $this->policy_id = $clientPolicy->id;
			    $fields['id'] = $this->policy_id;
			    $pensionPolicy = PensionPolicyModel::create($fields);
			    $clientPolicy->policy_id = $this->policy_id;
			    $clientPolicy->save();

			    \DB::commit();

                $this->dispatch('refreshActiveProducts')->to(\App\Livewire\Clienttabs\ActiveProductsTab::class);

			} catch (\Throwable $e) {
			    \DB::rollBack();
			    throw $e;
			}
	    }

        $prefix = (new PensionPolicyModel())->getPrefix();
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
                'subject'       => "Pension Policy Notes - {$clientName}",
                'text'          => $noteText,
                'note_type'     => 'system',
                'created_by'    => Auth::id(),
            ]);
        }

        $message = $this->policy_id
            ? "Pension policy updated successfully ({$policyCode})."
            : "Pension policy created successfully ({$policyCode}).";

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
        return view('livewire.policies.pension-policy-form');
    }

    private function getFields()
    {
        return collect($this->rules)->keys()->mapWithKeys(function ($field) {
            $value = $this->$field;

            // Empty strings → NULL (important for dates)
            if ($value === '') {
                return [$field => null];
            }

            // Convert UI dates to DB format
            if (in_array($field, ['start_date', 'end_date']) && $value) {
                return [
                    $field => Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d')
                ];
            }

            return [$field => $value];
        })->toArray();
    }

    private function resetInputFields()
    {
        $fields = $this->getFields();
        foreach ($fields as $key => $val) {
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
