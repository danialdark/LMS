<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('ویرایش رمز عبور') }}
    </x-slot>

    <x-slot name="description">
        {{ __('مطمن شوید که از یک رمز عبور طولانی و مناسب برای حساب کاربریتان استفاده میکنید') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="current_password" value="{{ __('رمز عبور فعلی') }}" />
            <x-jet-input id="current_password" type="password" class="mt-1 block w-full"
                wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-jet-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password" value="{{ __('رمز عبور جدید') }}" />
            <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password"
                autocomplete="new-password" />
            <x-jet-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password_confirmation" value="{{ __('تایید رمز عبور جدید') }}" />
            <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full"
                wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-jet-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('ذخیره شده.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('ذخیره') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
