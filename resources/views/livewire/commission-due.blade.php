<x-slot name="header">
    <h2 class="font-bold text-lg xl:text-2xl text-white">
        {{ __('Commission Due Report') }}
    </h2>
</x-slot>
<div class="px-4 lg:px-6 xl:px-8 w-full relative md:-mt-16 xl:-mt-20 pb-8">
    <!-- <div class="btn-header md:absolute md:right-6 xl:right-8 md:-top-[56px] lg:-top-[66px] xl:-top-[70px] z-10 flex items-center gap-4 mb-4  md:mb-0 justify-between md:justify-normal">
        <button @click="isOpen = !isOpen" class="bg-pos-gradient hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-5 rounded text-sm xl:text-base">{{ __('Search Commission Due') }}</button>
    </div> -->
    <div class="w-full relative">
        <div class="bg-white overflow-hidden shadow-xl rounded-lg px-4 py-4">
            <div class="commission-due-form bg-white py-4 lg:py-6 xl:py-8 2xl:py-10 relative w-full">
                @include('livewire.commissionduefilterform')
            </div>
            @if ($searchApplied)
            <div class="bg-gray-white w-full relative">
                <div class="w-full">
                    <div class="bg-white relative shadow-md rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-xs xl:text-sm  text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-slate-100">
                                    <tr>
                                        <th scope="col" class="p-2 xl:p-3">{{ __('Broker') }}</th>
                                        <th scope="col" class="p-2 xl:p-3">{{ __('Total Due') }}</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($brokerStats as $broker)
                                        <tr class="border-b">
                                            <td class="p-2 xl:p-3">{{ $broker['name'] }}</td>
                                            <td class="p-2 xl:p-3">€{{ number_format($broker['total_monthprem'], 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="p-4 text-center text-gray-500">
                                                {{ __('No results found.') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if (!empty($brokerStats))
                                    <tfoot class="text-xs text-white bg-deep-indigo-blue font-medium">
                                        <tr>
                                            <td class="p-2 xl:p-3">{{ __('Total') }}</td>
                                            <td class="p-2 xl:p-3">€{{ number_format($totals['total_monthprem'], 2) }}</td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 p-2 xl:p-3 shadow-md my-3" role="alert">
                      <div class="flex">
                        <div>
                          <p class="text-sm">{{ session('message') }}</p>
                        </div>
                      </div>
                    </div>
                @endif
        </div>
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
</div>