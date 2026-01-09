<div x-data="{ selectedProduct: '' }">
    <div class="addproduct-form bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6 items-center">
            <div class="sm:col-span-2">
                <label for="selectproduct" class="block oxford-blue text-xs lg:text-sm font-medium">
                    {{ __('Product') }}
                </label>
            </div>
            <div class="sm:col-span-4">
                <select 
                    id="selectproduct" 
                    x-model="selectedProduct"
                    class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray"
                >
                    <option selected value="">{{ __('Please select Product') }}</option>
                    <option value="canonly_policy">{{ __('Cancer Only') }}</option>
                    <option value="commercial_policy">{{ __('Commercial Policy') }}</option>
                    <option value="house_policy">{{ __('House Policy') }}</option>
                    <option value="life_policy">{{ __('Life Policy') }}</option>
                    <option value="motor_policy">{{ __('Motor Policy') }}</option>
                    <option value="mortgage_policy">{{ __('Mortgage') }}</option>
                    <option value="pension_policy">{{ __('Pension') }}</option>
                    <option value="peracc_policy">{{ __('Personal Accident') }}</option>
                </select>
            </div>
        </div>
    </div>
    <div x-show="selectedProduct === 'canonly_policy'">
        <livewire:policies.cancer-policy-form :client_id="$client_id" :key="$client_id" />
    </div>
    <div x-show="selectedProduct === 'commercial_policy'">
        <livewire:policies.commercial-policy-form :client_id="$client_id" :key="$client_id" />
    </div>
    <div x-show="selectedProduct === 'house_policy'">
        <livewire:policies.house-policy-form :client_id="$client_id" :key="$client_id" />
    </div>
    <div x-show="selectedProduct === 'life_policy'">
        <livewire:policies.life-policy-form :client_id="$client_id" :key="$client_id" />
    </div>
    <div x-show="selectedProduct === 'motor_policy'">
        <livewire:policies.motor-policy-form :client_id="$client_id" :key="$client_id" />
    </div>
    <div x-show="selectedProduct === 'mortgage_policy'">
        <livewire:policies.mortgage-policy-form :client_id="$client_id" :key="$client_id" />
    </div>
    <div x-show="selectedProduct === 'pension_policy'">
        <livewire:policies.pension-policy-form :client_id="$client_id" :key="$client_id" />
    </div>
    <div x-show="selectedProduct === 'peracc_policy'">
        <livewire:policies.accident-policy-form :client_id="$client_id" :key="$client_id" />
    </div>
</div>