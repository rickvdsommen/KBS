<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Bedankt voor je aanmelding! Voordat je begint, kun je je e-mailadres verifiëren door te klikken op de link die we zojuist naar je hebben gemaild? Als je de e-mail niet hebt ontvangen, sturen we je graag een nieuwe.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('Er is een nieuwe verificatielink naar het e-mailadres gestuurd dat je hebt opgegeven tijdens de registratie.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Verstuur verificatie e-mail opnieuw') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Uitloggen') }}
            </button>
        </form>
    </div>
</x-guest-layout>
