<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Projecten') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Add Project Button -->
            <div class="mb-4 flex justify-between items-center">
                <form action="{{ route('projects.create') }}">
                    <x-primary-button>Project toevoegen</x-primary-button>
                </form>
                <div class="flex space-x-4">
                    <form action="{{ route('tags.index') }}">
                        <x-secondary-button type="submit">tags beheren</x-secondary-button>
                    </form>
                    <form action="{{ route('category.index') }}">
                        <x-secondary-button type="submit">Categorie beheren</x-secondary-button>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                <!-- Project cards -->
                @foreach ($projects as $project)
                    <div class="h-full bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                        <div
                            class="h-full flex flex-col justify-between p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700">
                            <div>
                                <!-- Project each row -->
                                <a href="{{ route('projects.show', $project->id) }}" class="block hover:underline">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-200 mb-4">
                                        {{ $project->projectname }}</h3>
                                </a>
                                <div class="mb-4">
                                    <p class="text-gray-700 dark:text-gray-300"><span class="font-semibold">Fase:</span>
                                        {{ $project->phaseName }}</p>
                                    <p class="text-gray-700 dark:text-gray-300"><span
                                            class="font-semibold">Status:</span> {{ $project->status }}</p>
                                    <p class="text-gray-700 dark:text-gray-300"><span class="font-semibold">Begin
                                            datum:</span> {{ $project->startingDate }}</p>
                                </div>
                                <div class="mb-4">
                                    <p class="text-gray-700 dark:text-gray-300"><span class="font-semibold">Project
                                            Leader:</span> {{ $project->projectLeader }}</p>
                                    <p class="text-gray-700 dark:text-gray-300"><span class="font-semibold">Product
                                            Owner:</span> {{ $project->productOwner }}</p>
                                </div>
                                <div class="mb-4">
                                    <p class="text-gray-700 dark:text-gray-300"><span
                                            class="font-semibold">Omschrijving:</span> {{ $project->description }}</p>
                                </div>
                                <div class="mb-4">
                                    <p class="text-gray-700 dark:text-gray-300"><span
                                            class="font-semibold">Categorieën:</span>
                                        @foreach ($project->categories as $category)
                                            {{ $category->category }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </p>
                                    <p class="text-gray-700 dark:text-gray-300"><span class="font-semibold">Tags:</span>
                                        @foreach ($project->tags as $tag)
                                            {{ $tag->tag }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-end mt-6">
                                <a href="{{ route('projects.edit', $project->id) }}"
                                    class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                                    <x-primary-button>Bewerken</x-primary-button>
                                </a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                    onsubmit="return confirm('Weet je zeker dat je dit project wilt verwijderen?');"
                                    class="ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <x-secondary-button type="submit"
                                        class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">Verwijderen</x-secondary-button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
