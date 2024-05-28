<section>
    <div class="p-6 bg-white shadow-md rounded-lg">
        <div class="mb-4">
            <x-input-label for="course" :value="__('Cursussen')" class="text-lg font-semibold" />
        </div>

        <form id="courses-form" method="POST">
            <div class="space-y-4 mb-6">
                <input name="name" id="name" type="text" placeholder="Cursus naam" class="w-full p-2 border border-gray-300 rounded-md">
                <input name="description" id="description" type="text" placeholder="Omschrijving" class="w-full p-2 border border-gray-300 rounded-md">
                <x-secondary-button >Voeg toe</x-secondary-button>
            </div>
        </form>

        <ul class="space-y-2">
            @foreach ($courses as $course)
                <li class="p-4 bg-gray-100 rounded-md shadow-sm">
                    <span class="font-medium">{{ $course->courseName }}</span> - 
                    <span class="italic text-gray-700">{{ $course->description }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</section>