<section>
        <div class="p-6 bg-white shadow-md rounded-lg">
            <div class="mb-4">
                <x-input-label for="skills" :value="__('Vaardigheden')" class="text-lg font-semibold" />
            </div>

            <form action="" method="post">
                <div class="space-y-4 mb-6">
                    <input name="skill" id="skill" type="text" placeholder="Vaardigheid" class="w-full p-2 border border-gray-300 rounded-md">
                    <input name="experience" id="experience" type="number" placeholder="Ervaring" class="w-full p-2 border border-gray-300 rounded-md">
                    <input name="description" id="description" type="text" placeholder="Omschrijving" class="w-full p-2 border border-gray-300 rounded-md">
                    <x-secondary-button >Voeg toe</x-secondary-button>
                </div>
            </form>

            <ul class="space-y-2">
                @foreach ($skills as $skill)
                    <li class="p-4 bg-gray-100 rounded-md shadow-sm">
                        <span class="font-medium">{{ $skill->skillName }}</span> 
                        <span class="text-gray-600">({{ $skill->skillExperience }} jaar)</span> - 
                        <span class="italic text-gray-700">{{ $skill->description }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
</section>