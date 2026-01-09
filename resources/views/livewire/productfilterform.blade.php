<div class="w-full relative md:max-w-screen-xl ml-auto mr-auto">
	<form class="w-full relative" wire:submit.prevent="productsearch">
		<div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-2">
			<div class="sm:col-span-1">
		        <label for="inputString_name" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Name') }}</label>
		        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="inputString_name" wire:model="inputString_name" placeholder="{{ __('Name') }}">
		    </div>
		    <div class="sm:col-span-1">
		        <label for="policytype" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Policy Type') }}</label>
		        <select id="policytype" wire:model="policytype" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
		        	<option selected value="">{{ __('Select Policy type') }}</option>
				    <option value="Life Mortgage Cover">{{ __('Life Mortgage Cover') }}</option>
				    <option value="Life Term Cover">{{ __('Life Term Cover') }}</option>
				    <option value="Income Protector (Personal)">{{ __('Income Protector (Personal)') }}</option>
				    <option value="Income Protector (Company)">{{ __('Income Protector (Company)') }}</option>
				    <option value="Life Long Cover">{{ __('Life Long Cover') }}</option>
				    <option value="Over 50s Cover">{{ __('Over 50s Cover') }}</option>
				    <option value="Group Protection Scheme">{{ __('Group Protection Scheme') }}</option>
				</select>
		    </div>
		    <div class="sm:col-span-1">
		        <label for="inputString_ponum" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Policy Number') }}</label>
		        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="inputString_ponum" wire:model="inputString_ponum" placeholder="{{ __('Policy no') }}">
		    </div>
		    <div class="sm:col-span-1">
                <label for="sdate" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Policy End Between') }}</label>
                <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <div class="relative w-full">
			            	<div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
			              		@svg('calendar', 'icon icon-plus w-6 h-6 text-black')
			            	</div>
			            	<input id="sdate" x-ref="datepicker15"
				        		x-init="flatpickr($refs.datepicker15, {
				            	enableTime: false,
				            	dateFormat: 'd-m-Y'
				        		})" wire:model="sdate" datepicker-orientation="bottom right" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('Start Date') }}">
			          	</div> 
                    </div>
                    <div class="sm:col-span-3">
                        <div class="relative w-full">
			            	<div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
			              		@svg('calendar', 'icon icon-plus w-6 h-6 text-black')
			            	</div>
			            	<input id="fdate" x-ref="datepicker16"
				        		x-init="flatpickr($refs.datepicker16, {
				            	enableTime: false,
				            	dateFormat: 'd-m-Y'
				        		})" wire:model="fdate" datepicker-orientation="bottom right" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('End Date') }}">
			          	</div> 
                    </div>
                </div>
            </div>
		    <div class="sm:col-span-1">
		        <label for="product_type" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Product') }}</label>
		        <select id="product_type" wire:model="product_type" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
		        	<option selected value="">{{ __('Select product') }}</option>
				    <option value="CancerPolicy">{{ __('Cancer Only') }}</option>
				    <option value="CommercialPolicy">{{ __('Commercial Policy') }}</option>
				    <option value="HousePolicy">{{ __('House Policy') }}</option>
				    <option value="LifePolicy">{{ __('Life Policy') }}</option>
				    <option value="MotorPolicy">{{ __('Motor Policy') }}</option>
				    <option value="MortgagePolicy">{{ __('Mortgage') }}</option>
				    <option value="PensionPolicy">{{ __('Pension') }}</option>
				    <option value="PerAccPolicy">{{ __('Personal Accident') }}</option>
				</select>
		    </div>
		    <div class="sm:col-span-1">
		        <label for="tbl_admin_users_id" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Broker') }}</label>
		        <select id="brokers_filter" wire:model="brokers_filter" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
					<option value="">{{ __('Please select') }}</option>
					<?php foreach($brokers as $broker): ?>
					  	<option value="{{ $broker['id'] }}">{{ $broker['name'] }}</option>
					<?php endforeach; ?>
		        </select>
		        @error('broker') <span class="text-red-500">{{ $message }}</span>@enderror
		    </div>
		    <div class="sm:col-span-1">
		    	<label for="propinsurer" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Insurer') }}</label>
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
            </div>
            <div class="sm:col-span-1">
		        <label for="inputString_phnum" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Phone Number') }}</label>
		        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="inputString_phnum" wire:model="inputString_phnum" placeholder="{{ __('Phone number') }}">
		    </div>
		    <div class="sm:col-span-1">
		        <label for="inputString_street" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Address') }}</label>
		        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="inputString_street" wire:model="inputString_street" placeholder="{{ __('Address') }}">
		    </div>
		    <div class="sm:col-span-1">
		        <label for="inputString_yearc" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Year Created') }}</label>
		        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="inputString_yearc" wire:model="inputString_yearc" placeholder="{{ __('Year Created') }}">
		    </div>
		    <div class="sm:col-span-1">
		        <label for="inputString_poid" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('System Number (Numbers Only)') }}</label>
		        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="inputString_poid" wire:model="inputString_poid" placeholder="{{ __('System number') }}">
		    </div>
		    <div class="sm:col-span-1">
		    	<label for="intstatus" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Int Status') }}</label>
                <select id="intstatus" wire:model="intstatus" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
	                <option selected value="">{{ __('Select int') }}</option>
	                <option value="New">{{ __('New') }}</option> 
	                <option value="With U/W">{{ __('With U/W') }}</option> 
	                <option value="Commission Due">{{ __('Commission Due') }}</option> 
	                <option value="Closed">{{ __('Closed') }}</option> 
	                <option value="Cancelled">{{ __('Cancelled') }}</option> 
	                <option value="NTU">{{ __('NTU') }}</option> 
                </select>
            </div>
            <div class="sm:col-span-1">
			    <label for="left_our_agency_filter"
			           class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">
			        {{ __('Left Our Agency') }}
			    </label>

			    <select
			        id="left_our_agency_filter"
			        wire:model="left_our_agency_filter"
			        class="block text-xs lg:text-sm font-medium appearance-none
			               border border-pale-blue-gray rounded-md w-full
			               p-2.5 lg:p-3 text-black
			               focus:outline-none focus:shadow-outline
			               focus:border-oxford-blue focus:ring-oxford-blue">

			        <option value="">{{ __('') }}</option>
			        <option value="1">{{ __('Yes') }}</option>
			        <option value="0">{{ __('No') }}</option>
			    </select>
			</div>

		</div>
		<div class="flex justify-center pt-8">
		    <button type="submit" wire:click="productsearch" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded flex items-center justify-center gap-2.5">
		    	@svg('search', 'icon icon-search w-6 h-6')
		    	{{ __('Search Now') }}
		    </button>
		</div>
	</form>
</div>