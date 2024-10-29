<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Activate Two-Factor Authentication (2FA)') }}
        </h2>
        
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Enhance your account security by activating Two-Factor Authentication (2FA). With 2FA, a second layer of security will be added by requiring a verification code in addition to your password during login.') }}
        </p>
    </header>


    <form action="{{ route("2fa.store") }}" method="post">
        @csrf

        <x-primary-button>{{ Auth::user()->tfa_enable ? __('Deactivate Two Factor Auth'):  __('Activate Two Factor Auth')  }}</x-primary-button>

    </form>

</section>
