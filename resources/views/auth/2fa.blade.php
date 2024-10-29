<x-guest-layout>
    <form method="post" action="{{ route("2fa.check") }}"  class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('2FA Code')" />
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Check your email and  insert  the  2fa code  below.') }}
            </p>

            <x-text-input type="number" name='code'  class="mt-1 block w-full"  />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            
            <button class="py-2 w-full rounded-lg bg-white">Verify</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</x-guest-layout>
