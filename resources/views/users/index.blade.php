<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gebruikerbeheer') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center mb-6">
                <form id="invite-form" action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <input class="mb-2 w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="email" name="email" id="email" placeholder="Email uit te nodigen gebruiker" required>
                    <x-primary-button class="ml-2">Nieuwe gebruiker uitnodigen</x-primary-button>
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
            <div class=" text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6">
                <table class="border-collapse table-auto w-full text-sm" >
                    <thead>
                        <th class="px-4 py-2 text-left">Nr</th>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Naam</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Functie</th>
                        <th class="px-4 py-2 text-left">Lid sinds</th>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr class="border-t border-gray-200 dark:border-gray-700">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $user->id }}</td>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->function }}</td>
                            <td class="px-4 py-2">{{ $user->created_at }}</td>
                            <td class="px-4 py-2 flex space-x-2">
                                <form action="{{ route('users.edit', $user->id)}}" method="GET">
                                    <x-primary-button type="submit">Wijzigen</x-primary-button>
                                </form>
                                <form action="{{ route('users.destroy', $user->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-secondary-button class="text-red-600 dark:text-red-600" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')" type="submit">Verwijderen</x-primary-button>
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
        </div>
    </div>
</x-app-layout>