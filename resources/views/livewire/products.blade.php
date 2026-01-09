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
            <div class="productfilter-form bg-white py-4 lg:py-6 xl:py-8 2xl:py-10 relative w-full">
                @include('livewire.productfilterform')
            </div>
            @if($isOpen)
                @include('livewire.createclient')
            @endif
            @if (session()->has('success'))
                <div class="bg-red-100 text-gray-100 text-center font-semibold p-3 rounded-lg shadow-md mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if ($searchApplied)
                @if ($policies->count())
                    <div class="mt-4 mb-4 px-4">
                        @if (!$viewAll && $policies->hasPages())
                            <div>
                                {{ $policies->links() }}
                            </div>
                            <div class="flex justify-center">
                                <button wire:click="viewAllProducts" class="text-gray-700" style="margin-top: -40px;">
                                    View All
                                </button>
                            </div>
                        @elseif ($viewAll)
                            Showing all {{ $totalResults }} results
                            <div class="flex justify-center">
                                <button wire:click="resetPaginationView" class="text-gray-700">
                                    Back to Pagination
                                </button>
                            </div>
                        @elseif (!$viewAll && !$policies->hasPages())
                            Showing all {{ $totalResults }} results
                        @endif
                    </div>
                @endif
                <div class="bg-gray-white w-full relative">
                    <div class="w-full">
                        <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                            <div class="flex items-center justify-between px-4 py-2 border-b">
                                @php
                                    $selectedCount = is_array($selectedPolicies) ? count($selectedPolicies) : 0;
                                @endphp

                                <div>
                                    @if($selectedCount > 0)
                                        <span class="text-xs text-gray-600">
                                            Selected: {{ $selectedCount }}
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-400">
                                            No products selected
                                        </span>
                                    @endif
                                </div>

                                <button
                                    type="button"
                                    onclick="
                                        if (!confirm('Are you sure you want to delete selected products?')) {
                                            event.stopImmediatePropagation();
                                            event.preventDefault();
                                        }
                                    "
                                    wire:click="bulkRemove"
                                    {{ $selectedCount ? '' : 'disabled' }}
                                    class="bg-red-600 hover:bg-red-700 text-white text-xs xl:text-sm font-medium py-1.5 px-3 rounded
                                           {{ $selectedCount ? '' : 'opacity-40 cursor-not-allowed' }}">
                                    Delete Selected
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-xs xl:text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-slate-100">
                                        <tr>
                                            <th scope="col" class="p-2 xl:p-3 w-10">
                                                <input type="checkbox"
                                                       onclick="
                                                            const checked = this.checked;
                                                            const table = this.closest('table');
                                                            table.querySelectorAll('tbody input[data-policy-checkbox]').forEach(cb => {
                                                                cb.checked = checked;
                                                                cb.dispatchEvent(new Event('change'));
                                                            });
                                                       ">
                                            </th>
                                            <!-- Name -->
                                            <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('client.first_name')">
                                                {{ __('Name') }}
                                                @if($sortField == 'client.first_name')
                                                    {!! $sortDirection === 'asc' ? '&#9650;' : '&#9660;' !!}
                                                @endif
                                            </th>

                                            <!-- Contact No -->
                                            <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('client.home_no')">
                                                {{ __('Contact No') }}
                                                @if($sortField == 'client.home_no')
                                                    {!! $sortDirection === 'asc' ? '&#9650;' : '&#9660;' !!}
                                                @endif
                                            </th>

                                            <!-- Product Type -->
                                            <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('type')">
                                                {{ __('Product Type') }}
                                                @if($sortField == 'type')
                                                    {!! $sortDirection === 'asc' ? '&#9650;' : '&#9660;' !!}
                                                @endif
                                            </th>

                                            <!-- Insurer -->
                                            <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('propinsurer')">
                                                {{ __('Insurer') }}
                                                @if($sortField == 'propinsurer')
                                                    {!! $sortDirection === 'asc' ? '&#9650;' : '&#9660;' !!}
                                                @endif
                                            </th>

                                            <!-- Insurer Num -->
                                            <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('propinsurer_num')">
                                                {{ __('Insurer Num') }}
                                                @if($sortField == 'propinsurer_num')
                                                    {!! $sortDirection === 'asc' ? '&#9650;' : '&#9660;' !!}
                                                @endif
                                            </th>

                                            <!-- End Date -->
                                            <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('end_date')">
                                                {{ __('End Date') }}
                                                @if($sortField == 'end_date')
                                                    {!! $sortDirection === 'asc' ? '&#9650;' : '&#9660;' !!}
                                                @endif
                                            </th>

                                            <!-- Int Status -->
                                            <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('internal_status')">
                                                {{ __('Int Status') }}
                                                @if($sortField == 'internal_status')
                                                    {!! $sortDirection === 'asc' ? '&#9650;' : '&#9660;' !!}
                                                @endif
                                            </th>

                                            <!-- U/W Status -->
                                            <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('uw_status')">
                                                {{ __('U/W Status') }}
                                                @if($sortField == 'uw_status')
                                                    {!! $sortDirection === 'asc' ? '&#9650;' : '&#9660;' !!}
                                                @endif
                                            </th>

                                            <!-- Broker -->
                                            <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('broker')">
                                                {{ __('Broker') }}
                                                @if($sortField == 'broker')
                                                    {!! $sortDirection === 'asc' ? '&#9650;' : '&#9660;' !!}
                                                @endif
                                            </th>

                                            <!-- Actions -->
                                            <th scope="col" class="p-2 xl:p-3"><span class="sr-only">{{ __('Actions') }}</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                                    
                                        @forelse($policies as $policy)
                                        <tr class="border-b
                                            {{ $policy->left_our_agency
                                                ? 'bg-red-100 hover:bg-red-100'
                                                : '' }}">
                                            <td class="p-2 xl:p-3">
                                                <input type="checkbox"
                                                       data-policy-checkbox
                                                       wire:model.live="selectedPolicies"
                                                       value="{{ $policy->id }}"
                                                       wire:key="policy-checkbox-{{ $policy->id }}">
                                            </td>
                                            <th scope="row"
                                                wire:click="edit({{ $policy->client_id }})"
                                                class="p-2 xl:p-3 font-medium text-gray-900 pointer-events-auto cursor-pointer hover:text-vivid-amethyst">
                                                {{ $policy->client?->first_name ?? '-' }}
                                                {{ $policy->client?->last_name ?? '-' }}
                                                ( {{ $policy->getFullPolicyId() }} )
                                            </th>
                                            <td class="p-2 xl:p-3">
                                                {{ $policy->client?->home_no ?? '-' }}
                                            </td>
                                            <td class="p-2 xl:p-3">{{ $policy?->type ?? '-' }}</td>
                                            <td class="p-2 xl:p-3">{{ $this->getPropInsurer($policy->id) ?? '-' }}</td>
                                            <td class="p-2 xl:p-3">{{ $this->getPropInsurerNumByPolicyId($policy->id) ?? '-' }}</td>
                                            <td class="p-2 xl:p-3">{{ $policy?->end_date ? \Carbon\Carbon::parse($policy->end_date)->format('d-m-Y') : '-' }}</td>
                                            <td class="p-2 xl:p-3">{{ $this->getInternalStatus($policy->id) ?? '-' }}</td>
                                             <td class="p-2 xl:p-3">{{ $this->getUwStatus($policy->id) ?? '-' }}</td>
                                            <td class="p-2 xl:p-3">{{ $this->getBroker($policy->client_id) ?? '-' }}</td>
                                            <td class="p-2 xl:p-3">
                                                <button type="button"
                                                    onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                                    wire:click="remove({{ $policy->id }})"
                                                    class="block py-2 px-4 hover:bg-vivid-amethyst hover:text-white w-full text-left rounded">
                                                    Delete
                                                </button>
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
    <!-- Modal -->
    <div id="pdfModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-3/4 h-5/6 flex flex-col">
            
            <!-- Header -->
            <div class="flex justify-between items-center p-4 border-b">
                <h2 class="text-lg font-semibold">Letter PDF</h2>
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