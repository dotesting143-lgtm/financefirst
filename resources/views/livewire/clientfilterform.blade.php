<div class="w-full relative md:max-w-screen-xl ml-auto mr-auto">
	<form class="w-full relative" x-data="{inputString_source_of_lead: @entangle('inputString_source_of_lead')}" wire:submit.prevent="search">
		<div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-2">
			<div 
		          :class="{
		              'sm:col-span-1': inputString_source_of_lead === 'office' || inputString_source_of_lead === 'client',
		              'sm:col-span-2': !(inputString_source_of_lead === 'office' || inputString_source_of_lead === 'client')
		          }"
		      >
		        <label for="inputString_source_of_lead" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Source of lead') }}</label>
		        <select id="inputString_source_of_lead" wire:model="inputString_source_of_lead" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
		          <option value="">{{ __('Select source') }}</option>
		          <option value="office" {{ $inputString_source_of_lead === 'office' ? 'selected' : '' }}>{{ __('Office') }}</option>
		          <option value="broker" {{ $inputString_source_of_lead === 'broker' ? 'selected' : '' }}>{{ __('Broker (my own lead)') }}</option>
		          <option value="client" {{ $inputString_source_of_lead === 'client' ? 'selected' : '' }}>{{ __('Client (referred by client - office lead)') }}</option>
		      </select>
		        @error('inputString_source_of_lead') <span class="text-red-500">{{ $message }}</span>@enderror
		      </div>
		      <template x-if="inputString_source_of_lead === 'office' || inputString_source_of_lead === 'client'">
		        <div class="sm:col-span-1">
		          <label for="inputString_source_of_lead_sub" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">&nbsp;</label>
		          <select id="inputString_source_of_lead_sub" wire:model="inputString_source_of_lead_sub" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
		            <option value="">{{ __('Please select') }}</option>
		            <option value="Andy">{{ __('Andy') }}</option>
		            <option value="Elaine">{{ __('Elaine') }}</option>
		            <option value="Luke">{{ __('Luke') }}</option>
		            <option value="Walk-in">{{ __('Walk-in') }}</option>
		            <option value="Leads factory">{{ __('Leads factory') }}</option>
		          </select>
		          @error('inputString_source_of_lead_sub') <span class="text-red-500">{{ $message }}</span>@enderror
		        </div>
		      </template>
  			<div class="sm:col-span-1">
		        <label for="inputString_name" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Name') }}</label>
		        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="inputString_name" wire:model="inputString_name" placeholder="{{ __('Name') }}">
		    </div>
		    <div class="sm:col-span-1">
		    	
		    	@php $allCountries = [ 'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Anguilla', 'Antigua and Barbuda', 'Argentina', 'Armenia', 'Aruba', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bermuda', 'Bhutan', 'Bolivia', 'Bonaire, Sint Eustatius and Saba', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'British Indian Ocean Territory', 'Brunei Darussalam', 'Bulgaria', 'Burkina Faso', 'Burundi', 'Cabo Verde', 'Cambodia', 'Cameroon', 'Canada', 'Cayman Islands', 'Central African Republic', 'Chad', 'Chile', 'China', 'Colombia', 'Comoros', 'Congo', 'Congo, Democratic Republic of the', 'Cook Islands', 'Costa Rica', 'Côte d\'Ivoire', 'Croatia', 'Cuba', 'Curaçao', 'Cyprus', 'Czech Republic', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Eswatini', 'Ethiopia', 'Falkland Islands (Malvinas)', 'Faroe Islands', 'Fiji', 'Finland', 'France', 'French Guiana', 'French Polynesia', 'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Gibraltar', 'Greece', 'Greenland', 'Grenada', 'Guadeloupe', 'Guam', 'Guatemala', 'Guernsey', 'Guinea', 'Guinea-Bissau', 'Guyana', 'Haiti', 'Honduras', 'Hong Kong', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran (Islamic Republic of)', 'Iraq', 'Ireland', 'Isle of Man', 'Israel', 'Italy', 'Jamaica', 'Japan', 'Jersey', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Korea (Democratic People\'s Republic of)', 'Korea, Republic of', 'Kosovo', 'Kuwait', 'Kyrgyzstan', 'Lao People\'s Democratic Republic', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Macao', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Martinique', 'Mauritania', 'Mauritius', 'Mayotte', 'Mexico', 'Micronesia (Federated States of)', 'Moldova, Republic of', 'Monaco', 'Mongolia', 'Montenegro', 'Montserrat', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia', 'Nauru', 'Nepal', 'Netherlands', 'New Caledonia', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'Niue', 'Norfolk Island', 'Northern Mariana Islands', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Palestine, State of', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Pitcairn', 'Poland', 'Portugal', 'Puerto Rico', 'Qatar', 'Réunion', 'Romania', 'Russian Federation', 'Rwanda', 'Saint Barthélemy', 'Saint Helena', 'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Martin (French part)', 'Saint Pierre and Miquelon', 'Saint Vincent and the Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone', 'Singapore', 'Sint Maarten (Dutch part)', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Georgia and the South Sandwich Islands', 'South Sudan', 'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Svalbard and Jan Mayen', 'Sweden', 'Switzerland', 'Syrian Arab Republic', 'Taiwan, Province of China', 'Tajikistan', 'Tanzania, United Republic of', 'Thailand', 'Timor-Leste', 'Togo', 'Tokelau', 'Tonga', 'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Turks and Caicos Islands', 'Tuvalu', 'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States of America', 'United States Minor Outlying Islands', 'Uruguay', 'Uzbekistan', 'Vanuatu', 'Venezuela (Bolivarian Republic of)', 'Viet Nam', 'Virgin Islands (British)', 'Virgin Islands (U.S.)', 'Wallis and Futuna', 'Western Sahara', 'Yemen', 'Zambia', 'Zimbabwe' ]; @endphp

		        <label for="inputString_county_of_birth" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Nationality') }}</label>
		        <select id="inputString_county_of_birth" wire:model="inputString_county_of_birth" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
  					<option selected value="">{{ __('Select Nationality') }}</option>
			        {{-- All other countries --}}
			          @foreach($allCountries as $country)
			            <option value="{{ $country }}">{{ $country }}</option>
			          @endforeach
			    </select>
		    </div>
		    <div class="sm:col-span-1">
		        <label for="tbl_admin_users_id" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Broker') }}</label>
		        <select id="tbl_admin_users_id" wire:model="inputString_broker" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
		        	<option value="">{{ __('Select broker') }}</option>
		          	<?php foreach($brokersFilter as $broker): ?>
			        	<option value="{{ $broker['id'] }}">{{ $broker['name'] }}</option>
			      	<?php endforeach; ?>
		        </select>
		        @error('inputString_broker') <span class="text-red-500">{{ $message }}</span>@enderror
		    </div>
		    <div class="sm:col-span-1">
		        <label for="sort_by" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Sort By') }}</label>
		        <select id="sort_by" wire:model="sort_by" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
					<option value="Name">{{ __('Name') }}</option>
					<option value="Service Length">{{ __('Service Length') }}</option>
					<option value="Broker">{{ __('Broker') }}</option>
		        </select>			        
		    </div>
		    <div class="sm:col-span-1">
		        <label for="inputString_email" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Has Email Address') }}</label>
		        <select id="inputString_email" wire:model="inputString_email" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
	          		<option selected value="">{{ __('Select email') }}</option>
		          	<option value="Yes">{{ __('Yes') }}</option>
		          	<option value="No">{{ __('No') }}</option>
		        </select>			        
		    </div>
		    <div class="sm:col-span-1">
			    <label for="inputString_email_address"
			        class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">
			        {{ __('Email Address') }}
			    </label>

			    <input
			        type="text"
			        id="inputString_email_address"
			        wire:model="inputString_email_address"
			        placeholder="Email address"
			        class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray"
			    >
			</div>
		    <div class="sm:col-span-1">
		        <label for="inputString_poid" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('System Number (Numbers Only)') }}</label>
		        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="inputString_poid" wire:model="inputString_poid" placeholder="{{ __('System number') }}">
		    </div>
		    <div class="sm:col-span-1">
		        <label for="inputString_ponum" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Policy Number') }}</label>
		        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="inputString_ponum" wire:model="inputString_ponum" placeholder="{{ __('Policy Number') }}">
		    </div>
		    <div class="sm:col-span-1">
		        <label for="inputString_policytype" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Policy Type') }}</label>
		        <select id="inputString_policytype" wire:model="inputString_policytype" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
		        	<option selected value="">{{ __('Select Policy type') }}</option>
				    <option value="Life Mortgage Cover">{{ __('Life Mortgage Cover') }}</option>
				    <option value="Life Term Cover">{{ __('Life Term Cover') }}</option>
				    <option value="Income Protector (Personal)">{{ __('Income Protector (Personal)') }}</option>
				    <option value="Income Protector (Company)">{{ __('Income Protector (Company)') }}</option>
				    <option value="Life Long Cover">{{ __('Life Long Cover') }}</option>
				    <option value="Over 50s Cover">{{ __('Over 50s Cover') }}</option>
				    <option value="Group Protection Scheme">{{ __('Group Protection Scheme') }}</option>
				</select>
		    </div>
		    <div class="sm:col-span-1">
		        <label for="inputString_product_type" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Product') }}</label>
		        <select id="inputString_product_type" wire:model="inputString_product_type" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
		        	<option selected value="">{{ __('Select product') }}</option>
				    <option value="Cancer Only">{{ __('Cancer Only') }}</option>
				    <option value="Commercial Policy">{{ __('Commercial Policy') }}</option>
				    <option value="House Policy">{{ __('House Policy') }}</option>
				    <option value="Life Policy">{{ __('Life Policy') }}</option>
				    <option value="Motor Policy">{{ __('Motor Policy') }}</option>
				    <option value="Mortgage">{{ __('Mortgage') }}</option>
				    <option value="Pension">{{ __('Pension') }}</option>
				    <option value="Personal Accident">{{ __('Personal Accident') }}</option>
				</select>
		    </div>
		    <div class="sm:col-span-1">
		        <label for="closed_clients" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Include Closed') }}</label>
		        <select id="closed_clients" wire:model="closed_clients" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
		          	<option selected value="Yes">{{ __('Yes') }}</option>
		          	<option value="No">{{ __('No') }}</option>
		        </select>
		    </div>
		    <div class="sm:col-span-1">
		    	<label for="propinsurer" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Insurer') }}</label>
                <select id="propinsurer" wire:model="propinsurer" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
	                <option selected value="">{{ __('Select Proposed Insurer') }}</option>
	                <option value="AIG">{{ __('AIG') }}</option>
					<option value="Aviva">{{ __('Aviva') }}</option>
					<option value="Brokers Ireland">{{ __('Brokers Ireland') }}</option>
					<option value="EZ Fees ">{{ __('EZ Fees') }}</option>
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
		    <div class="sm:col-span-1 relative" x-data="{ open: false }" @click.outside="open = false">
			    <label for="inputStringphnum" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">
			        Phone Number
			    </label>

			    <input type="text"
			        id="inputStringphnum"
			        wire:model.debounce.300ms="inputStringphnum"
			        wire:input="searchPhoneNumbers"
			        placeholder="Phone number"
			        class="block w-full border rounded p-2.5 text-black focus:outline-none focus:border-oxford-blue focus:ring-oxford-blue"
			        autocomplete="off"
			        @input="open = $event.target.value.length > 0">

			    @if(is_array($phoneSearchResults) && count($phoneSearchResults) > 0)
			        <ul x-show="open" x-transition
			            class="absolute z-50 w-full bg-white border rounded shadow max-h-60 overflow-y-auto mt-1">
			            @foreach($phoneSearchResults as $number)
			                <li wire:click="selectPhoneNumber('{{ $number }}')"
			                    @click="open = false"
			                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
			                    {{ $number }}
			                </li>
			            @endforeach
			        </ul>
			    @elseif($inputStringphnum && strlen(trim($inputStringphnum)) > 1)
			        <div x-show="open" x-transition
			            class="absolute z-50 w-full bg-white border border-gray-300 rounded-md shadow-lg mt-1">
			            <div class="px-4 py-2 text-sm text-gray-500 italic">
			                No phone numbers found
			            </div>
			        </div>
			    @endif
			</div>
		    <div class="sm:col-span-1">
		        <label for="inputString_address" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Address') }}</label>
		        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="inputString_address" wire:model="inputString_address" placeholder="{{ __('Address') }}">
		    </div>
		    <div class="sm:col-span-1">
		        <label for="inputString_yearc" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Year Created') }}</label>
		        <input type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="inputString_yearc" wire:model="inputString_yearc" placeholder="{{ __('Year Created') }}">
		    </div>
		    <div class="sm:col-span-1">
			    <label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">
			        {{ __('Is Scheme') }}
			    </label>

			    <select
			        wire:model="inputString_is_scheme"
			        class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3"
			    >
			        <option value="">{{ __('All') }}</option>
			        <option value="Yes">{{ __('Yes') }}</option>
			        <option value="No">{{ __('No') }}</option>
			    </select>
			</div>
			<div class="sm:col-span-1">
			    <label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">
			        {{ __('Scheme Name') }}
			    </label>

			    <input
			        type="text"
			        wire:model="inputString_scheme_name"
			        placeholder="{{ __('Scheme name') }}"
			        class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3"
			    >
			</div>
			<div class="sm:col-span-1">
			    <label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">
			        {{ __('Left Our Agency') }}
			    </label>

			    <select
			        wire:model="inputString_left_our_agency"
			        class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3"
			    >
			        <option value="">{{ __('All') }}</option>
			        <option value="Yes">{{ __('Yes') }}</option>
			        <option value="No">{{ __('No') }}</option>
			    </select>
			</div>
			<div class="sm:col-span-1">
			    <label class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">
			        {{ __('Vulnerable Person') }}
			    </label>

			    <select
			        wire:model="inputString_vulnerable_person"
			        class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3"
			    >
			        <option value="">{{ __('All') }}</option>
			        <option value="Yes">{{ __('Yes') }}</option>
			        <option value="No">{{ __('No') }}</option>
			    </select>
			</div>
		</div>
		<div class="flex justify-center pt-8">
		    <button type="submit" wire:click="search" class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded flex items-center justify-center gap-2.5">
		    	@svg('search', 'icon icon-search w-6 h-6')
		    	{{ __('Search Now') }}
		    </button>
		</div>
	</form>
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

