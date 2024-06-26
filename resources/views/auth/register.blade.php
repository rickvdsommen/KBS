<x-guest-layout>
    <form method="POST" action="{{ route('register', ['email' => $email, 'expires' => $expires, 'signature' => $signature]) }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Voor- en Achternaam')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full bg-gray-100 cursor-not-allowed" type="email" name="email" value="{{ $email }}" readonly required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Birthday -->
        <div class="mt-4">
            <x-input-label for="birthday" :value="__('Geboortedatum')" />
            <x-text-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" value="" required />
            <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
        </div>

        <!-- Function -->
        <div class="mt-4">
            <x-input-label for="function" :value="__('Functie')" />
            <x-text-input id="function" class="block mt-1 w-full" type="text" name="function" value="" required />
            <x-input-error :messages="$errors->get('function')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Wachtwoord')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Bevestig Wachtwoord')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Al geregistreerd?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registreren') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
