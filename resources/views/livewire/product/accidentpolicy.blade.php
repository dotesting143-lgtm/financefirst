<div class="flex justify-center pb-8">
    <button  wire:click="savePolicy" type="button" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
        {{ __('Save Now') }}
    </button>
</div>
<div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
	<div class="sm:col-span-4">
        <label for="type" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Type') }}</label>
        <input readonly type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="type"  wire:model="type" value="{{ __('Personal Accident Insurance') }}">
		@error('type') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
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
      	<label for="start_date" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Start Date') }}</label>
      	<div class="relative w-full">
        	<div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
          		@svg('calendar', 'icon icon-plus w-6 h-6 text-black')
        	</div>
        	<input id="start_date" x-ref="datepicker1"
        		x-init="
                flatpickr($refs.datepicker1, {
                    dateFormat: 'd-m-Y',
                    allowInput: true,
                    onChange: function(selectedDates, dateStr) {
                        @this.set('start_date', dateStr)
                    }
                })
            " wire:model="start_date" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('Start Date') }}">
				@error('start_date') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
      	</div>
  	</div>
  	<div class="sm:col-span-2">
      	<label for="renewal_date" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Renewal Date') }}</label>
      	<div class="relative w-full">
        	<div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
          		@svg('calendar', 'icon icon-plus w-6 h-6 text-black')
        	</div>
        	<input id="renewal_date" x-ref="datepicker2"
        		x-init="flatpickr($refs.datepicker2, {
            	enableTime: false,
            	dateFormat: 'd-m-Y'
        		})" wire:model="renewal_date" datepicker datepicker-orientation="bottom right" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('Renewal Date') }}">
				@error('renewal_date') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
      	</div>
  	</div>
  	<div class="sm:col-span-2">
      	<label for="end_date" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('End Date') }}</label>
      	<div class="relative w-full">
        	<div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
          		@svg('calendar', 'icon icon-plus w-6 h-6 text-black')
        	</div>
        	<input id="end_date" x-ref="datepicker3"
        		x-init="flatpickr($refs.datepicker3, {
            	enableTime: false,
            	dateFormat: 'd-m-Y'
        		})" wire:model="end_date" datepicker datepicker-orientation="bottom right" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('End Date') }}">
				@error('end_date') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
      	</div>
  	</div>
  	<div class="sm:col-span-2">
        <label for="coveramt" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Cover (€)') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="coveramt"  wire:model="coveramt">
		@error('coveramt') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="curinsurer" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Current Insurer') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="curinsurer"  wire:model="curinsurer">
		@error('curinsurer') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="propinsurer" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Proposed Insurer') }}</label>
        <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <select id="propinsurer" wire:model="propinsurer" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
	                <option selected value="">{{ __('Select Proposed Insurer') }}</option>
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
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="propinsurer_num" placeholder="{{ __('Number') }}" wire:model="propinsurer_num">
				@error('propinsurer_num') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
            </div> 
        </div>
    </div>
    <div class="sm:col-span-2">
        <label for="curinsurer" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Benefit Type') }}</label>
        <select id="propinsurer" wire:model="propinsurer" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
            <option selected value="">{{ __('Select Benefit Type') }}</option>
            <option value="Gold">{{ __('Gold') }}</option>
			<option value="Platinum">{{ __('Platinum') }}</option>
        </select>
		@error('propinsurer') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="curinsurer" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Cover type') }}</label>
        <select id="propinsurer" wire:model="propinsurer" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
            <option selected value="">{{ __('Select Cover type') }}</option>
            <option value="Policy Holder">{{ __('Policy Holder') }}</option>
			<option value="Policy Holder and Children">{{ __('Policy Holder and Children') }}</option>
			<option value="Policy Holder and Partner/Spouse">{{ __('Policy Holder and Partner/Spouse') }}</option>
			<option value="Whole Family">{{ __('Whole Family') }}</option>
        </select>
		@error('propinsurer') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
      	<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Cover to start immediately') }}</label>
      	<div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
          	<div class="flex items-center">
              	<input checked="" id="startimm1-yes" wire:model="startimm1" name="startimm1" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="startimm1-yes" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Yes</label>
          	</div>
          	<div class="flex items-center">
              	<input id="startimm1-no" wire:model="startimm1" name="startimm1" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="startimm1-no" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">No</label>
          	</div>
      	</div>
		  @error('startimm1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
  	</div>
  	<div class="sm:col-span-2">
      	<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Price Pledge') }}</label>
      	<div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
          	<div class="flex items-center">
              	<input checked="" id="pricepledge1yes" wire:model="pricepledge1" name="pricepledge1" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="pricepledge1-yes" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Yes</label>
          	</div>
          	<div class="flex items-center">
              	<input id="pricepledge1-no" wire:model="pricepledge1" name="pricepledge1" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="pricepledge1-no" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">No</label>
          	</div>
      	</div>
		  @error('pricepledge1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
  	</div>
  	<div class="sm:col-span-2">
        <label for="monthprem" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Monthly Premium (€)') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="monthprem"  wire:model="monthprem">
		@error('monthprem') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="payfreq" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Payment Frequency (months)') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="payfreq"  wire:model="payfreq">
		@error('payfreq') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
      	<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Upfront Payment') }}</label>
      	<div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
          	<div class="flex items-center">
              	<input checked="" id="upfrontpay1-yes" wire:model="upfrontpay1" name="upfrontpay1" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="upfrontpay1-yes" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Yes</label>
          	</div>
          	<div class="flex items-center">
              	<input id="upfrontpay1-no" wire:model="upfrontpay1" name="upfrontpay1" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="upfrontpay1-no" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">No</label>
          	</div>
      	</div>
		  @error('upfrontpay1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
  	</div>
  	<div class="sm:col-span-2">
        <label for="fdate" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('First Payment Date') }}</label>
      	<div class="relative w-full">
        	<div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
          		@svg('calendar', 'icon icon-plus w-6 h-6 text-black')
        	</div>
        	<input id="fdate" x-ref="datepicker4"
        		x-init="flatpickr($refs.datepicker4, {
            	enableTime: false,
            	dateFormat: 'd-m-Y'
        		})" wire:model="fdate" datepicker datepicker-orientation="bottom right" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('End Date') }}">
				@error('fdate') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
      	</div>
    </div>
    <div class="sm:col-span-2">
        <label for="numpay" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Number of Payments') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="numpay"  wire:model="numpay">
		@error('numpay') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="col-span-full">
        <label for="needs_obj_text" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Needs And Objectives: (Please include a minimum of 4 reasons)') }}</label>
        <textarea rows="4" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="needs_obj_text" wire:model="needs_obj_text"></textarea>
		@error('needs_obj_text') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="col-span-full">
        <label for="per_circ_text" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Personal Circumstances: (Please include a minimum of 4 reasons)') }}</label>
        <textarea rows="4" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="per_circ_text" wire:model="per_circ_text"></textarea>
		@error('per_circ_text') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="col-span-full">
        <label for="fin_sit_text" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Financial Situation: (Please include a minimum of 4 reasons)') }}</label>
        <textarea rows="4" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="fin_sit_text" wire:model="fin_sit_text"></textarea>
		@error('fin_sit_text') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="col-span-full">
        <label for="risk_profile_text" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Risk Profile: (Please include a minimum of 4 reasons)') }}</label>
        <textarea rows="4" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="risk_profile_text" wire:model="risk_profile_text"></textarea>
		@error('risk_profile_text') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="col-span-full">
        <label for="recommend_text" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Recommendations') }}</label>
        <textarea rows="4" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="recommend_text" wire:model="recommend_text"></textarea>
		@error('recommend_text') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
</div>
<div class="flex justify-center pt-8">
    <button  wire:click="savePolicy" type="button" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
    	{{ __('Save Now') }}
    </button>
</div>