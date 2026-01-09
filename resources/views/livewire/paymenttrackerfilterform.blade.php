<div class="w-full relative md:max-w-screen-xl ml-auto mr-auto">
    <form class="w-full relative">
        <div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-2">
            <!-- Name Search -->
            <div class="sm:col-span-1">
                <label for="inputString_name" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Name') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="inputString_name" wire:model="inputString_name" placeholder="{{ __('Name') }}">
            </div>

            <!-- Broker Search -->
            <div class="sm:col-span-1">
                <label for="inputString_assigned_to_id" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Broker') }}</label>
                <select id="inputString_assigned_to_id" wire:model="inputString_assigned_to_id" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
                    <option selected value="">{{ __('Select Broker') }}</option>
                    @foreach($brokers as $broker)
                        <option value="{{ $broker->id }}">{{ $broker->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Phone Number Search -->
            <div class="sm:col-span-1">
                <label for="inputString_phone" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Phone Number') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="inputString_phone" wire:model="inputString_phone" placeholder="{{ __('Phone no') }}">
            </div>

            <!-- Policy Number Search -->
            <div class="sm:col-span-1">
                <label for="inputString_policy" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Policy Number') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="inputString_policy" wire:model="inputString_policy" placeholder="{{ __('Policy no') }}">
            </div>

            <!-- Status Search -->
            <div class="col-span-full">
                <label for="inputString_status" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Status') }}</label>
                <select id="inputString_status" wire:model="inputString_status" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
                    <option selected value="">{{ __('Select status') }}</option>
                    <option value="Open">{{ __('Open') }}</option>
                    <option value="Closed">{{ __('Closed') }}</option>                  
                </select>
            </div>
        </div>

        <!-- Search Button -->
        <div class="flex justify-center pt-8">
            <button type="button" wire:click="$refresh" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded flex items-center justify-center gap-2.5">
                @svg('search', 'icon icon-search w-6 h-6')
                {{ __('Search Now') }}
            </button>
        </div>
    </form>
</div>
<div wire:loading class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-50">
    <div class="flex flex-col items-center">
        <svg class="animate-spin h-16 w-16 text-white" viewBox="0 0 24 24" fill="none">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 0116 0M12 4v4M12 20v-4M20 12h-4M4 12h4"></path>
        </svg>
        <span class="text-lg font-semibold text-white mt-4">Loading, please wait...</span>
    </div>
</div>