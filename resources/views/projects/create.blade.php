<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create Project
        </h2>
    </x-slot>
    <div class="max-w-xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <form method="POST" action="{{ route('projects.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="projectname" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Project Naam</label>
                    <input type="text" name="projectname" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="phaseName" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Fase</label>
                    <input type="text" name="phaseName" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                    <select name="status" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        <option value="Planning">Planning</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed" >Completed</option>
                        <option value="On Hold" >On Hold</option>
                    </select>
    </div>
                <div class="mb-4">
                    <label for="startingDate" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Begindatum</label>
                    <input type="date" name="startingDate" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="projectLeader" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Project Leider</label>
                    <input type="text" name="projectLeader" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="productOwner" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Product Owner</label>
                    <input type="text" name="productOwner" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Omschrijving</label>
                    <textarea name="description" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required></textarea>
                </div>
                <x-primary-button>Opslaan</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
 