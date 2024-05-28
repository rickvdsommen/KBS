<section>
    <div class="p-6 bg-white shadow-md rounded-lg">
        <div class="mb-4">
            <x-input-label for="degree" :value="__('Opleidingen')" class="text-lg font-semibold" />
        </div>
        
        <form id="degree-form" method="POST">
            <div class="space-y-4 mb-6">
                <input name="degree" id="degree" type="text" placeholder="Opleiding Naam" class="w-full p-2 border border-gray-300 rounded-md">
                <input name="school" id="school" type="text" placeholder="School" class="w-full p-2 border border-gray-300 rounded-md">
                <input name="degreeYears" id="degreeYears" type="number" placeholder="Lengte opleiding in jaren" class="w-full p-2 border border-gray-300 rounded-md">
                <input name="currentYear" id="currentYear" type="number" placeholder="Huidig schooljaar" class="w-full p-2 border border-gray-300 rounded-md">
                <input name="description" id="description" type="text" placeholder="Omschrijving" class="w-full p-2 border border-gray-300 rounded-md">
                <x-secondary-button>Voeg toe</x-secondary-button>
            </div>
        </form>
        

        <ul class="space-y-2">
            @foreach ($degrees as $degree)
                <li class="p-4 bg-gray-100 rounded-md shadow-sm">
                    <span class="font-medium">{{ $degree->degree }}(Lj. {{ $degree->currentYear }} van de {{ $degree->degreeYears }})</span>
                    <span class="text-gray-600">bij {{ $degree->school }}</span> - 
                    <span class="italic text-gray-700">{{ $degree->description }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</section>