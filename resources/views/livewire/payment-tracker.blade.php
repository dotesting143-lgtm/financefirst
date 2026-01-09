<x-slot name="header">
    <h2 class="font-bold text-lg xl:text-2xl text-white">
        {{ __('Payment Tracker List') }}
    </h2>
</x-slot>

<div class="px-4 lg:px-6 xl:px-8 w-full relative md:-mt-16 xl:-mt-20 pb-8">
    <!-- Buttons for Search and Add New Client -->
    <div class="btn-header md:absolute md:right-6 xl:right-8 md:-top-[56px] lg:-top-[66px] xl:-top-[70px] z-10 flex items-center gap-4 mb-4 md:mb-0 justify-between md:justify-normal">
        <button wire:click="create" class="bg-pos-gradient hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-5 rounded text-sm xl:text-base">
            {{ __('Add New Client') }}
        </button>
    </div>

    @include('livewire.payment.paymentaddnotes')

    <div class="w-full relative">
        <div class="bg-white overflow-hidden shadow-xl rounded-lg px-4 py-4">
            <div class="payment-tracker-form bg-white py-4 lg:py-6 xl:py-8 2xl:py-10 relative w-full">
                @include('livewire.paymenttrackerfilterform')
            </div>
            @if ($isSearchPerformed)
            <div class="bg-gray-white w-full relative">
                <div class="w-full">
                    <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-xs xl:text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-slate-100">
                                    <tr>
                                        <th scope="col" class="p-2 xl:p-3">{{ __('Name') }}</th>
                                        <th scope="col" class="p-2 xl:p-3">{{ __('Broker') }}</th>
                                        <th scope="col" class="p-2 xl:p-3">{{ __('Last Meeting Date') }}</th>
                                        <th scope="col" class="p-2 xl:p-3">{{ __('Follow Up Date') }}</th>
                                        <th scope="col" class="p-2 xl:p-3">{{ __('Payments Missed') }}</th>
                                        <th scope="col" class="p-2 xl:p-3">{{ __('Arrears') }}</th>
                                        <th scope="col" class="p-2 xl:p-3">{{ __('Last Updated') }}</th>
                                        <th scope="col" class="p-2 xl:p-3">{{ __('Status') }}</th>
                                        <th scope="col" class="p-2 xl:p-3">
                                            <span class="sr-only">{{ __('Actions') }}</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($payments as $payment)
                                        <tr class="border-b">
                                            <th scope="row" wire:click="edit({{ $payment->id }})" class="p-2 xl:p-3 font-medium text-gray-900 pointer-events-auto cursor-pointer hover:text-vivid-amethyst">
                                                {{ $payment->client ? $payment->client->title . ' ' . $payment->client->first_name . ' ' . $payment->client->last_name : 'N/A' }}
                                            </th>
                                            <td class="p-2 xl:p-3">{{ $payment->broker }}</td>
                                            <td class="p-2 xl:p-3">{{ $payment->meeting_date ? Carbon\Carbon::parse($payment->meeting_date)->format('d/m/Y') : 'N/A' }}</td>
                                            <td class="p-2 xl:p-3">{{ $payment->follow_up_date ? Carbon\Carbon::parse($payment->follow_up_date)->format('d/m/Y') : 'N/A' }}</td>
                                            <td class="p-2 xl:p-3">{{ $payment->payments_missed }}</td>
                                            <td class="p-2 xl:p-3">{{ $payment->arrears_amount }}</td>
                                            <td class="p-2 xl:p-3">{{ $payment->updated_at->format('d/m/Y') }}</td>
                                            <td class="p-2 xl:p-3">
                                                <div class="flex items-center">
                                                    <div class="{{ $payment->status === 'open' ? 'bg-emerald-600' : 'bg-red-500' }} rounded-full rounded-lg size-3 mr-2"></div>
                                                    {{ ucfirst($payment->status) }}
                                                </div>
                                            </td>
                                            <td class="p-2 xl:p-3 flex items-center justify-end">
                                                <div x-data="{ open: false }" class="relative">
                                                    <!-- Dropdown Button -->
                                                    <button @click="open = !open" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                                        @svg('grid-dots', 'icon icon-grid-dots w-5 h-5')
                                                    </button>

                                                    <!-- Dropdown Menu -->
                                                    <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 w-44 bg-slate-100 rounded divide-y divide-gray-100 shadow">
                                                        <ul class="py-1 text-sm text-gray-700">
                                                            <li>
                                                                <button wire:click="edit({{ $payment->id }})" type="button" class="block py-2 px-4 hover:bg-vivid-amethyst hover:text-white w-full text-left rounded">Edit</button>
                                                            </li>
                                                        </ul>
                                                        <div class="py-1">
                                                            <button wire:click="delete({{ $payment->id }})" type="button" class="block py-2 px-4 hover:bg-vivid-amethyst hover:text-white w-full text-left rounded">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="p-2 xl:p-3 text-center text-gray-500">
                                                {{ __('No payment records found.') }}
                                            </td>
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
</div>
<script>
    function initDropdowns() {
        // Reinitialize dropdowns
        document.querySelectorAll('[data-dropdown-toggle]').forEach(button => {
            const dropdownId = button.getAttribute('data-dropdown-toggle');
            const dropdown = document.getElementById(dropdownId);

            button.addEventListener('click', () => {
                dropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (event) => {
                if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });
    }

    // Initialize dropdowns when the page loads
    document.addEventListener('DOMContentLoaded', () => {
        initDropdowns();
    });

    // Reinitialize dropdowns after Livewire updates the DOM
    Livewire.hook('message.processed', () => {
        initDropdowns();
    });
</script>