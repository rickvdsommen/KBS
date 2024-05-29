<section>
    <div class="p-6 bg-white shadow-md rounded-lg">
        <div class="mb-4">
            <x-input-label for="degree" :value="__('Opleidingen')" class="text-lg font-semibold" />
        </div>
        
        <form id="degree-form" action="{{ route('degree.store') }}" method="POST">
            @csrf
            <div class="space-y-4 mb-6">
                <input name="degree" id="degree" type="text" placeholder="Opleiding Naam" class="w-full p-2 border border-gray-300 rounded-md" required>
                <input name="school" id="school" type="text" placeholder="School" class="w-full p-2 border border-gray-300 rounded-md" required>
                <input name="degreeYears" id="degreeYears" type="number" placeholder="Lengte opleiding in jaren" class="w-full p-2 border border-gray-300 rounded-md" required>
                <input name="currentYear" id="currentYear" type="number" placeholder="Huidig schooljaar" class="w-full p-2 border border-gray-300 rounded-md" required>
                <input name="description" id="description" type="text" placeholder="Omschrijving" class="w-full p-2 border border-gray-300 rounded-md">
                <x-secondary-button type="submit">Voeg toe</x-secondary-button>
            </div>
        </form>
        
        <ul class="space-y-2">
            @foreach ($degrees as $degree)
                <li class="flex justify-between items-center p-4 bg-gray-100 rounded-md shadow-sm">
                    <div>
                        <span class="font-medium">{{ $degree->degree }} (Lj. {{ $degree->currentYear }} van de {{ $degree->degreeYears }})</span>
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