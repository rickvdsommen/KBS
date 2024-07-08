<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300 ease-in-out">
                <div class="p-8">
                    <div class="md:flex md:flex-row-reverse md:items-start md:justify-between">
                        <div class="mb-6 md:mb-0 md:w-1/2 flex justify-center items-start">
                            @if ($project->picture)
                                <img src="{{ asset('images/' . $project->picture) }}" alt="{{ $project->projectname }}" class="rounded-3xl h-auto max-h-96 max-w-full">
                            @else
                                <div class="bg-gray-300 rounded-lg h-96 w-96 flex items-center justify-center">
                                    <span class="text-gray-500 text-4xl">Geen foto</span>
                                </div>
                            @endif
                        </div>
                        <div class="md:w-1/2 md:mr-6">
                            <h2 class="text-3xl mb-2 font-semibold text-gray-900 dark:text-gray-200">{{ $project->projectname }}</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-1"><strong>Fase:</strong> {{ $project->phaseName }}</p>
                            <p class="text-gray-700 dark:text-gray-300 mb-1"><strong>Status:</strong> {{ $project->status }}</p>
                            <p class="text-gray-700 dark:text-gray-300 mb-1"><strong>Begin datum:</strong> {{ \Carbon\Carbon::parse($project->startingDate)->locale('nl')->translatedFormat('d F Y') }}</p>
                            <p class="text-gray-700 dark:text-gray-300 mb-1"><strong>Project Leader:</strong> <a class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600" href="{{ route('team.show', $project->projectLeaderRelation->id) }}">{{ $project->projectLeaderRelation->name }}</a></p>
                            <p class="text-gray-700 dark:text-gray-300 mb-1"><strong>Product Owner:</strong> <a class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600" href="{{ route('team.show', $project->productOwnerRelation->id) }}">{{ $project->productOwnerRelation->name }}</a></p>
                            <p class="text-gray-700 dark:text-gray-300"><strong>Omschrijving:</strong> {{ $project->description }}</p>

                            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-gray-200">Categorieën:</h3>
                            <ul class="list-disc list-inside">
                                @foreach ($project->categories as $category)
                                    <li class="text-gray-700 dark:text-gray-300">{{ $category->category }}</li>
                                @endforeach
                            </ul>

                            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-gray-200">Tags:</h3>
                            <ul class="list-disc list-inside">
                                @foreach ($project->tags as $tag)
                                    <li class="text-gray-700 dark:text-gray-300">{{ $tag->tag }}</li>
                                @endforeach
                            </ul>

                            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-gray-200">Gebruikers die werken aan dit project:</h3>
                            <ul class="list-disc list-inside">
                                @foreach ($project->users as $user)
                                    <li class="text-gray-700 dark:text-gray-300">
                                        <a class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600" href="{{ route('team.show', $user->id) }}">{{ $user->name }} </a> ({{ $user->function }})
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Vooruitgang:</h3>
                        <div class="flex items-center mt-2">
                            <div class="w-9/12 bg-gray-200 dark:bg-gray-600 rounded-lg overflow-hidden">
                                <div class="bg-indigo-500 dark:bg-indigo-600 text-xs leading-none py-1 text-center text-white" style="width: {{ $project->progress }}%;">
                                    {{ $project->progress }}%
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <a href="{{ route('projects.edit', $project->id) }}" class="text-indigo-600 hover:text-indigo-900">
                            <x-primary-button>Wijzigen</x-primary-button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
