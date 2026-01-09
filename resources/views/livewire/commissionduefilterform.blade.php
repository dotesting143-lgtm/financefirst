<div class="w-full relative md:max-w-screen-xl ml-auto mr-auto">
	<form class="w-full relative" wire:submit.prevent="search">
		<div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-2">
			 
		    <div class="col-span-full">
		        <label for="broker" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Broker') }}</label>
		        <select id="broker" wire:model="broker" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
		        	<option selected value="">{{ __('Select Broker') }}</option>
		        	<?php foreach($brokers as $broker): ?>
			        	<option value="{{ $broker->id }}">{{ $broker->name }}</option>
			      	<?php endforeach; ?>
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