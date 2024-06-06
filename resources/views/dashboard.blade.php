<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pb-12 pt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 shadow sm:rounded-lg">

                <div class="flex space-x-10">
                    <!-- First column for the calendar -->
                    <div class="w-1/3 border h-fit border-gray-300 dark:border-gray-600 rounded-lg p-5 shadow-md">
                        <div class="min-h-screen w-full" id="calendarDash"></div>
                    </div>

                    <!-- Second column for "Mijn Projecten" -->
                    <div class="w-1/3 border h-fit border-gray-300 dark:border-gray-600 rounded-lg p-5 shadow-md">
                        <h2 class="my-2 text-2xl font-semibold">Mijn Projecten:</h2>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-600 text-xl">
                            @forelse ($userProjects as $project)
                                <li class="py-2">
                                    <a href="{{ route('projects.show', $project->id) }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600">
                                        {{ $project->projectname }}
                                    </a>
                                </li>
                            @empty
                                <li class="py-2">Je hebt geen lopende projecten.</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Third column for "Wie is er vandaag aanwezig?" -->
                    <div class="w-1/3 border h-fit border-gray-300 dark:border-gray-600 rounded-lg p-5 shadow-md">
                        <h2 class="my-2 text-2xl font-semibold">Wie is er vandaag aanwezig?</h2>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-600 text-xl">
                            @forelse ($users as $user)
                                <li class="py-2 flex">
                                    <div>
                                        <a href="{{ route('team.show', $user->id) }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600">
                                            {{ $user->name }}
                                        </a>
                                        @include('components.status-indicator-extra')
                                    </div>
                                </li>
                            @empty
                                <li class="py-2">Er zijn geen medewerkers aanwezig vandaag.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
