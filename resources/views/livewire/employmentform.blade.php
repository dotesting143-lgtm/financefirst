<form x-data="{secOpen: false}">
    <div class="personal-details bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
            <div class="sm:col-span-2">
                <label for="employment_status" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Status') }}</label>
                <select id="employment_status" wire:model="employment_status" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
                <option selected>{{ __('Select status') }}</option>
                <option value="{{ __('Homemaker') }}">{{ __('Homemaker') }}</option>
                <option value="{{ __('Retired') }}">{{ __('Retired') }}</option>
                <option value="{{ __('Employee') }}">{{ __('Employee') }}</option>
                <option value="{{ __('Self-Employed') }}">{{ __('Self-Employed') }}</option>
                <option value="{{ __('Unemployed') }}">{{ __('Unemployed') }}</option>
                </select>
            </div>
            <div class="sm:col-span-2">
                <label for="employment_type" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Employee Status') }}</label>
                <div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
                    <div class="flex items-center">
                        <input id="employment_type_paye" wire:model="employment_type" type="radio" value="PAYE" name="employment_type" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="employment_type_paye" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">PAYE</label>
                    </div>
                    <div class="flex items-center">
                        <input id="employment_type_parttime" wire:model="employment_type" type="radio" value="Part-Time" name="employment_type" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="employment_type_parttime" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Part-Time</label>
                    </div>
                    <div class="flex items-center">
                        <input id="employment_temp" wire:model="employment_type" type="radio" value="Temp/Contract" name="employment_type" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="employment_temp" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Temp/Contract</label>
                    </div>
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="net_salary_pm" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Net Salary p.m. (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="net_salary_pm" placeholder="{{ __('2.00') }}" wire:model="net_salary_pm">
            </div>
            <div class="sm:col-span-2">
                <label for="gross_basic_salary_pm" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('a) Gross Basic Salary p.a. (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="gross_basic_salary_pm" placeholder="{{ __('3.00') }}" wire:model="gross_basic_salary_pm">
            </div>
            <div class="sm:col-span-2">
                <label for="overtime_pa" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('b) Overtime p.a. (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="overtime_pa" placeholder="{{ __('3.00') }}" wire:model="overtime_pa">
            </div>
            <div class="sm:col-span-2">
                <label for="overtime-frequency" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">
                    {{ __('Overtime Frequency') }}:
                </label>
                <div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
                    <div class="flex items-center">
                        <input id="overtime_freq_guaranteed" wire:model="overtime_freq" type="radio" value="Guaranteed" name="overtime_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="overtime_freq_guaranteed" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Guaranteed</label>
                    </div>
                    <div class="flex items-center">
                        <input id="overtime_freq_regular" wire:model="overtime_freq" type="radio" value="Regular" name="overtime_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="overtime_freq_regular" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Regular</label>
                    </div>
                    <div class="flex items-center">
                        <input id="overtime_freq_irregular" wire:model="overtime_freq" type="radio" value="Irregular" name="overtime_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="overtime_freq_irregular" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Irregular</label>
                    </div>
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="bonus_pa" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('c) Bonus p.a. (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="bonus_pa" placeholder="{{ __('5.00') }}" wire:model="bonus_pa">
            </div>
            <div class="sm:col-span-2">
                <label for="bonus_freq" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Bonus Frequency') }}</label>
                <div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
                    <div class="flex items-center">
                        <input id="bonus_freq_guaranteed" wire:model="bonus_freq" type="radio" value="Guaranteed" name="bonus_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="bonus_freq_guaranteed" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Guaranteed</label>
                    </div>
                    <div class="flex items-center">
                        <input id="bonus_freq_regular" wire:model="bonus_freq" type="radio" value="Regular" name="bonus_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="bonus_freq_regular" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Regular</label>
                    </div>
                    <div class="flex items-center">
                        <input id="bonus_freq_irregular" wire:model="bonus_freq" type="radio" value="Irregular" name="bonus_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="bonus_freq_irregular" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Irregular</label>
                    </div>
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="commission_pa" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('d) Commission p.a. (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="commission_pa" placeholder="{{ __('6.00') }}" wire:model="commission_pa">
            </div>
            <div class="sm:col-span-2">
                <label for="commission_freq" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Commission Frequency') }}</label>
                <div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
                    <div class="flex items-center">
                        <input id="commission_freq_guaranteed" wire:model="commission_freq" type="radio" value="Guaranteed" name="commission_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="commission_freq_guaranteed" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Guaranteed</label>
                    </div>
                    <div class="flex items-center">
                        <input id="commission_freq_regular" wire:model="commission_freq" type="radio" value="Regular" name="commission_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="commission_freq_regular" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Regular</label>
                    </div>
                    <div class="flex items-center">
                        <input id="commission_freq_irregular" wire:model="commission_freq" type="radio" value="Irregular" name="commission_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="commission_freq_irregular" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Irregular</label>
                    </div>
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="gross_salary_total" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Gross Salary p.a. (€) (Total of a,b,c,d)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="gross_salary_total" placeholder="{{ __('7.00') }}" wire:model="gross_salary_total">
            </div>
            <div class="sm:col-span-2">
                <label for="other_income_pa_non_rental" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Other Income (non-rental) p.a. (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="other_income_pa_non_rental" placeholder="{{ __('8.00') }}" wire:model="other_income_pa_non_rental">
            </div>
            <div class="sm:col-span-2">
                <label for="other_income_pa_existing_rental" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Other Income (existing rental) p.a. (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="other_income_pa_existing_rental" placeholder="{{ __('8.00') }}" wire:model="other_income_pa_existing_rental">
            </div>
            <div class="sm:col-span-2">
                <label for="other_income_pa_anticipated_rental" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Other Income (anticipated rental) (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="other_income_pa_anticipated_rental" placeholder="{{ __('8.00') }}" wire:model="other_income_pa_anticipated_rental">
            </div>
            <div class="sm:col-span-2">
                <label for="other_income_pa_total_rental" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Other Income (total rental) p.a. (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="other_income_pa_total_rental" placeholder="{{ __('8.00') }}" wire:model="other_income_pa_total_rental">
            </div>
            <div class="col-span-full text-base lg:text-lg xl:text-xl text-black font-bold">{{ __('If Self-Employed, the following section can be skipped') }}:</div>
            <div class="sm:col-span-2">
                <label for="occupation" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Occupation') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="occupation" placeholder="{{ __('12') }}" wire:model="occupation">
            </div>
            <div class="sm:col-span-2">
                <label for="employer" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Employer') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="employer" placeholder="{{ __('13') }}" wire:model="employer">
            </div>
            <div class="sm:col-span-2">
                <label for="length_service_yr" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Length of Service') }}</label>
                <div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="length_service_yr" placeholder="{{ __('Year') }}" wire:model="length_service_yr">
                    </div>
                    <div class="sm:col-span-3">
                        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="length_service_mo" placeholder="{{ __('Months') }}" wire:model="length_service_mo">
                    </div> 
                </div>
            </div>
            <div class="col-span-full">
                <label for="employer_address1" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Address') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="employer_address1" placeholder="{{ __('13') }}" wire:model="employer_address1">
            </div>
            <div class="col-span-full text-base lg:text-lg xl:text-xl text-black font-bold">{{ __('If less than one year in current position please state') }}:</div>
            <div class="sm:col-span-2">
                <label for="prev_occupation" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Previous Occupation') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="prev_occupation" placeholder="{{ __('12') }}" wire:model="prev_occupation">
            </div>
            <div class="sm:col-span-2">
                <label for="prev_employer" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Previous Employer') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="prev_employer" placeholder="{{ __('13') }}" wire:model="prev_employer">
            </div>
            <div class="sm:col-span-2">
                <label for="prev_length_service_yr" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Previous Length of Service') }}</label>
                <div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="prev_length_service_yr" placeholder="{{ __('Year') }}" wire:model="prev_length_service_yr">
                    </div>
                    <div class="sm:col-span-3">
                        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="prev_length_service_mo" placeholder="{{ __('Months') }}" wire:model="prev_length_service_mo">
                    </div> 
                </div>
            </div>
            <div class="col-span-full">
                <label for="prev_employer_address1" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Address') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="prev_employer_address1" placeholder="{{ __('13') }}" wire:model="prev_employer_address1">
            </div>
            <div class="col-span-full text-base lg:text-lg xl:text-xl text-black font-bold">{{ __('Self-Employed Details') }}:</div>
            <div class="sm:col-span-2">
                <label for="business_name" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Business Name') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="business_name" placeholder="{{ __('Enter Business Name') }}" wire:model="business_name">
            </div>
            <div class="sm:col-span-2">
                <label for="business_nature" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Nature of Business') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="business_nature" placeholder="{{ __('Enter Nature of Business') }}" wire:model="business_nature">
            </div>
            <div class="sm:col-span-2">
                <label for="dateestablished" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Date Established') }}</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                        <svg class="w-6 h-6 text-black"  viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 4H18C19.0609 4 20.0783 4.42143 20.8284 5.17157C21.5786 5.92172 22 6.93913 22 8V18C22 19.0609 21.5786 20.0783 20.8284 20.8284C20.0783 21.5786 19.0609 22 18 22H6C4.93913 22 3.92172 21.5786 3.17157 20.8284C2.42143 20.0783 2 19.0609 2 18V8C2 6.93913 2.42143 5.92172 3.17157 5.17157C3.92172 4.42143 4.93913 4 6 4ZM6 6C5.46957 6 4.96086 6.21071 4.58579 6.58579C4.21071 6.96086 4 7.46957 4 8V18C4 18.5304 4.21071 19.0391 4.58579 19.4142C4.96086 19.7893 5.46957 20 6 20H18C18.5304 20 19.0391 19.7893 19.4142 19.4142C19.7893 19.0391 20 18.5304 20 18V8C20 7.46957 19.7893 6.96086 19.4142 6.58579C19.0391 6.21071 18.5304 6 18 6H6Z" fill="currentColor"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 10C3 9.73478 3.10536 9.48043 3.29289 9.29289C3.48043 9.10536 3.73478 9 4 9H20C20.2652 9 20.5196 9.10536 20.7071 9.29289C20.8946 9.48043 21 9.73478 21 10C21 10.2652 20.8946 10.5196 20.7071 10.7071C20.5196 10.8946 20.2652 11 20 11H4C3.73478 11 3.48043 10.8946 3.29289 10.7071C3.10536 10.5196 3 10.2652 3 10ZM8 2C8.26522 2 8.51957 2.10536 8.70711 2.29289C8.89464 2.48043 9 2.73478 9 3V7C9 7.26522 8.89464 7.51957 8.70711 7.70711C8.51957 7.89464 8.26522 8 8 8C7.73478 8 7.48043 7.89464 7.29289 7.70711C7.10536 7.51957 7 7.26522 7 7V3C7 2.73478 7.10536 2.48043 7.29289 2.29289C7.48043 2.10536 7.73478 2 8 2ZM16 2C16.2652 2 16.5196 2.10536 16.7071 2.29289C16.8946 2.48043 17 2.73478 17 3V7C17 7.26522 16.8946 7.51957 16.7071 7.70711C16.5196 7.89464 16.2652 8 16 8C15.7348 8 15.4804 7.89464 15.2929 7.70711C15.1054 7.51957 15 7.26522 15 7V3C15 2.73478 15.1054 2.48043 15.2929 2.29289C15.4804 2.10536 15.7348 2 16 2Z" fill="currentColor"/>
                            <path d="M8 13C8 13.2652 7.89464 13.5196 7.70711 13.7071C7.51957 13.8946 7.26522 14 7 14C6.73478 14 6.48043 13.8946 6.29289 13.7071C6.10536 13.5196 6 13.2652 6 13C6 12.7348 6.10536 12.4804 6.29289 12.2929C6.48043 12.1054 6.73478 12 7 12C7.26522 12 7.51957 12.1054 7.70711 12.2929C7.89464 12.4804 8 12.7348 8 13ZM8 17C8 17.2652 7.89464 17.5196 7.70711 17.7071C7.51957 17.8946 7.26522 18 7 18C6.73478 18 6.48043 17.8946 6.29289 17.7071C6.10536 17.5196 6 17.2652 6 17C6 16.7348 6.10536 16.4804 6.29289 16.2929C6.48043 16.1054 6.73478 16 7 16C7.26522 16 7.51957 16.1054 7.70711 16.2929C7.89464 16.4804 8 16.7348 8 17ZM13 13C13 13.2652 12.8946 13.5196 12.7071 13.7071C12.5196 13.8946 12.2652 14 12 14C11.7348 14 11.4804 13.8946 11.2929 13.7071C11.1054 13.5196 11 13.2652 11 13C11 12.7348 11.1054 12.4804 11.2929 12.2929C11.4804 12.1054 11.7348 12 12 12C12.2652 12 12.5196 12.1054 12.7071 12.2929C12.8946 12.4804 13 12.7348 13 13ZM13 17C13 17.2652 12.8946 17.5196 12.7071 17.7071C12.5196 17.8946 12.2652 18 12 18C11.7348 18 11.4804 17.8946 11.2929 17.7071C11.1054 17.5196 11 17.2652 11 17C11 16.7348 11.1054 16.4804 11.2929 16.2929C11.4804 16.1054 11.7348 16 12 16C12.2652 16 12.5196 16.1054 12.7071 16.2929C12.8946 16.4804 13 16.7348 13 17ZM18 13C18 13.2652 17.8946 13.5196 17.7071 13.7071C17.5196 13.8946 17.2652 14 17 14C16.7348 14 16.4804 13.8946 16.2929 13.7071C16.1054 13.5196 16 13.2652 16 13C16 12.7348 16.1054 12.4804 16.2929 12.2929C16.4804 12.1054 16.7348 12 17 12C17.2652 12 17.5196 12.1054 17.7071 12.2929C17.8946 12.4804 18 12.7348 18 13ZM18 17C18 17.2652 17.8946 17.5196 17.7071 17.7071C17.5196 17.8946 17.2652 18 17 18C16.7348 18 16.4804 17.8946 16.2929 17.7071C16.1054 17.5196 16 17.2652 16 17C16 16.7348 16.1054 16.4804 16.2929 16.2929C16.4804 16.1054 16.7348 16 17 16C17.2652 16 17.5196 16.1054 17.7071 16.2929C17.8946 16.4804 18 16.7348 18 17Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <input id="date_estd" x-ref="datepicker"
                        x-init="flatpickr($refs.datepicker, {
                        enableTime: false,
                        allowInput: true,
                        dateFormat: 'd/m/Y',
                        })" wire:model="date_estd" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('Year') }}">
                </div>
            </div>
            <div class="sm:col-span-4">
                <label for="selfaddress" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Address') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="selfaddress" placeholder="{{ __('Address') }}" wire:model="selfaddress">
            </div>
            <div class="sm:col-span-2">
                <label for="business_role" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Business Role') }}</label>
                <div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
                    <div class="flex items-center">
                        <input id="business_role_soletrader" wire:model="business_role" type="radio" value="Sole Trader" name="business_role" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="business_role_soletrader" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Sole Trader</label>
                    </div>
                    <div class="flex items-center">
                        <input id="business_role_director" wire:model="business_role" type="radio" value="Director/Partner" name="business_role" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="business_role_director" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Director/Partner</label>
                    </div>
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="shareholding_pc" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('% Shareholding (if applicable)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="shareholding_pc" placeholder="{{ __('Shareholding') }}" wire:model="shareholding_pc">
            </div>
            <div class="sm:col-span-2">
                <label for="net_profit_3yrs_avg" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Last 3 years Net Profit average (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="net_profit_3yrs_avg" placeholder="{{ __('Shareholding') }}" wire:model="net_profit_3yrs_avg">
            </div>
            <div class="sm:col-span-2">
                <label for="drawings_3yrs_avg" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Last 3 years Drawings average (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="drawings_3yrs_avg" placeholder="{{ __('Shareholding') }}" wire:model="drawings_3yrs_avg">
            </div>
        </div>
    </div>
    <div x-show="secOpen" class="mt-5 personal-details second-person bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <h3 class="mb-4 text-xl font-medium text-black uppercase bg-slate-100 px-5 py-5">{{ __('Second Person') }}</h3>
        <div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
            <div class="sm:col-span-2">
                <label for="sec_employment_status" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Status') }}</label>
                <select id="sec_employment_status" wire:model="sec_employment_status" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
                <option selected>{{ __('Select status') }}</option>
                <option value="{{ __('Homemaker') }}">{{ __('Homemaker') }}</option>
                <option value="{{ __('Retired') }}">{{ __('Retired') }}</option>
                <option value="{{ __('Employee') }}">{{ __('Employee') }}</option>
                <option value="{{ __('Self-Employed') }}">{{ __('Self-Employed') }}</option>
                <option value="{{ __('Unemployed') }}">{{ __('Unemployed') }}</option>
                </select>
            </div>
            <div class="sm:col-span-2">
                <label for="status" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Employee Status') }}</label>
                <div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
                    <div class="flex items-center">
                        <input id="sec_employment_type_paye" wire:model="sec_employment_type" type="radio" value="PAYE" name="sec_employment_type" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="sec_employment_type_paye" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">PAYE</label>
                    </div>
                    <div class="flex items-center">
                        <input id="sec_employment_type_part_time" wire:model="sec_employment_type" type="radio" value="Part-Time" name="sec_employment_type" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="sec_employment_type_part_time" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Part-Time</label>
                    </div>
                    <div class="flex items-center">
                        <input id="sec_employment_type_temp" wire:model="sec_employment_type" type="radio" value="Temp/Contract" name="sec_employment_type" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="sec_employment_type_temp" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Temp/Contract</label>
                    </div>
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="netsalary" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Net Salary p.m. (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_net_salary_pm" placeholder="{{ __('2.00') }}" wire:model="sec_net_salary_pm">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_gross_basic_salary_pm" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('a) Gross Basic Salary p.a. (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_gross_basic_salary_pm" placeholder="{{ __('3.00') }}" wire:model="sec_gross_basic_salary_pm">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_overtime_pa" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('b) Overtime p.a. (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_overtime_pa" placeholder="{{ __('3.00') }}" wire:model="sec_overtime_pa">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_overtime_freq" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Overtime Frequency') }}</label>
                <div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
                    <div class="flex items-center">
                        <input id="sec_overtime_freq_guaranteed" wire:model="sec_overtime_freq" type="radio" value="Guaranteed" name="sec_overtime_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="sec_overtime_freq_guaranteed" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Guaranteed</label>
                    </div>
                    <div class="flex items-center">
                        <input id="sec_overtime_freq_regular" wire:model="sec_overtime_freq" type="radio" value="Regular" name="sec_overtime_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="sec_overtime_freq_regular" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Regular</label>
                    </div>
                    <div class="flex items-center">
                        <input id="sec_overtime_freq_irregular" wire:model="sec_overtime_freq" type="radio" value="Irregular" name="sec_overtime_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="sec_overtime_freq_irregular" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Irregular</label>
                    </div>
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="sec_bonus_pa" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('c) Bonus p.a. (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_bonus_pa" placeholder="{{ __('5.00') }}" wire:model="sec_bonus_pa">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_bonus_freq" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Bonus Frequency') }}</label>
                <div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
                    <div class="flex items-center">
                        <input id="sec_bonus_freq_guaranteed" wire:model="sec_bonus_freq" type="radio" value="Guaranteed" name="sec_bonus_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="sec_bonus_freq_guaranteed" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Guaranteed</label>
                    </div>
                    <div class="flex items-center">
                        <input id="sec_bonus_freq_regular" wire:model="sec_bonus_freq" type="radio" value="Regular" name="sec_bonus_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="sec_bonus_freq_regular" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Regular</label>
                    </div>
                    <div class="flex items-center">
                        <input id="sec_bonus_freq_irregular" wire:model="sec_bonus_freq" type="radio" value="Irregular" name="sec_bonus_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="sec_bonus_freq_irregular" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Irregular</label>
                    </div>
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="sec_commission_pa" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('d) Commission p.a. (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_commission_pa" placeholder="{{ __('6.00') }}" wire:model="sec_commission_pa">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_commission_freq" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Commission Frequency') }}</label>
                <div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
                    <div class="flex items-center">
                        <input id="sec_commission_freq_guaranteed" wire:model="sec_commission_freq" type="radio" value="Guaranteed" name="sec_commission_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="sec_commission_freq_guaranteed" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Guaranteed</label>
                    </div>
                    <div class="flex items-center">
                        <input id="sec_commission_freq_regular" wire:model="sec_commission_freq" type="radio" value="Regular" name="sec_commission_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="sec_commission_freq_regular" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Regular</label>
                    </div>
                    <div class="flex items-center">
                        <input id="sec_commission_freq_irregular" wire:model="sec_commission_freq" type="radio" value="Irregular" name="sec_commission_freq" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="sec_commission_freq_irregular" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Irregular</label>
                    </div>
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="sec_gross_salary_total" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Gross Salary p.a. (€) (Total of a,b,c,d)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_gross_salary_total" placeholder="{{ __('7.00') }}" wire:model="sec_gross_salary_total">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_other_income_pa_non_rental" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Other Income (non-rental) p.a. (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_other_income_pa_non_rental" placeholder="{{ __('8.00') }}" wire:model="sec_other_income_pa_non_rental">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_other_income_pa_existing_rental" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Other Income (existing rental) p.a. (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_other_income_pa_existing_rental" placeholder="{{ __('8.00') }}" wire:model="sec_other_income_pa_existing_rental">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_other_income_pa_anticipated_rental" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Other Income (anticipated rental) (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_other_income_pa_anticipated_rental" placeholder="{{ __('8.00') }}" wire:model="sec_other_income_pa_anticipated_rental">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_other_income_pa_total_rental" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Other Income (total rental) p.a. (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_other_income_pa_total_rental" placeholder="{{ __('8.00') }}" wire:model="sec_other_income_pa_total_rental">
            </div>
            <div class="col-span-full text-base lg:text-lg xl:text-xl text-black font-bold">{{ __('If Self-Employed, the following section can be skipped') }}:</div>
            <div class="sm:col-span-2">
                <label for="sec_occupation" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Occupation') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_occupation" placeholder="{{ __('12') }}" wire:model="sec_occupation">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_employer" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Employer') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_employer" placeholder="{{ __('13') }}" wire:model="sec_employer">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_length_service_yr" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Length of Service') }}</label>
                <div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_length_service_yr" placeholder="{{ __('Year') }}" wire:model="sec_length_service_yr">
                    </div>
                    <div class="sm:col-span-3">
                        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_length_service_mo" placeholder="{{ __('Months') }}" wire:model="sec_length_service_mo">
                    </div> 
                </div>
            </div>
            <div class="col-span-full">
                <label for="sec_employer_address1" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Address') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_employer_address1" placeholder="{{ __('13') }}" wire:model="sec_employer_address1">
            </div>
            <div class="col-span-full text-base lg:text-lg xl:text-xl text-black font-bold">{{ __('If less than one year in current position please state') }}:</div>
            <div class="sm:col-span-2">
                <label for="sec_prev_occupation" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Previous Occupation') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_prev_occupation" placeholder="{{ __('12') }}" wire:model="sec_prev_occupation">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_prev_employer" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Previous Employer') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_prev_employer" placeholder="{{ __('13') }}" wire:model="sec_prev_employer">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_prev_length_service_yr" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Previous Length of Service') }}</label>
                <div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_prev_length_service_yr" placeholder="{{ __('Year') }}" wire:model="sec_prev_length_service_yr">
                    </div>
                    <div class="sm:col-span-3">
                        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_prev_length_service_mo" placeholder="{{ __('Months') }}" wire:model="sec_prev_length_service_mo">
                    </div> 
                </div>
            </div>
            <div class="col-span-full">
                <label for="sec_prev_employer_address2" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Address') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_prev_employer_address2" placeholder="{{ __('13') }}" wire:model="sec_prev_employer_address2">
            </div>
            <div class="col-span-full text-base lg:text-lg xl:text-xl text-black font-bold">{{ __('Self-Employed Details') }}:</div>
            <div class="sm:col-span-2">
                <label for="sec_business_name" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Business Name') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_business_name" placeholder="{{ __('Enter Business Name') }}" wire:model="sec_business_name">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_business_nature" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Nature of Business') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_business_nature" placeholder="{{ __('Enter Nature of Business') }}" wire:model="sec_business_nature">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_date_estd" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Date Established') }}</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                        <svg class="w-6 h-6 text-black"  viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 4H18C19.0609 4 20.0783 4.42143 20.8284 5.17157C21.5786 5.92172 22 6.93913 22 8V18C22 19.0609 21.5786 20.0783 20.8284 20.8284C20.0783 21.5786 19.0609 22 18 22H6C4.93913 22 3.92172 21.5786 3.17157 20.8284C2.42143 20.0783 2 19.0609 2 18V8C2 6.93913 2.42143 5.92172 3.17157 5.17157C3.92172 4.42143 4.93913 4 6 4ZM6 6C5.46957 6 4.96086 6.21071 4.58579 6.58579C4.21071 6.96086 4 7.46957 4 8V18C4 18.5304 4.21071 19.0391 4.58579 19.4142C4.96086 19.7893 5.46957 20 6 20H18C18.5304 20 19.0391 19.7893 19.4142 19.4142C19.7893 19.0391 20 18.5304 20 18V8C20 7.46957 19.7893 6.96086 19.4142 6.58579C19.0391 6.21071 18.5304 6 18 6H6Z" fill="currentColor"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 10C3 9.73478 3.10536 9.48043 3.29289 9.29289C3.48043 9.10536 3.73478 9 4 9H20C20.2652 9 20.5196 9.10536 20.7071 9.29289C20.8946 9.48043 21 9.73478 21 10C21 10.2652 20.8946 10.5196 20.7071 10.7071C20.5196 10.8946 20.2652 11 20 11H4C3.73478 11 3.48043 10.8946 3.29289 10.7071C3.10536 10.5196 3 10.2652 3 10ZM8 2C8.26522 2 8.51957 2.10536 8.70711 2.29289C8.89464 2.48043 9 2.73478 9 3V7C9 7.26522 8.89464 7.51957 8.70711 7.70711C8.51957 7.89464 8.26522 8 8 8C7.73478 8 7.48043 7.89464 7.29289 7.70711C7.10536 7.51957 7 7.26522 7 7V3C7 2.73478 7.10536 2.48043 7.29289 2.29289C7.48043 2.10536 7.73478 2 8 2ZM16 2C16.2652 2 16.5196 2.10536 16.7071 2.29289C16.8946 2.48043 17 2.73478 17 3V7C17 7.26522 16.8946 7.51957 16.7071 7.70711C16.5196 7.89464 16.2652 8 16 8C15.7348 8 15.4804 7.89464 15.2929 7.70711C15.1054 7.51957 15 7.26522 15 7V3C15 2.73478 15.1054 2.48043 15.2929 2.29289C15.4804 2.10536 15.7348 2 16 2Z" fill="currentColor"/>
                            <path d="M8 13C8 13.2652 7.89464 13.5196 7.70711 13.7071C7.51957 13.8946 7.26522 14 7 14C6.73478 14 6.48043 13.8946 6.29289 13.7071C6.10536 13.5196 6 13.2652 6 13C6 12.7348 6.10536 12.4804 6.29289 12.2929C6.48043 12.1054 6.73478 12 7 12C7.26522 12 7.51957 12.1054 7.70711 12.2929C7.89464 12.4804 8 12.7348 8 13ZM8 17C8 17.2652 7.89464 17.5196 7.70711 17.7071C7.51957 17.8946 7.26522 18 7 18C6.73478 18 6.48043 17.8946 6.29289 17.7071C6.10536 17.5196 6 17.2652 6 17C6 16.7348 6.10536 16.4804 6.29289 16.2929C6.48043 16.1054 6.73478 16 7 16C7.26522 16 7.51957 16.1054 7.70711 16.2929C7.89464 16.4804 8 16.7348 8 17ZM13 13C13 13.2652 12.8946 13.5196 12.7071 13.7071C12.5196 13.8946 12.2652 14 12 14C11.7348 14 11.4804 13.8946 11.2929 13.7071C11.1054 13.5196 11 13.2652 11 13C11 12.7348 11.1054 12.4804 11.2929 12.2929C11.4804 12.1054 11.7348 12 12 12C12.2652 12 12.5196 12.1054 12.7071 12.2929C12.8946 12.4804 13 12.7348 13 13ZM13 17C13 17.2652 12.8946 17.5196 12.7071 17.7071C12.5196 17.8946 12.2652 18 12 18C11.7348 18 11.4804 17.8946 11.2929 17.7071C11.1054 17.5196 11 17.2652 11 17C11 16.7348 11.1054 16.4804 11.2929 16.2929C11.4804 16.1054 11.7348 16 12 16C12.2652 16 12.5196 16.1054 12.7071 16.2929C12.8946 16.4804 13 16.7348 13 17ZM18 13C18 13.2652 17.8946 13.5196 17.7071 13.7071C17.5196 13.8946 17.2652 14 17 14C16.7348 14 16.4804 13.8946 16.2929 13.7071C16.1054 13.5196 16 13.2652 16 13C16 12.7348 16.1054 12.4804 16.2929 12.2929C16.4804 12.1054 16.7348 12 17 12C17.2652 12 17.5196 12.1054 17.7071 12.2929C17.8946 12.4804 18 12.7348 18 13ZM18 17C18 17.2652 17.8946 17.5196 17.7071 17.7071C17.5196 17.8946 17.2652 18 17 18C16.7348 18 16.4804 17.8946 16.2929 17.7071C16.1054 17.5196 16 17.2652 16 17C16 16.7348 16.1054 16.4804 16.2929 16.2929C16.4804 16.1054 16.7348 16 17 16C17.2652 16 17.5196 16.1054 17.7071 16.2929C17.8946 16.4804 18 16.7348 18 17Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <input id="sec_date_estd" x-ref="datepicker2"
                        x-init="flatpickr($refs.datepicker2, {
                        enableTime: false,
                        allowInput: true,
                        dateFormat: 'd/m/Y',
                        })" wire:model="sec_date_estd" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('Year') }}">
                </div>
            </div>
            <div class="sm:col-span-4">
                <label for="sec_business_add1" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Address') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_business_add1" placeholder="{{ __('Address') }}" wire:model="sec_business_add1">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_business_role" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Business Role') }}</label>
                <div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
                    <div class="flex items-center">
                        <input id="sec_business_role_soletrader" wire:model="sec_business_role" type="radio" value="Sole Trader" name="sec_business_role" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="soletrader" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Sole Trader</label>
                    </div>
                    <div class="flex items-center">
                        <input id="sec_business_role_director" wire:model="sec_business_role" type="radio" value="Director/Partner" name="sec_business_role" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                        <label for="director" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Director/Partner</label>
                    </div>
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="sec_shareholding_pc" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('% Shareholding (if applicable)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_shareholding_pc" placeholder="{{ __('Shareholding') }}" wire:model="sec_shareholding_pc">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_net_profit_3yrs_avg" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Last 3 years Net Profit average (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_net_profit_3yrs_avg" placeholder="{{ __('Shareholding') }}" wire:model="sec_net_profit_3yrs_avg">
            </div>
            <div class="sm:col-span-2">
                <label for="sec_drawings_3yrs_avg" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Last 3 years Drawings average (€)') }}</label>
                <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_drawings_3yrs_avg" placeholder="{{ __('Shareholding') }}" wire:model="sec_drawings_3yrs_avg">
            </div>
        </div>
    </div>
    <div class="px-4 py-3 sm:px-6 flex justify-between">
        <button type="button" @click="secOpen = !secOpen" class="text-sm md:text-base xl:text-lg text-oxford-blue font-medium underline underline-offset-4 hover:text-vivid-amethyst">{{ __('Add Second Person +') }}</button>
        <div class="hidden sm:flex sm:flex-1 sm:h-[40px] md:h-[44px]"></div>
        <div class="sm:absolute sm:left-1/2 sm:transform sm:-translate-x-1/2">
            <button wire:click.prevent="store()" type="button" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
                {{ __('Save Now') }}
            </button>
        </div>
    </div>
</form>