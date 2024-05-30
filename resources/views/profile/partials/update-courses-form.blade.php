<section>
    <div class="p-6 bg-white dark:bg-gray-700 shadow-md rounded-lg border">
        <div class="mb-4">
            <x-input-label for="course" :value="__('Cursussen')" class="text-lg font-semibold" />
        </div>

        <form id="courses-form" action="{{ route('course.store') }}" method="POST">
            @csrf
            <div class="space-y-4 mb-6">
                <x-text-input name="name" id="name" type="text" placeholder="Titel cursus" class="w-full" required/>
                <input name="year" id="year" type="number" placeholder="Jaar behaald" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" min="1900" max="2100" step="1" required>
                <x-text-input name="description" id="description" type="text" placeholder="Omschrijving" class="w-full" required/>
                <x-primary-button type="submit">Voeg toe</x-primary-button>
            </div>
        </form>

        <ul class="space-y-2">
            @foreach ($courses as $course)
                <li class="flex justify-between items-center p-4 bg-gray-100 dark:bg-gray-800 rounded-md shadow-sm">
                    <div>
                        <span class="font-medium dark:text-white">{{ $course->courseName }}</span>
                        <span class="text-gray-600 dark:text-gray-400">({{ $course->year }})</span>
                        <span class="dark:text-white">-</span> 
                        <span class="italic text-gray-700 dark:text-gray-300">{{ $course->description }}</span>
                    </div>
                    <div>
                        <form action="{{ route('course.destroy', $course->id) }}" method="post" onsubmit="return confirm('Weet je zeker dat je deze cursus wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</section>
