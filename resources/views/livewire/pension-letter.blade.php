<x-slot name="header">
        <h2 class="font-bold text-lg xl:text-2xl text-white">
            {{ __('Pension Letter') }}
        </h2>
</x-slot>
<div class="px-4 lg:px-6 xl:px-8 w-full relative md:-mt-16 xl:-mt-20 pb-8">
    <div class="w-full relative">
        <div class="bg-white overflow-hidden shadow-xl rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 p-2 xl:p-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <form wire:submit.prevent="submitForm">
                <div class="pension-form bg-white sm:px-4 lg:p-6">
                    <div class="grid grid-cols-1 gap-4 lg:gap-6">
                        <div class="col-span-full">
                            <label for="pens_letter" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Pension Letter Text') }}<span class="text-red-500 ml-0.5">*</span></label>
                            <textarea id="pens_letter" wire:model.defer="pens_letter" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" required rows="12"></textarea>
                            @error('pens_letter') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="flex justify-center pt-8 items-center gap-4">
                        <button type="button" wire:click.prevent="submitForm()" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">{{ __('Save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>