<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bewerk Categorie') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
    
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
    
                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700">Categorie Naam</label>
                        <input id="category" type="text" name="category" value="{{ old('category', $category->category) }}" required autofocus class="block w-80 mt-1 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    </div>
    
                    <div class="flex items-center justify-end mt-4">
                        <x-secondary-button type="button" onclick="window.history.back();">
                            Annuleren
                        </x-secondary-button>
    
                        <x-primary-button class="ml-3">
                            Wijzigen
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</x-app-layout>
