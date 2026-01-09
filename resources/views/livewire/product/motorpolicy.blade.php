<div class="flex justify-center pb-8">
    <button wire:click="savePolicy" type="button" type="button" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
        {{ __('Save Now') }}
    </button>
</div>
<div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
	<div class="sm:col-span-2">
        <label for="type" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Type') }}</label>
        <input readonly type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="type"  wire:model="type" value="{{ __('Motor Insurance') }}">
        @error('type') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="term" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Term (months)') }}</label>
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
      	<label for="start_date" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Start Date') }}</label>
      	<div class="relative w-full">
        	<div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
          		@svg('calendar', 'icon icon-plus w-6 h-6 text-black')
        	</div>
        	<input id="start_date" x-ref="datepicker1"
        		x-init="flatpickr($refs.datepicker1, {
            	enableTime: false,
            	dateFormat: 'd-m-Y'
        		})" wire:model="start_date" datepicker datepicker-orientation="bottom right" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('Start Date') }}">
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
        <label for="motortype" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Vehicle Type') }}</label>
        <select id="motortype" wire:model="motortype" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
            <option selected value="">{{ __('Select Vehicle Type') }}</option>
		    <option value="Bus">{{ __('Bus') }}</option>
		    <option value="Bike">{{ __('Bike') }}</option>
		    <option value="Car">{{ __('Car') }}</option>
		    <option value="Jeep">{{ __('Jeep') }}</option>
		    <option value="Mobile Home">{{ __('Mobile Home') }}</option>
		    <option value="Truck">{{ __('Truck') }}</option>
		    <option value="Van">{{ __('Van') }}</option>
		</select>
        @error('motortype') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="value" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Vehicle Value') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="value"  wire:model="value">
		@error('value') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="insuretype" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Insurance Type') }}</label>
        <select id="insuretype" wire:model="insuretype" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
            <option selected value="">{{ __('Select Insurance Type') }}</option>
		    <option value="Full Comprehensive">{{ __('Full Comprehensive') }}</option>
		    <option value="Third Party">{{ __('Third Party') }}</option>
		    <option value="Third Party/FT">{{ __('Third Party/FT') }}</option> 
		</select>
        @error('insuretype') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
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
        <label for="make" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Vehicle Make') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="make"  wire:model="make">
		@error('make') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="model" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Vehicle Model') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="model"  wire:model="model">
		@error('model') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="year" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Vehicle Year') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="year"  wire:model="year">
		@error('year') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="registration" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Vehicle Registration') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="registration"  wire:model="registration">
		@error('registration') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="security" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Security') }}</label>
        <select id="security" wire:model="security" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
            <option selected value="">{{ __('Select Security') }}</option>
		    <option value="Alarm">{{ __('Alarm') }}</option>
		    <option value="Immobilizer">{{ __('Immobilizer') }}</option>
		</select>
		@error('security') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="parking" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Parking') }}</label>
        <select id="parking" wire:model="parking" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
            <option selected value="">{{ __('Select Parking') }}</option>
		    <option value="Off Street">{{ __('Off Street') }}</option>
		    <option value="Secure">{{ __('Secure') }}</option>
		    <option value="Underground">{{ __('Underground') }}</option>
		</select>
		@error('parking') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
      	<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Full License') }}</label>
      	<div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
          	<div class="flex items-center">
              	<input checked="" id="license1-yes" wire:model="license1" name="license1" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="license1-yes" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Yes</label>
          	</div>
          	<div class="flex items-center">
              	<input id="license1-no" wire:model="license1" name="license1" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="license1-no" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">No</label>
          	</div>
      	</div>
		  @error('license1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
  	</div>
  	<div class="sm:col-span-2">
        <label for="licenseyears" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('No of Years') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="licenseyears"  wire:model="licenseyears">
		@error('licenseyears') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="noclaims" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('No Claims Bonus (months)') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="noclaims"  wire:model="noclaims">
		@error('noclaims') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="col-span-full">
        <label for="claimdetails" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Claim Details') }}</label>
        <textarea rows="4" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="claimdetails" wire:model="claimdetails"></textarea>
		@error('claimdetails') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
      	<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Price Pledge') }}</label>
      	<div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
          	<div class="flex items-center">
              	<input checked="" id="pricepledge1-yes" wire:model="pricepledge1" name="pricepledge1" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
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
        <input  type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="monthprem"  wire:model="monthprem">
		@error('monthprem') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="payfreq" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Payment Frequency (months)') }}</label>
        <input  type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="payfreq"  wire:model="payfreq">
		@error('payfreq') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-3">
        <label for="numpay" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Number of Payments') }}</label>
        <input  type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="numpay"  wire:model="numpay">
		@error('numpay') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-3">
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
    <button wire:click="savePolicy" type="button" type="button" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
    	{{ __('Save Now') }}
    </button>
</div>