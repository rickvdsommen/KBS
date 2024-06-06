<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pb-12 pt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 shadow sm:rounded-lg">

                <div class="flex">
                    <div class="w-1/2">
                        <h2 class="mt-8 text-xl font-semibold">Agenda</h2>
                        <div class="min-h-screen " id="calendarDash"></div>
                    </div>
                    <div class="w-1/2 pl-4">
                        <h2 class="mt-8 text-xl font-semibold">Medewerkers aanwezig vandaag</h2>
                        <ul class="mt-14 divide-y divide-gray-200 dark:divide-gray-600 " >
                            @forelse ($updatedDevices as $device)
                                <li class="py-2 flex items-center justify-between">
                                    <div>
                                        <a href="{{ route('team.show', $device->user->id) }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600">
                                            {{ $device->user->name }}
                                        </a>
                                        <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">
                                            @if ($device->status === 'aanwezig')
                                                Aanwezig
                                            @else
                                                Bezet
                                            @endif
                                        </span>
                                    </div>
                                    <!-- Add any additional information or actions for each user here -->
                                </li>
                            @empty
                                <li class="py-2">Er zijn geen medewerkers aanwezig vandaag.</li>
                            @endforelse
                        </ul>

                        <h2 class="mt-8 text-xl font-semibold">Mijn Projecten</h2>
                        <ul class="mt-4 divide-y divide-gray-200 dark:divide-gray-600">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
