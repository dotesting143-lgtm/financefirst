<div class="flex justify-center pb-8">
    <button wire:click="savePolicy" type="button" type="button" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
        {{ __('Save Now') }}
    </button>
    @error('type') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
</div>
<div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
	<div class="sm:col-span-2">
        <label for="type" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Type') }}</label>
        <input readonly type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="type"  wire:model="type" value="{{ __('Mortgage') }}">
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
        <label for="monthprem" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Monthly Premium (€)') }}</label>
        <input  type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="monthprem"  wire:model="monthprem">
        @error('monthprem') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-3">
        <label for="coveramt" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Cover Amount (€)') }}</label>
        <input  type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="coveramt"  wire:model="coveramt">
        @error('coveramt') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-3">
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
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" placeholder="{{ __('Number') }}" id="propinsurer_num" wire:model="propinsurer_num">
                @error('propinsurer_num') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
            </div> 
        </div>
    </div>
    <div class="col-span-full text-xl text-black font-bold">{{ __('Property Details') }}</div>
    <div class="col-span-full">
        <label for="propinsurer" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Full Address') }}</label>
        <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" placeholder="{{ __('Address 1') }}" id="propadd1" wire:model="propadd1">
                @error('propadd1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
            </div>
            <div class="sm:col-span-3">
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" placeholder="{{ __('Address 2') }}" id="propadd2" wire:model="propadd2">
                @error('propadd2') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
            </div> 
        </div>
    </div>
    <div class="sm:col-span-3">
        <label for="proptype" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Property Type') }}</label>
        <select id="proptype" wire:model="proptype" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
            <option selected value="">{{ __('Select Property Type') }}</option>
		    <option value="Apartment">{{ __('Apartment') }}</option>
		    <option value="Bungalow">{{ __('Bungalow') }}</option>
		    <option value="Townhouse">{{ __('Townhouse') }}</option>
		    <option value="Terraced">{{ __('Terraced') }}</option>
		    <option value="Semi-Detached">{{ __('Semi-Detached') }}</option>
		    <option value="Detached">{{ __('Detached') }}</option>
		</select>
        @error('proptype') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-3">
        <label for="proprooms" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('No of Rooms') }}</label>
        <input  type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="proprooms"  wire:model="proprooms">
        @error('proprooms') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="col-span-full">
      	<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Construction Type') }}</label>
      	<div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-3 items-center">
          	<div class="sm:col-span-1">
              	<input checked id="propcontype1-brick" wire:model="propcontype1" name="propcontype1" type="radio" value="" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="propcontype1-brick" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Traditional Brick</label>
          	</div>
          	<div class="sm:col-span-1">
              	<input id="propcontype1-frame" wire:model="propcontype1" name="propcontype1" type="radio" value="" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="propcontype1-frame" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Timber Frame</label>
          	</div>
          	<div class="sm:col-span-1">
              	<input id="propcontype1-concrete" wire:model="propcontype1" name="propcontype1" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="propcontype1-concrete" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Pre-cast Concrete</label>
          	</div>
      	</div>
          @error('propcontype1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
  	</div>
  	<div class="col-span-full">
      	<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Property Use') }}</label>
      	<div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-2 xl:grid-cols-4 items-center">
          	<div class="sm:col-span-1">
              	<input checked id="propuse1-reside" wire:model="propuse1" name="propuse1" type="radio" value="" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="propuse1-reside" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Reside at Property</label>
          	</div>
          	<div class="sm:col-span-1">
              	<input id="propuse1-let" wire:model="propuse1" name="propuse1" type="radio" value="" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="propuse1-let" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Let Property</label>
          	</div>
          	<div class="sm:col-span-1">
          		<input id="propuse1-secondary" wire:model="propuse1" name="propuse1" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="propuse1-secondary" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Secondary Residence/Holiday Home</label>
          	</div>
          	<div class="sm:col-span-1">
              	<input id="propuse1-other" wire:model="propuse1" name="propuse1" type="radio" value="0" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
              	<label for="propuse1-other" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Other Use</label>
          	</div>
      	</div>
          @error('propuse1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
  	</div>
  	<div class="sm:col-span-3">
        <label for="propyear" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Year Built') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="propyear"  wire:model="propyear" value="">
        @error('propyear') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-3">
        <label for="propyearsrun" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('If Leasehold, years to run') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="propyearsrun"  wire:model="propyearsrun" value="">
        @error('propyearsrun') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-3">
        <label for="propprice" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Purchase Price') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="propprice"  wire:model="propprice" value="">
        @error('propprice') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-3">
        <label for="propvalue" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Estimated Value') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="propvalue"  wire:model="propvalue" value="">
        @error('propvalue') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
  	<div class="col-span-full text-xl text-black font-bold">{{ __('Guarantor Details') }}</div>
  	<div class="sm:col-span-3">
        <label for="guarname" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Full Name') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="guarname"  wire:model="guarname" value="">
        @error('guarname') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
  	<div class="sm:col-span-3">
      	<label for="guardob" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Date of Birth') }}</label>
      	<div class="relative w-full">
        	<div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
          		@svg('calendar', 'icon icon-plus w-6 h-6 text-black')
        	</div>
        	<input id="guardob" x-ref="datepicker11"
        		x-init="flatpickr($refs.datepicker11, {
            	enableTime: false,
            	dateFormat: 'd-m-Y'
        		})" wire:model="guardob" datepicker datepicker-orientation="bottom right" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('Date of Birth') }}">
                @error('guardob') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
      	</div>
  	</div>
  	<div class="col-span-full">
        <label for="guaradd1" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Address') }}</label>
        <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" placeholder="{{ __('Address 1') }}" id="guaradd1" wire:model="guaradd1">
                @error('guaradd1') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
            </div>
            <div class="sm:col-span-3">
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" placeholder="{{ __('Address 2') }}" id="guaradd2" wire:model="guaradd2">
                @error('guaradd2') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
            </div> 
        </div>
    </div>
    <div class="sm:col-span-2">
        <label for="guarhomeno" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Home No') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="guarhomeno"  wire:model="guarhomeno" value="">
        @error('guarhomeno') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="guarmobile" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Mobile No') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="guarmobile"  wire:model="guarmobile" value="">
        @error('guarmobile') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="guaroccup" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Occupation') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="guaroccup"  wire:model="guaroccup" value="">
        @error('guaroccup') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="guarincome" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Basic Income') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="guarincome"  wire:model="guarincome" value="">
        @error('guarincome') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="guarrelapp" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Relationship to Applicant') }}</label>
        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="guarrelapp"  wire:model="guarrelapp" value="">
        @error('guarrelapp') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="guaremail" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Email') }}</label>
        <input type="email" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="guaremail"  wire:model="guaremail" value="">
        @error('guaremail') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
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
    @error('type') <span class="text-red-500 block text-xs lg:text-sm mt-1">{{ $message }}</span>@enderror
</div>