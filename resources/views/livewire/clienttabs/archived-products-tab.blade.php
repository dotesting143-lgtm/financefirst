<div wire:init="fetchPolicies">
    @if($policies->isEmpty())
        <div class="text-sm lg:text-sm px-6 py-3">No archived products found</div>
    @else
        @foreach ($policies as $policy)
            @if(class_basename($policy) == 'CancerPolicy')
                <livewire:policies.cancer-policy-form wire:key="cancer-{{ $policy->id }}" :client_id="$client_id" :policy_id="$policy->id" :policy="$policy" />
            @endif
            @if(class_basename($policy) == 'HousePolicy')
                <livewire:policies.house-policy-form wire:key="house-{{ $policy->id }}" :client_id="$client_id" :policy_id="$policy->id" :policy="$policy" />
            @endif
            @if(class_basename($policy) == 'LifePolicy')
                <livewire:policies.life-policy-form wire:key="life-{{ $policy->id }}" :client_id="$client_id" :policy_id="$policy->id" :policy="$policy" />
            @endif
            @if(class_basename($policy) == 'MortgagePolicy')
                <livewire:policies.mortgage-policy-form wire:key="mortgage-{{ $policy->id }}" :client_id="$client_id" :policy_id="$policy->id" :policy="$policy" />
            @endif
            @if(class_basename($policy) == 'PensionPolicy')
                <livewire:policies.pension-policy-form wire:key="pension-{{ $policy->id }}" :client_id="$client_id" :policy_id="$policy->id" :policy="$policy" />
            @endif
            @if(class_basename($policy) == 'PerAccPolicy')
                <livewire:policies.accident-policy-form wire:key="accident-{{ $policy->id }}" :client_id="$client_id" :policy_id="$policy->id" :policy="$policy" />
            @endif
            @if(class_basename($policy) == 'CommercialPolicy')
                <livewire:policies.commercial-policy-form wire:key="commercial-{{ $policy->id }}" :client_id="$client_id" :policy_id="$policy->id" :policy="$policy" />
            @endif
            @if(class_basename($policy) == 'MotorPolicy')
                <livewire:policies.motor-policy-form wire:key="motor-{{ $policy->id }}" :client_id="$client_id" :policy_id="$policy->id" :policy="$policy" />
            @endif
        @endforeach
        <div class="text-sm lg:text-sm px-6 py-3">{{ count($policies) }} archived products</div>
    @endif
</div>
