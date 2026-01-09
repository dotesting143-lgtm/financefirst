<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">
        <link  rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}" />
        <link  rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        @bukStyles(true)
		@bukScripts(true)
    </head>
    <body class="font-sans antialiased">
        <x-banner />
        <div class="min-h-screen bg-mist-gray relative lg:ml-64">
            @include('sidebarmenu')
            {{-- @livewire('navigation-menu') --}}
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-oxford-blue transition-all duration-300 mb-4 md:mb-0">
                    <div class="w-full py-4 lg:py-6 xl:py-9 px-4 lg:px-6 xl:px-8 md:pb-20 lg:pb-24 xl:pb-28 flex items-center gap-4">
                        <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-white rounded-lg bg-pos-gradient hover:bg-pos-gradient focus:outline-none focus:ring-2 focus:ring-bg-pos-gradient lg:hidden">
                            <span class="sr-only">Open sidebar</span>
                            @svg('burger', 'icon icon-burger w-6 h-6')
                        </button>
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="relative transition-all duration-300">
                {{ $slot }}
            </main>
        </div>
        @stack('modals')
        <!-- Global Loader -->
		<div wire:loading class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
		    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-white"></div>
		</div>

        @livewireScripts
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    </body>
</html>
