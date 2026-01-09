@php
    $hasSecondPerson = !empty($sec_first_name) || !empty($sec_last_name);
@endphp
<form
    x-data="{
        secOpen: @js($hasSecondPerson),
        selectedDate: '',
        source_of_lead: @entangle('source_of_lead')
    }"
>
  @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <strong>{{ __('Validation Errors:') }}</strong>
        <ul>
            @foreach ($errors->messages() as $field => $messages)
                @foreach ($messages as $message)
                    <li>- <strong>{{ $field }}</strong>: {{ $message }}</li>
                @endforeach
            @endforeach
        </ul>
    </div>
  @endif
  <div class="personal-details bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
    <div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
      <div 
          :class="{
              'sm:col-span-2': source_of_lead === 'office' || source_of_lead === 'client',
              'sm:col-span-3': !(source_of_lead === 'office' || source_of_lead === 'client')
          }"
      >
        <label for="source_of_lead" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Source of lead') }}</label>
        <select id="source_of_lead" wire:model="source_of_lead" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
          <option value="">{{ __('Select source') }}</option>
          <option value="office" {{ $source_of_lead === 'office' ? 'selected' : '' }}>{{ __('Office') }}</option>
          <option value="broker" {{ $source_of_lead === 'broker' ? 'selected' : '' }}>{{ __('Broker (my own lead)') }}</option>
          <option value="client" {{ $source_of_lead === 'client' ? 'selected' : '' }}>{{ __('Client (referred by client - office lead)') }}</option>
      </select>
        @error('source_of_lead') <span class="text-red-500">{{ $message }}</span>@enderror
      </div>
      <template x-if="source_of_lead === 'office' || source_of_lead === 'client'">
        <div class="sm:col-span-2">
          <label for="source_of_lead_sub" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">&nbsp;</label>
          <select id="source_of_lead_sub" wire:model="source_of_lead_sub" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
            <option value="">{{ __('Please select') }}</option>
            <option value="Andy">{{ __('Andy') }}</option>
            <option value="Elaine">{{ __('Elaine') }}</option>
            <option value="Luke">{{ __('Luke') }}</option>
            <option value="Walk-in">{{ __('Walk-in') }}</option>
            <option value="Leads factory">{{ __('Leads factory') }}</option>
          </select>
          @error('source_of_lead_sub') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>
      </template>
      <div 
          :class="{
              'sm:col-span-2': source_of_lead === 'office' || source_of_lead === 'client',
              'sm:col-span-3': !(source_of_lead === 'office' || source_of_lead === 'client')
          }"
      >
        <label for="broker" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Broker') }}</label>
        <select id="broker" wire:model="broker" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray"
          @if(auth()->user()->role == 2 || auth()->user()->role == 3)
              @if(!$isCreateMode) disabled @endif
          @endif>
          <option value="">{{ __('Please select') }}</option>

          @if((auth()->user()->role == 2 || auth()->user()->role == 3) && $isCreateMode)
          <option value="{{ auth()->id() }}">{{ auth()->user()->name }}</option>
          @else
            @foreach(($brokersFilter ?? []) as $broker)
                <option value="{{ $broker['id'] }}">{{ $broker['name'] }}</option>
            @endforeach
          @endif
        </select>
        @error('broker') <span class="text-red-500">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label class="flex items-center gap-3">
              <input
                  type="checkbox"
                  wire:model="left_our_agency"
                  class="w-4 h-4"
              >
              <span class="text-xs lg:text-sm font-medium oxford-blue">
                  {{ __('Left Our Agency') }}
              </span>
          </label>
      </div>
      <div class="sm:col-span-2">
              <label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">
                  {{ __('Vulnerable person?') }}
              </label>

              <select
                  wire:model="vulnerable_person"
                  class="block text-xs lg:text-sm font-medium border rounded-md w-full p-2.5"
              >
                  <option value="">{{ __('Select') }}</option>
                  <option value="Yes">{{ __('Yes') }}</option>
                  <option value="No">{{ __('No') }}</option>
              </select>
      </div>
      <div class="sm:col-span-2">
        <label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">
            {{ __('Consent to Marketing?') }}
        </label>

        <select
            wire:model="marketing_consent"
            class="block text-xs lg:text-sm font-medium border rounded-md w-full p-2.5"
        >
            <option value="">{{ __('Select') }}</option>
            <option value="1">{{ __('Yes') }}</option>
            <option value="0">{{ __('No') }}</option>
        </select>
    </div>
    <div
          x-show="$wire.marketing_consent == 1"
          x-cloak
          class="sm:col-span-4"
      >
          <label class="block oxford-blue text-xs lg:text-sm font-medium mb-2">
              {{ __('Marketing Consent Applies To:') }}
          </label>

          <div class="flex gap-6 flex-wrap">
              <label class="flex items-center gap-2">
                  <input type="checkbox" wire:model="marketing_email">
                  {{ __('Email') }}
              </label>

              <label class="flex items-center gap-2">
                  <input type="checkbox" wire:model="marketing_post">
                  {{ __('Post') }}
              </label>

              <label class="flex items-center gap-2">
                  <input type="checkbox" wire:model="marketing_text">
                  {{ __('Text Message') }}
              </label>
          </div>
      </div>



      <div class="sm:col-span-2">
        <label class="block oxford-blue text-xs lg:text-sm font-medium mb-2">
            {{ __('Is this a Scheme?') }}
        </label>

        <div class="flex gap-6">
            <label class="flex items-center gap-2">
                <input
                    type="radio"
                    wire:model="is_scheme"
                    value="1"
                    class="w-4 h-4"
                >
                {{ __('Yes') }}
            </label>

            <label class="flex items-center gap-2">
                <input
                    type="radio"
                    wire:model="is_scheme"
                    value="0"
                    class="w-4 h-4"
                >
                {{ __('No') }}
            </label>
        </div>
    </div>


      {{-- Scheme Name --}}
      <div
          x-show="$wire.is_scheme == 1"
          x-cloak
          class="sm:col-span-2"
      >
          <label class="block oxford-blue text-xs lg:text-sm font-medium mb-2">
              {{ __('Scheme Name') }}
          </label>

          <input
              type="text"
              wire:model="scheme_name"
              placeholder="{{ __('Enter scheme name') }}"
              class="block text-xs lg:text-sm font-medium border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3"
          >
      </div>


      <div class="sm:col-span-2">
          <label for="title" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Title') }}<span class="text-red-500 ml-0.5">*</span></label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="title" placeholder="{{ __('Title') }}" wire:model="title">
          @error('title') <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="first_name" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('First name') }}<span class="text-red-500 ml-0.5">*</span></label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="first_name" placeholder="{{ __('First name') }}" wire:model="first_name">
          @error('first_name')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="last_name" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Last name') }}<span class="text-red-500 ml-0.5">*</span></label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="last_name" wire:model="last_name" placeholder="{{ __('Last name') }}">
          @error('last_name')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="date_of_birth" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Date Of Birth') }}<span class="text-red-500 ml-0.5">*</span></label>
          <div class="relative w-full">
            <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
              <svg class="w-6 h-6 text-black"  viewBox="0 0 24 24" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6 4H18C19.0609 4 20.0783 4.42143 20.8284 5.17157C21.5786 5.92172 22 6.93913 22 8V18C22 19.0609 21.5786 20.0783 20.8284 20.8284C20.0783 21.5786 19.0609 22 18 22H6C4.93913 22 3.92172 21.5786 3.17157 20.8284C2.42143 20.0783 2 19.0609 2 18V8C2 6.93913 2.42143 5.92172 3.17157 5.17157C3.92172 4.42143 4.93913 4 6 4ZM6 6C5.46957 6 4.96086 6.21071 4.58579 6.58579C4.21071 6.96086 4 7.46957 4 8V18C4 18.5304 4.21071 19.0391 4.58579 19.4142C4.96086 19.7893 5.46957 20 6 20H18C18.5304 20 19.0391 19.7893 19.4142 19.4142C19.7893 19.0391 20 18.5304 20 18V8C20 7.46957 19.7893 6.96086 19.4142 6.58579C19.0391 6.21071 18.5304 6 18 6H6Z" fill="currentColor"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3 10C3 9.73478 3.10536 9.48043 3.29289 9.29289C3.48043 9.10536 3.73478 9 4 9H20C20.2652 9 20.5196 9.10536 20.7071 9.29289C20.8946 9.48043 21 9.73478 21 10C21 10.2652 20.8946 10.5196 20.7071 10.7071C20.5196 10.8946 20.2652 11 20 11H4C3.73478 11 3.48043 10.8946 3.29289 10.7071C3.10536 10.5196 3 10.2652 3 10ZM8 2C8.26522 2 8.51957 2.10536 8.70711 2.29289C8.89464 2.48043 9 2.73478 9 3V7C9 7.26522 8.89464 7.51957 8.70711 7.70711C8.51957 7.89464 8.26522 8 8 8C7.73478 8 7.48043 7.89464 7.29289 7.70711C7.10536 7.51957 7 7.26522 7 7V3C7 2.73478 7.10536 2.48043 7.29289 2.29289C7.48043 2.10536 7.73478 2 8 2ZM16 2C16.2652 2 16.5196 2.10536 16.7071 2.29289C16.8946 2.48043 17 2.73478 17 3V7C17 7.26522 16.8946 7.51957 16.7071 7.70711C16.5196 7.89464 16.2652 8 16 8C15.7348 8 15.4804 7.89464 15.2929 7.70711C15.1054 7.51957 15 7.26522 15 7V3C15 2.73478 15.1054 2.48043 15.2929 2.29289C15.4804 2.10536 15.7348 2 16 2Z" fill="currentColor"/>
                <path d="M8 13C8 13.2652 7.89464 13.5196 7.70711 13.7071C7.51957 13.8946 7.26522 14 7 14C6.73478 14 6.48043 13.8946 6.29289 13.7071C6.10536 13.5196 6 13.2652 6 13C6 12.7348 6.10536 12.4804 6.29289 12.2929C6.48043 12.1054 6.73478 12 7 12C7.26522 12 7.51957 12.1054 7.70711 12.2929C7.89464 12.4804 8 12.7348 8 13ZM8 17C8 17.2652 7.89464 17.5196 7.70711 17.7071C7.51957 17.8946 7.26522 18 7 18C6.73478 18 6.48043 17.8946 6.29289 17.7071C6.10536 17.5196 6 17.2652 6 17C6 16.7348 6.10536 16.4804 6.29289 16.2929C6.48043 16.1054 6.73478 16 7 16C7.26522 16 7.51957 16.1054 7.70711 16.2929C7.89464 16.4804 8 16.7348 8 17ZM13 13C13 13.2652 12.8946 13.5196 12.7071 13.7071C12.5196 13.8946 12.2652 14 12 14C11.7348 14 11.4804 13.8946 11.2929 13.7071C11.1054 13.5196 11 13.2652 11 13C11 12.7348 11.1054 12.4804 11.2929 12.2929C11.4804 12.1054 11.7348 12 12 12C12.2652 12 12.5196 12.1054 12.7071 12.2929C12.8946 12.4804 13 12.7348 13 13ZM13 17C13 17.2652 12.8946 17.5196 12.7071 17.7071C12.5196 17.8946 12.2652 18 12 18C11.7348 18 11.4804 17.8946 11.2929 17.7071C11.1054 17.5196 11 17.2652 11 17C11 16.7348 11.1054 16.4804 11.2929 16.2929C11.4804 16.1054 11.7348 16 12 16C12.2652 16 12.5196 16.1054 12.7071 16.2929C12.8946 16.4804 13 16.7348 13 17ZM18 13C18 13.2652 17.8946 13.5196 17.7071 13.7071C17.5196 13.8946 17.2652 14 17 14C16.7348 14 16.4804 13.8946 16.2929 13.7071C16.1054 13.5196 16 13.2652 16 13C16 12.7348 16.1054 12.4804 16.2929 12.2929C16.4804 12.1054 16.7348 12 17 12C17.2652 12 17.5196 12.1054 17.7071 12.2929C17.8946 12.4804 18 12.7348 18 13ZM18 17C18 17.2652 17.8946 17.5196 17.7071 17.7071C17.5196 17.8946 17.2652 18 17 18C16.7348 18 16.4804 17.8946 16.2929 17.7071C16.1054 17.5196 16 17.2652 16 17C16 16.7348 16.1054 16.4804 16.2929 16.2929C16.4804 16.1054 16.7348 16 17 16C17.2652 16 17.5196 16.1054 17.7071 16.2929C17.8946 16.4804 18 16.7348 18 17Z" fill="currentColor"/>
              </svg>
            </div>
            <input id="date_of_birth" x-ref="datepicker"
             x-init="flatpickr($refs.datepicker, {
                 enableTime: false,
                 allowInput: true,
                 dateFormat: 'd/m/Y',
             })"
             wire:model="date_of_birth"
             type="text"
             class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10"
             placeholder="{{ __('Date Of Birth') }}">
          @error('date_of_birth')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
          </div>
      </div>
      <div class="sm:col-span-2">
        <label for="gender" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Gender') }}<span class="text-red-500 ml-0.5">*</span></label>
        <select id="gender" wire:model="gender" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
          <option selected>{{ __('Select gender') }}</option>
          <option value="{{ __('Male') }}">{{ __('Male') }}</option>
          <option value="{{ __('Female') }}">{{ __('Female') }}</option>
          <option value="{{ __('Other') }}">{{ __('Other') }}</option>
        </select>
        @error('gender') <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
        <label for="relationship_status" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Relationship Status') }}<span class="text-red-500 ml-0.5">*</span></label>
        <select id="relationship_status" wire:model="relationship_status" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
          <option selected>{{ __('Relationship status') }}</option>
          <option value="{{ __('Single') }}">{{ __('Single') }}</option>
          <option value="{{ __('Married') }}">{{ __('Married') }}</option>
          <option value="{{ __('Civil Partnership') }}">{{ __('Civil Partnership') }}</option>
          <option value="{{ __('Separated') }}">{{ __('Separated') }}</option>
          <option value="{{ __('Divorced') }}">{{ __('Divorced') }}</option>
          <option value="{{ __('Widowed') }}">{{ __('Widowed') }}</option>
        </select>
        @error('relationship_status')<span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="address" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Address 1') }}<span class="text-red-500 ml-0.5">*</span></label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="address" wire:model="address" placeholder="{{ __('Address') }}">
          @error('address')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="address2" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Address 2') }}</label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="address2" wire:model="address2" placeholder="{{ __('Address') }}">
          @error('address2') <span class="text-red-500">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
        <label for="postcode" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Postcode') }}</label>
        <select id="postcode" wire:model="postcode" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
          <option selected>{{ __('Select Postcode') }}</option>
            <option value="Co Antrim">Co Antrim</option>
            <option value="Co Armagh">Co Armagh</option>
            <option value="Co Carlow">Co Carlow</option>
            <option value="Co Cavan">Co Cavan</option>
            <option value="Co Clare">Co Clare</option>
            <option value="Co Cork">Co Cork</option>
            <option value="Co Derry">Co Derry</option>
            <option value="Co Donegal">Co Donegal</option>
            <option value="Co Down">Co Down</option>
            <option value="Co Dublin">Co Dublin</option>
            <option value="Dublin 1">Dublin 1</option>
            <option value="Dublin 2">Dublin 2</option>
            <option value="Dublin 3">Dublin 3</option>
            <option value="Dublin 4">Dublin 4</option>
            <option value="Dublin 5">Dublin 5</option>
            <option value="Dublin 6">Dublin 6</option>
            <option value="Dublin 6W">Dublin 6W</option>
            <option value="Dublin 7">Dublin 7</option>
            <option value="Dublin 8">Dublin 8</option>
            <option value="Dublin 9">Dublin 9</option>
            <option value="Dublin 10">Dublin 10</option>
            <option value="Dublin 11">Dublin 11</option>
            <option value="Dublin 12">Dublin 12</option>
            <option value="Dublin 13">Dublin 13</option>
            <option value="Dublin 14">Dublin 14</option>
            <option value="Dublin 15">Dublin 15</option>
            <option value="Dublin 16">Dublin 16</option>
            <option value="Dublin 17">Dublin 17</option>
            <option value="Dublin 18">Dublin 18</option>
            <option value="Dublin 20">Dublin 20</option>
            <option value="Dublin 22">Dublin 22</option>
            <option value="Dublin 24">Dublin 24</option>
            <option value="Co Fermanagh">Co Fermanagh</option>
            <option value="Co Galway">Co Galway</option>
            <option value="Co Kerry">Co Kerry</option>
            <option value="Co Kildare">Co Kildare</option>
            <option value="Co Kilkenny">Co Kilkenny</option>
            <option value="Co Laois">Co Laois</option>
            <option value="Co Leitrim">Co Leitrim</option>
            <option value="Co Limerick">Co Limerick</option>
            <option value="Co Longford">Co Longford</option>
            <option value="Co Louth">Co Louth</option>
            <option value="Co Mayo">Co Mayo</option>
            <option value="Co Meath">Co Meath</option>
            <option value="Co Monaghan">Co Monaghan</option>
            <option value="Co Offaly">Co Offaly</option>
            <option value="Co Roscommon">Co Roscommon</option>
            <option value="Co Sligo">Co Sligo</option>
            <option value="Co Tipperary">Co Tipperary</option>
            <option value="Co Tyrone">Co Tyrone</option>
            <option value="Co Waterford">Co Waterford</option>
            <option value="Co Wexford">Co Wexford</option>
            <option value="Co Westmeath">Co Westmeath</option>
            <option value="Co Wicklow">Co Wicklow</option>
        </select>
        @error('postcode')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="eircode" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Eircode') }}</label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="eircode" wire:model="eircode" placeholder="{{ __('Eircode') }}">
          @error('eircode')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
        
        @php 

        $preferredCountries = [ 'Ireland', 'India', 'Latvia', 'Lithuania', 'Poland', 'Ukraine', 'United States', 'United Kingdom' ]; 

        $allCountries = [ 'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Anguilla', 'Argentina', 'Armenia', 'Aruba', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bermuda', 'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei Darussalam', 'Bulgaria', 'Burkina Faso', 'Burundi', 'Cambodia', 'Cameroon', 'Canada', 'Cape Verde', 'Cayman Islands', 'Central African Republic', 'Chad', 'Chile', 'China', 'Colombia', 'Comoros', 'Congo', 'Cook Islands', 'Costa Rica', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic', 'Denmark', 'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Ethiopia', 'Faroe Islands', 'Fiji', 'Finland', 'France', 'French Guiana', 'French Polynesia', 'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Gibraltar', 'Greece', 'Greenland', 'Grenada', 'Guadeloupe', 'Guam', 'Guatemala', 'Guinea', 'Guinea-bissau', 'Guyana', 'Haiti', 'Honduras', 'Hong Kong', 'Hungary', 'Iceland', 'Indonesia', 'Iran', 'Iraq', 'Israel', 'Italy', 'Jamaica', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Korea', 'Kuwait', 'Kyrgyzstan', 'Lebanon', 'Lesotho', 'Liberia', 'Libyan Arab Jamahiriya', 'Liechtenstein', 'Luxembourg', 'Macao', 'Macedonia', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Martinique', 'Mauritania', 'Mauritius', 'Mayotte', 'Mexico', 'Micronesia', 'Moldova, Republic of', 'Monaco', 'Mongolia', 'Montserrat', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia', 'Nauru', 'Nepal', 'Netherlands', 'Netherlands Antilles', 'New Caledonia', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'Niue', 'Norfolk Island', 'Northern Mariana Islands', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Palestinian Territory', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Pitcairn', 'Portugal', 'Puerto Rico', 'Qatar', 'Reunion', 'Romania', 'Russian Federation', 'Rwanda', 'Saint Helena', 'Saint Kitts and Nevis', 'Saint Lucia', 'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia', 'Senegal', 'Serbia and Montenegro', 'Seychelles', 'Sierra Leone', 'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Svalbard and Jan Mayen', 'Swaziland', 'Sweden', 'Switzerland', 'Syrian Arab Republic', 'Taiwan, Province of China', 'Tajikistan', 'Tanzania, United Republic of', 'Thailand', 'Timor-leste', 'Togo', 'Tokelau', 'Tonga', 'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Turks and Caicos Islands', 'Tuvalu', 'Uganda', 'United Arab Emirates', 'Uruguay', 'Uzbekistan', 'Vanuatu', 'Venezuela', 'Vietnam', 'Virgin Islands', 'Wallis and Futuna', 'Western Sahara', 'Yemen', 'Zambia', 'Zimbabwe' ]; 

        @endphp

        <label for="county_of_birth" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Country of birth') }}</label>
        <select id="county_of_birth" wire:model="county_of_birth" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
          @if(empty($county_of_birth))
              <option selected value="">{{ __('County of birth') }}</option>
          @else
              <option value="">{{ __('County of birth') }}</option>
          @endif

           @foreach($preferredCountries as $country)
              @if($county_of_birth === $country)
                  <option value="{{ $country }}" selected>{{ $country }}</option>
              @else
                  <option value="{{ $country }}">{{ $country }}</option>
              @endif
          @endforeach

          {{-- Separator --}}
          @if($county_of_birth === 'null')
              <option value="null" selected>-------------------</option>
          @else
              <option value="null">-------------------</option>
          @endif

          {{-- All other countries --}}
          @foreach($allCountries as $country)
              @if($county_of_birth === $country)
                  <option value="{{ $country }}" selected>{{ $country }}</option>
              @else
                  <option value="{{ $country }}">{{ $country }}</option>
              @endif
          @endforeach
          
        </select>
        @error('county_of_birth') <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="previous_surname" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Previous Surname') }}</label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="previous_surname" placeholder="{{ __('Previous Surname') }}" wire:model="previous_surname">
      </div>
      <div class="sm:col-span-2">
          <label for="home_no" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Home No') }}</label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="home_no" wire:model="home_no" placeholder="{{ __('Home no.') }}">
          @error('home_no')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="work_no" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Work No') }}</label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="work_no" wire:model="work_no" placeholder="{{ __('Work no.') }}">
          @error('work_no') <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="mobile_no" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Mobile No') }}<span class="text-red-500 ml-0.5">*</span></label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="mobile_no" wire:model="mobile_no" placeholder="{{ __('Mobile no.') }}">
          @error('mobile_no') <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="email" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Email Address') }}</label>
          <input type="email" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="email" wire:model="email" placeholder="{{ __('Email') }}">
          @error('email') <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="dependents" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Dependents') }}</label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="dependents" wire:model="dependents" placeholder="{{ __('Dependents') }}">
          @error('dependents') <span class="text-red-500">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Smoked within the last 12 months?') }}</label>
          <div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
              <div class="flex items-center">
                  <input id="smoked_yes" wire:model="smoked_in_last_12_months" type="radio" value="1" name="smoked_in_last_12_months" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                  <label for="smoked_yes" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">Yes</label>
              </div>
              <div class="flex items-center">
                  <input id="smoked_no" wire:model="smoked_in_last_12_months" type="radio" value="0" name="smoked_in_last_12_months" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                  <label for="smoked_no" class="ms-2 text-xs lg:text-sm font-medium text-cool-gray">No</label>
              </div>
             
          </div>
           @error('smoked_in_last_12_months')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
    </div>
  </div>
  <div x-show="secOpen" class="mt-5 personal-details second-person bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
    <h3 class="mb-4 text-xl font-medium text-black uppercase bg-slate-100 px-5 py-5">{{ __('Second Person') }}</h3>
    <div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
      <div class="sm:col-span-2">
          <label for="sec_title" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Title') }}<span class="text-red-500 ml-0.5">*</span></label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_title" placeholder="{{ __('Title') }}" wire:model="sec_title">
          @error('sec_title')<span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="sec_first_name" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('First name') }}<span class="text-red-500 ml-0.5">*</span></label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_first_name" placeholder="{{ __('First name') }}" wire:model="sec_first_name">
          @error('sec_first_name')<span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="sec_last_name" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Last name') }}<span class="text-red-500 ml-0.5">*</span></label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_last_name" wire:model="sec_last_name" placeholder="{{ __('Last name') }}">
          @error('sec_last_name')<span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="sec_date_of_birth" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Date Of Birth') }}<span class="text-red-500 ml-0.5">*</span></label>
          <div class="relative w-full">
            <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
              <svg class="w-6 h-6 text-black"  viewBox="0 0 24 24" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6 4H18C19.0609 4 20.0783 4.42143 20.8284 5.17157C21.5786 5.92172 22 6.93913 22 8V18C22 19.0609 21.5786 20.0783 20.8284 20.8284C20.0783 21.5786 19.0609 22 18 22H6C4.93913 22 3.92172 21.5786 3.17157 20.8284C2.42143 20.0783 2 19.0609 2 18V8C2 6.93913 2.42143 5.92172 3.17157 5.17157C3.92172 4.42143 4.93913 4 6 4ZM6 6C5.46957 6 4.96086 6.21071 4.58579 6.58579C4.21071 6.96086 4 7.46957 4 8V18C4 18.5304 4.21071 19.0391 4.58579 19.4142C4.96086 19.7893 5.46957 20 6 20H18C18.5304 20 19.0391 19.7893 19.4142 19.4142C19.7893 19.0391 20 18.5304 20 18V8C20 7.46957 19.7893 6.96086 19.4142 6.58579C19.0391 6.21071 18.5304 6 18 6H6Z" fill="currentColor"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3 10C3 9.73478 3.10536 9.48043 3.29289 9.29289C3.48043 9.10536 3.73478 9 4 9H20C20.2652 9 20.5196 9.10536 20.7071 9.29289C20.8946 9.48043 21 9.73478 21 10C21 10.2652 20.8946 10.5196 20.7071 10.7071C20.5196 10.8946 20.2652 11 20 11H4C3.73478 11 3.48043 10.8946 3.29289 10.7071C3.10536 10.5196 3 10.2652 3 10ZM8 2C8.26522 2 8.51957 2.10536 8.70711 2.29289C8.89464 2.48043 9 2.73478 9 3V7C9 7.26522 8.89464 7.51957 8.70711 7.70711C8.51957 7.89464 8.26522 8 8 8C7.73478 8 7.48043 7.89464 7.29289 7.70711C7.10536 7.51957 7 7.26522 7 7V3C7 2.73478 7.10536 2.48043 7.29289 2.29289C7.48043 2.10536 7.73478 2 8 2ZM16 2C16.2652 2 16.5196 2.10536 16.7071 2.29289C16.8946 2.48043 17 2.73478 17 3V7C17 7.26522 16.8946 7.51957 16.7071 7.70711C16.5196 7.89464 16.2652 8 16 8C15.7348 8 15.4804 7.89464 15.2929 7.70711C15.1054 7.51957 15 7.26522 15 7V3C15 2.73478 15.1054 2.48043 15.2929 2.29289C15.4804 2.10536 15.7348 2 16 2Z" fill="currentColor"/>
                <path d="M8 13C8 13.2652 7.89464 13.5196 7.70711 13.7071C7.51957 13.8946 7.26522 14 7 14C6.73478 14 6.48043 13.8946 6.29289 13.7071C6.10536 13.5196 6 13.2652 6 13C6 12.7348 6.10536 12.4804 6.29289 12.2929C6.48043 12.1054 6.73478 12 7 12C7.26522 12 7.51957 12.1054 7.70711 12.2929C7.89464 12.4804 8 12.7348 8 13ZM8 17C8 17.2652 7.89464 17.5196 7.70711 17.7071C7.51957 17.8946 7.26522 18 7 18C6.73478 18 6.48043 17.8946 6.29289 17.7071C6.10536 17.5196 6 17.2652 6 17C6 16.7348 6.10536 16.4804 6.29289 16.2929C6.48043 16.1054 6.73478 16 7 16C7.26522 16 7.51957 16.1054 7.70711 16.2929C7.89464 16.4804 8 16.7348 8 17ZM13 13C13 13.2652 12.8946 13.5196 12.7071 13.7071C12.5196 13.8946 12.2652 14 12 14C11.7348 14 11.4804 13.8946 11.2929 13.7071C11.1054 13.5196 11 13.2652 11 13C11 12.7348 11.1054 12.4804 11.2929 12.2929C11.4804 12.1054 11.7348 12 12 12C12.2652 12 12.5196 12.1054 12.7071 12.2929C12.8946 12.4804 13 12.7348 13 13ZM13 17C13 17.2652 12.8946 17.5196 12.7071 17.7071C12.5196 17.8946 12.2652 18 12 18C11.7348 18 11.4804 17.8946 11.2929 17.7071C11.1054 17.5196 11 17.2652 11 17C11 16.7348 11.1054 16.4804 11.2929 16.2929C11.4804 16.1054 11.7348 16 12 16C12.2652 16 12.5196 16.1054 12.7071 16.2929C12.8946 16.4804 13 16.7348 13 17ZM18 13C18 13.2652 17.8946 13.5196 17.7071 13.7071C17.5196 13.8946 17.2652 14 17 14C16.7348 14 16.4804 13.8946 16.2929 13.7071C16.1054 13.5196 16 13.2652 16 13C16 12.7348 16.1054 12.4804 16.2929 12.2929C16.4804 12.1054 16.7348 12 17 12C17.2652 12 17.5196 12.1054 17.7071 12.2929C17.8946 12.4804 18 12.7348 18 13ZM18 17C18 17.2652 17.8946 17.5196 17.7071 17.7071C17.5196 17.8946 17.2652 18 17 18C16.7348 18 16.4804 17.8946 16.2929 17.7071C16.1054 17.5196 16 17.2652 16 17C16 16.7348 16.1054 16.4804 16.2929 16.2929C16.4804 16.1054 16.7348 16 17 16C17.2652 16 17.5196 16.1054 17.7071 16.2929C17.8946 16.4804 18 16.7348 18 17Z" fill="currentColor"/>
              </svg>
            </div>
            <input id="sec_date_of_birth" x-ref="datepicker2"
              x-init="flatpickr($refs.datepicker2, {
               enableTime: false,
               allowInput: true,
               dateFormat: 'd/m/Y',
           })" wire:model="sec_date_of_birth" datepicker datepicker-orientation="bottom right" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('Date Of Birth') }}">
            @error('sec_date_of_birth') <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
          </div>
      </div>
      <div class="sm:col-span-2">
        <label for="sec_gender" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Gender') }}<span class="text-red-500 ml-0.5">*</span></label>
        <select id="sec_gender" wire:model="sec_gender" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
          <option selected>{{ __('Select gender') }}</option>
          <option value="{{ __('Male') }}">{{ __('Male') }}</option>
          <option value="{{ __('Female') }}">{{ __('Female') }}</option>
          <option value="{{ __('Other') }}">{{ __('Other') }}</option>
        </select>
        @error('sec_gender')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
        <label for="sec_relationship_status" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Relationship Status') }}<span class="text-red-500 ml-0.5">*</span></label>
        <select id="sec_relationship_status" wire:model="sec_relationship_status" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
          <option selected>{{ __('Relationship status') }}</option>
          <option value="{{ __('Single') }}">{{ __('Single') }}</option>
          <option value="{{ __('Married') }}">{{ __('Married') }}</option>
          <option value="{{ __('Civil Partnership') }}">{{ __('Civil Partnership') }}</option>
          <option value="{{ __('Separated') }}">{{ __('Separated') }}</option>
          <option value="{{ __('Divorced') }}">{{ __('Divorced') }}</option>
          <option value="{{ __('Widowed') }}">{{ __('Widowed') }}</option>
        </select>
        @error('sec_relationship_status')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="sec_address" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Address 1') }}<span class="text-red-500 ml-0.5">*</span></label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_address" wire:model="sec_address" placeholder="{{ __('Address') }}">
          @error('sec_address')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="sec_address2" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Address 2') }}</label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_address2" wire:model="sec_address2" placeholder="{{ __('Address') }}">
          @error('sec_address2') <span class="text-red-500">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
        <label for="sec_postcode" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Postcode') }}</label>
        <select id="sec_postcode" wire:model="sec_postcode" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
          <option selected>{{ __('Select Postcode') }}</option>
            <option value="Co Antrim">Co Antrim</option>
            <option value="Co Armagh">Co Armagh</option>
            <option value="Co Carlow">Co Carlow</option>
            <option value="Co Cavan">Co Cavan</option>
            <option value="Co Clare">Co Clare</option>
            <option value="Co Cork">Co Cork</option>
            <option value="Co Derry">Co Derry</option>
            <option value="Co Donegal">Co Donegal</option>
            <option value="Co Down">Co Down</option>
            <option value="Co Dublin">Co Dublin</option>
            <option value="Dublin 1">Dublin 1</option>
            <option value="Dublin 2">Dublin 2</option>
            <option value="Dublin 3">Dublin 3</option>
            <option value="Dublin 4">Dublin 4</option>
            <option value="Dublin 5">Dublin 5</option>
            <option value="Dublin 6">Dublin 6</option>
            <option value="Dublin 6W">Dublin 6W</option>
            <option value="Dublin 7">Dublin 7</option>
            <option value="Dublin 8">Dublin 8</option>
            <option value="Dublin 9">Dublin 9</option>
            <option value="Dublin 10">Dublin 10</option>
            <option value="Dublin 11">Dublin 11</option>
            <option value="Dublin 12">Dublin 12</option>
            <option value="Dublin 13">Dublin 13</option>
            <option value="Dublin 14">Dublin 14</option>
            <option value="Dublin 15">Dublin 15</option>
            <option value="Dublin 16">Dublin 16</option>
            <option value="Dublin 17">Dublin 17</option>
            <option value="Dublin 18">Dublin 18</option>
            <option value="Dublin 20">Dublin 20</option>
            <option value="Dublin 22">Dublin 22</option>
            <option value="Dublin 24">Dublin 24</option>
            <option value="Co Fermanagh">Co Fermanagh</option>
            <option value="Co Galway">Co Galway</option>
            <option value="Co Kerry">Co Kerry</option>
            <option value="Co Kildare">Co Kildare</option>
            <option value="Co Kilkenny">Co Kilkenny</option>
            <option value="Co Laois">Co Laois</option>
            <option value="Co Leitrim">Co Leitrim</option>
            <option value="Co Limerick">Co Limerick</option>
            <option value="Co Longford">Co Longford</option>
            <option value="Co Louth">Co Louth</option>
            <option value="Co Mayo">Co Mayo</option>
            <option value="Co Meath">Co Meath</option>
            <option value="Co Monaghan">Co Monaghan</option>
            <option value="Co Offaly">Co Offaly</option>
            <option value="Co Roscommon">Co Roscommon</option>
            <option value="Co Sligo">Co Sligo</option>
            <option value="Co Tipperary">Co Tipperary</option>
            <option value="Co Tyrone">Co Tyrone</option>
            <option value="Co Waterford">Co Waterford</option>
            <option value="Co Wexford">Co Wexford</option>
            <option value="Co Westmeath">Co Westmeath</option>
            <option value="Co Wicklow">Co Wicklow</option>
        </select>
        @error('sec_postcode') <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="sec_eircode" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Eircode') }}</label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_eircode" wire:model="sec_eircode" placeholder="{{ __('Eircode') }}">
          @error('sec_eircode')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
        <label for="sec_country_of_birth" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Country of birth') }}</label>
        <select id="sec_country_of_birth" wire:model="sec_country_of_birth" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
          @if(empty($county_of_birth))
              <option selected value="">{{ __('County of birth') }}</option>
          @else
              <option value="">{{ __('County of birth') }}</option>
          @endif

           @foreach($preferredCountries as $country)
              @if($county_of_birth === $country)
                  <option value="{{ $country }}" selected>{{ $country }}</option>
              @else
                  <option value="{{ $country }}">{{ $country }}</option>
              @endif
          @endforeach

          {{-- Separator --}}
          @if($county_of_birth === 'null')
              <option value="null" selected>-------------------</option>
          @else
              <option value="null">-------------------</option>
          @endif

          {{-- All other countries --}}
          @foreach($allCountries as $country)
              @if($county_of_birth === $country)
                  <option value="{{ $country }}" selected>{{ $country }}</option>
              @else
                  <option value="{{ $country }}">{{ $country }}</option>
              @endif
          @endforeach
           </select>
        @error('sec_country_of_birth')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="sec_previous_surname" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Previous Surname') }}</label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_previous_surname" placeholder="{{ __('Previous Surname') }}" wire:model="sec_previous_surname">
      </div>
      <div class="sm:col-span-2">
          <label for="sec_home_no" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Home No') }}</label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_home_no" wire:model="sec_home_no" placeholder="{{ __('Home no.') }}">
          @error('sec_home_no')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="sec_work_no" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Work No') }}</label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_work_no" wire:model="sec_work_no" placeholder="{{ __('Work no.') }}">
          @error('sec_work_no')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="sec_mobile_no" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Mobile No') }}<span class="text-red-500 ml-0.5">*</span></label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_mobile_no" wire:model="sec_mobile_no" placeholder="{{ __('Mobile no.') }}">
          @error('sec_mobile_no')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="sec_email" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Email Address') }}</label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_email" wire:model="sec_email" placeholder="{{ __('Email') }}">
          @error('sec_email') <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label for="sec_dependents" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Dependents') }}</label>
          <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="sec_dependents" wire:model="sec_dependents" placeholder="{{ __('Dependents') }}">
          @error('sec_dependents') <span class="text-red-500">{{ $message }}</span>@enderror
      </div>
      <div class="sm:col-span-2">
          <label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Smoked within the last 12 months?') }}</label>
          <div class="flex py-2.5 flex-wrap justify-between gap-2 flex-col sm:flex-row">
              <div class="flex items-center">
                  <input id="sec_smoked_yes" wire:model="sec_smoked_in_last_12_months" type="radio" value="1" name="sec_smoked_in_last_12_months" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                  <label for="sec_smoked_yes" class="ms-2 text-sm font-medium text-cool-gray">Yes</label>
              </div>
              <div class="flex items-center">
                  <input id="sec_smoked_no" wire:model="sec_smoked_in_last_12_months" type="radio" value="0" name="sec_smoked_in_last_12_months" class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6 text-vivid-sky-blue bg-white border-neutral-gray focus:ring-vivid-sky-blue focus:ring-2">
                  <label for="sec_smoked_no" class="ms-2 text-sm font-medium text-cool-gray">No</label>
              </div>
             
          </div>
           @error('sec_smoked_in_last_12_months')  <span class="text-red-500 text-xs pt-1 block">{{ $message }}</span>@enderror
      </div>
    </div>
  </div>
  <div class="px-4 py-3 sm:px-6 flex justify-between">
      <button
            type="button"
            @click="secOpen = !secOpen"
            class="text-sm md:text-base xl:text-lg text-oxford-blue font-medium underline underline-offset-4 hover:text-vivid-amethyst"
        >
            <span x-show="!secOpen" x-cloak>{{ __('Add Second Person +') }}</span>
            <span x-show="secOpen" x-cloak>{{ __('Hide Second Person -') }}</span>
        </button>
      <div class="hidden sm:flex sm:flex-1 sm:h-[40px] md:h-[44px]"></div>
      <div class="sm:absolute sm:left-1/2 sm:transform sm:-translate-x-1/2">
        <button wire:click.prevent="store()" type="button" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
          {{ __('Save Now') }}
        </button>
      </div>
  </div>
</form>
