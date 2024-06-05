<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Team') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
        <!-- Search bar -->
        <form method="GET" action="{{ route('teams.index') }}">
            <input type="text" name="search" placeholder="Zoek een persoon  ...">
            <x-primary-button type="submit">Zoek</x-primary-button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-8">
            @foreach ($users as $user)
                <a href="{{ route('team.show', $user) }}">
                    <div class="bg-white rounded-lg overflow-hidden shadow-md cursor-pointer">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold">{{ $user->name }}</h3>
                            <p class="text-gray-600 mb-4"><strong>Email:</strong> {{ $user->email }}</p>
                            <p class="text-gray-600 mb-4"><strong>Functie:</strong> {{ $user->function }}</p>
                            <div>
                                <h4 class="text-sm font-semibold mb-2">Opleiding</h4>
                                <ul class="list-disc list-inside text-gray-600">
                                    @foreach ($user->degrees as $degree)
                                        <li>{{ $degree->degree }} - {{ $degree->school }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold mb-2">Vaardigheden</h4>
                                <ul class="list-disc list-inside text-gray-600">
                                    @foreach ($user->skills as $skill)
                                        <li>{{ $skill->skillName }} ({{ $skill->skillExperience }} jaren)</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold mb-2">Cursussen</h4>
                                <ul class="list-disc list-inside text-gray-600">
                                    @foreach ($user->courses as $course)
                                        <li>{{ $course->courseName }} ({{ $course->year }})</li>
                                    @endforeach
                                </ul>
                            </div>
                            <p class="text-gray-600 mb-4"><strong>Bio:</strong> {{ $user->bio }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-8">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
