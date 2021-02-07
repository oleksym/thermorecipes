<div>
    <x-auth-card>

        <!-- Session Status -->
        {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        <div class="{{ $logged_in ? 'animation-linear animation-duration-500 animate-hide' : '' }}">

            <form method="POST" wire:submit.prevent="login">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />

                    <x-input wire:model.lazy="email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

                    <x-validation-error class="mb-4" :errors="$errors->get('email')" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input wire:model.lazy="password" id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-validation-error class="mb-4" :errors="$errors->get('password')" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input wire:model.lazy="remember_me" id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-button class="ml-3">
                        {{ __('Login') }}
                    </x-button>
                </div>
            </form>
        </div>

        @if ($logged_in)
            <div class="opacity-0 animation-linear animation-duration-500 animation-delay-1000 animate-show text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div wire:poll.2s="redirectAfterLogin"></div>
        @endif
    </x-auth-card>
</div>
