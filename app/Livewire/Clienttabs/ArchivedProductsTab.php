<?php

namespace App\Livewire\Clienttabs;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\CancerPolicy;
use App\Models\HousePolicy;
use App\Models\LifePolicy;
use App\Models\MortgagePolicy;
use App\Models\PensionPolicy;
use App\Models\PerAccPolicy;
use App\Models\CommercialPolicy;
use App\Models\MotorPolicy;
use Illuminate\Support\Collection;

class ArchivedProductsTab extends Component
{
    public $client_id;
    public $policies;

    public function mount($client_id = null)
    {
        $this->client_id = $client_id;
        $this->fetchPolicies();
    }

    public function fetchPolicies()
    {
        $clientPolicies = \App\Models\ClientPolicies::where('client_id', $this->client_id)
            ->where('active', 'Inactive')
            ->get();

        $this->policies = collect();

        foreach ($clientPolicies as $clientPolicy) {
            $model = $this->getModelFromType($clientPolicy->policy_type);
            if ($model && class_exists($model)) {
                $policy = $model::find($clientPolicy->policy_id);
                if ($policy) {
                    $this->policies->push($policy);
                }
            }
        }
    }

    private function getModelFromType($type)
    {
        return match ($type) {
            'canonly_policy' => CancerPolicy::class,
            'house_policy' => HousePolicy::class,
            'life_policy' => LifePolicy::class,
            'mortgage_policy' => MortgagePolicy::class,
            'pension_policy' => PensionPolicy::class,
            'peracc_policy' => PerAccPolicy::class,
            'commercial_policy' => CommercialPolicy::class,
            'motor_policy' => MotorPolicy::class,
            default => null,
        };
    }


    public function render()
    {
        return view('livewire.clienttabs.archived-products-tab');
    }
}
