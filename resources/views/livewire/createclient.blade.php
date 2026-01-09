<div class="fixed z-50 inset-0 overflow-y-auto ease-out duration-400 updateclientmodal">
  <div class="flex items-start justify-center min-h-screen py-4 px-4 text-center sm:block w-full">
    <div class="fixed inset-0 transition-opacity">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <!-- This element is to trick the browser into centering the modal contents. -->
    {{-- <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span> --}}
    @if($client_id)
      <div class="inline-block align-center text-left overflow-hidden transform transition-all sm:my-8 align-middle max-w-screen-xl w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline" data-modal-scrollable>
        <div x-data="{ 
            activeTab: '{{$this->activeProdTab}}',
            titles: {
                tab1: 'Personal Details',
                tab2: 'Employment Details',
                tab3: 'Add Products',
                tab4: 'Active Products',
                tab5: 'Document Storage',
                tab6: 'Archived Products',
            }}" class="w-full relative">
          <!-- Tabs -->
          <div class="grid grid-cols-2 sm:grid-cols-3 md:flex md:flex-wrap gap-1 lg:gap-2">
              <button 
              class="px-3 lg:px-4 xl:px-6 rounded-md md:rounded-t-md md:rounded-b-none text-white text-xs lg:text-sm lg:text-base xl:text-lg font-normal py-2 lg:py-2.5" 
                  :class="activeTab === 'tab1' ? 'bg-royal-indigo' : 'bg-vivid-amethyst hover:bg-royal-indigo text-white hover:text-white'" 
                  @click="activeTab = 'tab1'">
                  {{ __('Personal Details') }}
              </button>
              <button 
              class="px-3 lg:px-4 xl:px-6 rounded-md md:rounded-t-md md:rounded-b-none text-white text-xs lg:text-sm lg:text-base xl:text-lg font-normal py-2 lg:py-2.5" 
                  :class="activeTab === 'tab2' ? 'bg-royal-indigo' : 'bg-vivid-amethyst hover:bg-royal-indigo text-white hover:text-white'" 
                  @click="activeTab = 'tab2'">
                  {{ __('Employment Details') }}
              </button>
              <button 
              class="px-3 lg:px-4 xl:px-6 rounded-md md:rounded-t-md md:rounded-b-none text-white text-xs lg:text-sm lg:text-base xl:text-lg font-normal py-2 lg:py-2.5" 
                  :class="activeTab === 'tab3' ? 'bg-royal-indigo' : 'bg-vivid-amethyst hover:bg-royal-indigo text-white hover:text-white'" 
                  @click="activeTab = 'tab3'">
                  {{ __('Add Products') }}
              </button>
              <button 
              class="px-3 lg:px-4 xl:px-6 rounded-md md:rounded-t-md md:rounded-b-none text-white text-xs lg:text-sm lg:text-base xl:text-lg font-normal py-2 lg:py-2.5" 
                  :class="activeTab === 'tab4' ? 'bg-royal-indigo' : 'bg-vivid-amethyst hover:bg-royal-indigo text-white hover:text-white'" 
                  @click="activeTab = 'tab4'">
                  {{ __('Active Products') }}
              </button>
              <button 
                  class="px-3 lg:px-4 xl:px-6 rounded-md md:rounded-t-md md:rounded-b-none text-white text-xs lg:text-sm lg:text-base xl:text-lg font-normal py-2 lg:py-2.5"
                  :class="activeTab === 'tab5' ? 'bg-royal-indigo' : 'bg-vivid-amethyst hover:bg-royal-indigo text-white hover:text-white'" 
                  @click="activeTab = 'tab5'">
                  {{ __('Document Storage') }}
              </button>
              <button 
                  class="px-3 lg:px-4 xl:px-6 rounded-md md:rounded-t-md md:rounded-b-none text-white text-xs lg:text-sm lg:text-base xl:text-lg font-normal py-2 lg:py-2.5"
                  :class="activeTab === 'tab6' ? 'bg-royal-indigo' : 'bg-vivid-amethyst hover:bg-royal-indigo text-white hover:text-white'" 
                  @click="activeTab = 'tab6'">
                  {{ __('Archived Products') }}
              </button>
          </div>

          <!-- Tab Content -->
          <div class="w-full relative bg-white rounded-lg rounded-tl-none">
            <div class="flex items-center justify-between px-6 py-3 rounded-t-lg bg-slate-100">
                <h3 class="text-lg lg:text-xl font-medium text-black uppercase" x-text="titles[activeTab]"></h3>
                <button wire:click="closeModal()" type="button" type="button" class="oxford-blue bg-transparent hover:bg-oxford-blue hover:text-white rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center border border-oxford-blue">
                    @svg('close', 'icon icon-close w-3 h-3')
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
              <div x-show="activeTab === 'tab1'" class="w-full relative">
                <!-- Personal Details -->
                @include('livewire.clientform')
              </div>
              <div x-show="activeTab === 'tab2'" class="w-full relative">
                @include('livewire.employmentform')
              </div>
              <div x-show="activeTab === 'tab3'" class="w-full relative">
                @include('livewire.addproductform')
              </div>
              <div x-show="activeTab === 'tab4'">
                  <livewire:clienttabs.active-products-tab :client_id="$client_id" :key="$client_id" />
              </div>
              <div x-show="activeTab === 'tab5'" class="w-full relative">
                <livewire:file-upload :client_id="$client_id" :key="$client_id" />
              </div>
              <div x-show="activeTab === 'tab6'" class="w-full relative">
                <livewire:clienttabs.archived-products-tab :client_id="$client_id" :key="$client_id" />
              </div>
          </div>
        </div>
      </div>
    @else
      <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 align-middle max-w-screen-xl w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
        <div class="flex items-center justify-between px-4 sm:px-6 py-3 rounded-t-lg bg-slate-100">
            <h3 class="text-lg lg:text-xl font-medium text-black uppercase">{{ __('Personal Details') }}</h3>
            <button wire:click="closeModal()" type="button" type="button" class="oxford-blue bg-transparent hover:bg-oxford-blue hover:text-white rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center border border-oxford-blue">
                @svg('close', 'icon icon-close w-3 h-3')
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <!-- Personal Details -->
        @include('livewire.clientform')
      </div>
    @endif
  </div>
</div>
