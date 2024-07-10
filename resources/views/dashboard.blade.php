<x-app-layout>
    <x-slot name="header" class="bg-gray-400">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Page Content -->
    <main class="bg-gray-100 dark:bg-gray-800 min-h-screen h-full flex">
        <!-- Left Sidebar -->
        <div class="w-1/4 border-r border-gray-300 dark:border-gray-600 p-5">
            <h2 class="my-2 text-2xl font-semibold">Afspraken voor vandaag:</h2>
            <ul class="divide-y divide-gray-200 dark:divide-gray-600 text-lg font-semibold">
                @forelse ($appointments as $appointment)
                    <li class="py-2">
                        <a href="{{ route('agenda.index', $appointment->id) }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600">
                            {{ $appointment->title }}
                        </a>
                        <div class="text-gray-700 dark:text-gray-300">
                            {{ \Carbon\Carbon::parse($appointment->start)->format('H:i') }} - {{ \Carbon\Carbon::parse($appointment->end)->format('H:i') }}
                        </div>
                    </li>
                @empty
                    <li class="py-2 font-normal text-base">Er zijn geen afspraken voor vandaag.</li>
                @endforelse
            </ul>
        </div>

        <!-- Middle Section -->
        <div class="flex-1 p-5">
            <h2 class="my-2 text-2xl font-semibold">Huidige Projecten:</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($userProjects as $project)
                    <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-5 shadow-md bg-white">
                        <a href="{{ route('projects.show', $project->id) }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600 block mt-2">
                            <h2 class="my-2 text-xl font-semibold">{{ $project->projectname }}</h2>
                            <img src="{{ asset('images/' . $project->picture) }}" alt="{{ $project->projectname }}" class="h-full w-full rounded-2xl">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="w-1/4 border-l border-gray-300 dark:border-gray-600 p-5">
            <h2 class="my-2 text-2xl font-semibold">Wie is er vandaag aanwezig?</h2>
            <div class="grid grid-cols-2 gap-4">
                @forelse ($users as $user)
                    <div class="flex flex-col items-center">
                        <a href="{{ route('team.show', $user->id) }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600 mt-2 text-center">
                            @include('components.profile_picture')<br/>{{ $user->name }}
                        </a>
                    </div>
                @empty
                    <div class="py-2 font-normal text-base">Niemand :(</div>
                @endforelse
            </div>
        </div>
    </main>
</x-app-layout>
