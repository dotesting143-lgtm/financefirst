<!-- Modal -->
    <div id="paymentnotesdetails" class="{{ $isOpen ? 'block' : 'hidden' }} fixed z-50 inset-0 overflow-y-auto ease-out duration-400">
        <div class="flex items-start justify-center min-h-screen py-4 px-4 text-center sm:block w-full">
            <!-- Modal Overlay -->
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal Content -->
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all align-middle max-w-screen-xl w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <!-- Modal Header -->
                <div class="flex items-center justify-between px-4 sm:px-6 py-3 rounded-t-lg bg-slate-100">
                    <h3 class="text-lg lg:text-xl font-medium text-black uppercase">{{ __('Note Details') }}</h3>
                    <button wire:click="closeModal" type="button" class="oxford-blue bg-transparent hover:bg-oxford-blue hover:text-white rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center border border-oxford-blue">
                        @svg('close', 'icon icon-close w-3 h-3')
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Form -->
                <form wire:submit.prevent="{{ $payment_id ? 'update' : 'store' }}">
                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <strong>{{ __('Validation Errors:') }}</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form Fields -->
                    <div class="adduser-form bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
                            <!-- Client ID -->
                            <div class="sm:col-span-3">
                                <label for="client_id" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Client') }}:</label>
                                <select id="client_id" wire:model="client_id" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
                                    <option selected value="">{{ __('Select Client') }}</option>
                                    <option value="1">{{ __('Alan Henvey (Test)') }}</option>
                                    <option value="11725">{{ __('Mr. Test Client') }}</option>
                                </select>
                            </div>

                            <!-- Policy Number -->
                            <div class="sm:col-span-3">
                                <label for="policy_no" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Policy Number') }}:</label>
                                <input type="text" id="policy_no" wire:model="policy_no" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" placeholder="{{ __('Policy no') }}">
                            </div>

                            <!-- Broker -->
                            <div class="sm:col-span-2">
                                <label for="broker" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Broker') }}:</label>
                                <input type="text" id="broker" wire:model="broker" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" placeholder="{{ __('Broker') }}">
                            </div>

                            <!-- Insurer -->
                            <div class="sm:col-span-2">
                                <label for="insurer" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Insurer') }}:</label>
                                <select id="insurer" wire:model="insurer" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
                                    <option selected value="">{{ __('Select Insurer') }}</option>
                                    <option value="AIG">{{ __('AIG') }}</option>
                                    <option value="Aviva">{{ __('Aviva') }}</option>
                                    <option value="Brokers Ireland">{{ __('Brokers Ireland') }}</option>
                                    <option value="EZ Fees">{{ __('EZ Fees') }}</option>
                                    <option value="Friends First">{{ __('Friends First') }}</option>
                                    <option value="Greenman">{{ __('Greenman') }}</option>
                                    <option value="Hive">{{ __('Hive') }}</option>
                                    <option value="ICS">{{ __('ICS') }}</option>
                                    <option value="Irish Life">{{ __('Irish Life') }}</option>
                                    <option value="MIS Underwriting">{{ __('MIS Underwriting') }}</option>
                                    <option value="New Court">{{ __('New Court') }}</option>
                                    <option value="New Ireland">{{ __('New Ireland') }}</option>
                                    <option value="Royal London">{{ __('Royal London') }}</option>
                                    <option value="Wealth Options">{{ __('Wealth Options') }}</option>
                                    <option value="Zurich">{{ __('Zurich') }}</option>
                                </select>
                            </div>

                            <!-- Premium -->
                            <div class="sm:col-span-2">
                                <label for="premium" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Premium') }}:</label>
                                <input type="text" id="premium" wire:model="premium" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" placeholder="{{ __('Premium') }}">
                            </div>

                            <!-- Last Paid -->
                            <div class="sm:col-span-2">
                                <label for="last_paid" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Last Paid') }}:</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                                        @svg('calendar', 'icon icon-plus w-6 h-6 text-black')
                                    </div>
                                    <input id="last_paid" x-ref="datepicker15"
					        		x-init="flatpickr($refs.datepicker15, {
					            	enableTime: false,
					            	dateFormat: 'd-m-Y'
					        		})" wire:model="last_paid" datepicker15 datepicker-orientation="bottom right" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('Last Paid') }}">
                                </div>
                            </div>

                            <!-- Arrears Amount -->
                            <div class="sm:col-span-2">
                                <label for="arrears_amount" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Arrears Amount') }}:</label>
                                <input type="text" id="arrears_amount" wire:model="arrears_amount" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" placeholder="{{ __('Arrears Amount') }}">
                            </div>

                            <!-- Payments Missed -->
                            <div class="sm:col-span-2">
                                <label for="payments_missed" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Payments Missed') }}:</label>
                                <input type="text" id="payments_missed" wire:model="payments_missed" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" placeholder="{{ __('Payments Missed') }}">
                            </div>

                            <!-- Meeting Date -->
                            <div class="sm:col-span-2">
                                <label for="meeting_date" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Meeting Date') }}:</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                                        @svg('calendar', 'icon icon-plus w-6 h-6 text-black')
                                    </div>
                                    <input id="meeting_date" x-ref="datepicker16"
					        		x-init="flatpickr($refs.datepicker16, {
					            	enableTime: false,
					            	dateFormat: 'd-m-Y'
					        		})" wire:model="meeting_date" datepicker16 datepicker-orientation="bottom right" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('Meeting Date') }}">
                                </div>
                            </div>

                            <!-- Follow Up Date -->
                            <div class="sm:col-span-2">
                                <label for="follow_up_date" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Follow Up Date') }}:</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                                        @svg('calendar', 'icon icon-plus w-6 h-6 text-black')
                                    </div>
                                    <input id="follow_up_date" x-ref="datepicker17"
					        		x-init="flatpickr($refs.datepicker17, {
					            	enableTime: false,
					            	dateFormat: 'd-m-Y'
					        		})" wire:model="follow_up_date" datepicker17 datepicker-orientation="bottom right" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('Follow Up Date') }}">
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="sm:col-span-2">
                                <label for="status" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Status') }}:</label>
                                <select id="status" wire:model="status" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
                                    <option selected value="">{{ __('Select status') }}</option>
                                    <option value="open">{{ __('Open') }}</option>
                                    <option value="closed">{{ __('Closed') }}</option>
                                </select>
                            </div>

                            <!-- Client In-Active -->
                            <div class="col-span-full">
                                <label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Client In-Active') }}:</label>
                                <div class="flex py-2.5">
                                    <div class="flex items-center">
                                        <input id="client_inactive" wire:model="client_inactive" name="client_inactive" type="radio" value="1" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                                        <label for="client_inactive" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Yes</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="col-span-full">
                                <label for="notes" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Notes') }}:</label>
                                <textarea rows="4" id="notes" wire:model="notes" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray"></textarea>
                            </div>
                        </div>

                        <div class="flex justify-center pt-8">
                            <button type="submit" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
                                {{ $payment_id ? __('Update') : __('Submit Now') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>