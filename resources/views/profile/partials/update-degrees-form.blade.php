<section>
    <div class="p-6 bg-white dark:bg-gray-700 shadow-md rounded-lg border">
        <div class="mb-4">
            <x-input-label for="degree" :value="__('Opleidingen')" class="text-lg font-semibold" />
        </div>
        
        <form id="degree-form" action="{{ route('degree.store') }}" method="POST">
            @csrf
            <div class="space-y-4 mb-6">
                <input name="degree" id="degree" type="text" placeholder="Opleiding Naam" class="w-full p-2 border border-gray-300 rounded-md" required>
                <input name="school" id="school" type="text" placeholder="School" class="w-full p-2 border border-gray-300 rounded-md" required>
                <input name="degreeYears" id="degreeYears" type="number" placeholder="Lengte opleiding in jaren" class="w-full p-2 border border-gray-300 rounded-md" required>
                <div class="flex items-center">
                    <input type="checkbox" name="graduated" id="graduated" class="mr-2 block rounded-md border-gray-300 dark:border-gray-700 shadow-sm">
                    <label for="graduated" class="text-gray-700">Afgestudeerd?</label>
                </div>
                <input name="currentYear" id="currentYear" type="number" placeholder="Huidig schooljaar" class="w-full p-2 border border-gray-300 rounded-md disabled:bg-gray-200 disabled:text-gray-500" required>
                <input name="description" id="description" type="text" placeholder="Omschrijving" class="w-full p-2 border border-gray-300 rounded-md">
                <x-secondary-button type="submit">Voeg toe</x-secondary-button>
            </div>
        </form>
        
        <ul class="space-y-2">
            @foreach ($degrees as $degree)
                <li class="flex justify-between items-center p-4 bg-gray-100 rounded-md shadow-sm">
                    <div>
                        <span class="font-medium">
                            @if ($degree->graduated)
                                {{ $degree->degree }} (Afgestudeerd)
                            @else
                                {{ $degree->degree }} (Lj. {{ $degree->currentYear }} van de {{ $degree->degreeYears }})
                            @endif
                        </span>
                        <span class="text-gray-600">bij {{ $degree->school }}</span> - 
                        <span class="italic text-gray-700">{{ $degree->description }}</span>
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