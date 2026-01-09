<div class="fixed z-50 inset-0 overflow-y-auto ease-out duration-400">
	<div class="flex items-start justify-center min-h-screen py-4 px-4 text-center sm:block w-full">
    	<div class="fixed inset-0 transition-opacity">
      		<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    	</div>
      	<div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 align-middle max-w-screen-xl w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
        	<div class="flex items-center justify-between px-4 sm:px-6 py-3 rounded-t-lg bg-slate-100">
            	<h3 class="text-lg lg:text-xl font-medium text-black uppercase">{{ __('User Details') }}</h3>
            	<button wire:click="closeModal()" type="button" type="button" class="oxford-blue bg-transparent hover:bg-oxford-blue hover:text-white rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center border border-oxford-blue">
            		@svg('close', 'icon icon-close w-3 h-3')
                	<span class="sr-only">Close modal</span>
            	</button>
        	</div>
        	<form x-data="{secOpen: false}">
        		<div class="adduser-form bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        			<div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
        				<div class="sm:col-span-3">
        					<label for="name" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Full Name') }}<span class="text-red-500 ml-0.5">*</span></label>
				          	<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" wire:model="name" id="name">
				          	@error('name') <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span> @enderror
				      	</div>
				      	<div class="sm:col-span-3">
        					<label for="username" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('User Name') }}<span class="text-red-500 ml-0.5">*</span></label>
				          	<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" wire:model="username" id="username">
				          	@error('username') <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span> @enderror
				      	</div>
				      	<div class="sm:col-span-3">
        					<label for="password" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Password') }}<span class="text-red-500 ml-0.5">*</span></label>
        					<div class="relative" x-data="{ show: false }">
				          		<input type="password" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" wire:model="password" id="password" x-bind:type=" show ? 'text' : 'password'">
				          		<button type="button" class="absolute bg-transparent text-black right-3 top-0 bottom-0 flex items-center justify-center hover:text-blue-600" @click="show = !show">
					          		<span x-show="!show">@svg('eyes1', 'w-5 h-5')</span>
        							<span x-show="show" style="display: none;">@svg('eyes', 'w-5 h-5')</span>
			                    </button>
			                </div>
				          	@error('password') <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span> @enderror
				      	</div>
				      	<div class="sm:col-span-3">
        					<label for="password" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Confirm Password') }}<span class="text-red-500 ml-0.5">*</span></label>
        					<div class="relative" x-data="{ show: false }">
					          	<input type="password" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" wire:model="confirmPassword" id="confirmPassword" x-bind:type=" show ? 'text' : 'password'">
					          	<button type="button" class="absolute bg-transparent text-black right-3 top-0 bottom-0 flex items-center justify-center hover:text-blue-600" @click="show = !show">
					          		<span x-show="!show">@svg('eyes1', 'w-5 h-5')</span>
        							<span x-show="show" style="display: none;">@svg('eyes', 'w-5 h-5')</span>
			                    </button>
			                </div>
				          	@error('confirmPassword') <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span> @enderror
				      	</div>
				      	<div class="sm:col-span-3">
        					<label for="email" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Email Address') }}<span class="text-red-500 ml-0.5">*</span></label>
				          	<input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" wire:model="email" id="email">
				          	@error('email') <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span> @enderror
				      	</div>
				      	<div class="sm:col-span-3">
        					<label for="role" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Access Level') }}<span class="text-red-500 ml-0.5">*</span></label>
				          	<select id="role" wire:model="role" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
				          		<option value="">Please select</option>
	                            @foreach ($roles as $key => $label)
	                                <option value="{{ $key }}">{{ $label }}</option>
	                            @endforeach
	                        </select>
				          	@error('role') <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span> @enderror
				      	</div>
        			</div>
        			<div class="flex justify-center pt-8 items-center gap-4">
        				<button type="button" wire:click.prevent="store()" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
		                    {{ $isEditing ? 'Update User' : 'Create User' }}
		                </button>
		                @if ($isEditing)
		                    <button type="button" wire:click="closeModal()" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
		                    	{{ __('Cancel') }}
		                    </button>
		                @endif
					</div>
        		</div>
        	</form>
      	</div>
  	</div>
</div>
