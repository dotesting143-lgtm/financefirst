<div wire:init="fetchPolicies">
    @if($policies->isEmpty())
        <p>No policies found for this client.</p>
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
    @endif
</div>
<script>
document.addEventListener("livewire:navigated", initStatusWatchers);
document.addEventListener("livewire:initialized", initStatusWatchers);

function initStatusWatchers() {

    document.querySelectorAll('select.internal_status, select#internal_status')
        .forEach(select => {

            if (select.dataset.bound) return; // avoid duplicate binding
            select.dataset.bound = true;

            select.addEventListener("change", function () {

                // find the Alpine accordion root (where x-data is)
                let alpineRoot = this.closest('[x-data]');
                if (!alpineRoot) return;

                // access Alpine component
                let comp = Alpine.$data(alpineRoot);
                if (!comp) return;

                // only open if not already open
                if (comp.active !== comp.id) {
                    comp.active = comp.id;  // ✅ OPEN accordion
                }
            });
        });
}
</script>


