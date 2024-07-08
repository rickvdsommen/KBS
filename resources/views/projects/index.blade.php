<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Projecten') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto h-full sm:px-6 lg:px-8 pt-4">
        {{-- Search function --}}
        <form method="GET" action="{{ route('projects.index') }}" class="flex items-center mb-6 mx-2">
            <x-text-input type="text" name="search" id="search" value="{{ request('search') }}"
                placeholder="Zoek projecten..." class="mb-2 w-80" />
            <x-primary-button class="ml-2">Zoek</x-primary-button>
        </form>

        <!-- Add Project Button -->
        <div class="mb-4 mx-2 flex justify-between items-center">
            <form action="{{ route('projects.create') }}">
                <x-primary-button>Project Toevoegen</x-primary-button>
            </form>
            @role('admin')
            <div class="flex lg:space-x-4">
                <form action="{{ route('tags.index') }}">
                    <x-secondary-button type="submit">Beheer Tags</x-secondary-button>
                </form>
                <form action="{{ route('categories.index') }}">
                    <x-secondary-button type="submit">Beheer Categorieën</x-secondary-button>
                </form>
            </div>
            @endrole
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <!-- Project cards -->
            @forelse ($projects as $project)
            <div class="h-full bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg transform transition-transform hover:scale-105">
                <a href="{{ route('projects.show', $project->id) }}">
                    <div
                        class="h-full flex flex-col justify-between p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700 hover:shadow-xl cursor-pointer">
                        <div>
                            <!-- Project each row -->
                            <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-200 mb-4">
                                {{ $project->projectname }}
                            </h3>

                            <div class="mb-4">
                                <p class="text-gray-700 dark:text-gray-300">
                                    <span class="font-semibold">Fase:</span> {{ $project->phaseName }}
                                </p>
                                <p class="text-gray-700 dark:text-gray-300">
                                    <span class="font-semibold">Status:</span> {{ $project->status }}
                                </p>
                                <p class="text-gray-700 dark:text-gray-300">
                                    <span class="font-semibold">Begin datum:</span> {{ \Carbon\Carbon::parse($project->startingDate)->locale('nl')->translatedFormat('d F Y') }}
                                </p>
                            </div>
                            <div class="mb-4">
                                <p class="text-gray-700 dark:text-gray-300">
                                    <span class="font-semibold">Project Leader:</span>
                                    {{ $project->projectLeaderRelation->name }}
                                </p>
                                <p class="text-gray-700 dark:text-gray-300">
                                    <span class="font-semibold">Product Owner:</span> {{ $project->productOwnerRelation->name }}
                                </p>
                            </div>
                            <div class="mb-4">
                                <p class="text-gray-700 dark:text-gray-300">
                                    <span class="font-semibold">Omschrijving:</span>
                                    @php
                                        // Truncate description to max 200 characters
                                        $description = $project->description;
                                        $truncated_description = strlen($description) > 200 ? substr($description, 0, 200) . '...' : $description;
                                    @endphp
                                    {{ $truncated_description }}
                                </p>
                            </div>
                            <div class="mb-4">
                                <p class="text-gray-700 dark:text-gray-300">
                                    <span class="font-semibold">Categorieën:</span>
                                    @foreach ($project->categories as $category)
                                    {{ $category->category }}@if (!$loop->last),@endif
                                    @endforeach
                                </p>
                                <p class="text-gray-700 dark:text-gray-300">
                                    <span class="font-semibold">Tags:</span>
                                    @foreach ($project->tags as $tag)
                                    {{ $tag->tag }}@if (!$loop->last),@endif
                                    @endforeach
                                </p>
                            </div>
                            <!-- Progress Bar -->
                            <div class="mb-4">
                                <p class="text-gray-700 dark:text-gray-300">
                                    <span class="font-semibold">Vooruitgang:</span>
                                </p>
                                <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-lg overflow-hidden mt-2">
                                    <div class="bg-indigo-500 dark:bg-indigo-600 text-xs leading-none py-1 text-center text-white"
                                        style="width: {{ $project->progress }}%;">
                                        {{ $project->progress }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <a href="{{ route('projects.edit', $project->id) }}"
                                class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                                <x-primary-button>Wijzigen</x-primary-button>
                            </a>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="text-gray-700 dark:text-gray-300">Geen projecten gevonden.</div>
            @endforelse
        </div>
        <!-- Pagination links -->
        <div class="pt-6 pb-10">
            {{ $projects->links() }}
        </div>
    </div>
</x-app-layout>
