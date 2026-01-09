<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <x-label for="username"  class="text-pastel-blue text-sm lg:text-base" value="{{ __('Username') }}" />
                <input id="username" class="block border mt-2 w-full bg-space-cadet border-dark-cornflower-blue focus:border-dark-cornflower-blue focus:ring-dark-cornflower-blue text-white shadow-none rounded-lg outline-none py-2.5 lg:py-3 xl:py-4 px-2 xl:px-3 text-sm lg:text-base" type="username" name="username" :value="old('username')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-5">
                <x-label for="password" class="text-pastel-blue text-sm lg:text-base" value="{{ __('Password') }}" />
                <div class="relative" x-data="{ show: false }">
                    <input id="password" class="block border mt-2 w-full bg-space-cadet border-dark-cornflower-blue focus:border-dark-cornflower-blue focus:ring-dark-cornflower-blue text-white shadow-none rounded-lg outline-none py-2.5 lg:py-3 xl:py-4 px-2 xl:px-3 text-sm lg:text-base" x-bind:type=" show ? 'text' : 'password'" name="password" required autocomplete="current-password" />
                    <button type="button" class="absolute bg-transparent text-white right-3 top-0 bottom-0 flex items-center justify-center hover:text-blue-600" @click="show = !show">
                        <span x-show="!show">@svg('eyes1', 'w-5 h-5')</span>
                        <span x-show="show" style="display: none;">@svg('eyes', 'w-5 h-5')</span>
                    </button>
                </div>
            </div>
            <div class="block mt-5">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" class="border-dark-cornflower-blue" name="remember" />
                    <span class="ms-2 text-sm lg:text-base text-pastel-blue">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex flex-wrap justify-center mt-7">
                <button type="submit" class="flex items-center justify-center uppercase bg-pos-gradient hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-bold rounded-lg w-full justify-center mb-6 disabled:opacity-50 transition ease-in-out duration-150 py-2.5 lg:py-3 xl:py-4 px-2 xl:px-3 text-base lg:text-lg xl:text-xl">
                    {{ __('Login') }}
                </button>
                @if (Route::has('password.request'))
                    <a class="text-sm lg:text-base xl:text-lg text-white hover:text-pastel-blue focus:outline-none" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
