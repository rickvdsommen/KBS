<div class="flex-1 sm:py-5 px-4 sm:h-full">
    <h2 class="my-2 text-2xl font-semibold text-center">Huidige Projecten:</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-5">
        @foreach ($userProjects as $project)
            <div class="relative border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden bg-white shadow-lg hover:shadow-xl">
                <a href="{{ route('projects.show', $project->id) }}" class="block">
                    <img src="{{ asset('images/' . $project->picture) }}" alt="{{ $project->projectname }}" class="h-auto w-full">
                    <div class="p-4">
                        <h2 class="mb-2 text-lg font-semibold text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600 text-center">{{ $project->projectname }}</h2>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
