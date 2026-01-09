<div id="editnotesdetails" tabindex="-1" class="fixed z-50 inset-0 overflow-y-auto ease-out duration-400">
	<div class="flex items-start justify-center min-h-screen py-4 px-4 text-center sm:block w-full">
    	<div class="fixed inset-0 transition-opacity">
      		<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    	</div>
      	<div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all align-middle max-w-screen-xl w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
        	<div class="flex items-center justify-between px-4 sm:px-6 py-3 rounded-t-lg bg-slate-100">
            	<h3 class="text-lg lg:text-xl font-medium text-black uppercase">{{ __('Edit Note') }}</h3>
            	<button type="button" wire:click="closeModal()" class="oxford-blue bg-transparent hover:bg-oxford-blue hover:text-white rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center border border-oxford-blue">
            		@svg('close', 'icon icon-close w-3 h-3')
                	<span class="sr-only">Close modal</span>
            	</button>
        	</div>
        	@if (!$form_submitted)
        	<form>
        		<div class="editnotes-form bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        			<div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-3 bg-oxford-blue text-white rounded-md py-3 px-4 lg:px-7 items-center relative">
						<div class="col-span-full sm:col-span-1 text-sm lg:text-base text-left font-medium">
			                 {{ __('Note Details') }}
			            </div>
			            <div class="sm:col-span-1">
			                <label for="internal_status" class="block oxford-blue text-xs lg:text-sm font-medium mb-1">{{ __('Internal Status') }}:</label>
			                <select id="internal_status" wire:model="internal_status" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full px-3 py-1 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
				                <option selected value="">{{ __('Select Internal Status') }}</option>
				                <option value="New">{{ __('New') }}</option>
							    <option value="With U/W">{{ __('With U/W') }}</option>
							    <option value="Commission Due">{{ __('Commission Due') }}</option>
							    <option value="Closed">{{ __('Closed') }}</option>
							    <option value="Cancelled">{{ __('Cancelled') }}</option>
							    <option value="NTU">{{ __('NTU') }}</option>
			                </select>
			            </div>
			            <div class="sm:col-span-1">
			                <label for="uw_status" class="block oxford-blue text-xs lg:text-sm font-medium mb-1">{{ __('U/W Status') }}:</label>
			                <select id="uw_status" wire:model="uw_status" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full px-3 py-1 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
				                <option selected value="">{{ __('Select U/W Status') }}</option>
							    <option value="Not Filed">{{ __('Not Filed') }}</option>
							    <option value="Pending">{{ __('Pending') }}</option>
							    <option value="Approved">{{ __('Approved') }}</option>
							    <option value="Further Info">{{ __('Further Info') }}</option>
							    <option value="Declined">{{ __('Declined') }}</option>
			                </select>
			            </div>
					</div>
        			<div class="mt-8 grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-6">
        				<div class="sm:col-span-3">
					        <label for="client_name" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Client') }}:</label>
					        <input readonly type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="client_name" wire:model="client_name" placeholder="{{ __('Client Name') }}">
					    </div>
					    <div class="sm:col-span-3">
					        <label for="assigned_to" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Assigned To') }}:</label>
					        <select id="assigned_to" wire:model="assigned_to" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray">
					        	<option value="">{{ __('Select Assigned to') }}</option>
						        @foreach($users as $user)
						        	<option value="{{ $user->id }}">{{ $user->name }}</option>
						      	@endforeach
							</select>
					    </div>
        				<div class="sm:col-span-3">
					        <label for="no_subject" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Subject') }}:</label>
					        <input readonly type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="subjectcustom" wire:model="subjectcustom" placeholder="{{ __('Subject') }}">
					    </div>
					    <div class="sm:col-span-3">
							<label for="reminder_date" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Reminder Date') }}:</label>
			                <div class="relative w-full">
				            	<div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
				              		@svg('calendar', 'icon icon-plus w-6 h-6 text-black')
				            	</div>
				            	<input id="reminder_date" x-ref="datepicker15"
					        		x-init="flatpickr($refs.datepicker15, {
					            	enableTime: false,
					            	dateFormat: 'd-m-Y'
					        		})" wire:model="reminder_date" datepicker15 datepicker-orientation="bottom right" type="text" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray pe-10" placeholder="{{ __('Select Date') }}">
				          	</div> 
			            </div>
				      	<div class="col-span-full">
			                <label for="new_notes" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('New Note') }}:</label>
			                <textarea rows="3" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="new_notes" wire:model="new_notes"></textarea>
			            </div>
			            <div class="col-span-full">
			                <label for="notes_history_text" class="block oxford-blue text-xs lg:text-sm font-medium mb-1 lg:mb-2">{{ __('Notes History') }}:</label>
			                <textarea readonly rows="12" class="block text-xs lg:text-sm font-medium appearance-none border border-pale-blue-gray rounded-md w-full p-2.5 lg:p-3 text-black focus:outline-none focus:shadow-outline focus:border-oxford-blue focus:ring-oxford-blue placeholder:text-cool-gray" id="notes_history_text" wire:model="notes_history_text"></textarea>
			            </div>
        			</div>
        			<div class="flex justify-center pt-8">
						<button type="button"
						    wire:click="submitNote"
						    class="bg-pos-gradient text-sm md:text-base xl:text-lg hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-6 lg:px-8 xl:px-10 rounded">
						    {{ __('Save Note') }}
						</button>
					</div>
        		</div>
        	</form>
        	@else
				<div class="p-10 text-center mb-4" 
        	     tabindex="0" 
        	     wire:key="success-message"
        	     x-data 
        	     x-init="$el.focus(); $el.addEventListener('keydown', (e) => { if(e.key === 'Enter' || e.key === 'Escape') @this.closeModal() })">
					<h3 class="text-lg font-semibold text-green-600 mb-4">New note added successfully!</h3>
					<p class="text-sm text-gray-500 mb-4">Press Enter or Escape to close</p>
					<button type="button" 
					        wire:click="closeModal" 
					        class="mt-4 bg-oxford-blue text-white font-medium py-2 px-6 rounded hover:bg-opacity-90 mb-4"
					        autofocus>
						Close
					</button>
				</div>
			@endif
      	</div>
  	</div>
</div>