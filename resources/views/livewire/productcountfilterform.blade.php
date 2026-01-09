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
		        <label for="postcode" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Postcode') }}</label>
		        <select id="postcode" wire:model="postcode" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
		        	<option selected value="">{{ __('Select Postcode') }}</option>
				    <option value="Co Antrim">{{ __('Co Antrim') }}</option>
				    <option value="Co Armagh">{{ __('Co Armagh') }}</option>
				    <option value="Co Carlow">{{ __('Co Carlow') }}</option>
				    <option value="Co Cavan">{{ __('Co Cavan') }}</option>
				    <option value="Co Clare">{{ __('Co Clare') }}</option>
				    <option value="Co Cork">{{ __('Co Cork') }}</option>
				    <option value="Co Derry">{{ __('Co Derry') }}</option>
				    <option value="Co Donegal">{{ __('Co Donegal') }}</option>
				    <option value="Co Down">{{ __('Co Down') }}</option>
				    <option value="Co Dublin">{{ __('Co Dublin') }}</option>
				    <option value="Dublin 1">{{ __('Dublin 1') }}</option>
				    <option value="Dublin 2">{{ __('Dublin 2') }}</option>
				    <option value="Dublin 3">{{ __('Dublin 3') }}</option>
				    <option value="Dublin 4">{{ __('Dublin 4') }}</option>
				    <option value="Dublin 5">{{ __('Dublin 5') }}</option>
				    <option value="Dublin 6">{{ __('Dublin 6') }}</option>
				    <option value="Dublin 6W">{{ __('Dublin 6W') }}</option>
				    <option value="Dublin 7">{{ __('Dublin 7') }}</option>
				    <option value="Dublin 8">{{ __('Dublin 8') }}</option>
				    <option value="Dublin 9">{{ __('Dublin 9') }}</option>
				    <option value="Dublin 10">{{ __('Dublin 10') }}</option>
				    <option value="Dublin 11">{{ __('Dublin 11') }}</option>
				    <option value="Dublin 12">{{ __('Dublin 12') }}</option>
				    <option value="Dublin 13">{{ __('Dublin 13') }}</option>
				    <option value="Dublin 14">{{ __('Dublin 14') }}</option>
				    <option value="Dublin 15">{{ __('Dublin 15') }}</option>
				    <option value="Dublin 16">{{ __('Dublin 16') }}</option>
				    <option value="Dublin 17">{{ __('Dublin 17') }}</option>
				    <option value="Dublin 18">{{ __('Dublin 18') }}</option>
				    <option value="Dublin 20">{{ __('Dublin 20') }}</option>
				    <option value="Dublin 22">{{ __('Dublin 22') }}</option>
				    <option value="Dublin 24">{{ __('Dublin 24') }}</option>
				    <option value="Co Fermanagh">{{ __('Co Fermanagh') }}</option>
				    <option value="Co Galway">{{ __('Co Galway') }}</option>
				    <option value="Co Kerry">{{ __('Co Kerry') }}</option>
				    <option value="Co Kildare">{{ __('Co Kildare') }}</option>
				    <option value="Co Kilkenny">{{ __('Co Kilkenny') }}</option>
				    <option value="Co Laois">{{ __('Co Laois') }}</option>
				    <option value="Co Leitrim">{{ __('Co Leitrim') }}</option>
				    <option value="Co Limerick">{{ __('Co Limerick') }}</option>
				    <option value="Co Longford">{{ __('Co Longford') }}</option>
				    <option value="Co Louth">{{ __('Co Louth') }}</option>
				    <option value="Co Mayo">{{ __('Co Mayo') }}</option>
				    <option value="Co Meath">{{ __('Co Meath') }}</option>
				    <option value="Co Monaghan">{{ __('Co Monaghan') }}</option>
				    <option value="Co Offaly">{{ __('Co Offaly') }}</option>
				    <option value="Co Roscommon">{{ __('Co Roscommon') }}</option>
				    <option value="Co Sligo">{{ __('Co Sligo') }}</option>
				    <option value="Co Tipperary">{{ __('Co Tipperary') }}</option>
				    <option value="Co Tyrone">{{ __('Co Tyrone') }}</option>
				    <option value="Co Waterford">{{ __('Co Waterford') }}</option>
				    <option value="Co Wexford">{{ __('Co Wexford') }}</option>
				    <option value="Co Westmeath">{{ __('Co Westmeath') }}</option>
				    <option value="Co Wicklow">{{ __('Co Wicklow') }}</option> 
				</select>
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
          		<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('UW Status') }}</label>
          		<div class="flex py-2.5 flex-wrap gap-4 flex-col sm:flex-row">
              		<div class="flex items-center">
					    <input id="notfiled" wire:model="uwstatus" type="checkbox" value="Not Filed" class="w-4 h-4 lg:w-5 lg:h-5 text-oxford-blue bg-white border-soft-gray rounded-sm focus:ring-oxford-blue focus:ring-2">
					    <label for="notfiled" class="ms-2 text-xs lg:text-sm font-medium text-yankees-blue">Not Filed</label>
					</div>
					<div class="flex items-center">
					    <input id="pending" wire:model="uwstatus" type="checkbox" value="Pending" class="w-4 h-4 lg:w-5 lg:h-5 text-oxford-blue bg-white border-soft-gray rounded-sm focus:ring-oxford-blue focus:ring-2">
					    <label for="pending" class="ms-2 text-xs lg:text-sm font-medium text-yankees-blue">Pending</label>
					</div>
					<div class="flex items-center">
					    <input id="approved" wire:model="uwstatus" type="checkbox" value="Approved" class="w-4 h-4 lg:w-5 lg:h-5 text-oxford-blue bg-white border-soft-gray rounded-sm focus:ring-oxford-blue focus:ring-2">
					    <label for="approved" class="ms-2 text-xs lg:text-sm font-medium text-yankees-blue">Approved</label>
					</div>
					<div class="flex items-center">
					    <input id="furtherinfo" wire:model="uwstatus" type="checkbox" value="Further Info" class="w-4 h-4 lg:w-5 lg:h-5 text-oxford-blue bg-white border-soft-gray rounded-sm focus:ring-oxford-blue focus:ring-2">
					    <label for="furtherinfo" class="ms-2 text-xs lg:text-sm font-medium text-yankees-blue">Further Info</label>
					</div>
					<div class="flex items-center">
					    <input id="declined" wire:model="uwstatus" type="checkbox" value="Declined" class="w-4 h-4 lg:w-5 lg:h-5 text-oxford-blue bg-white border-soft-gray rounded-sm focus:ring-oxford-blue focus:ring-2">
					    <label for="declined" class="ms-2 text-xs lg:text-sm font-medium text-yankees-blue">Declined</label>
					</div>
          		</div>
      		</div>
      		<div class="sm:col-span-1">
          		<label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Internal Status') }}</label>
          		<div class="flex py-2.5 flex-wrap gap-4 flex-col sm:flex-row">
              		<div class="flex items-center">
	                  	<input id="new" wire:model="intstatus" type="checkbox" value="New" class="w-5 h-5 text-oxford-blue bg-white border-soft-gray rounded-sm focus:ring-oxford-blue focus:ring-2">
	                  	<label for="new" class="ms-2 text-xs lg:text-sm font-medium text-yankees-blue">New</label>
              		</div>
	              	<div class="flex items-center">
	                	<input id="withuw" wire:model="intstatus" type="checkbox" value="With U/W" class="w-5 h-5 text-oxford-blue bg-white border-soft-gray rounded-sm focus:ring-oxford-blue focus:ring-2">
	                  	<label for="withuw" class="ms-2 text-xs lg:text-sm font-medium text-yankees-blue">With U/W</label>
	              	</div>
	              	<div class="flex items-center">
	                	<input id="commissiondue" wire:model="intstatus" type="checkbox" value="Commission Due" class="w-5 h-5 text-oxford-blue bg-white border-soft-gray rounded-sm focus:ring-oxford-blue focus:ring-2">
	                  	<label for="commissiondue" class="ms-2 text-xs lg:text-sm font-medium text-yankees-blue">Commission Due</label>
	              	</div>
	              	<div class="flex items-center">
	                	<input id="closed" wire:model="intstatus" type="checkbox" value="Closed" class="w-5 h-5 text-oxford-blue bg-white border-soft-gray rounded-sm focus:ring-oxford-blue focus:ring-2">
	                  	<label for="closed" class="ms-2 text-xs lg:text-sm font-medium text-yankees-blue">Closed</label>
	              	</div>
	              	<div class="flex items-center">
	                	<input id="cancelled" wire:model="intstatus" type="checkbox" value="Cancelled" class="w-5 h-5 text-oxford-blue bg-white border-soft-gray rounded-sm focus:ring-oxford-blue focus:ring-2">
	                  	<label for="cancelled" class="ms-2 text-xs lg:text-sm font-medium text-yankees-blue">Cancelled</label>
	              	</div>
          		</div>
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