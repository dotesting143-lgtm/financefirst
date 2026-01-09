<x-slot name="header">
    <h2 class="font-bold text-lg xl:text-2xl text-white">
        {{ __('Payment Tracker Report') }}
    </h2>
</x-slot>
<div class="px-4 lg:px-6 xl:px-8 w-full relative md:-mt-16 xl:-mt-20 pb-8">
    <div class="btn-header md:absolute md:right-6 xl:right-8 md:-top-[56px] lg:-top-[66px] xl:-top-[70px] z-10 flex items-center gap-4 mb-4  md:mb-0 justify-between md:justify-normal">
    </div>
    <div class="w-full relative">
        <div class="bg-white overflow-hidden shadow-xl rounded-lg px-4 py-4">
            <div class="payment-tracker-report-form bg-white py-4 lg:py-6 xl:py-8 2xl:py-10 relative w-full">
                @include('livewire.paymenttrackerreportfilterform')
            </div>
             @if ($searchApplied)
            <div class="bg-gray-white w-full relative">
                <div class="w-full">
                    <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-slate-100">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">{{ __('Broker') }}</th> 
                                        <th scope="col" class="px-4 py-3">{{ __('Client') }}</th>
                                        <th scope="col" class="px-4 py-3">{{ __('Policy No') }}</th>
                                        <th scope="col" class="px-4 py-3">{{ __('Note') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reportData as $row)
                                    <tr class="border-b">
                                        <td class="px-4 py-3">{{ $row->broker_name }}</td>
                                        <td class="px-4 py-3">{{ $row->client_first_name }} {{ $row->client_last_name }}</td>
                                        <td class="px-4 py-3">{{ $row->policy_id }}</td>
                                        <td class="px-4 py-3">
                                            <pre>{{ $row->text }}</pre>
                                        </td>
                                    </tr>
                                     @empty
                                     <tr class="border-b">
                                        <td class="px-4 py-3" colspan="4">No data found.</td>
                                    </tr>
                                     @endforelse
                                </tbody>
                            </table>
                        </div>
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