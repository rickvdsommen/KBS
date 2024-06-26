<div class="text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6 mb-6">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">
        Nieuwe gebruiker aanmaken
    </h2>
    <div class="flex flex-wrap items-start space-y-5 md:space-y-0 md:space-x-5">
        
        {{-- Invite function --}}
        <form id="invite-form" action="{{ route('users.store') }}" method="POST" class="flex flex-wrap w-full items-center">
            @csrf
            <x-text-input class="w-full md:w-1/5 mb-2 mx-1" type="text" name="name" id="name" placeholder="Naam" required/>
            <x-text-input class="w-full md:w-1/5 mb-2 mx-1" type="email" name="email" id="email" placeholder="E-mailadres" required/>
            <x-text-input class="w-full md:w-1/5 mb-2 mx-1" type="text" name="function" id="function" placeholder="Functie" required/>
            <x-text-input class="w-full md:w-1/5 mb-2 mx-1" type="password" name="password" id="password" placeholder="Wachtwoord" required/>
            <x-primary-button class="ml-2 mt-2 md:mt-0 h-fit">Aanmaken</x-primary-button>
        </form>
        
        {{-- Success message --}}
        @if (session('status') === 'added')
            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 5000)"
                class="text-green-600 text-lg ml-4"
            >
                Gebruiker is aangemaakt!
            </div>
        @endif
        
        {{-- Error message --}}
        @if (session('status') === 'error')
            <div class="text-red-600 text-lg ml-4">
                {{ session('error') }}
            </div>
        @elseif ($errors->any())
            <div class="text-red-600 text-lg ml-4">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
    </div>
</div>
