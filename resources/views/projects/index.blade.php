<!-- resources/views/projects/index.blade.php -->

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
                <div class="h-full flex flex-col justify-between p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">{{ $project->projectname }}</h3>
                        <p class="text-gray-700 dark:text-gray-300"><strong>Phase:</strong> {{ $project->phaseName }}</p>
                        <p class="text-gray-700 dark:text-gray-300"><strong>Status:</strong> {{ $project->status }}</p>
                        <p class="text-gray-700 dark:text-gray-300"><strong>Starting Date:</strong> {{ $project->startingDate }}</p>
                        <p class="text-gray-700 dark:text-gray-300"><strong>Project Leader:</strong> {{ $project->projectLeader }}</p>
                        <p class="text-gray-700 dark:text-gray-300"><strong>Categorie:</strong> {{ $project->categorie }}</p>
                        <p class="text-gray-700 dark:text-gray-300"><strong>Product Owner:</strong> {{ $project->productOwner }}</p>
                        <p class="text-gray-700 dark:text-gray-300"><strong>Description:</strong> {{ $project->description }}</p>
                    </div>
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('projects.edit', $project->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ml-2 text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

</x-app-layout>
