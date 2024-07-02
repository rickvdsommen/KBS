<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300 ease-in-out">
            <div class="p-8">
                <div class="md:flex md:flex-row-reverse md:items-start md:justify-between">
                    <div class="mb-6 md:mb-0 md:w-1/2 flex justify-center items-start">
                        @if ($user->profile_picture)
                            <img src="{{ asset('images/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="rounded-3xl h-auto max-h-96 max-w-full">
                        @else
                            <div class="bg-gray-300 rounded-lg h-96 w-96 flex items-center justify-center">
                                <span class="text-gray-500 text-4xl">Geen foto</span>
                            </div>
                        @endif
                    </div>
                    <div class="md:w-1/2 md:ml-6">
                        <h3 class="text-3xl font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ $user->name }} @include('components.status-indicator-extra')</h3>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mb-4"><strong>Email: </strong><a href="mailto:{{ $user->email }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600">{{ $user->email }}</a></p>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mb-4"><strong>Telefoonnummer: </strong><a href="tel:{{ $user->phone }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600">{{ $user->phone }}</a></p>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mb-4"><strong>Geboortedatum:</strong> {{ \Carbon\Carbon::parse($user->birthday)->locale('nl')->translatedFormat('d F Y') }}</p>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mb-4"><strong>Functie:</strong> {{ $user->function }}</p>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mb-4"><strong>Mijn werkplek:</strong> {{ $user->location }}</p>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mb-6"><strong>Bio:</strong> {{ $user->bio }}</p>
                        @if ($user->degrees->count() > 0)
                            <div class="mb-6">
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-1">Opleidingen</h4>
                                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 ml-4">
                                    @foreach ($user->degrees as $degree)
                                        <li class="mb-2"><span class="font-medium dark:text-white">
                                                @if ($degree->graduated)
                                                    {{ $degree->degree }} (Afgestudeerd)
                                                @else
                                                    {{ $degree->degree }} (Lj. {{ $degree->currentYear }} van de {{ $degree->degreeYears }})
                                                @endif
                                            </span>
                                            <span class="text-gray-600 dark:text-gray-400">bij {{ $degree->school }}</span>
                                            <br>
                                            <span class="ml-6 text-sm italic text-gray-700 dark:text-gray-300">{{ $degree->description }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($user->skills->count() > 0)
                            <div class="mb-6">
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-1">Vaardigheden</h4>
                                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 ml-4">
                                    @foreach ($user->skills as $skill)
                                        <li><span class="font-medium dark:text-white">{{ $skill->skillName }}</span>
                                            <span class="text-gray-600 dark:text-gray-400">({{ $skill->skillExperience }} jaar)</span>
                                            <span class="dark:text-white">-</span>
                                            <span class="italic text-gray-700 dark:text-gray-300">{{ $skill->description }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($user->courses->count() > 0)
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-1">Cursussen</h4>
                                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 ml-4">
                                    @foreach ($user->courses as $course)
                                        <li><span class="font-medium dark:text-white">{{ $course->courseName }}</span>
                                            <span class="text-gray-600 dark:text-gray-400">({{ $course->year }})</span>
                                            <span class="dark:text-white">-</span>
                                            <span class="italic text-gray-700 dark:text-gray-300">{{ $course->description }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
