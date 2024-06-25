<?php
// Define an array of Dutch month names
$dutchMonths = [
    1 => 'januari',
    2 => 'februari',
    3 => 'maart',
    4 => 'april',
    5 => 'mei',
    6 => 'juni',
    7 => 'juli',
    8 => 'augustus',
    9 => 'september',
    10 => 'oktober',
    11 => 'november',
    12 => 'december',
];
?>

<div class=" text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6">
    {{-- Search function --}}
    <form method="GET" action="{{ route('users.index') }}" class="items-center mb-6">
        <x-text-input type="text" name="search" id="search" value="{{ request('search') }}"
            placeholder="Zoek op ID, naam, email of functie..." class="mb-2 w-80"/>

        <select name="role" id="role"
            class="mb-2 ml-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            <option value="">Alle Rollen</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Gebruiker</option>
        </select>

        <x-primary-button class="ml-2">Zoeken</x-primary-button>
    </form>
    <div class="overflow-x-auto">
    <table class="border-collapse table-auto w-full text-sm">
        <thead>
            {{-- <th class="px-4 py-2 text-left">Nr</th> --}}
            <th class="px-4 py-2 text-left">ID</th>
            <th class="px-4 py-2 text-left">Naam</th>
            <th class="px-4 py-2 text-left">Email</th>
            <th class="px-4 py-2 text-left">Functie</th>
            <th class="px-4 py-2 text-left">Lid sinds</th>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr class="border-t border-gray-200 dark:border-gray-800">
                    {{-- <td class="px-4 py-2">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td> --}}
                    <td class="px-4 py-2">{{ $user->id }}</td>
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">{{ $user->function }}</td>
                    <td class="px-4 py-2">{{ $user->created_at->format('d') }}
                        {{ $dutchMonths[$user->created_at->format('n')] }} {{ $user->created_at->format('Y') }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <form action="{{ route('users.edit', $user->id) }}" method="GET">
                            <x-primary-button type="submit">Wijzigen</x-primary-button>
                        </form>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-secondary-button class="text-red-600 dark:text-red-600"
                                onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')"
                                type="submit">Verwijderen</x-primary-button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    Geen gebruikers
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
    <div class="mt-5">
        {{ $users->links() }}
    </div>
</div>
