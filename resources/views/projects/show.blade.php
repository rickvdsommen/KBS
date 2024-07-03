<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700">
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
                        <li i class="text-gray-700 dark:text-gray-300">
                            <a class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600" href="{{ route('team.show', $user->id) }}">{{ $user->name }} </a> ({{ $user->function }})
                        </li>
                        @endforeach
                    </ul>

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
