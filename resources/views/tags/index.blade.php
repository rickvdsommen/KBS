<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tags') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6 mb-6 mt-4 max-w-7xl">
            <div class="mb-2">
                <h1 class="text-2xl mb-6">Tag Toevoegen</h1>
                <form action="{{ route('tags.store') }}" method="POST" class="flex">
                    @csrf
                    <input id="tag" placeholder="Tag" class="mb-2 w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm" type="text" name="tag" :value="old('tag')" required autofocus />
                    <x-primary-button class="w-30 h-8 mt-1 ml-2">{{ __('Toevoegen') }}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl mb-6">Tags</h1>

                <div class="mb-2">
                    <form action="{{ route('tags.index') }}" method="GET" class="flex">
                        <input id="search" placeholder="zoek tags..." class="mb-2 w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm" type="text" name="search" value="{{ request('search') }}" autofocus />
                        <x-primary-button class="w-30 h-8 mt-1 ml-2">Zoeken</x-primary-button>
                    </form>
                </div>

                @if ($tags->isEmpty())
                    <p class="text-gray-700 dark:text-gray-300">Kon geen tags vinden.</p>
                @else
                    <ul class="space-y-4">
                        @foreach($tags as $tag)
                            <li class="flex justify-between items-center p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow">
                                <span>{{ $tag->tag }}</span>
                                <div class="flex space-x-2">
                                    <a href="{{ route('tags.edit', $tag->id) }}" class="text-blue-600 hover:text-blue-900">
                                        <x-primary-button>Wijzigen</x-primary-button>
                                    </a>
                                    <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tag?');">
                                        @csrf
                                        @method('DELETE')
                                        <x-secondary-button type="submit" class="text-red-600 hover:text-red-900">Verwijderen</x-secondary-button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <!-- Pagination links -->
            <div class="mt-4">
                {{ $tags->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
