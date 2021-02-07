<div>
    <x-auth-card>
        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        <div class="{{ $registered ? 'animation-linear animation-duration-500 animate-hide' : '' }}">

            <form method="POST" wire:submit.prevent="register">
                @csrf

                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Name')" />

                    <x-input wire:model.lazy="name" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                    <x-validation-error class="mb-4" :errors="$errors->get('name')" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input wire:model.lazy="email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                    <x-validation-error class="mb-4" :errors="$errors->get('email')" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input wire:model.lazy="password" id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-validation-error class="mb-4" :errors="$errors->get('password')" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input wire:model.lazy="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />

                    <x-validation-error class="mb-4" :errors="$errors->get('password_confirmation')" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="ml-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </div>

        @if ($registered)
            <div class="opacity-0 animation-linear animation-duration-500 animation-delay-1000 animate-show text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div wire:poll.2s="redirectAfterRegistration"></div>
        @endif
    </x-auth-card>
</div>
