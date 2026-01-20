<?php

namespace App\Livewire\Policies;

use Livewire\Component;
use App\Models\CommercialPolicy as CommercialPolicyModel;
use App\Models\ClientPolicies;
use Carbon\Carbon;
use App\Models\ProductNotes;
use Illuminate\Support\Facades\Auth;

class CommercialPolicyForm extends Component
{
    public $policy_id,$policy;
    public $client_id, $start_date, $renewal_date, $end_date, $term, $curinsurer, $propinsurer, $propinsurer_num, 
    $busdesc, $targetprem, $locdesc, $conwalls, $confloor, $conroof, $constory, $conheattype, $extblank, 
    $secalarm, $seccctv, $secwin, $secdoor, $dambuild, $damfix, $damstock, $damplant, $damgross, $damworkings, $damrent,
    $damempliab, $damclwage, $damoswage, $damppl, $damturnover, $damcomputer, $dammoney, 
    $claimdate1, 
    $claimdetails1, 
    $claimamt1, 
    $claimreserv1,
    $claimdate2,
    $claimdetails2,
    $claimamt2,
    $claimreserv2,
    $claimdate3,
    $claimdetails3,
    $claimamt3,
    $claimreserv3,
    $claimdate4,
    $claimdetails4,
    $claimamt4,
    $claimreserv4,
    $claimdate5,
    $claimdetails5,
    $claimamt5,
    $claimreserv5,
    $pricepledge1,
    $monthprem,
    $payfreq,
    $upfrontpay1,
    $needs_obj_text, $per_circ_text, $fin_sit_text, $risk_profile_text, $recommend_text;
    
    public $internal_status = 'New', $uw_status = 'Not Filed', $numpay, $active;

    public $type = 'Commercial Insurance';
    public $policy_type = 'commercial_policy';
    public $isActive = 1;
    public $left_our_agency = 0;

    protected $rules = [
        'client_id' => 'required|max:255',
        'internal_status' => 'nullable|string',
        'uw_status' => 'nullable|string',
        'type' => 'required|max:255',
        'start_date'    => 'required|date_format:d-m-Y',
        'renewal_date' => 'nullable|date_format:d-m-Y',
        'end_date'     => 'nullable|date_format:d-m-Y',
        'term' => 'required|string|max:255',
        'busdesc' => 'nullable|string|max:255',
        'curinsurer' => 'nullable|string|max:255',
        'propinsurer' => 'required|string|max:255',
        'propinsurer_num' => 'nullable|string|max:255',
        'targetprem' => 'nullable|string|max:255',
        'locdesc' => 'nullable|string|max:255',
        'conwalls' => 'nullable|string|max:255',
        'confloor' => 'nullable|string|max:255',
        'conroof' => 'nullable|string|max:255',
        'constory' => 'nullable|string|max:255',
        'conheattype' => 'nullable|string|max:255',
        'extblank' => 'nullable|string|max:255',
        'secalarm' => 'nullable|string|max:255',
        'seccctv' => 'nullable|string|max:255',
        'secwin' => 'nullable|string|max:255',
        'secdoor' => 'nullable|string|max:255',
        'dambuild' => 'nullable|string|max:255',
        'damfix' => 'nullable|string|max:255',
        'damstock' => 'nullable|string|max:255',
        'damplant' => 'nullable|string|max:255',
        'damgross' => 'nullable|string|max:255',
        'damworkings' => 'nullable|string|max:255',
        'damrent' => 'nullable|string|max:255',
        'damempliab' => 'nullable|string|max:255',
        'damclwage' => 'nullable|string|max:255',
        'damoswage' => 'nullable|string|max:255',
        'damppl' => 'nullable|string|max:255',
        'damturnover' => 'nullable|string|max:255',
        'damcomputer' => 'nullable|string|max:255',
        'dammoney' => 'nullable|string|max:255',
        'claimdate1' => 'nullable|date_format:d-m-Y',
        'claimdetails1' => 'nullable|string|max:255',
        'claimamt1' => 'nullable|string|max:255',
        'claimreserv1' => 'nullable|string|max:255',
        'claimdate2' => 'nullable|date_format:d-m-Y',
        'claimdetails2' => 'nullable|string|max:255',
        'claimamt2' => 'nullable|string|max:255',
        'claimreserv2' => 'nullable|string|max:255',
        'claimdate3' => 'nullable|date_format:d-m-Y',
        'claimdetails3' => 'nullable|string|max:255',
        'claimamt3' => 'nullable|string|max:255',
        'claimreserv3' => 'nullable|string|max:255',
        'claimdate4' => 'nullable|date_format:d-m-Y',
        'claimdetails4' => 'nullable|string|max:255',
        'claimamt4' => 'nullable|string|max:255',
        'claimreserv4' => 'nullable|string|max:255',
        'claimdate5' => 'nullable|date_format:d-m-Y',
        'claimdetails5' => 'nullable|string|max:255',
        'claimamt5' => 'nullable|string|max:255',
        'claimreserv5' => 'nullable|string|max:255',
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
        'left_our_agency' => 'boolean'
    ];

    public function mount($client_id = null, $policy_id = null)
    {
        $this->client_id = $client_id;
        if(!empty($policy_id)) {
            $this->policy_id = $policy_id;
            $this->isActive = 0;
            $this->fetchPolicy();
        }
        $this->start_date = $this->start_date ?? now()->format('d-m-Y');
    }

    public function fetchPolicy()
    {
        $commercialpolicy = CommercialPolicyModel::findOrFail($this->policy_id);
        foreach ($this->rules as $field => $rule) {
        	if (isset($commercialpolicy->$field)) {
                if (in_array($field, ['renewal_date', 'end_date', 'fdate']) && $commercialpolicy->$field) {
                    $this->$field = Carbon::parse($commercialpolicy->$field)->format('d-m-Y');
                } else {
                    $this->$field = $commercialpolicy->$field;
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
	        
	        $commercialPolicy = CommercialPolicyModel::updateOrCreate(['id' => $this->policy_id], $fields);
	    } else {
	        \DB::beginTransaction();
			try {
			    $clientPolicy = $this->createClientPolicy($activeStatus);
			    $this->policy_id = $clientPolicy->id;
			    $fields['id'] = $this->policy_id;
			    $commercialPolicy = CommercialPolicyModel::create($fields);
			    $clientPolicy->policy_id = $this->policy_id;
			    $clientPolicy->save();

			    \DB::commit();

                $this->dispatch('refreshActiveProducts')->to(\App\Livewire\Clienttabs\ActiveProductsTab::class);

			} catch (\Throwable $e) {
			    \DB::rollBack();
			    throw $e;
			}
	    }
  
        $prefix = (new CommercialPolicyModel())->getPrefix();
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
                'subject'       => "Commercial Policy Notes - {$clientName}",
                'text'          => $noteText,
                'note_type'     => 'system',
                'created_by'    => Auth::id(),
            ]);
        }

        $message = $this->policy_id
            ? "Commercial policy data updated successfully ({$policyCode})."
            : "Commercial policy data created successfully ({$policyCode}).";

        session()->flash('addproduct_message', $message);


        if(!$this->policy_id) {
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

    private function getFields()
    {
        $dateFields = [
            'start_date',
            'renewal_date',
            'end_date',
            'claimdate1',
            'claimdate2',
            'claimdate3',
            'claimdate4',
            'claimdate5',
        ];

        return collect($this->rules)->keys()->mapWithKeys(function ($field) use ($dateFields) {
            $value = $this->$field;

            // Empty string → NULL (important for DB)
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

    public function render()
    {
        return view('livewire.policies.commercial-policy-form');
    }
}
