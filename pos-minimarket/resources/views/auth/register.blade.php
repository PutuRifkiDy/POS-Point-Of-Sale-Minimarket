<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
        </x-slot>

        <x-validation-errors class="tw-mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="tw-block tw-mt-1 tw-w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="tw-mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="tw-block tw-mt-1 tw-w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="tw-mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="tw-block tw-mt-1 tw-w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="tw-mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="tw-block tw-mt-1 tw-w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="tw-mt-4">
                    <x-label for="terms">
                        <div class="tw-flex tw-items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="tw-ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="tw-underline tw-text-sm tw-text-gray-600 hover:tw-text-gray-900 tw-rounded-md focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="tw-underline tw-text-sm tw-text-gray-600 hover:tw-text-gray-900 tw-rounded-md focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
                <a class="tw-underline tw-text-sm tw-text-gray-600 hover:tw-text-gray-900 tw-rounded-md focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="tw-ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
