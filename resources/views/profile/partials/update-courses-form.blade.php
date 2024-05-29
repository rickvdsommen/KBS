<section>
    <div class="p-6 bg-white shadow-md rounded-lg">
        <div class="mb-4">
            <x-input-label for="course" :value="__('Cursussen')" class="text-lg font-semibold" />
        </div>

        <form id="courses-form" action="{{ route('course.store') }}" method="POST">
            @csrf
            <div class="space-y-4 mb-6">
                <input name="name" id="name" type="text" placeholder="Cursus naam" class="w-full p-2 border border-gray-300 rounded-md" required>
                <input name="year" id="year" type="number" placeholder="Jaar behaald" class="w-full p-2 border border-gray-300 rounded-md" min="1900" max="2100" step="1" required>
                <input name="description" id="description" type="text" placeholder="Omschrijving" class="w-full p-2 border border-gray-300 rounded-md" required>
                <x-secondary-button type="submit">Voeg toe</x-secondary-button>
            </div>
        </form>

        <ul class="space-y-2">
            @foreach ($courses as $course)
                <li class="flex justify-between items-center p-4 bg-gray-100 rounded-md shadow-sm">
                    <div>
                        <span class="font-medium">{{ $course->courseName }}</span>
                        <span class="text-gray-600">({{ $course->year }})</span> -  
                        <span class="italic text-gray-700">{{ $course->description }}</span>
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
