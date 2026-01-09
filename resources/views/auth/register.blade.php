<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <x-label for="name" class="text-pastel-blue text-base" value="{{ __('Name') }}" />
                <input id="name" class="block mt-2 w-full py-4 bg-space-cadet border-dark-cornflower-blue focus:border-dark-cornflower-blue focus:ring-dark-cornflower-blue text-white shadow-none rounded-lg" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>
            <div class="mt-5">
                <x-label for="username" class="text-pastel-blue text-base" value="{{ __('username') }}" />
                <input id="username" class="block mt-2 w-full py-4 bg-space-cadet border-dark-cornflower-blue focus:border-dark-cornflower-blue focus:ring-dark-cornflower-blue text-white shadow-none rounded-lg" type="text" name="username" :value="old('username')" required autocomplete="username" />
            </div>
            <div class="mt-5">
                <x-label for="email" class="text-pastel-blue text-base" value="{{ __('Email') }}" />
                <input id="email" class="block mt-2 w-full py-4 bg-space-cadet border-dark-cornflower-blue focus:border-dark-cornflower-blue focus:ring-dark-cornflower-blue text-white shadow-none rounded-lg" type="email" name="email" :value="old('email')" required autocomplete="email" />
            </div>
            <div class="mt-5">
                <x-label for="password" class="text-pastel-blue text-base" value="{{ __('Password') }}" />
                <input id="password" class="block mt-2 w-full py-4 bg-space-cadet border-dark-cornflower-blue focus:border-dark-cornflower-blue focus:ring-dark-cornflower-blue text-white shadow-none rounded-lg" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-5"> 
                <x-label for="password_confirmation" class="text-pastel-blue text-base" value="{{ __('Confirm Password') }}" />
                <input id="password_confirmation" class="block mt-2 w-full py-4 bg-space-cadet border-dark-cornflower-blue focus:border-dark-cornflower-blue focus:ring-dark-cornflower-blue text-white shadow-none rounded-lg" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-5">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex flex-wrap justify-center mt-7">
                <button type="submit" class="flex items-center justify-center uppercase bg-pos-gradient hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-bold py-4 text-xl px-4 rounded-lg w-full justify-center mb-6 disabled:opacity-50 transition ease-in-out duration-150">
                    {{ __('Register') }}
                </button>
                <a class="text-lg text-white hover:text-pastel-blue focus:outline-none" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
