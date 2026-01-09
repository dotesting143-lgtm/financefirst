<div class="w-full relative md:max-w-screen-xl ml-auto mr-auto">
	<form class="w-full relative" wire:submit.prevent="search">
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
				</div>
            </div>
            <div class="sm:col-span-1">
			    <label for="edate" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">
			        {{ __('End Date') }}
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
		        <label for="reportsort" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Sort Report By') }}</label>
		        <select id="reportsort" wire:model="reportsort" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
		        	<option selected value="">{{ __('Select report') }}</option>
				    <option value="cancer">{{ __('Cancer Only') }}</option>
				    <option value="commercial">{{ __('Commercial Policy') }}</option>
				    <option value="house">{{ __('House Policy') }}</option>
				    <option value="life">{{ __('Life Policy') }}</option>
				    <option value="motor">{{ __('Motor Policy') }}</option>
				    <option value="mortgage">{{ __('Mortgage Policy') }}</option>
				    <option value="pension">{{ __('Pension Policy') }}</option>
				    <option value="pap">{{ __('Personal Accident') }}</option>
				    <option value="total">{{ __('Totals') }}</option>
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