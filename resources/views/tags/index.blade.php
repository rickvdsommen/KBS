<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Tags Beheren
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
        <div class="text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6 mb-6 max-w-7xl">

            <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">Tag Toevoegen</h1>
            <div class="flex flex-wrap w-full space-y-2 sm:space-y-0 sm:space-x-2 items-center">
                <form action="{{ route('tags.store') }}" method="POST" class="w-full sm:w-fit items-center flex flex-wrap sm:space-x-2 sm:space-y-0 space-y-2">
                    @csrf
                    <x-text-input id="tag" placeholder="Tag" class="w-full sm:w-80" type="text" name="tag"
                        :value="old('tag')" required autofocus />
                    <x-primary-button class="">{{ __('Toevoegen') }}</x-primary-button>
                </form>
                <a href="{{ route('projects.index') }}">
                    <x-secondary-button class="">
                        Terug naar overzicht
                    </x-secondary-button>
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="mb-2">
                <form action="{{ route('tags.index') }}" method="GET"
                    class="flex flex-wrap space-y-2 sm:space-y-0 sm:space-x-2">
                    <x-text-input id="search" placeholder="Zoek tags..." class="w-full sm:w-80" type="text"
                        name="search" value="{{ request('search') }}" autofocus />
                    <x-primary-button class=" sm:w-auto sm:ml-2">Zoeken</x-primary-button>
                </form>
            </div>

            @if ($tags->isEmpty())
                <p class="text-gray-700 dark:text-gray-300">Kon geen tags vinden.</p>
            @else
                <ul class="space-y-4">
                    @foreach ($tags as $tag)
                        <li
                            class="flex flex-wrap justify-between items-center p-4 bg-gray-100 dark:bg-gray-600 rounded-lg shadow w-full sm:w-80 sm:min-w-fit">

                            <div class="flex flex-wrap space-x-2">
                                <span class="text-gray-800 dark:text-gray-200 mt-1">{{ $tag->tag }}</span>
                                <a href="{{ route('tags.edit', $tag->id) }}">
                                    <x-primary-button>Wijzigen</x-primary-button>
                                </a>
                                <form action="{{ route('tags.destroy', $tag->id) }}" method="POST"
                                    onsubmit="return confirm('Weet je zeker dat je deze tag wilt verwijderen?');">
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
