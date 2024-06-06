<section>
    <div class="p-6 bg-white dark:bg-gray-700 shadow-md rounded-lg border">
        <div class="mb-4">
            <x-input-label for="degree" :value="__('Opleidingen')" class="text-lg font-semibold" />
        </div>
        
        <form id="degree-form" action="{{ route('degree.store') }}" method="POST">
            @csrf
            <div class="space-y-4 mb-6">
                <x-text-input name="degree" id="degree" type="text" placeholder="Naam opleiding/ richting" class="w-full" required/>
                <x-text-input name="school" id="school" type="text" placeholder="Naam school" class="w-full" required/>
                <input name="degreeYears" id="degreeYears" type="number" placeholder="Hoeveel jaar duurt de opleiding?" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                <div class="flex items-center">
                    <input type="checkbox" name="graduated" id="graduated" class="mr-2 block rounded-md border-gray-300 dark:border-gray-700 shadow-sm">
                    <label for="graduated" class="text-gray-700 dark:text-gray-300">Afgestudeerd?</label>
                </div>
                <input name="currentYear" id="currentYear" type="number" placeholder="Huidig schooljaar" class="w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 disabled:bg-gray-200 disabled:text-gray-500 dark:disabled:bg-gray-800 dark:disabled:text-gray-500 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                <x-text-input name="description" id="description" type="text" placeholder="Omschrijving" class="w-full"/>
                <x-primary-button type="submit">Voeg toe</x-primary-button>
            </div>
        </form>
        
        <ul class="space-y-2">
            @foreach ($degrees as $degree)
                <li class="flex justify-between items-center p-4 bg-gray-100 dark:bg-gray-800 rounded-md shadow-sm">
                    <div>
                        <span class="font-medium dark:text-white">
                            @if ($degree->graduated)
                                {{ $degree->degree }} (Afgestudeerd)
                            @else
                                {{ $degree->degree }} (Lj. {{ $degree->currentYear }} van de {{ $degree->degreeYears }})
                            @endif
                        </span>
                        <span class="text-gray-600 dark:text-gray-400">bij {{ $degree->school }}</span>
                        <span class="dark:text-white">-</span> 
                        <span class="italic text-gray-700 dark:text-gray-300">{{ $degree->description }}</span>
                    </div>
                    <div>
                        <form action="{{ route('degree.destroy', $degree->id) }}" method="post" onsubmit="return confirm('Weet je zeker dat je deze opleiding wilt verwijderen?');">
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const graduatedCheckbox = document.getElementById('graduated');
        const currentYearInput = document.getElementById('currentYear');

        graduatedCheckbox.addEventListener('change', function () {
            if (graduatedCheckbox.checked) {
                currentYearInput.value = '';
                currentYearInput.disabled = true;
            } else {
                currentYearInput.disabled = false;
            }
        });
    });
</script>