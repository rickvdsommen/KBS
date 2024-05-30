<section>
        <div class="p-6 bg-white dark:bg-gray-700 shadow-md rounded-lg border">
            <div class="mb-4">
                <x-input-label for="skills" :value="__('Vaardigheden')" class="text-lg font-semibold" />
            </div>

            <form action="{{ route('skill.store')}}" method="post">
                @csrf
                <div class="space-y-4 mb-6">
                    <x-text-input name="skill" id="skill" type="text" placeholder="Vaardigheid" class="w-full" required/>
                    <input name="experience" id="experience" type="number" placeholder="Aantal jaren ervaring" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                    <x-text-input name="description" id="description" type="text" placeholder="Omschrijving" class="w-full"/>
                    <x-primary-button type="submit">Voeg toe</x-primary-button>
                </div>
            </form>

            <ul class="space-y-2">
                @foreach ($skills as $skill)
                    <li class="flex justify-between items-center p-4 bg-gray-100 dark:bg-gray-800 rounded-md shadow-sm">
                        <div>
                            <span class="font-medium dark:text-white">{{ $skill->skillName }}</span> 
                            <span class="text-gray-600 dark:text-gray-400">({{ $skill->skillExperience }} jaar)</span>
                            <span class="dark:text-white">-</span> 
                            <span class="italic text-gray-700 dark:text-gray-300">{{ $skill->description }}</span>
                        </div>
                        <div>
                            <form action="{{ route('skill.destroy', $skill->id) }}" method="post" onsubmit="return confirm('Weet je zeker dat je deze vaardigheid wilt verwijderen?');">
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