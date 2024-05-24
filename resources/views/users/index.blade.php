<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gebruikerbeheer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form id="invite-form" method="POST">
                @csrf
                <input class="mb-2 w-80" type="email" name="email" id="email" placeholder="Email uit te nodigen gebruiker" required>
                <x-primary-button onclick="return confirmInvitation()">Nieuwe gebruiker uitnodigen</x-primary-button>
            </form>

            <table class="border-collapse table-auto w-full text-sm mt-2" >
                <thead>
                    <th class="text-left">Nr</th>
                    <th class="text-left">ID</th>
                    <th class="text-left">Naam</th>
                    <th class="text-left">Email</th>
                    <th class="text-left">Functie</th>
                    <th class="text-left">Lid sinds</th>
                    <th class="text-left">Actie</th>
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
                            <a href="{{ route('users.edit', $user->id)}}">Wijzigen</a>
                            <form action="" method="post">
                                <x-primary-button onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')" type="submit">Verwijderen</x-primary-button>
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

<script>
    function confirmInvitation() {
        const emailInput = document.getElementById('email');
        const email = emailInput.value;

        if (!email) {
            alert('Vul een emailadres in');
            return false;
        }

        const form = document.getElementById('invite-form');
        const actionUrl = `{{ url('/admin/user/registration') }}/${encodeURIComponent(email)}`;
        form.action = actionUrl;

        return confirm(`Weet je zeker dat je ${email} wilt uitnodigen?`);
    }
</script>