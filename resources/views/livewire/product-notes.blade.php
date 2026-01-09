<x-slot name="header">
    <h2 class="font-bold text-lg xl:text-2xl text-white">
        {{ __('Products Notes List') }}
    </h2>
</x-slot>
<div class="px-4 lg:px-6 xl:px-8 w-full relative md:-mt-16 xl:-mt-20 pb-8">
    <!-- <div class="btn-header md:absolute md:right-6 xl:right-8 md:-top-[56px] lg:-top-[66px] xl:-top-[70px] z-10 flex items-center gap-4 mb-4  md:mb-0 justify-between md:justify-normal">
        <button @click="isOpen = !isOpen" class="bg-pos-gradient hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-5 rounded text-sm xl:text-base">{{ __('Search Product Notes') }}</button>
    </div> -->
    
             
          
    @if($isOpen)
        @include('livewire.productnotes.editnotesform')
    @endif
    <div class="w-full relative">
        <div class="bg-white overflow-hidden shadow-xl rounded-lg px-4 py-4">
            <div class="productnote-form bg-white py-4 lg:py-6 xl:py-8 2xl:py-10 relative w-full">
                @include('livewire.productnotefilterform')
            </div>
            @if ($searchApplied)
                @if ($allproductnotes->count())
                    <div class="mt-4 mb-4 px-4">
                        @if (!$viewAll && $allproductnotes->hasPages())
                            <div>
                                {{ $allproductnotes->links() }}
                            </div>
                            <div class="flex justify-center">
                                <button wire:click="viewAllNotes" class="text-gray-700" style="margin-top: -40px;">
                                    View All
                                </button>
                            </div>
                        @elseif ($viewAll)
                            <div class="flex justify-center">
                                <button wire:click="resetPaginationView" class="text-gray-700">
                                    Back to Pagination
                                </button>
                            </div>
                        @endif
                    </div>
                @endif
            <div class="bg-gray-white w-full relative">
                <div class="w-full">
                    <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-xs xl:text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-slate-100">
                                    <tr>
                                        <th class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('first_name')">
                                            Name
                                            @if($sort_by === 'first_name') {!! $sort_direction === 'asc' ? '▲' : '▼' !!} @endif
                                        </th>
                                        <th class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('subject')">
                                            Subject
                                            @if($sort_by === 'subject') {!! $sort_direction === 'asc' ? '▲' : '▼' !!} @endif
                                        </th>
                                        <th class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('insurer')">
                                            Insurer
                                            @if($sort_by === 'insurer') {!! $sort_direction === 'asc' ? '▲' : '▼' !!} @endif
                                        </th>
                                        <th class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('created_by')">
                                            Product Created By
                                            @if($sort_by === 'created_by') {!! $sort_direction === 'asc' ? '▲' : '▼' !!} @endif
                                        </th>
                                        <th class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('assigned_to')">
                                            Note Assigned To
                                            @if($sort_by === 'assigned_to') {!! $sort_direction === 'asc' ? '▲' : '▼' !!} @endif
                                        </th>
                                        <th class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('updated_at')">
                                            Last Updated
                                            @if($sort_by === 'updated_at') {!! $sort_direction === 'asc' ? '▲' : '▼' !!} @endif
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($allproductnotes as $productnote)
                                    <tr class="border-b">
                                        <!--<th scope="row" wire:click="edit({{ $productnote->id }})" class="p-2 xl:p-3 font-medium text-gray-900 pointer-events-auto cursor-pointer hover:text-vivid-amethyst">{{ $productnote->first_name }} {{ $productnote->last_name }}</th>-->
                                        <!-- <td class="p-2 xl:p-3">{{ $productnote->subject }} {{ $productnote->getFullPolicyId() ? '(' . $productnote->getFullPolicyId() . ')' : '' }} {{ $productnote->getPolicy?->clientPolicy?->propinsurer_num ? '(' . $productnote->getPolicy?->clientPolicy?->propinsurer_num . ')' : '' }}</td> -->
                                        <th scope="row" 
                                            wire:click="edit({{ $productnote->id }})" 
                                            class="p-2 xl:p-3 font-medium text-gray-900 pointer-events-auto cursor-pointer hover:text-vivid-amethyst">

                                            {{ $productnote->getPolicy?->clientPolicy?->client?->first_name }}
                                            {{ $productnote->getPolicy?->clientPolicy?->client?->last_name }}
                                        </th>
                                        @php
                                            $clientId = $productnote->getClientId();
                                        @endphp
                                        <td class="p-2 xl:p-3">
                                            {{ $productnote->subject }}

                                            @if ($clientId)
                                                <a 
                                                    href="{{ url('/clients?openclient=' . $clientId . '&tab=products') }}" 
                                                    target="_blank" 
                                                    class="text-blue-600 cursor-pointer hover:text-vivid-amethyst"
                                                >
                                                    {{ $productnote->getFullPolicyId() }}
                                                </a>
                                            @endif

                                            {{ $productnote->getPolicy?->clientPolicy?->propinsurer_num 
                                                ? '(' . $productnote->getPolicy->clientPolicy->propinsurer_num . ')' 
                                                : '' }}
                                        </td>
                                        <td class="p-2 xl:p-3">
                                            @if($sort_by === 'insurer' && isset($productnote->insurer_name))
                                                {{ $productnote->insurer_name }}
                                            @else
                                                {{ $productnote->getPolicy?->clientPolicy?->propinsurer }}
                                            @endif
                                        </td>
                                        <td class="p-2 xl:p-3">{{ $productnote->createdBy?->name }}</td>
                                        <td class="p-2 xl:p-3">{{ $productnote->assignTo?->name }}</td>
                                        <td class="p-2 xl:p-3">{{ $productnote->getLastUpdatedDate() }}</td>
                                    </tr>
                                    @empty
                                    <tr class="border-b">
                                        <th colspan="7" scope="row" class="p-2 xl:p-3 font-medium text-gray-900 pointer-events-auto">No results found.</th>
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
</div>