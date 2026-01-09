<div id="sidebar-multi-level-sidebar" class="bg-eerie-midnight fixed top-0 left-0 z-40 w-64 min-h-full h-full transition-transform -translate-x-full lg:translate-x-0 overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300" aria-label="Sidebar">
    <div class="w-full mx-auto p-3 2xl:p-4 min-h-full h-full">
    	<div class="flex flex-wrap w-full justify-between h-full relative">
    		<div class="flex flex-wrap w-full self-start">
    			<!-- Logo -->
                <div class="flex items-center justify-center text-white">
                    <a href="{{ route('clients') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>
                <div class="flex w-full my-6 border-t-2 border-t border-gunmetal"></div>
                <div class="flex w-full mb-2">
                    <x-nav-link href="{{ route('clients') }}" :active="request()->routeIs('clients')" title="{{ __('Clients') }}">
                        <span class="mr-2 2xl:mr-3">@svg('user', 'icon icon-user w-5 h-5')</span>
                        <span class="whitespace-nowrap">{{ __('Clients') }}</span>
                    </x-nav-link>
                </div>
                @if (Auth::user()->role == 1 || Auth::user()->role == 4)
                <div class="flex w-full mb-2">
                    <x-nav-link href="{{ route('products') }}" :active="request()->routeIs('products')" title="{{ __('Products') }}">
                        <span class="mr-2 2xl:mr-3">@svg('product', 'icon icon-product w-5 h-5')</span>
                        <span class="whitespace-nowrap">{{ __('Products') }}</span>
                    </x-nav-link>
                </div>
                @endif
                <div class="flex w-full mb-2">
                    <x-nav-link href="{{ route('product-notes') }}" :active="request()->routeIs('product-notes')" title="{{ __('Product Notes') }}">
                        <span class="mr-2 2xl:mr-3">@svg('notes', 'icon icon-notes w-5 h-5')</span>
                        <span class="whitespace-nowrap">{{ __('Product Notes') }}</span>
                    </x-nav-link>
                </div>
                @if (Auth::user()->role == 1 || Auth::user()->role == 4)
                <div class="flex w-full mb-2">
                    <x-nav-link href="{{ route('payment-tracker') }}" :active="request()->routeIs('payment-tracker')" title="{{ __('Payment Tracker') }}">
                        <span class="mr-2 2xl:mr-3">@svg('payment', 'icon icon-payment w-5 h-5')</span>
                        <span class="whitespace-nowrap">{{ __('Payment Tracker') }}</span>
                    </x-nav-link>
                </div>
                <div class="relative w-full mb-2" x-data="{ acitve: false }">
				    <button @click="acitve = !acitve" class="w-full flex-shrink-0 flex items-center p-2 2xl:p-2.5 text-base leading-4 font-medium rounded-lg text-white hover:bg-gunmetal hover:text-white focus:outline-none focus:bg-gunmetal active:bg-gunmetal transition ease-in-out duration-150 text-left text-sm 2xl:text-base" title="{{ __('Administration') }}">
				        <span class="mr-2 2xl:mr-3">@svg('setting', 'icon icon-setting w-5 h-5')</span>
				        <span class="whitespace-nowrap">{{ __('Administration') }}</span>
				        @svg('arrow-down', 'icon icon-external -me-0.5 size-4 ml-auto')
				    </button>
				    <div x-show="acitve" x-cloak @click.away="acitve = false" class="relative z-50 mt-2 w-full rounded-lg shadow-lg">
				    	<div class="rounded-lg ring-1 ring-black ring-opacity-5 p-1 bg-gunmetal">
                            @if (Auth::user()->role == 4)
				        	<x-dropdown-link href="{{ route('users') }}" title="{{ __('User List') }}">
                                <span class="mr-2 2xl:mr-3">@svg('user-list', 'icon icon-user-list w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('User List') }}</span>
                            </x-dropdown-link>
                            @endif
                            <x-dropdown-link href="{{ route('suitabilityletter') }}" title="{{ __('Suitability Letter Text') }}">
                                <span class="mr-2 2xl:mr-3">@svg('suitability', 'icon icon-suitability w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('Suitability Letter Text') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('pensionletter') }}" title="{{ __('Pension Letter Text') }}">
                                <span class="mr-2 2xl:mr-3">@svg('pension', 'icon icon-pension w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('Pension Letter Text') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('mortgagesuitabilityletter') }}" title="{{ __('Mortgage Letter Text') }}">
                                <span class="mr-2 2xl:mr-3">@svg('pension', 'icon icon-pension w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('Mortgage Letter Text') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('personalaccsuitabilityletter') }}" title="{{ __('Personal Acc Letter Text') }}">
                                <span class="mr-2 2xl:mr-3">@svg('pension', 'icon icon-pension w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('Personal Acc Letter Text') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('thankyouletter') }}" title="{{ __('Thank You Letter Text') }}">
                                <span class="mr-2 2xl:mr-3">@svg('thankyou', 'icon icon-thankyou w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('Thank You Letter Text') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('pension-thankyouletter') }}" title="{{ __('Pension Thank You Letter Text') }}">
                                <span class="mr-2 2xl:mr-3">@svg('thankyou', 'icon icon-thankyou w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('Pension Thank You Letter') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('mortgage-thankyouletter') }}" title="{{ __('Mortgage Thank You Letter Text') }}">
                                <span class="mr-2 2xl:mr-3">@svg('thankyou', 'icon icon-thankyou w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('Mortgage Thank You Letter') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('personalacc-thankyouletter') }}" title="{{ __('PersonalAcc Thank You Letter Text') }}">
                                <span class="mr-2 2xl:mr-3">@svg('thankyou', 'icon icon-thankyou w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('P Acc Thank You Letter') }}</span>
                            </x-dropdown-link>
                        </div>
				    </div>
				</div>
                <div class="relative w-full mb-2" x-data="{ active: false }">
                    <button @click="active = !active" class="w-full flex-shrink-0 flex items-center p-2 2xl:p-2.5 text-base leading-4 font-medium rounded-lg text-white hover:bg-gunmetal hover:text-white focus:outline-none focus:bg-gunmetal active:bg-gunmetal transition ease-in-out duration-150 text-left text-sm 2xl:text-base" title="{{ __('Reports') }}">
                        <span class="mr-2 2xl:mr-3">@svg('reports', 'icon icon-reports w-5 h-5')</span>
                        <span class="whitespace-nowrap">{{ __('Reports') }}</span>
                        @svg('arrow-down', 'icon icon-external -me-0.5 size-4 ml-auto')
                    </button>
                    <div x-show="active" x-cloak @click.away="active = false" class="relative z-50 mt-2 w-full rounded-lg shadow-lg">
                        <div class="rounded-lg ring-1 ring-black ring-opacity-5 p-1 bg-gunmetal" title="{{ __('Reports') }}">
                            <x-dropdown-link href="{{ route('product-count') }}" :active="request()->routeIs('product-count')" title="{{ __('Product Counts') }}">
                                <span class="mr-2 2xl:mr-3">@svg('product-counts', 'icon icon-product-counts w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('Product Counts') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('broker-productivity') }}" :active="request()->routeIs('broker-productivity')" title="{{ __('Broker Productivity') }}">
                                <span class="mr-2 2xl:mr-3">@svg('broker-productivity', 'icon icon-broker-productivity w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('Broker Productivity') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('insurer-report') }}" :active="request()->routeIs('insurer-report')" title="{{ __('Insurer Report') }}">
                                <span class="mr-2 2xl:mr-3">@svg('insurer-report', 'icon icon-insurer-report w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('Insurer Report') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('commission-due') }}" :active="request()->routeIs('commission-due')" title="{{ __('Commission Due') }}">
                                <span class="mr-2 2xl:mr-3">@svg('commission-due', 'icon icon-commission-due w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('Commission Due') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('payment-tracker-report') }}" :active="request()->routeIs('payment-tracker-report')" title="{{ __('Payment Tracker Report') }}">
                                <span class="mr-2 2xl:mr-3">@svg('payment-tracker-report', 'icon icon-payment-tracker-report w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('Payment Tracker Report') }}</span>
                            </x-dropdown-link>
                        </div>
                    </div>
                </div>
                
                <div class="relative w-full" x-data="{ active: false }">
                    <button @click="active = !active" class="w-full flex-shrink-0 flex items-center p-2 2xl:p-2.5 text-base leading-4 font-medium rounded-lg text-white hover:bg-gunmetal hover:text-white focus:outline-none focus:bg-gunmetal active:bg-gunmetal transition ease-in-out duration-150 text-left text-sm 2xl:text-base" title="{{ __('External Links') }}">
                        <span class="mr-2 2xl:mr-3">@svg('external', 'icon icon-external w-5 h-5')</span>
                        <span class="whitespace-nowrap">{{ __('External Links') }}</span>
                        @svg('arrow-down', 'icon icon-external -me-0.5 size-4 ml-auto')
                    </button>
                    <div x-show="active" x-cloak @click.away="active = false" class="relative z-50 mt-2 w-full rounded-lg shadow-lg">
                        <div class="rounded-lg ring-1 ring-black ring-opacity-5 p-1 bg-gunmetal">
                            <x-dropdown-link href="http://www.bline.ie/" target="_blank" title="{{ __('BLine') }}">
                                <span class="mr-2 2xl:mr-3">@svg('external', 'icon icon-external w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('BLine') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link href="https://www.zurichinsurance.ie/exg/" target="_blank" title="{{ __('Zurish HelpPoint') }}">
                                <span class="mr-2 2xl:mr-3">@svg('external', 'icon icon-external w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('Zurish HelpPoint') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link href="https://www.brokerfirst.friendsfirst.ie/ole/" target="_blank" title="{{ __('Friends First BrokerFirst') }}">
                                <span class="mr-2 2xl:mr-3">@svg('external', 'icon icon-external w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('Friends First BrokerFirst') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link href="http://www.newireland.ie/broker" target="_blank" title="{{ __('New Ireland Broker') }}">
                                <span class="mr-2 2xl:mr-3">@svg('external', 'icon icon-external w-5 h-5')</span>
                                <span class="whitespace-nowrap">{{ __('New Ireland Broker') }}</span>
                            </x-dropdown-link>
                        </div>
                    </div>
                </div>
                @endif
                <div class="flex w-full my-6 border-t-2 border-t border-gunmetal"></div>
    		</div>
            <div class="flex flex-wrap w-full self-end">
                <div class="flex w-full mb-2">
                    <x-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')" class="text-sm 2xl:text-base text-white/[.5] hover:text-white" title="{{ __('Change Password') }}">
                        <span class="mr-2 2xl:mr-3">@svg('change-password', 'icon icon-change-password w-5 h-5')</span>
                        <span class="whitespace-nowrap">{{ __('Change Password') }}</span>
                    </x-nav-link>
                </div>
                <!-- Authentication -->
                <div class="flex w-full mb-2">
                    <form class="w-full" method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-nav-link href="{{ route('logout') }}" :active="request()->routeIs('logout')" @click.prevent="$root.submit();" class="sm:text-old-rose text-sm 2xl:text-base hover:text-white" title="{{ __('Logout Account') }}">
                            <span class="mr-2 2xl:mr-3">@svg('logout', 'icon icon-logout w-5 h-5')</span>
                            <span class="whitespace-nowrap">{{ __('Logout Account') }}</span>
                        </x-nav-link>
                    </form>
                </div>
            </div>
    	</div>
    </div>
</div>
