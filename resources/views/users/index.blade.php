<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gebruikerbeheer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center">
                <form id="invite-form" action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <input class="mb-2 w-80" type="email" name="email" id="email" placeholder="Email uit te nodigen gebruiker" required>
                    <x-primary-button>Nieuwe gebruiker uitnodigen</x-primary-button>
                </form>
                    @if (session('status') === 'invited')
                    <div
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 5000)"
                        class="text-green-600 text-lg ml-2"
                    > Uitnodiging verzonden!</div>
                @endif
                
            </div>

            <table class="border-collapse table-auto w-full text-sm mt-2" >
                <thead>
                    <th class="text-left">Nr</th>
                    <th class="text-left">ID</th>
                    <th class="text-left">Naam</th>
                    <th class="text-left">Email</th>
                    <th class="text-left">Functie</th>
                    <th class="text-left">Lid sinds</th>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->function }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td class="flex">
                            <form action="{{ route('users.edit', $user->id)}}" method="GET">
                                <x-primary-button type="submit">Wijzigen</x-primary-button>
                            </form>
                            <form action="{{ route('users.destroy', $user->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-secondary-button onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')" type="submit">Verwijderen</x-primary-button>
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
</x-app-layout>