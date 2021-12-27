<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="national_code" value="{{ __('کد ملی') }}" />
                <x-jet-input id="national_code" class="block mt-1 w-full" type="text" name="national_code"
                    :value="old('national_code')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('رمز عبور') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('مرا به خاطر بسپار') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('رمز عبور خود را فراموش کرده اید؟') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('ورود') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
