<!-- resources/views/locations/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Voeg Locatie Toe
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Location Creation Form --}}
            <form action="{{ route('locations.store') }}" method="POST" class="mb-6">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Locatie</label>
                    <input type="text" id="name" name="name" class="form-input mt-1 block w-full" placeholder="Voer de locatie naam in" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Add other fields as needed -->

                <div class="flex items-center justify-between">
                    <button type="submit" class="py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-75">
                        Opslaan
                    </button>
                    <a href="{{ route('devices.index') }}">
                        <x-secondary-button>
                            Terug naar Devices
                        </x-secondary-button>
                    </a>
                </div>
            </form>
        </div>
        <div class="bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6 mt-7">

            {{-- Search Bar --}}
            <form action="{{ route('locations.create') }}" method="GET" class="mb-6">
                <div class="flex items-center">
                    <input type="text" name="search" id="search" class="form-input w-full" placeholder="Zoek locaties">
                    <button type="submit" class="ml-2 py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-75">
                        Zoeken
                    </button>
                </div>
            </form>

            {{-- Display list of all locations --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Alle Locaties</h3>
                <ul class="mt-2 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($locations as $location)
                        <li class="py-2 flex justify-between items-center">
                            <span class="block text-sm font-medium text-gray-800 dark:text-gray-200">{{ $location->name }}</span>
                            <form action="{{ route('locations.destroy', $location->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-2 py-1 px-3 bg-red-500 hover:bg-red-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-opacity-75">
                                    Verwijderen
                                </button>
                            </form>
                        </li>
                    @empty
                        <li class="py-2">
                            <span class="block text-sm text-gray-500 dark:text-gray-400">Geen locaties gevonden.</span>
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
