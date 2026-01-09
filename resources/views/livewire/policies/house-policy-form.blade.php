<div class="house-policy-form bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
    <form wire:submit="saveHousePolicy">
        <input type="hidden" wire:model="client_id" value="{{ $client_id }}">
        @error('client_id') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
        <div class="w-full relative" x-data="{ active: @json($isActive) }">
            <div class="accordion w-full relative" x-data="{ id: 1 }">
                <div class="grid grid-cols-2 lg:grid-cols-6 gap-4 lg:gap-6 bg-oxford-blue text-white rounded-md py-3 px-4 lg:px-7 !pe-16 items-center relative">
                    <div class="col-span-full lg:col-span-1">
                        <div class="text-sm lg:text-base text-left font-medium">
                            {{ __('House Policy') }}
                        </div>
                        @if (isset($policy))
                        <div class="text-sm lg:text-base text-left font-small">
                            {{ $policy->getFullPolicyId() }} {{ $policy->clientPolicy?->propinsurer_num ? '(' . $policy->clientPolicy?->propinsurer_num . ')' : '' }}
                        </div>
                        @endif
                    </div>
                    
                    <div class="col-span-full sm:col-span-1">
                        <label for="internal_status" class="block oxford-blue text-xs lg:text-sm font-medium mb-1">{{ __('Internal Status') }}</label>
                        <select id="internal_status" wire:model="internal_status" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full px-3 py-1 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" @click="if(active !== id) active = id">
                            <option selected value="">{{ __('Select Internal Status') }}</option>
                            <option value="New">{{ __('New') }}</option>
                            <option value="With U/W">{{ __('With U/W') }}</option>
                            <option value="Commission Due">{{ __('Commission Due') }}</option>
                            <option value="Closed">{{ __('Closed') }}</option>
                            <option value="Cancelled">{{ __('Cancelled') }}</option>
                            <option value="NTU">{{ __('NTU') }}</option>
                        </select>
                        @error('internal_status') <span class="text-red-500 block text-xs lg:text-xs mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-span-full sm:col-span-1">
                        <label for="uw_status" class="block oxford-blue text-xs lg:text-sm font-medium mb-1">{{ __('U/W Status') }}</label>
                        <select id="uw_status" wire:model="uw_status" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full px-3 py-1 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
                            <option selected value="">{{ __('Select U/W Status') }}</option>
                            <option value="Not Filed">{{ __('Not Filed') }}</option>
                            <option value="Pending">{{ __('Pending') }}</option>
                            <option value="Approved">{{ __('Approved') }}</option>
                            <option value="Further Info">{{ __('Further Info') }}</option>
                            <option value="Declined">{{ __('Declined') }}</option>
                        </select>
                        @error('uw_status') <span class="text-red-500 block text-xs lg:text-xs mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-span-full sm:col-span-1 text-center">
                        <livewire:generate-notes-pdf :policyId="$policy_id" />
                    </div>
                    <div class="col-span-full sm:col-span-1 text-center">
                        <livewire:generate-thankyou-pdf :policyId="$policy_id" />
                    </div>
                    <div class="col-span-full sm:col-span-1 text-center">
                        <livewire:generate-letter-pdf :policyId="$policy_id" />
                    </div>
                    <div class="svg-wrapper pointer-events-auto cursor-pointer absolute inset-y-0 end-0 flex items-center pe-3 lg:pe-7 active:text-vivid-amethyst focus:text-vivid-amethyst hover:text-vivid-amethyst" 
                         @click="active = (active === id ? null : id)">
                        <!-- Show 'plus' icon when inactive -->
                        <span x-show="active !== id">
                            @svg('plus', 'icon icon-plus w-7 h-7')
                        </span>
                        <!-- Show 'minus' icon when active -->
                        <span x-show="active === id">
                            @svg('minus', 'icon icon-minus w-7 h-7')
                        </span>
                    </div>
                </div>
                @if (session()->has('addproduct_message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 p-2 xl:p-3 shadow-md my-3" role="alert">
                      <div class="flex">
                        <div>
                          <p class="text-sm">{{ session('addproduct_message') }}</p>
                        </div>
                      </div>
                    </div>
                @endif
                <div class="mt-8 w-full relative" x-show="active === id" x-collapse>
                    @include('livewire.product.housepolicy')
                </div>
            </div>
        </div>
    </form>
</div>