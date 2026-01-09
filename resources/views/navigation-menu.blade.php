<nav x-data="{ open: false }" class="bg-eerie-midnight text-white border-b border-gray-100 fixed h-full bottom-0 w-64 top-0 overflow-y-auto
  [&::-webkit-scrollbar]:w-2
  [&::-webkit-scrollbar-track]:bg-gray-100
  [&::-webkit-scrollbar-thumb]:bg-gray-300
  dark:[&::-webkit-scrollbar-track]:bg-neutral-700
  dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
    <!-- Primary Navigation Menu -->
    <div class="w-full mx-auto p-6 h-full">
        <div class="flex flex-wrap w-full justify-between h-full">
            <div class="flex flex-wrap w-full self-start">
                <!-- Logo -->
                <div class="flex items-center justify-center text-white">
                    <a href="{{ route('clients') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>
                <div class="hidden sm:flex w-full my-6 border-t-2 border-t border-gunmetal"></div>
                <!-- Navigation Links -->
                <div class="hidden sm:flex w-full mb-2">
                    <x-nav-link href="{{ route('clients') }}" :active="request()->routeIs('clients')">
                        @svg('user', 'icon icon-user w-5 h-5 mr-3')
                        {{ __('Clients') }}
                    </x-nav-link>
                </div>
                <div class="hidden sm:flex w-full mb-2">
                    <x-nav-link href="#" :active="request()->routeIs('products')">
                        @svg('product', 'icon icon-product w-5 h-5 mr-3')
                        {{ __('Products') }}
                    </x-nav-link>
                </div>
                <div class="hidden sm:flex w-full mb-2">
                    <x-nav-link href="#" :active="request()->routeIs('product-notes')">
                        @svg('notes', 'icon icon-notes w-5 h-5 mr-3')
                        {{ __('Product Notes') }}
                    </x-nav-link>
                </div>
                @if (Auth::user()->role == 1)
                <div class="hidden sm:flex w-full mb-2">
                    <x-nav-link href="#" :active="request()->routeIs('payment-tracker')">
                        @svg('payment', 'icon icon-payment w-5 h-5 mr-3')
                        {{ __('Payment Tracker') }}
                    </x-nav-link>
                </div>
                <div class="hidden sm:flex sm:flex-wrap sm:w-full mb-2">
                    <!-- Settings Dropdown -->
                    <div class="w-full relative">
                        <x-dropdown align="right" width="100">
                            <x-slot name="trigger">
                                <span class="flex rounded-lg">
                                    <button type="button" class="w-full flex-shrink-0 flex items-center p-2.5 text-base leading-4 font-medium rounded-lg text-white hover:bg-gunmetal hover:text-white focus:outline-none focus:bg-gunmetal active:bg-gunmetal transition ease-in-out duration-150 text-left">
                                        @svg('setting', 'icon icon-setting w-5 h-5 mr-3')
                                        {{ __('Administration') }}
                                        @svg('arrow-down', 'icon icon-external -me-0.5 size-4 ml-auto')
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link href="{{ route('users') }}">
                                    {{ __('User List') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#">
                                    {{ __('Suitability Letter Text') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#">
                                    {{ __('Pension Letter Text') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#">
                                    {{ __('Mortgage Letter Text') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#">
                                    {{ __('Personal Acc Letter Text') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#">
                                    {{ __('Thank You Letter Text') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#">
                                    {{ __('Pension Thank You Letter Text') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#">
                                    {{ __('Mortgage Thank You Letter Text') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#">
                                    {{ __('PersonalAcc Thank You Letter Text') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                <div class="hidden sm:flex sm:flex-wrap sm:w-full mb-2">
                    <!-- Settings Dropdown -->
                    <div class="w-full relative">
                        <x-dropdown align="right" width="100">
                            <x-slot name="trigger">
                                <span class="flex rounded-lg">
                                    <button type="button" class="w-full flex-shrink-0 flex items-center p-2.5 text-base leading-4 font-medium rounded-lg text-white hover:bg-gunmetal hover:text-white focus:outline-none focus:bg-gunmetal active:bg-gunmetal transition ease-in-out duration-150 text-left">
                                        @svg('reports', 'icon icon-reports w-5 h-5 mr-3')
                                        {{ __('Reports') }}
                                        @svg('arrow-down', 'icon icon-external -me-0.5 size-4 ml-auto')
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link href="#">
                                    {{ __('Product Counts') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#">
                                    {{ __('Broker Productivity') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#">
                                    {{ __('Insurer Report') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#">
                                    {{ __('Commission Due') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#">
                                    {{ __('Payment Tracker Report') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                @endif
                <div class="hidden sm:flex sm:flex-wrap sm:w-full">
                    <!-- Settings Dropdown -->
                    <div class="w-full relative">
                        <x-dropdown align="right" width="100">
                            <x-slot name="trigger">
                                <span class="flex rounded-lg">
                                    <button type="button" class="w-full flex-shrink-0 flex items-center p-2.5 text-base leading-4 font-medium rounded-lg text-white hover:bg-gunmetal hover:text-white focus:outline-none focus:bg-gunmetal active:bg-gunmetal transition ease-in-out duration-150 text-left">
                                        @svg('external', 'icon icon-external w-5 h-5 mr-3')
                                        {{ __('External Links') }}
                                        @svg('arrow-down', 'icon icon-external -me-0.5 size-4 ml-auto')
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="http://www.bline.ie/" target="_blank">
                                    {{ __('BLine') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="https://www.zurichinsurance.ie/exg/" target="_blank">
                                    {{ __('Zurish HelpPoint') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="https://www.brokerfirst.friendsfirst.ie/ole/" target="_blank">
                                    {{ __('Friends First BrokerFirst') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="http://www.newireland.ie/broker" target="_blank">
                                    {{ __('New Ireland Broker') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                
                <div class="hidden sm:flex w-full my-6 border-t-2 border-t border-gunmetal"></div>
            </div>
            <div class="hidden sm:flex sm:flex-wrap sm:w-full self-end">
                <div class="hidden sm:flex w-full mb-2">
                    <x-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')" class="text-sm text-white/[.5] hover:text-white">
                        @svg('change-password', 'icon icon-change-password w-5 h-5 mr-3')
                        {{ __('Change Password') }}
                    </x-nav-link>
                </div>
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <div class="hidden sm:flex w-full mb-2">
                        <x-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')" class="text-sm">
                            {{ __('API Tokens') }}
                        </x-nav-link>
                    </div>
                @endif
                <!-- Authentication -->
                <div class="hidden sm:flex w-full mb-2">
                    <form class="w-full" method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-nav-link href="{{ route('logout') }}" :active="request()->routeIs('logout')" @click.prevent="$root.submit();" class="sm:text-old-rose text-sm hover:text-white">
                            @svg('logout', 'icon icon-logout w-5 h-5 mr-3')
                            {{ __('Logout Account') }}
                        </x-nav-link>
                    </form>
                </div>
            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('clients') }}" :active="request()->routeIs('clients')">
                {{ __('Clients') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
