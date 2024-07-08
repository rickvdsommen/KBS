<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Locaties beheren
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
        <div class="text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6 mb-6 max-w-7xl">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">
                Locatie toevoegen
            </h2>
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Location Creation Form --}}
            <form action="{{ route('locations.store') }}" method="POST" class="flex flex-wrap space-y-2 sm:space-y-0 sm:space-x-2">
                @csrf
                
                <x-text-input type="text" id="name" name="name" class="mb-2 w-full sm:w-80" placeholder="Voer de locatie naam in" required />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <div class="flex items-center justify-between w-full space-x-2 sm:w-auto">
                    <x-primary-button type="submit" class="w-32 sm:w-auto sm:ml-2 mt-1">
                        Voeg toe
                    </x-primary-button>
                    <a href="{{ route('availability.index') }}" class="w-full sm:w-auto sm:ml-2 mt-1">
                        <x-secondary-button class="sm:w-auto">
                            Terug naar overzicht
                        </x-secondary-button>
                    </a>
                </div>
            </form>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6">

            {{-- Search Bar --}}
            <form action="{{ route('locations.create') }}" method="GET" class="flex flex-wrap space-y-2 sm:space-y-0 sm:space-x-2">
                <x-text-input type="text" name="search" id="search" class="w-full sm:w-80" placeholder="Zoek locaties" />
                <x-primary-button type="submit" class="sm:w-auto sm:ml-2">
                    Zoeken
                </x-primary-button>
            </form>

            {{-- Display list of all locations --}}
            <div>
                <ul class="mt-2 divide-y divide-gray-200 dark:divide-gray-700 space-y-4">
                    @forelse($locations as $location)
                        <li class="flex justify-between items-center p-4 bg-gray-100 dark:bg-gray-600 rounded-lg shadow w-full sm:w-80 sm:min-w-fit">
                            <span class="text-gray-800 dark:text-gray-200">{{ $location->name }}</span>
                            <div class="flex space-x-2 pl-2">
                                <form action="{{ route('locations.destroy', $location->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze locatie wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <x-secondary-button type="submit" class="text-red-600 hover:text-red-900">
                                        Verwijderen
                                    </x-secondary-button>
                                </form>
                            </div>
                        </li>
                    @empty
                        <li class="py-2">
                            <span class="text-gray-700 dark:text-gray-300">Geen locaties gevonden.</span>
                        </li>
                    @endforelse
                </ul>

                {{-- Pagination Links --}}
                <div class="mt-4">
                    {{ $locations->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
