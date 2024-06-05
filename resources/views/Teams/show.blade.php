<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg overflow-hidden shadow-md">
            <div class="p-6">
                <h3 class="text-lg font-semibold">{{ $user->name }}</h3>
                <p class="text-gray-600 mb-4"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="text-gray-600 mb-4"><strong>Functie:</strong> {{ $user->function }}</p>
                <p class="text-gray-600 mb-4"><strong>Bio:</strong> {{ $user->bio }}</p>
                <div>
                    <h4 class="text-sm font-semibold mb-2">Opleidingen</h4>
                    <ul class="list-disc list-inside text-gray-600">
                        @foreach ($user->degrees as $degree)
                            <li>{{ $degree->degree }} - {{ $degree->school }}</li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold mb-2">Vaardigheden</h4>
                    <ul class="list-disc list-inside text-gray-600">
                        @foreach ($user->skills as $skill)
                            <li>{{ $skill->skillName }} ({{ $skill->skillExperience }} years)</li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold mb-2">Cursussen</h4>
                    <ul class="list-disc list-inside text-gray-600">
                        @foreach ($user->courses as $course)
                            <li>{{ $course->courseName }} ({{ $course->year }})</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
