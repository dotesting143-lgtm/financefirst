<?php

namespace App\Livewire\Policies;

use Livewire\Component;
use App\Models\LifePolicy;
use App\Models\ClientPolicies;
use Carbon\Carbon;
use App\Models\ProductNotes;
use Illuminate\Support\Facades\Auth;

class LifePolicyForm extends Component
{
    public $policy_id, $policy;
    public $client_id, $start_date, $renewal_date, $end_date, $term, $curinsurer, $coveramt_1, 
           $coveramt_2, $specill_1, $specill_2, $specill_type_11, $specill_type_21, $hoscash_1, $hoscash_2, 
           $occclass1_11, $occclass1_21, $acccover_1, $acccover_2, $occclass2_11, $occclass2_21, 
           $height_ft_1, $height_ft_2, $height_in_1, $height_in_2, $height_me_1, $height_me_2, 
           $height_cm_1, $height_cm_2, $weight_st_1, $weight_st_2, $weight_lb_1, $weight_lb_2, 
           $weight_kg_1, $weight_kg_2, $guarantee1, $infprotect1, $startimm1, $index1, $pricepledge1, 
           $payfreq, $upfrontpay1, $numpay, $needs_obj_text, $per_circ_text, $fin_sit_text, 
           $risk_profile_text, $recommend_text;
    public $internal_status = 'New', $uw_status = 'Not Filed', $active, $propinsurer, $propinsurer_num, $monthprem;
    public $type;
    public $isActive = 1;
    public $policy_type = 'life_policy';
    public $creation_date;
    public $left_our_agency = 0;

    protected $rules = [
        'client_id' => 'required|max:255',
        'internal_status' => 'nullable|string',
        'uw_status' => 'nullable|string',
        'type' => 'required|string|max:255',
        'start_date' => 'required|date',
        'renewal_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'term' => 'required|string|max:255',
        'curinsurer' => 'nullable|string|max:255',
        'propinsurer' => 'required|string|max:255',
        'propinsurer_num' => 'nullable|string|max:255',
        'coveramt_1' => 'required|string',
        'coveramt_2' => 'nullable|string|max:255',
        'specill_1' => 'nullable|string|max:255',
        'specill_2' => 'nullable|string|max:255',
        'specill_type_11' => 'required|string|max:255',
        'specill_type_21' => 'nullable|string|max:255',
        'hoscash_1' => 'nullable|string|max:255',
        'hoscash_2' => 'nullable|string|max:255',
        'occclass1_11' => 'nullable|string|max:255',
        'occclass1_21' => 'nullable|string|max:255',
        'acccover_1' => 'nullable|string|max:255',
        'acccover_2' => 'nullable|string|max:255',
        'occclass2_11' => 'nullable|string|max:255',
        'occclass2_21' => 'nullable|string|max:255',
        'height_ft_1' => 'nullable|string|max:255',
        'height_ft_2' => 'nullable|string|max:255',
        'height_in_1' => 'nullable|string|max:255',
        'height_in_2' => 'nullable|string|max:255',
        'height_me_1' => 'nullable|string|max:255',
        'height_me_2' => 'nullable|string|max:255',
        'height_cm_1' => 'nullable|string|max:255',
        'height_cm_2' => 'nullable|string|max:255',
        'weight_st_1' => 'nullable|string|max:255',
        'weight_st_2' => 'nullable|string|max:255',
        'weight_lb_1' => 'nullable|string|max:255',
        'weight_lb_2' => 'nullable|string|max:255',
        'weight_kg_1' => 'nullable|string|max:255',
        'weight_kg_2' => 'nullable|string|max:255',
        'guarantee1' => 'required|string|max:255',
        'infprotect1' => 'nullable|string|max:255',
        'startimm1' => 'required|string|max:255',
        'index1' => 'nullable|string|max:255',
        'pricepledge1' => 'required|string|max:10',
        'monthprem' => 'required|string',
        'payfreq' => 'nullable|string|max:255',
        'upfrontpay1' => 'nullable|string|max:255',
        'numpay' => 'nullable|string',
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
        if (!empty($policy_id)) {
            $this->policy_id = $policy_id;
            $this->isActive = 0;
            $this->fetchPolicy();
        }
        $this->start_date = $this->start_date ?? now()->format('d-m-Y');
    }

    public function fetchPolicy()
    {
        $lifePolicy = LifePolicy::findOrFail($this->policy_id);
        foreach ($this->rules as $field => $rule) {
            if (isset($lifePolicy->$field)) {
                if (in_array($field, ['start_date', 'renewal_date', 'end_date', 'fdate']) && $lifePolicy->$field) {
                    $this->$field = Carbon::parse($lifePolicy->$field)->format('d-m-Y');
                } else {
                    $this->$field = $lifePolicy->$field;
                }
            }
        }

        $clientPolicy = ClientPolicies::findOrFail($this->policy_id);

        if ($clientPolicy) {
            $this->internal_status = $clientPolicy->internal_status;
            $this->uw_status = $clientPolicy->uw_status;
            $this->monthprem = $clientPolicy->monthprem;
            $this->propinsurer = $clientPolicy->propinsurer;
            $this->propinsurer_num = $clientPolicy->propinsurer_num;
            $this->left_our_agency  = (bool) $clientPolicy->left_our_agency;
        }
    }

    public function savePolicy()
    {
    	$this->validate($this->rules);
        $this->start_date = $this->formatDate($this->start_date);
        $this->renewal_date = $this->formatDate($this->renewal_date);
        $this->end_date = $this->formatDate($this->end_date);
        
        $fields = $this->getFields();

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
		        ]);
	        } else {
	        	$clientPolicy = $this->createClientPolicy($activeStatus, $this->policy_id);
	        }
	        $lifePolicy = LifePolicy::updateOrCreate(['id' => $this->policy_id], $fields);
	    } else {
	        \DB::beginTransaction();
			try {
			    $clientPolicy = $this->createClientPolicy($activeStatus);
			    $this->policy_id = $clientPolicy->id;
			    $fields['id'] = $this->policy_id;
			    $lifePolicy = LifePolicy::create($fields);
			    $clientPolicy->policy_id = $this->policy_id;
			    $clientPolicy->save();
			    \DB::commit();

                $this->dispatch('refreshActiveProducts')->to(\App\Livewire\Clienttabs\ActiveProductsTab::class);

			} catch (\Throwable $e) {
			    \DB::rollBack();
			    throw $e;
			}
	    }
  
        $prefix = (new LifePolicy())->getPrefix();
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
                'subject'       => "Life Policy Notes - {$clientName}",
                'text'          => $noteText,
                'note_type'     => 'system',
                'created_by'    => Auth::id(),
            ]);
        }


        $message = $this->policy_id
            ? "Life policy data updated successfully ({$policyCode})."
            : "Life policy data created successfully ({$policyCode}).";

        session()->flash('addproduct_message', $message);

        $this->dispatch('scrollToTop');

        if (!$this->policy_id) {
            $this->resetInputFields();
        }

        if ($this->internal_status === 'Closed' || $this->internal_status === 'Cancelled') {
            // Redirect to clients page with parameters to open archived tab
            return redirect()->route('clients', [
                'openclient' => $this->client_id,
                'tab' => 'archived'
            ]);
        } else {
            // Redirect to clients page with parameters to open active tab
            return redirect()->route('clients', [
                'openclient' => $this->client_id,
                'tab' => 'active'
            ]);
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
        return view('livewire.policies.life-policy-form');
    }

    private function getFields()
    {
        return collect($this->rules)->keys()->mapWithKeys(fn($field) => [$field => $this->$field])->toArray();
    }

    private function resetInputFields()
    {
        foreach ($this->getFields() as $key => $val) {
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
