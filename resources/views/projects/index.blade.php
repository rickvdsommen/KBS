<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Projecten') }}
        </h2>
    </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Add Project Button -->
        <div class="mb-4">
            <form action="{{ route('projects.create') }}">
                <x-primary-button>Project toevoegen</x-primary-button>
            </form>
        </div>
        

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Project cards --> 
                @foreach ($projects as $project)
                <div class="h-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="h-full flex flex-col justify-between p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <!-- Project each row -->
                            <a href="{{ route('projects.show', $project->id) }}" class="block">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">{{ $project->projectname }}</h3>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Fase:</strong> {{ $project->phaseName }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Status:</strong> {{ $project->status }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Begin datum:</strong> {{ $project->startingDate }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Project Leader:</strong> {{ $project->projectLeader }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Product Owner:</strong> {{ $project->productOwner }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Omschrijving:</strong> {{ $project->description }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Categorieën:</strong>
                                    @foreach ($project->categories as $category)
                                        {{ $category->category }}@if (!$loop->last), @endif
                                    @endforeach
                                </p>
                                <p class="text-gray-700 dark:text-gray-300"><strong>Tags:</strong>
                                    @foreach ($project->tags as $tag)
                                        {{ $tag->tag }}@if (!$loop->last), @endif
                                    @endforeach
                                </p>
                            </a>
                        </div>
                        <div class="flex justify-end mt-4">
                            <a href="{{ route('projects.edit', $project->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                <x-primary-button>Bewerken</x-primary-button>
                            </a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit project wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <x-secondary-button type="submit" class="ml-2 text-red-600 hover:text-red-900">Verwijderen</x-secondary-button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
