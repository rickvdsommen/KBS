<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Overzicht medewerkers') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
        <!-- Search bar -->
        <form method="GET" action="{{ route('team.index') }}">
            <x-text-input class="w-80 ml-2" type="text" name="search" placeholder="Zoek een persoon..."/>
            <x-primary-button class="ml-2 mt-2" type="submit">Zoek</x-primary-button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-5">
            @foreach ($users as $user)
                <a href="{{ route('team.show', $user) }}" class="transform transition-transform hover:scale-105 flex">
                    <div class="flex-1 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden shadow-lg hover:shadow-xl cursor-pointer flex flex-col items-center">
                        {{-- @if ($user->profile_picture)
                            <img src="{{ asset('images/' . $user->profile_picture) }}" alt="PF" class="w-full h-48 object-contain">
                        @else
                            <div class="w-full h-48 bg-gray-300"></div>
                        @endif --}}
                        <div class="mt-6 ml-4">
                        @include('components.profile_picture_big')
                        </div>
                        <h3 class="text-3xl font-semibold text-gray-700 dark:text-gray-300 mt-2">{{ $user->name }} </h3>
                        <div class="px-6 pb-6 flex-1 flex flex-col w-full">
                            
                            
                            <p class="text-gray-700 dark:text-gray-300 mt-2"><strong>Functie:</strong> {{ $user->function }}</p>
                            @if ($user->degrees->count() > 0)
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold mt-2 text-gray-700 dark:text-gray-300">Opleiding</h4>
                                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                                    @foreach ($user->degrees->slice(0,2) as $degree)
                                        <li>{{ $degree->degree }}<span class="text-sm text-gray-600 dark:text-gray-400"> - {{ $degree->school }}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if ($user->skills->count() > 0)
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold mt-2 text-gray-700 dark:text-gray-300">Vaardigheden</h4>
                                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                                    @foreach ($user->skills->slice(0,2) as $skill)
                                        <li>{{ $skill->skillName }} ({{ $skill->skillExperience }} jaar)</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if ($user->courses->count() > 0)
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold mt-2 text-gray-700 dark:text-gray-300">Cursussen</h4>
                                <ul class="mb-2 list-disc list-inside text-gray-700 dark:text-gray-300">
                                    @foreach ($user->courses->slice(0,2) as $course)
                                        <li>{{ $course->courseName }} ({{ $course->year }})</li>
                                    @endforeach
                                </ul>
                                @if ($user->courses->count() > 2 || $user->degrees->count() > 2 || $user->skills->count() > 2)
                                    <span class="mt-2 font-extrabold text-gray-700 dark:text-gray-300">En nog veel meer...</span>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="py-5">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
