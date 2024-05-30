<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Tags Beheren
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
        <div
            class="text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6 mb-6 max-w-7xl">
            <div class="mb-2">
                <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">Tag Toevoegen</h1>
                <form action="{{ route('tags.store') }}" method="POST" class="flex">
                    @csrf
                    <x-text-input id="tag" placeholder="Tag"
                        class="mb-2 w-80 " type="text"
                        name="tag" :value="old('tag')" required autofocus />
                    <x-primary-button class="w-30 h-8 mt-1 ml-2">{{ __('Toevoegen') }}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6">

            <div class="mb-2">
                <form action="{{ route('tags.index') }}" method="GET" class="flex">
                    <x-text-input id="search" placeholder="Zoek tags..."
                        class="mb-2 w-80 " type="text"
                        name="search" value="{{ request('search') }}" autofocus />
                    <x-primary-button class="w-30 h-8 mt-1 ml-2">Zoeken</x-primary-button>
                </form>
            </div>

            @if ($tags->isEmpty())
                <p class="text-gray-700 dark:text-gray-300">Kon geen tags vinden.</p>
            @else
                <ul class="space-y-4">
                    @foreach ($tags as $tag)
                        <li
                            class="flex justify-between items-center p-4 bg-gray-100 dark:bg-gray-600 rounded-lg shadow min-w-fit w-1/3">
                            <span class="text-gray-800 dark:text-gray-200">{{ $tag->tag }}</span>
                            <div class="flex space-x-2 pl-2">
                                <a href="{{ route('tags.edit', $tag->id) }}" class="text-blue-600 hover:text-blue-900">
                                    <x-primary-button>Wijzigen</x-primary-button>
                                </a>
                                <form action="{{ route('tags.destroy', $tag->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this tag?');">
                                    @csrf
                                    @method('DELETE')
                                    <x-secondary-button type="submit"
                                        class="text-red-600 hover:text-red-900">Verwijderen</x-secondary-button>
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
</x-app-layout>
