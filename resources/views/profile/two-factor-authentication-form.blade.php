<x-jet-action-section>
    <x-slot name="title">
        {{ __('تایید دو مرحله ای') }}
    </x-slot>

    <x-slot name="description">
        {{ __('با تایید دو مرحله ای امنیت حساب کاربری خود را به حداکثر برسانید') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                {{ __('تایید دو مرحله ای شما فعال است.') }}
            @else
                {{ __('تایید دو مرحله ای شما غیر فعال است.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('با استفاده از این ویژگی شما به صورت تصادفی کد هایی را دریافت میکنید که به عنوان رمز عبور دوم شما استفاده میشود.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('تایید دو مرحله ای شما هم اکنون فعال است.برای استفاده لطفا برنامه googleauthentication را روی گوشی موبایل خود نصب کرده و کد زیر را اسکن کنید') }}
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('کلید های بازیابی زیر را در جایی امن نگه داری کنید تا در هنگام عدم دسترسی به گوشی موبایل از انها به جای رمز دوم خود استفاده کنید.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (!$this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        {{ __('فعال') }}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('تولید دوباره کلید ها') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('نمایش کلید های بازیابی') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-jet-danger-button wire:loading.attr="disabled">
                        {{ __('غیر فعال کردن') }}
                    </x-jet-danger-button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
