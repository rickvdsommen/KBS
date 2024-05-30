<div class=" text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6 mb-6">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">
        Nieuwe gebruikers uitnodigen
    </h2>
    <div class="flex items-center">
        
        {{-- Invite function --}}
        <form id="invite-form" action="{{ route('users.store') }}" method="POST">
            @csrf
            <x-text-input class="w-80" type="email" name="email" id="email" placeholder="E-mailadres van uitgenodigde" required/>
            <x-primary-button class="ml-2">Verstuur uitnodiging</x-primary-button>
        </form>
        @if (session('status') === 'invited')
            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 5000)"
                class="text-green-600 text-lg ml-4"
            > Uitnodiging verzonden!</div>
        @endif
    </div>
</div>