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
            <div class="flex flex-wrap items-center space-y-2 sm:space-y-0 sm:space-x-2 mb-6">
            <form method="GET" action="{{ route('devices.index') }}" >
                <x-text-input type="text" name="search" id="search" value="{{ request('search') }}"
                placeholder="Zoek op Apparaat ID of Gebruiker..." class="w-80 mr-2" />

                <x-primary-button>Zoeken</x-primary-button>
            </form>
            @role('admin')
                <a href="{{ route('locations.create') }}" class="transform transition-transform hover:scale-105 flex">
                    <x-secondary-button>Beheer locaties</x-secondary-button>
                </a>
            @endrole
            </div>

            <div class="overflow-x-auto">
                <table class="border-collapse table-auto w-full">
                    <thead>
                            <th class="py-2 px-4 text-left">Apparaat ID</th>
                            <th class="py-2 px-4 text-left">Status</th>
                            <th class="py-2 px-4 text-left">Locatie</th>
                            <th class="py-2 px-4 text-left">Gebruiker</th>
                            <th class="py-2 px-4 text-left"></th>
                    </thead>
                    <tbody>
                        @foreach($devices as $device)
                            <tr class="border-t border-gray-200 dark:border-gray-800">
                                <td class="py-2 px-4">{{ $device->id }}</td>
                                <td class="py-2 px-4">{{ $device->status }}</td>
                                <td class="py-2 px-4">
                                    <form action="{{ route('devices.update', $device->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <select name="location_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-6/12" >
                                            <option value="">Geen locatie</option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}" @if($device->location_id == $location->id) selected @endif>{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-primary-button type="submit">Wijzigen</x-primary-button>
                                    </form>
                                </td>
                                <td class="py-2 px-4">{{ $device->user ? $device->user->name : 'Niet gekoppeld' }}</td>
                                <td class="py-2 px-4">
                                    @if($device->user)
                                        <form action="{{ route('devices.unlink') }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="device_id" value="{{ $device->id }}">
                                            <x-secondary-button class="text-red-600 dark:text-red-600" type="submit"> Ontkoppelen</x-secondary-button>
                                        </form>
                                    @else
                                        <form action="{{ route('devices.link') }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="device_id" value="{{ $device->id }}">
                                            <select name="user_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                                <option value="">Selecteer gebruiker</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-primary-button type="submit">Koppel</x-primary-button>
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
</x-app-layout>
