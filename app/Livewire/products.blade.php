<x-slot name="header">
    <h2 class="font-bold text-lg xl:text-2xl text-white">
        {{ __('Products List') }}
    </h2>
</x-slot>
<div class="px-4 lg:px-6 xl:px-8 w-full relative md:-mt-16 xl:-mt-20 pb-8">
    <div class="btn-header md:absolute md:right-6 xl:right-8 md:-top-[56px] lg:-top-[66px] xl:-top-[70px] z-10 flex items-center gap-4 mb-4  md:mb-0 justify-between md:justify-normal">
        <!-- <button @click="isOpen = !isOpen" class="bg-pos-gradient hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-5 rounded text-sm xl:text-base">{{ __('Search Products') }}</button> -->
    </div>
    <div class="w-full relative">
        <div class="bg-white overflow-hidden shadow-xl rounded-lg px-4 py-4">
        
            @if($isOpen)
                @include('livewire.createclient')
            @endif
            @if ($searchApplied)
                <div class="bg-gray-white w-full relative">
                    <div class="w-full">
                        <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-xs xl:text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-slate-100">
                                        <tr>
                                            <th scope="col" class="p-2 xl:p-3">{{ __('Name') }}</th>
                                            <th scope="col" class="p-2 xl:p-3">{{ __('Contact No') }}</th> 
                                            <th scope="col" class="p-2 xl:p-3">{{ __('Product Type') }}</th> 
                                            <th scope="col" class="p-2 xl:p-3">{{ __('Insurer') }}</th> 
                                            <th scope="col" class="p-2 xl:p-3">{{ __('Insurer Num') }}</th> 
                                            <th scope="col" class="p-2 xl:p-3">{{ __('End Date') }}</th> 
                                            <th scope="col" class="p-2 xl:p-3">{{ __('Int Status') }}</th> 
                                            <th scope="col" class="p-2 xl:p-3">{{ __('U/W Status') }}</th> 
                                            <th scope="col" class="p-2 xl:p-3">{{ __('Broker') }}</th> 
                                            <th scope="col" class="p-2 xl:p-3">
                                                <span class="sr-only">{{ __('Actions') }}</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($policies as $policy)
                                        <tr class="border-b">
                                            <th scope="row" wire:click="edit({{ $policy->client->id }})" class="p-2 xl:p-3 font-medium text-gray-900 pointer-events-auto cursor-pointer hover:text-vivid-amethyst">{{ $policy->client->first_name }} {{ $policy->client->last_name }}</th>
                                            <td class="p-2 xl:p-3">{{ $policy->client->home_no }}</td>
                                            <td class="p-2 xl:p-3">{{ $policy?->type ?? '-' }}</td>
                                            <td class="p-2 xl:p-3">{{ $policy?->propinsurer ?? '-' }}</td>
                                            <td class="p-2 xl:p-3">{{ $policy?->propinsurer_num ?? '-' }}</td>
                                            <td class="p-2 xl:p-3">{{ $policy?->end_date ? \Carbon\Carbon::parse($policy->end_date)->format('d-m-Y') : '-' }}</td>
                                            <td class="p-2 xl:p-3">{{ $policy->internal_status ?? '-' }}</td>
                                            <td class="p-2 xl:p-3">{{ $policy->uw_status ?? '-' }}</td>
                                            <td class="p-2 xl:p-3">{{ $policy->client->assignedUser->name ?? '-' }}</td>
                                            <td class="p-2 xl:p-3 flex items-center justify-end">
                                                <button id="dropdown-1-button" data-dropdown-toggle="dropdown-1" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                                    @svg('grid-dots', 'icon icon-grid-dots w-5 h-5')
                                                </button>
                                                <div id="dropdown-1" class="hidden z-10 w-44 bg-slate-100 rounded divide-y divide-gray-100 shadow">
                                                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdown-1-button">
                                                        <li>
                                                            <button type="button" class="block py-2 px-4 hover:bg-vivid-amethyst hover:text-white w-full text-left rounded">Edit</button>
                                                        </li>
                                                    </ul>
                                                    <div class="py-1">
                                                        <button type="button" class="block py-2 px-4 hover:bg-vivid-amethyst hover:text-white w-full text-left rounded">Delete</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr class="border-b">
                                            <th colspan="10" scope="row" class="p-2 xl:p-3 font-medium text-gray-900 pointer-events-auto">No results found.</th>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
             
                @if (count($policies) && $policies->hasPages())
                    <div class="mt-4 px-4">
                        {{ $policies->links() }}
                    </div>
                @endif
            @endif

            <div class="productfilter-form bg-white py-4 lg:py-6 xl:py-8 2xl:py-10 relative w-full">
                <!-- @include('livewire.productfilterform') -->
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
    <!-- Modal -->
    <div id="pdfModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-3/4 h-5/6 flex flex-col">
            
            <!-- Header -->
            <div class="flex justify-between items-center p-4 border-b">
                <h2 class="text-lg font-semibold">Formal Letter PDF</h2>
                <button onclick="closePdfModal()" class="text-gray-500 hover:text-gray-700">
                    ✖
                </button>
            </div>

            <!-- Body (PDF iframe) -->
            <div class="flex-1 overflow-hidden">
                <iframe id="pdfFrame" src="" class="w-full h-full"></iframe>
            </div>
        </div>
    </div>
</div>
<script>
    function openPdfInModal(url) {
        document.getElementById('pdfFrame').src = url;
        document.getElementById('pdfModal').classList.remove('hidden');
    }

    function closePdfModal() {
        document.getElementById('pdfModal').classList.add('hidden');
        document.getElementById('pdfFrame').src = ''; // clear iframe for cleanliness
    }
</script>