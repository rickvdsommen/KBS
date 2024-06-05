<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-200">{{ $project->projectname }}</h2>
                    <p class="text-gray-700 dark:text-gray-300"><strong>Fase:</strong> {{ $project->phaseName }}</p>
                    <p class="text-gray-700 dark:text-gray-300"><strong>Status:</strong> {{ $project->status }}</p>
                    <p class="text-gray-700 dark:text-gray-300"><strong>Begin datum:</strong> {{ $project->startingDate }}</p>
                    <p class="text-gray-700 dark:text-gray-300"><strong>Project Leader:</strong> {{ $project->projectLeader }}</p>
                    <p class="text-gray-700 dark:text-gray-300"><strong>Product Owner:</strong> {{ $project->productOwner }}</p>
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
                            {{ $user->name }} ({{ $user->function }})
                        </li>
                        @endforeach
                    </ul>

                    <div class="flex justify-end mt-4">
                        <a href="{{ route('projects.edit', $project->id) }}" class="text-indigo-600 hover:text-indigo-900">
                            <x-primary-button>Wijzigen</x-primary-button>
                        </a>
                        @role('admin') 
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit project wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <x-secondary-button type="submit" class="ml-2 text-red-600 hover:text-red-900">Verwijderen</x-secondary-button>
                        </form>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
