<div class="flex justify-center pb-8">
    <button wire:click="savePolicy" type="button" type="button" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
        {{ __('Save Now') }}
    </button>
</div>
<div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
	<div class="sm:col-span-2">
        <label for="type" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Type') }}</label>
        <select id="type" wire:model="type" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
          	<option selected value="">{{ __('Select Policy Type') }}</option>
		    <option value="Pension">{{ __('Pension') }}</option>
		    <option value="ARF">{{ __('ARF') }}</option>
		    <option value="Executive Pension">{{ __('Executive Pension') }}</option>
		    <option value="Group Pension Scheme">{{ __('Group Pension Scheme') }}</option>
		    <option value="Personal Pension">{{ __('Personal Pension') }}</option>
		    <option value="PRB">{{ __('PRB') }}</option>
		    <option value="PRSA">{{ __('PRSA') }}</option>
		    <option value="Investments">{{ __('Investments') }}</option>
        </select>
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
        <label for="aptype" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('AP Plan Type') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="aptype"  wire:model="aptype">
        @error('aptype') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="sptype" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('SP Plan Type') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sptype"  wire:model="sptype">
        @error('sptype') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="intname" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Intermediary Name') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="intname"  wire:model="intname">
        @error('intname') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="intnum" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Intermediary Number') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="intnum"  wire:model="intnum">
        @error('intnum') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="regcon" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Regular Contribution') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="regcon"  wire:model="regcon">
        @error('regcon') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="sincon" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Single Contribution') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sincon"  wire:model="sincon">
        @error('sincon') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="retage" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Selected Retirement Age') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="retage"  wire:model="retage">
        @error('retage') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="monthprem" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Monthly Premium (€)') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="monthprem"  wire:model="monthprem">
        @error('monthprem') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
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
    <button wire:click="savePolicy" type="button" type="button" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
    	{{ __('Save Now') }}
    </button>
</div>