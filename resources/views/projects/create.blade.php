<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Project aanmaken
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <form method="POST" action="{{ route('projects.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="projectname" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Project Naam</label>
                    <input type="text" name="projectname" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="phaseName" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Fase</label>
                    <input type="text" name="phaseName" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                    <select name="status" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        <option value="Planning">Planning</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                        <option value="On Hold">On Hold</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="startingDate" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Begindatum</label>
                    <input type="date" name="startingDate" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="projectLeader" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Project Leider</label>
                    <input type="text" name="projectLeader" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="productOwner" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Product Owner</label>
                    <input type="text" name="productOwner" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Omschrijving</label>
                    <textarea name="description" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="tags" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tags</label>
                    <div class="mt-1 space-x-2 flex flex-wrap">
                        @foreach($tags as $tag)
                        <label class="inline-flex items-center mr-4 mb-2">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="form-checkbox h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 focus:ring-indigo-500">
                            <span class="ml-2">{{ $tag->tag }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="categories" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Categorieën</label>
                    <div class="mt-1 space-x-2 flex flex-wrap">
                        @foreach($categories as $category)
                        <label class="inline-flex items-center mr-4 mb-2">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-checkbox h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 focus:ring-indigo-500">
                            <span class="ml-2">{{ $category->category }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                
                <x-primary-button>Opslaan</x-primary-button>
            </form>
        </div>
        
    </div>
</x-app-layout>
