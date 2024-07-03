<!-- devices-management.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                Aanwezigheid
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        {{-- Search function --}}
        <div class="bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6 mb-4">
            <form method="GET" action="{{ route('devices.index') }}" class="flex flex-wrap items-center space-y-2 sm:space-y-0 sm:space-x-2">
                <x-text-input type="text" name="name" id="name" value="{{ request('name') }}"
                    placeholder="Zoeken op gebruikersnaam..." class="w-full sm:w-64" />

                <x-text-input type="number" name="id" id="id" value="{{ request('id') }}"
                    placeholder="Zoeken op apparaat ID..." class="w-full sm:w-64" min="1" />

                <x-primary-button>Zoek</x-primary-button>

                <a href="{{ route('locations.create') }}" class="transform transition-transform hover:scale-105 flex">
                    <x-secondary-button>Beheer locaties</x-secondary-button>
                </a>
            </form>
        </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
                            <th class="py-2 px-4 text-left">Apparaat ID</th>
                            <th class="py-2 px-4 text-left">Status</th>
                            <th class="py-2 px-4 text-left">Locatie</th>
                            <th class="py-2 px-4 text-left">Gebruiker</th>
                            <th class="py-2 px-4 text-left">Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($devices as $device)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2 px-4">{{ $device->id }}</td>
                                <td class="py-2 px-4">{{ $device->status }}</td>
                                <td class="py-2 px-4">
                                    <form action="{{ route('devices.update', $device->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <select name="location_id" class="form-select bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 w-6/12" >
                                            <option value="">Geen locatie</option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}" @if($device->location_id == $location->id) selected @endif>{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-primary">Wijzigen</button>
                                    </form>
                                </td>
                                <td class="py-2 px-4">{{ $device->user ? $device->user->name : 'Unassigned' }}</td>
                                <td class="py-2 px-4">
                                    @if($device->user)
                                        <form action="{{ route('devices.unlink') }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="device_id" value="{{ $device->id }}">
                                            <button type="submit" class="btn btn-danger">Ontkoppelen</button>
                                        </form>
                                    @else
                                        <form action="{{ route('devices.link') }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="device_id" value="{{ $device->id }}">
                                            <select name="user_id" class="form-select" required>
                                                <option value="">Selecteer gebruiker</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-primary">Koppel</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $devices->links() }} {{-- Display pagination links --}}
            </div>
        </div>
    </div>

    <style>
        .form-select {
            padding: 0.5rem;
            border-radius: 0.375rem;
            border: 1px solid #d1d5db;
        }
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #2563eb;
            color: white;
        }
        .btn-danger {
            background-color: #dc2626;
            color: white;
        }
        .overflow-x-auto {
            overflow-x: auto;
            max-width: 100%;
        }
    </style>
</x-app-layout>
