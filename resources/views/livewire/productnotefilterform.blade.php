<div class="w-full relative md:max-w-screen-xl ml-auto mr-auto">
	<form class="w-full relative" wire:submit.prevent="search">
		<div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-2">
			<div class="sm:col-span-1">
		        <label for="inputString_name" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Name') }}</label>
		        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="inputString_name" wire:model="inputString_name" placeholder="{{ __('Name') }}">
		    </div>
		    <div class="sm:col-span-1">
		        <label for="inputString_product_type" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Policy Type') }}</label>
		        <select id="inputString_product_type" wire:model="inputString_product_type" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
		        	<option selected value="">{{ __('Select Policy type') }}</option>
				    <option value="canonly_policy">{{ __('Cancer Only') }}</option>
				    <option value="commercial_policy">{{ __('Commercial Policy') }}</option>
				    <option value="house_policy">{{ __('House Policy') }}</option>
				    <option value="life_policy">{{ __('Life Policy') }}</option>
				    <option value="motor_policy">{{ __('Motor Policy') }}</option>
				    <option value="mortgage_policy">{{ __('Mortgage') }}</option>
				    <option value="pension_policy">{{ __('Pension') }}</option>
				    <option value="peracc_policy">{{ __('Personal Accident') }}</option>
				</select>
		    </div>
		    <div class="sm:col-span-1">
		        <label for="inputString_ponum" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Policy Number') }}</label>
		        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="inputString_ponum" wire:model="inputString_ponum" placeholder="{{ __('Policy no') }}">
		    </div>
		    <div class="sm:col-span-1">
		        <label for="inputString_assigned_to_id" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Assigned To') }}</label>
		        <select id="tbl_admin_users_id" wire:model="user_filter" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
		        	<option value="">{{ __('Select Assigned to') }}</option>
			        @foreach($usersFilter as $user)
			        	<option value="{{ $user->id }}">{{ $user->name }}</option>
			      	@endforeach
			    </select>
		    </div>
		</div>
		<div class="flex justify-center pt-8">
		    <button type="submit" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded flex items-center justify-center gap-2.5">
			    @svg('search', 'icon icon-search w-6 h-6')
			    {{ __('Search Now') }}
			</button>
		</div>
	</form>
</div>