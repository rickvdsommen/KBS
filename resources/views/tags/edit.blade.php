<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl mb-6">Edit Tag</h1>
    
                <form action="{{ route('tags.update', $tag->id) }}" method="POST">
                    @csrf
                    @method('PUT')
    
                    <div class="mb-4">
                        <label for="tag" class="block text-sm font-medium text-gray-700">Tag Name</label>
                        <input id="tag"  class="block mt-1 w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="text" name="tag" value="{{ $tag->tag }}" required autofocus />
                    </div>
    
                    <div class="flex items-center justify-end mt-4">
                        <x-secondary-button type="button" onclick="window.history.back();">
                            Wijzigen
                        </x-secondary-button>
    
                        <x-primary-button class="ml-3">
                            Bewerken
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</x-app-layout>
