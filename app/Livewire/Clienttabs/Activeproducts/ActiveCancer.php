<?php
namespace App\Livewire\Clienttabs\Activeproducts;

use Livewire\Component;
use App\Models\CancerPolicy as CancerPolicyModel;

class ActiveCancer extends Component
{
    public $client_id;
    public $policy_id;
    public $cancerpolicy;

    protected $rules = [
        'client_id' => 'required|max:255',
        'type' => 'required|string|max:255',
        'start_date' => 'required|date',
        'renewal_date' => 'date',
        'end_date' => 'date',
        'term' => 'required|string|max:255',
        'curinsurer' => 'nullable|string|max:255',
        'propinsurer' => 'nullable|string|max:255',
        'propinsurer_num' => 'nullable|string|max:255',
        'cover' => 'nullable|string|max:255',
        'bentype' => 'required|string|max:255',
        'covtype' => 'required|string|max:255',
        'startimm1' => 'required|string|max:255',
        'pricepledge1' => 'required|string|max:10',
        'payfreq' => 'nullable|string|max:255',
        'monthprem' => 'required|string|max:255',
        'upfrontpay1' => 'nullable|string|max:255',
        'fdate1' => 'required|date',
        'numpay' => 'nullable|string|max:255',
        'needs_obj_text' => 'required|string|max:255',
        'per_circ_text' => 'required|string|max:255',
        'fin_sit_text' => 'required|string|max:255',
        'risk_profile_text' => 'required|string|max:255',
        'recommend_text' => 'required|string|max:255'
    ];

    public function mount($client_id = null, $policy_id = null)
    {
        $this->client_id = $client_id;
        $this->policy_id = $policy_id;
        $this->fetchPolicy();
    }

    public function fetchPolicy()
    {
        $cancerpolicy = CancerPolicyModel::findOrFail($this->policy_id);
        foreach ($this->rules as $field => $rule) {
            $this->$field = $cancerpolicy->$field;
        }
        $this->cancerpolicy = $cancerpolicy;
    }

    public function render()
    {
        return view('livewire.clienttabs.activeproducts.active-cancer');
    }
}

