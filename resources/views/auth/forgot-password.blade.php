<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-7 text-sm lg:text-base text-white">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @session('status')
            <div class="mb-4 font-medium text-sm lg:text-base text-green-600">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" class="text-pastel-blue text-sm lg:text-base" value="{{ __('Email') }}" />
                <input id="email" class="block mt-2 w-full bg-space-cadet border-dark-cornflower-blue focus:border-dark-cornflower-blue focus:ring-dark-cornflower-blue text-white shadow-none rounded-lg py-2.5 lg:py-3 xl:py-4 px-2 xl:px-3 text-sm lg:text-base" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex flex-wrap justify-center mt-7">
                <button type="submit" class="flex items-center justify-center uppercase bg-pos-gradient hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-bold rounded-lg w-full justify-center mb-6 disabled:opacity-50 transition ease-in-out duration-150 py-2.5 lg:py-3 xl:py-4 px-2 xl:px-3 text-base lg:text-lg xl:text-xl">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
