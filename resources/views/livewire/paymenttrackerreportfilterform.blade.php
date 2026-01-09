<div class="w-full relative md:max-w-screen-xl ml-auto mr-auto">
	<form class="w-full relative">
		<div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-2">
			<div class="sm:col-span-1">
				<label for="sdate" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Start Date') }}</label>
                <div class="relative w-full">
				    <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
				        @svg('calendar', 'icon icon-plus w-6 h-6 text-black')
				    </div>
				    <input
				        id="sdate"
				        x-data
				        x-ref="datepicker_sdate"
				        x-init="flatpickr($refs.datepicker_sdate, {
				            enableTime: false,
				            dateFormat: 'Y-m-d'
				        })"
				        wire:model="sdate"
				        type="text"
				        class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10"
				        placeholder="{{ __('Start Date') }}"
				    >
				    @error('sdate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
				</div>
            </div>
            <div class="sm:col-span-1">
			    <label for="edate" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">
			        {{ __('End Date') }}:
			    </label>
			    <div class="relative w-full" x-data>
			        <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
			            @svg('calendar', 'icon icon-plus w-6 h-6 text-black')
			        </div>
			        <input
			            id="edate"
			            x-ref="datepicker_edate"
			            x-init="flatpickr($refs.datepicker_edate, {
			                enableTime: false,
			                dateFormat: 'Y-m-d'
			            })"
			            wire:model="edate"
			            type="text"
			            class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10"
			            placeholder="{{ __('End Date') }}"
			        >
			        @error('edate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
			    </div>
			</div>
		    <div class="sm:col-span-1">
		        <label for="tbl_admin_users_id" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Broker') }}</label>
		        <select id="tbl_admin_users_id" wire:model="broker" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
		        	<option value="">{{ __('Select broker') }}</option>
		          	<?php foreach($brokers as $broker): ?>
			        	<option value="{{ $broker->id }}">{{ $broker->name }}</option>
			      	<?php endforeach; ?>
		        </select>
		        @error('broker') <span class="text-red-500">{{ $message }}</span>@enderror
		    </div>
		    <div class="sm:col-span-1">
		        <label for="propinsurer" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Insurer') }}</label>
		        <select id="propinsurer" wire:model="propinsurer" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
		                <option selected value="">{{ __('Select Insurer') }}</option>
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
		    <div class="col-span-full">
		        <label for="status" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Status') }}</label>
		        <select id="status" wire:model="status" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
		        	<option selected value="">{{ __('Select status') }}</option>
		        	<option value="">{{ __('Open') }}</option>
		            <option value="Closed">{{ __('Closed') }}</option>		            
				</select>
		    </div>
		</div>
		<div class="flex justify-center pt-8">
		    <button wire:click="search" type="button" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded flex items-center justify-center gap-2.5">
		    	@svg('search', 'icon icon-search w-6 h-6')
		    	{{ __('Search Now') }}
		    </button>
		</div>
	</form>
</div>