<div class="flex justify-center pb-8">
    <button wire:click="savePolicy" type="button" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
    	{{ __('Save Now') }}
    </button>
</div>
<div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
	<div class="sm:col-span-2">
        <label for="type" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Type') }}</label>
        <select id="type" wire:model="type" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
          	<option selected value="">{{ __('Select Policy Type') }}</option>
		    <option value="Life Mortgage Cover">{{ __('Life Mortgage Cover') }}</option>
		    <option value="Life Term Cover">{{ __('Life Term Cover') }}</option>
		    <option value="Income Protector (Personal)">{{ __('Income Protector (Personal)') }}</option>
		    <option value="Income Protector (Company)">{{ __('Income Protector (Company)') }}</option>
		    <option value="Life Long Cover">{{ __('Life Long Cover') }}</option>
		    <option value="Over 50s Cover">{{ __('Over 50s Cover') }}</option>
		    <option value="Group Protection Scheme">{{ __('Group Protection Scheme') }}</option>
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
  	<div class="sm:col-span-3">
        <label for="curinsurer" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Current Insurer') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="curinsurer"  wire:model="curinsurer">
        @error('curinsurer') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-3">
        <label for="propinsurer" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Proposed Insurer') }}</label>
        <div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
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
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 relative">
	<div class="mt-8 grid grid-cols-1 gap-4 lg:gap-6 bg-slate-100 relative p-4 sm:p-6">
		<div class="col-span-full text-base lg:text-lg xl:text-xl text-black font-bold">{{ __('First Person') }}</div>
		<div class="sm:col-span-3">
			<label for="coveramt_1" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Life Cover (€)') }}</label>
			<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="coveramt_1"  wire:model="coveramt_1">
			@error('coveramt_1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
		</div>
		<div class="sm:col-span-3">
			<label for="specill_1" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Specified Illness Cover (€)') }}</label>
			<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="specill_1"  wire:model="specill_1">
			@error('specill_1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
		</div>
		<div class="sm:col-span-3">
			<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Specified Illness Type') }}</label>
			<div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
				<div class="flex items-center">
					<input checked="" id="specill_type_11-standalone" wire:model="specill_type_11" name="specill_type_11" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
					<label for="specill_type_11-standalone" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Standalone</label>
				</div>
				<div class="flex items-center">
					<input id="specill_type_11-accelerated" wire:model="specill_type_11" name="specill_type_11" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
					<label for="specill_type_11-accelerated" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Accelerated</label>
				</div>
				<div class="flex items-center">
					<input id="specill_type_11-independent" wire:model="specill_type_11" name="specill_type_11" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
					<label for="specill_type_11-independent" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Independent</label>
				</div>
			</div>
			@error('specill_type_11') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
		</div>
		<div class="sm:col-span-3">
			<label for="hoscash_1" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Hospital Cash Cover (€, per day)') }}</label>
			<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="hoscash_1"  wire:model="hoscash_1">
			@error('hoscash_1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
		</div>
		<div class="sm:col-span-2 hidden">
			<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Occupation Class') }}</label>
			<div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
				<div class="flex items-center">
					<input checked="" id="occclass1_11-a" wire:model="occclass1_11" name="occclass1_11" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
					<label for="occclass1_11-a" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">A</label>
				</div>
				<div class="flex items-center">
					<input id="occclass1_11-b" wire:model="occclass1_11" name="occclass1_11" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
					<label for="occclass1_11-b" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">B</label>
				</div>
			</div>
			@error('occclass1_11') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
		</div>
		<div class="sm:col-span-2">
			<label for="acccover_1" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Accident Cover (€, per week)') }}</label>
			<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="acccover_1"  wire:model="acccover_1">
			@error('acccover_1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
		</div>
		<div class="sm:col-span-2 hidden">
			<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Occupation Class') }}</label>
			<div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
				<div class="flex items-center">
					<input checked="" id="occclass2_11-x" wire:model="occclass2_11" name="occclass2_11" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
					<label for="occclass2_11-x" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">X</label>
				</div>
				<div class="flex items-center">
					<input id="occclass2_11-y" wire:model="occclass2_11" name="occclass2_11" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
					<label for="occclass2_11-y" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Y</label>
				</div>
			</div>
			@error('occclass2_11') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
		</div>
		<div class="col-span-full hidden">
			<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Height') }}</label>
			<div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-4">
				<div class="sm:col-span-1">
					<div class="flex">
						<span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-pale-blue-gray rounded-none rounded-l-lg">{{ __('ft') }}</span>
						<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-none rounded-r-lg w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="height_ft_1"  wire:model="height_ft_1" placeholder="{{ __('Imperial') }}">
						@error('height_ft_1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
					</div>
				</div>
				<div class="sm:col-span-1">
					<div class="flex">
						<span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-pale-blue-gray rounded-none rounded-l-lg">{{ __('in') }}</span>
						<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-none rounded-r-lg w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="height_in_1"  wire:model="height_in_1" placeholder="{{ __('Imperial') }}">
						@error('height_in_1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
					</div>
				</div>
				<div class="sm:col-span-1">
					<div class="flex">
						<span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-pale-blue-gray rounded-none rounded-l-lg">{{ __('m') }}</span>
						<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-none rounded-r-lg w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="height_me_1"  wire:model="height_me_1" placeholder="{{ __('Metric') }}">
						@error('height_me_1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
					</div>
				</div>
				<div class="sm:col-span-1">
					<div class="flex">
						<span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-pale-blue-gray rounded-none rounded-l-lg">{{ __('cm') }}</span>
						<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-none rounded-r-lg w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="height_cm_1"  wire:model="height_cm_1" placeholder="{{ __('Metric') }}">
						@error('height_cm_1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
					</div>
				</div>
			</div>
		</div>
		<div class="col-span-full hidden">
			<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Weight') }}</label>
			<div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-3">
				<div class="sm:col-span-1">
					<div class="flex">
						<span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-pale-blue-gray rounded-none rounded-l-lg">{{ __('st') }}</span>
						<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-none rounded-r-lg w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="weight_st_1"  wire:model="weight_st_1" placeholder="{{ __('Imperial') }}">
						@error('weight_st_1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
					</div>
				</div>
				<div class="sm:col-span-1">
					<div class="flex">
						<span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-pale-blue-gray rounded-none rounded-l-lg">{{ __('lb') }}</span>
						<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-none rounded-r-lg w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="weight_lb_1"  wire:model="weight_lb_1" placeholder="{{ __('Imperial') }}">
						@error('weight_lb_1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
					</div>
				</div>
				<div class="sm:col-span-1">
					<div class="flex">
						<span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-pale-blue-gray rounded-none rounded-l-lg">{{ __('kg') }}</span>
						<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-none rounded-r-lg w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="weight_kg_1"  wire:model="weight_kg_1" placeholder="{{ __('Metric') }}">
						@error('weight_kg_1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="mt-8 grid grid-cols-1 gap-4 lg:gap-6 bg-grey-200 relative p-4 sm:p-6">
		<div class="col-span-full text-base lg:text-lg xl:text-xl text-black font-bold">{{ __('Second Person') }}</div>
		<div class="col-span-full">
			<label for="coveramt_2" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Life Cover (€)') }}</label>
			<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="coveramt_2"  wire:model="coveramt_2">
			@error('coveramt_2') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
		</div>
		<div class="col-span-full">
			<label for="specill_2" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Specified Illness Cover (€)') }}</label>
			<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="specill_2"  wire:model="specill_2">
			@error('specill_2') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
		</div>
		<div class="col-span-full">
			<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Specified Illness Type') }}</label>
			<div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
				<div class="flex items-center">
					<input checked="" id="specill_type_21-standalone" wire:model="specill_type_21" name="specill_type_21" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
					<label for="specill_type_21-standalone" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Standalone</label>
				</div>
				<div class="flex items-center">
					<input id="specill_type_21-accelerated" wire:model="specill_type_21" name="specill_type_21" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
					<label for="specill_type_21-accelerated" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Accelerated</label>
				</div>
				<div class="flex items-center">
					<input id="specill_type_21-independent" wire:model="specill_type_21" name="specill_type_21" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
					<label for="specill_type_21-independent" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Independent</label>
				</div>
			</div>
			@error('specill_type_21') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
		</div>
		<div class="col-span-full">
			<label for="hoscash_2" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Hospital Cash Cover (€, per day)') }}</label>
			<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="hoscash_2"  wire:model="hoscash_2">
			@error('hoscash_2') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
		</div>
		<div class="col-span-full hidden">
			<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Occupation Class') }}</label>
			<div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
				<div class="flex items-center">
					<input checked="" id="occclass1_21-a" wire:model="occclass1_21" name="occclass1_21" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
					<label for="occclass1_21-a" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">A</label>
				</div>
				<div class="flex items-center">
					<input id="occclass1_21-b" wire:model="occclass1_21" name="occclass1_21" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
					<label for="occclass1_21-b" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">B</label>
				</div>
			</div>
			@error('occclass1_21') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
		</div>
		<div class="col-span-full">
			<label for="acccover_2" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Accident Cover (€, per week)') }}</label>
			<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="acccover_2"  wire:model="acccover_2">
			@error('acccover_2') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
		</div>
		<div class="col-span-full hidden">
			<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Occupation Class') }}</label>
			<div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
				<div class="flex items-center">
					<input checked="" id="occclass2_21-x" wire:model="occclass2_21"  name="occclass2_21" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
					<label for="occclass2_21-x" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">X</label>
				</div>
				<div class="flex items-center">
					<input id="occclass2_21-y" wire:model="occclass2_21" name="occclass2_21" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
					<label for="occclass2_21-y" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Y</label>
				</div>
			</div>
			@error('occclass2_21') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
		</div>
		<div class="col-span-full hidden">
			<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Height') }}</label>
			<div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-4">
				<div class="sm:col-span-1">
					<div class="flex">
						<span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-pale-blue-gray rounded-none rounded-l-lg">{{ __('ft') }}</span>
						<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-none rounded-r-lg w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="height_ft_2"  wire:model="height_ft_2" placeholder="{{ __('Imperial') }}">
						@error('height_ft_2') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
					</div>
				</div>
				<div class="sm:col-span-1">
					<div class="flex">
						<span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-pale-blue-gray rounded-none rounded-l-lg">{{ __('in') }}</span>
						<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-none rounded-r-lg w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="height_in_2"  wire:model="height_in_2" placeholder="{{ __('Imperial') }}">
						@error('height_in_2') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
					</div>
				</div>
				<div class="sm:col-span-1">
					<div class="flex">
						<span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-pale-blue-gray rounded-none rounded-l-lg">{{ __('m') }}</span>
						<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-none rounded-r-lg w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="height_me_2"  wire:model="height_me_2" placeholder="{{ __('Metric') }}">
						@error('height_me_2') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
					</div>
				</div>
				<div class="sm:col-span-1">
					<div class="flex">
						<span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-pale-blue-gray rounded-none rounded-l-lg">{{ __('cm') }}</span>
						<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-none rounded-r-lg w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="height_cm_2"  wire:model="height_cm_2" placeholder="{{ __('Metric') }}">
						@error('height_cm_2') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
					</div>
				</div>
			</div>
		</div>
		<div class="col-span-full hidden">
			<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Weight') }}</label>
			<div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-3">
				<div class="sm:col-span-1">
					<div class="flex">
						<span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-pale-blue-gray rounded-none rounded-l-lg">{{ __('st') }}</span>
						<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-none rounded-r-lg w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="weight_st_2"  wire:model="weight_st_2" placeholder="{{ __('Imperial') }}">
						@error('weight_st_2') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
					</div>
				</div>
				<div class="sm:col-span-1">
					<div class="flex">
						<span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-pale-blue-gray rounded-none rounded-l-lg">{{ __('lb') }}</span>
						<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-none rounded-r-lg w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="weight_lb_2"  wire:model="weight_lb_2" placeholder="{{ __('Imperial') }}">
						@error('weight_lb_2') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
					</div>
				</div>
				<div class="sm:col-span-1">
					<div class="flex">
						<span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-pale-blue-gray rounded-none rounded-l-lg">{{ __('kg') }}</span>
						<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-none rounded-r-lg w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="weight_kg_2"  wire:model="weight_kg_2" placeholder="{{ __('Metric') }}">
						@error('weight_kg_2') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="mt-8 grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
	<div class="sm:col-span-2">
      	<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Guaranteed Cover Again') }}</label>
      	<div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
          	<div class="flex items-center">
              	<input checked="" id="guarantee1-yes" wire:model="guarantee1" name="guarantee1" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="guarantee1-yes" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Yes</label>
          	</div>
          	<div class="flex items-center">
              	<input id="guarantee1-no" wire:model="guarantee1" name="guarantee1" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="guarantee1-no" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">No</label>
          	</div>
      	</div>
      	@error('guarantee1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
  	</div>
  	<div class="sm:col-span-2">
      	<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Inflation Protection') }}</label>
      	<div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
          	<div class="flex items-center">
              	<input checked="" id="infprotect1-yes" wire:model="infprotect1" name="infprotect1" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="infprotect1-yes" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Yes</label>
          	</div>
          	<div class="flex items-center">
              	<input id="infprotect1-no" wire:model="infprotect1" name="infprotect1" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="infprotect1-no" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">No</label>
          	</div>
      	</div>
      	@error('infprotect1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
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
              	<label for="startimm1" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">No</label>
          	</div>
      	</div>
      	@error('startimm1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
  	</div>
  	<div class="sm:col-span-2">
      	<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Index Linked') }}</label>
      	<div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
          	<div class="flex items-center">
              	<input checked="" id="index1-yes" wire:model="index1" name="index1" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="index1-yes" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Yes</label>
          	</div>
          	<div class="flex items-center">
              	<input id="index1-no" wire:model="index1" name="index1" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="index1-no" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">No</label>
          	</div>
      	</div>
      	@error('index1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
  	</div>
  	<div class="sm:col-span-2">
      	<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Price Pledge') }}</label>
      	<div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
          	<div class="flex items-center">
              	<input checked="" id="pricepledge1yes" wire:model="pricepledge1" name="pricepledge1" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="pricepledge1yes" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Yes</label>
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
    <div class="sm:col-span-2 hidden">
        <label for="numpay" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Number of Payments') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="numpay"  wire:model="numpay">
        @error('numpay') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2 hidden">
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
    <button wire:click="savePolicy" type="button" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
    	{{ __('Save Now') }}
    </button>
</div>