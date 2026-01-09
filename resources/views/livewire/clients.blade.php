<x-slot name="header">
    <h2 class="font-bold text-lg xl:text-2xl text-white">
        {{ __('Client Lists') }}
    </h2>
</x-slot>
<div class="px-4 lg:px-6 xl:px-8 w-full relative md:-mt-16 xl:-mt-20 pb-8" x-data="{ isOpen: true }" @click.outside="isOpen = false">
    <div class="btn-header md:absolute md:right-6 xl:right-8 md:-top-[56px] lg:-top-[66px] xl:-top-[70px] z-10 flex items-center gap-4 mb-4  md:mb-0 justify-between md:justify-normal">
        <!-- <button class="bg-pos-gradient hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-5 rounded text-sm xl:text-base">{{ __('Search Client') }}</button> -->
        <button wire:click="create()" class="bg-pos-gradient hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-5 rounded text-sm xl:text-base">{{ __('Add New Client') }}</button>
    </div>

    <div class="w-full relative">
        <div class="bg-white overflow-hidden shadow-xl rounded-lg px-4 py-4">
            <div class="clientfilter-form bg-white py-4 lg:py-6 xl:py-8 2xl:py-10 relative w-full">
                @include('livewire.clientfilterform')
            </div>
            @if($isOpen)
                @include('livewire.createclient')
            @endif
            @if ($searchApplied)
                @if ($allclients->count())
                    <div class="mt-4 mb-4 px-4">
                        @if (!$viewAll && $allclients->hasPages())
                            <div>
                                {{ $allclients->links() }}
                            </div>
                            <div class="flex justify-center">
                                <button wire:click="viewAllClients" class="text-gray-700" style="margin-top: -40px;">
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
                        @elseif (!$viewAll && !$allclients->hasPages())
                            Showing all {{ $totalResults }} results
                        @endif
                    </div>
                @endif
            @endif
            @if (session()->has('message'))
                <div class="w-full relative md:max-w-screen-xl ml-auto mr-auto">
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 p-2 xl:p-3 shadow-md my-3" role="alert">
                      <div class="flex">
                        <div>
                          <p class="text-sm">{{ session('message') }}</p>
                        </div>
                      </div>
                    </div>
                </div>
            @endif
            <div class="bg-gray-white w-full relative" id="searchResults">
                <div class="w-full">
                    <!-- Start coding here -->
                    <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                        {{-- Bulk actions bar --}}
                        @if (Auth::user()->role == 1 || Auth::user()->role == 4)
                            <div class="flex items-center justify-between px-4 py-2 border-b">
                                <div>
                                    @if(count($selectedClients) > 0)
                                        <span class="text-xs text-gray-600">
                                            Selected: {{ count($selectedClients) }}
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-400">
                                            No clients selected
                                        </span>
                                    @endif
                                </div>
                                <div>
                                <button
                                    type="button"
                                    onclick="
                                        if (!confirm('Are you sure you want to delete selected clients?')) {
                                            event.stopImmediatePropagation();
                                            event.preventDefault();
                                        }
                                    "
                                    wire:click="bulkDelete"
                                    {{ count($selectedClients) ? '' : 'disabled' }}
                                    class="bg-red-600 hover:bg-red-700 text-white text-xs xl:text-sm font-medium py-1.5 px-3 rounded
                                           {{ count($selectedClients) ? '' : 'opacity-40 cursor-not-allowed' }}">
                                    Delete Selected
                                </button>
                                <button
                                    type="button"
                                    wire:click="bulkExport"
                                    {{ count($selectedClients) ? '' : 'disabled' }}
                                    class="bg-pos-gradient hover:bg-pos-gradient text-white text-xs xl:text-sm font-medium ml-2 py-1.5 px-3 rounded
                                           {{ count($selectedClients) ? '' : 'opacity-40 cursor-not-allowed' }}">
                                    Export Selected
                                </button>
                                </div>
                            </div>
                        @endif
                        <div class="overflow-x-auto">
                            <table class="w-full text-xs xl:text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-slate-100">
                                    <tr>
                                        @if (Auth::user()->role == 1 || Auth::user()->role == 4)
                                            <th class="p-2 xl:p-3 w-10">
                                                {{-- Master checkbox: toggles all row checkboxes via Alpine --}}
                                                <input type="checkbox"
                                                       x-on:change="
                                                            const checked = $el.checked;
                                                            $el.closest('table')
                                                               .querySelectorAll('tbody input[data-client-checkbox]')
                                                               .forEach(cb => {
                                                                    cb.checked = checked;
                                                                    cb.dispatchEvent(new Event('change'));
                                                               });
                                                       ">
                                            </th>
                                        @endif
                                        <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('first_name')">
                                            Name
                                            @if($sort_by === 'first_name') {!! $sort_direction === 'asc' ? '▲' : '▼' !!} @endif
                                        </th>
                                        <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('address')">
                                            Address
                                            @if($sort_by === 'address') {!! $sort_direction === 'asc' ? '▲' : '▼' !!} @endif
                                        </th>
                                        <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('county_of_birth')">
                                            County
                                            @if($sort_by === 'county_of_birth') {!! $sort_direction === 'asc' ? '▲' : '▼' !!} @endif
                                        </th>
                                        <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('county_of_birth')">
                                            Nationality
                                            @if($sort_by === 'county_of_birth') {!! $sort_direction === 'asc' ? '▲' : '▼' !!} @endif
                                        </th>
                                        <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('date_of_birth')">
                                            Date of Birth
                                            @if($sort_by === 'date_of_birth') {!! $sort_direction === 'asc' ? '▲' : '▼' !!} @endif
                                        </th>
                                        <th scope="col" class="p-2 xl:p-3">Contact No</th>
                                        <th scope="col" class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('email')">
                                            Email
                                            @if($sort_by === 'email') {!! $sort_direction === 'asc' ? '▲' : '▼' !!} @endif
                                        </th>
                                        <th class="p-2 xl:p-3 cursor-pointer" wire:click="sortBy('broker_name')">
                                            Broker
                                            @if($sort_by === 'broker_name') {!! $sort_direction === 'asc' ? '▲' : '▼' !!} @endif
                                        </th>
                                        <th scope="col" class="p-2 xl:p-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($allclients as $client)
                                    <tr class="border-b {{ $client->left_our_agency ? 'bg-red-100' : '' }}">
                                        @if (Auth::user()->role == 1 || Auth::user()->role == 4)
                                            <td class="p-2 xl:p-3">
                                                <input type="checkbox"
                                                       data-client-checkbox
                                                       wire:model.live="selectedClients"
                                                       value="{{ $client->id }}"
                                                       wire:key="client-checkbox-{{ $client->id }}">
                                            </td>
                                        @endif
                                        <th scope="row" wire:click="edit({{ $client->id }})" class="p-2 xl:p-3 font-medium text-gray-900 pointer-events-auto hover:text-vivid-amethyst cursor-pointer">{{ $client->first_name }} {{ $client->last_name }}</th>
                                        <td class="p-2 xl:p-3">{{ ($client->address) ?: '--' }}....</td>
                                        <td class="p-2 xl:p-3">{{ $client->postcode }}</td>
                                        <td class="p-2 xl:p-3">{{ $client->county_of_birth }}</td>
                                        <td class="p-2 xl:p-3">
                                            {{ \Carbon\Carbon::parse($client->date_of_birth)->format('d/m/Y') }}
                                        </td>
                                        <td class="p-2 xl:p-3">
                                            @if($client->home_no)
                                                Home: {{ $client->home_no }} <br>
                                            @endif
                                            @if($client->work_no)
                                                Work: {{ $client->work_no }} <br>
                                            @endif
                                            @if($client->mobile_no)
                                                Mobile: {{ $client->mobile_no }}
                                            @endif
                                        </td>
                                        <td class="p-2 xl:p-3">{{ $client->email }}</td>
                                        <td class="p-2 xl:p-3">{{ $client->broker_name ?? '-' }}</td>
                                        <td class="p-2 xl:p-3 flex items-center justify-end" x-data="{ open: false }">
                                            <button @click="open = !open" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none">
                                                @svg('grid-dots', 'icon icon-grid-dots w-5 h-5')
                                            </button>
                                            <div x-show="open" @click.outside="open = false" class="absolute right-0 z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                                <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdown-{{ $client->id }}-button">
                                                    <li>
                                                        <button type="button" wire:click="edit({{ $client->id }})" class="block py-2 px-4 hover:bg-gray-100 w-full text-left">Edit</button>
                                                    </li>
                                                </ul>
                                                @if (Auth::user()->role == 1 || Auth::user()->role == 4)
                                                <div class="py-1">
                                                    <button type="button" wire:click="delete({{ $client->id }})" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">Delete</button>
                                                </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="border-b">
                                        <th colspan="9" scope="row" class="p-2 xl:p-3 font-medium text-gray-900 pointer-events-auto">No results found.</th>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
<script>    
    $(document).ready(function() {
        Livewire.on('scrollToResults', () => {
            const el = $('#searchResults');
            if (el.length) {
                $('html, body').animate({
                    scrollTop: el.offset().top
                }, 600);
            }
        });
    });

</script>
<script>
    document.addEventListener('livewire:initialized', () => {
        window.Livewire.on('scroll-to-results', () => {
            setTimeout(() => {
                const el = document.getElementById('searchResults');
                if (el) {
                    el.scrollIntoView({ behavior: 'smooth' });
                }
            }, 1000); // 2000 milliseconds = 2 seconds
        });
    });
</script>