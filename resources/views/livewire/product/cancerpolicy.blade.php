<div class="flex justify-center pb-8">
    <button type="submit" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
        {{ __('Save Now') }}
    </button>
</div>
<div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6 mt-8">
    <div class="sm:col-span-2">
        <label for="type" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Type') }}</label>
        <input readonly type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="cancerpolicy_type"  wire:model="type" value="Cancer Only Insurance">
        @error('type') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="term" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Term (years)') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="term"  wire:model="term">
        @error('term') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label class="flex items-center gap-2 cursor-pointer mt-8">
            <input
                type="checkbox"
                wire:model="left_our_agency"
                class="w-4 h-4 lg:w-5 lg:h-5 text-vivid-sky-blue border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2"
            >
            <span class="text-xs lg:text-sm font-medium text-cool-gray">
                {{ __('Left Our Agency') }}
            </span>
        </label>
    </div>
    <div class="sm:col-span-2">
        <label for="cancerpolicy_startdate" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Start Date') }}</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                @svg('calendar', 'icon icon-plus w-6 h-6 text-black')
            </div>
            <input id="cancerpolicy_startdate" x-ref="datepicker1"
                x-init="flatpickr($refs.datepicker1, {
                enableTime: false,
                dateFormat: 'd-m-Y'
                })" wire:model="start_date" datepicker datepicker-orientation="bottom right" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('Start Date') }}">
        </div>
        @error('start_date') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="cancerpolicy_renewaldate" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Renewal Date') }}</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                @svg('calendar', 'icon icon-plus w-6 h-6 text-black')
            </div>
            <input id="cancerpolicy_renewaldate" x-ref="datepicker2"
                x-init="flatpickr($refs.datepicker2, {
                enableTime: false,
                dateFormat: 'd-m-Y'
                })" wire:model="renewal_date" datepicker datepicker-orientation="bottom right" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('Renewal Date') }}">
        </div>
        @error('renewal_date') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="cancerpolicy_enddate" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('End Date') }}</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                @svg('calendar', 'icon icon-plus w-6 h-6 text-black')
            </div>
            <input id="cancerpolicy_enddate" x-ref="datepicker3"
                x-init="flatpickr($refs.datepicker3, {
                enableTime: false,
                dateFormat: 'd-m-Y'
                })" wire:model="end_date" datepicker datepicker-orientation="bottom right" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('End Date') }}">
        </div>
        @error('end_date') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="cancerpolicy_current" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Current Insurer') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="cancerpolicy_current"  wire:model="curinsurer">
        @error('curinsurer') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="lengthyears" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Proposed Insurer') }}</label>
        <div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <select id="cancerpolicy_proposed" wire:model="propinsurer" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
                    <option selected value="">{{ __('Select Select') }}</option>
                    <option value="AIG">{{ __('AIG') }}</option>
                    <option value="Aviva">{{ __('Aviva') }}</option>
                    <option value="Brokers Ireland">{{ __('Brokers Ireland') }}</option>
                    <option value="EZ Fees ">{{ __('EZ Fees') }}</option>
                    <option value="Friends First">{{ __('Friends First') }}</option>
                    <option value="Greenman">{{ __('Greenman') }}</option>
                    <option value="Hive">{{ __('Hive') }}</option>
                    <option value="ICS">{{ __('ICS') }}</option>
                    <option value="Irish Life">{{ __('Irish Life') }}</option>
                    <option value="MIS Underwriting">{{ __('MIS Underwriting') }}</option>
                    <option value="New Court">{{ __('New Court') }}</option>
                    <option value="New Ireland">{{ __('New Ireland') }}</option>
                    <option value="Royal London">{{ __('Royal London') }}</option>
                    <option value="Wealth Options">{{ __('Wealth Options') }}</option>
                    <option value="Zurich">{{ __('Zurich') }}</option>
                </select> 
                @error('propinsurer') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
            </div>
            <div class="sm:col-span-3">
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="cancerpolicy_proposed_number" placeholder="{{ __('Number') }}" wire:model="propinsurer_num">
                @error('propinsurer_num') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
            </div> 
        </div>
    </div>
    <div class="sm:col-span-2">
        <label for="cancerpolicy_cover" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Cover (€)') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="cancerpolicy_cover"  wire:model="cover">
        @error('cover') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="cancerpolicy_benefittype" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Benefit Type (€)') }}</label>
        <select id="cancerpolicy_benefittype" wire:model="bentype" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
            <option selected value="">{{ __('Select Benefit Type') }}</option>
            <option value="Standard">{{ __('Standard') }}</option>
            <option value="Double">{{ __('Double') }}</option> 
        </select>
        @error('bentype') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="cancerpolicy_covertype" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Cover type') }}</label>
        <select id="cancerpolicy_covertype" wire:model="covtype" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
            <option selected value="">{{ __('Select Cover Type') }}</option>
            <option value="Policy Holder">{{ __('Policy Holder') }}</option>
            <option value="Policy Holder and Partner/Spouse">{{ __('Policy Holder and Partner/Spouse') }}</option> 
        </select>
        @error('covtype') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Cover to start immediately') }}</label>
        <div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
            <div class="flex items-center">
                <input checked="" id="cancerpolicy_cover_yes" wire:model="startimm1" name="cancerpolicy_cover" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                <label for="cancerpolicy_cover_yes" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Yes</label>
            </div>
            <div class="flex items-center">
                <input id="cancerpolicy_cover_no" wire:model="startimm1" name="cancerpolicy_cover" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                <label for="cancerpolicy_cover_no" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">No</label>
            </div>
        </div>
        @error('startimm1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Price Pledge') }}</label>
        <div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
            <div class="flex items-center">
                <input checked="" id="cancerpolicy_price_yes" wire:model="pricepledge1" name="cancerpolicy_price" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                <label for="cancerpolicy_price_yes" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Yes</label>
            </div>
            <div class="flex items-center">
                <input id="cancerpolicy_price_no" wire:model="pricepledge1" name="cancerpolicy_price" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                <label for="cancerpolicy_price_no" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">No</label>
            </div>
        </div>
        @error('pricepledge1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="cancerpolicy_monthlypremium" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Monthly Premium (€)') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="cancerpolicy_monthlypremium"  wire:model="monthprem">
        @error('monthprem') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="cancerpolicy_paymentfrequency" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Payment Frequency (months)') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="cancerpolicy_paymentfrequency"  wire:model="payfreq">
        @error('payfreq') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Upfront Payment') }}</label>
        <div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
            <div class="flex items-center">
                <input checked="" id="cancerpolicy_upfrontpayment_yes" wire:model="upfrontpay1" name="cancerpolicy_upfrontpayment" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                <label for="cancerpolicy_upfrontpayment_yes" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Yes</label>
            </div>
            <div class="flex items-center">
                <input id="cancerpolicy_upfrontpayment_no" wire:model="upfrontpay1" name="cancerpolicy_upfrontpayment" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                <label for="cancerpolicy_upfrontpayment_no" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">No</label>
            </div>
        </div>
        @error('upfrontpay1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="cancerpolicy_fdate1" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('First Payment Date') }}</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                @svg('calendar', 'icon icon-plus w-6 h-6 text-black')
            </div>
            <input id="cancerpolicy_fdate1" x-ref="datepicker4"
                x-init="flatpickr($refs.datepicker4, {
                enableTime: false,
                dateFormat: 'd-m-Y'
                })" wire:model="fdate1" datepicker datepicker-orientation="bottom right" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('First Payment Date') }}">
            @error('fdate1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="sm:col-span-2">
        <label for="cancerpolicy_numberofpayments" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Number of Payments') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="cancerpolicy_numberofpayments"  wire:model="numpay">
        @error('numpay') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="col-span-full">
        <label for="cancerpolicy_objectives" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Needs And Objectives: (Please include a minimum of 4 reasons)') }}</label>
        <textarea rows="4" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="cancerpolicy_objectives" wire:model="needs_obj_text"></textarea>
        @error('needs_obj_text') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="col-span-full">
        <label for="cancerpolicy_circumstances" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Personal Circumstances: (Please include a minimum of 4 reasons)') }}</label>
        <textarea rows="4" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="cancerpolicy_circumstances" wire:model="per_circ_text"></textarea>
        @error('per_circ_text') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="col-span-full">
        <label for="cancerpolicy_situation" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Financial Situation: (Please include a minimum of 4 reasons)') }}</label>
        <textarea rows="4" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="cancerpolicy_situation" wire:model="fin_sit_text"></textarea>
        @error('fin_sit_text') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="col-span-full">
        <label for="cancerpolicy_riskprofile" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Risk Profile: (Please include a minimum of 4 reasons)') }}</label>
        <textarea rows="4" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="cancerpolicy_riskprofile" wire:model="risk_profile_text"></textarea>
        @error('risk_profile_text') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="col-span-full">
        <label for="cancerpolicy_pecommendations" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Recommendations') }}</label>
        <textarea rows="4" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="cancerpolicy_pecommendations" wire:model="recommend_text"></textarea>
        @error('recommend_text') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
</div>
<div class="flex justify-center pt-8">
    <button type="submit" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
        {{ __('Save Now') }}
    </button>
</div>