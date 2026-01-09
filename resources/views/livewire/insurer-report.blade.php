<x-slot name="header">
    <h2 class="font-bold text-lg xl:text-2xl text-white">
        {{ __('Insurer Report') }}
    </h2>
</x-slot>
<div class="px-4 lg:px-6 xl:px-8 w-full relative md:-mt-16 xl:-mt-20 pb-8">
    <!-- <div class="btn-header md:absolute md:right-6 xl:right-8 md:-top-[56px] lg:-top-[66px] xl:-top-[70px] z-10 flex items-center gap-4 mb-4  md:mb-0 justify-between md:justify-normal">
        <button @click="isOpen = !isOpen" class="bg-pos-gradient hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-5 rounded text-sm xl:text-base">{{ __('Search Insurer Report') }}</button>
    </div> -->
    <div class="w-full relative">
        <div class="bg-white overflow-hidden shadow-xl rounded-lg px-4 py-4">
            <div class="insurer-report-form bg-white py-4 lg:py-6 xl:py-8 2xl:py-10 relative w-full">
                @include('livewire.insurerreportfilterform')
            </div>
             @if ($searchApplied)
            <div class="bg-gray-white w-full relative">
                <div class="w-full">
                    <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-xs xl:text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-slate-100">
                                    <tr>
                                        <th scope="col" class="p-2 xl:p-3 border border-gray-300 border-t-0 border-l-0">{{ __('Insurer') }}</th>
                                        <th colspan="2" scope="col" class="p-2 xl:p-3 border border-gray-300 border-t-0">{{ __('Life Policy') }}</th> 
                                        <th colspan="2" scope="col" class="p-2 xl:p-3 border border-gray-300 border-t-0">{{ __('House Policy') }}</th> 
                                        <th colspan="2" scope="col" class="p-2 xl:p-3 border border-gray-300 border-t-0">{{ __('Motor Policy') }}</th>
                                        <th colspan="2" scope="col" class="p-2 xl:p-3 border border-gray-300 border-t-0">{{ __('Mortgage Policy') }}</th>
                                        <th colspan="2" scope="col" class="p-2 xl:p-3 border border-gray-300 border-t-0">{{ __('Commercial Policy') }}</th>
                                        <th colspan="2" scope="col" class="p-2 xl:p-3 border border-gray-300 border-t-0">{{ __('Pension Policy') }}</th>
                                        <th colspan="2" scope="col" class="p-2 xl:p-3 border border-gray-300 border-t-0">{{ __('Private Accident Policy') }}</th>
                                        <th colspan="2" scope="col" class="p-2 xl:p-3 border border-gray-300 border-t-0">{{ __('Cancer Only Policy') }}</th>
                                        <th colspan="2" scope="col" class="p-2 xl:p-3 border border-gray-300 border-t-0 border-r-0">{{ __('Total Policies') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="text-xs">
                                    <tr class="text-white bg-oxford-blue">
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">&nbsp;</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Count</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Turnover</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Count</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Turnover</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Count</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Turnover</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Count</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Turnover</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Count</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Turnover</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Count</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Turnover</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Count</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Turnover</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Count</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Turnover</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Count</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Product Turnover</td>
                                    </tr>
                                    @forelse ($insurerStats as $insurer)
                                    <tr class="border-b">
                                        <td class="p-2 xl:p-3 border border-dark-sapphire insurername">{{ $insurer['name'] }}</td>

                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $insurer['life_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($insurer['life_monthprem'], 2) }}</td>

                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $insurer['house_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($insurer['house_monthprem'], 2) }}</td>

                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $insurer['motor_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($insurer['motor_monthprem'], 2) }}</td>

                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $insurer['mortgage_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($insurer['mortgage_monthprem'], 2) }}</td>

                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $insurer['commercial_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($insurer['commercial_monthprem'], 2) }}</td>

                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $insurer['pension_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($insurer['pension_monthprem'], 2) }}</td>

                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $insurer['pap_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($insurer['pap_monthprem'], 2) }}</td>

                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $insurer['cancer_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($insurer['cancer_monthprem'], 2) }}</td>

                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $insurer['total_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($insurer['total_monthprem'], 2) }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="17" class="p-3 text-center text-gray-600">No results found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if (count($insurerStats) > 0)
                                <tfoot class="text-xs text-white bg-deep-indigo-blue font-medium">
                                    <tr>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">Total</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $totals['life_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($totals['life_monthprem'], 2) }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $totals['house_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($totals['house_monthprem'], 2) }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $totals['motor_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($totals['motor_monthprem'], 2) }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $totals['mortgage_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($totals['mortgage_monthprem'], 2) }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $totals['commercial_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($totals['commercial_monthprem'], 2) }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $totals['pension_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($totals['pension_monthprem'], 2) }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $totals['pap_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($totals['pap_monthprem'], 2) }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $totals['cancer_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($totals['cancer_monthprem'], 2) }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">{{ $totals['total_count'] }}</td>
                                        <td class="p-2 xl:p-3 border border-dark-sapphire">€{{ number_format($totals['total_monthprem'], 2) }}</td>
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