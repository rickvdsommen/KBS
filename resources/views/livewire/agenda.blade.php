<div class="sm:border-r border-gray-300 dark:border-gray-600 sm:py-5 pt-4 px-4 sm:h-full">
    <h2 class="my-2 text-2xl font-semibold">Afspraken voor vandaag:</h2>
    <ul class="divide-y divide-gray-200 dark:divide-gray-600" wire:poll.5s="refreshItems">
        @forelse ($appointments as $appointment)
            <li class="py-3">
                <a href="{{ route('agenda.index', $appointment->id) }}" class="block text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600 font-semibold">
                    {{ $appointment->title }}
                </a>
                @if ($appointment->description)
                    <p class="mt-1 text-sm text-gray-500">{{ $appointment->description }}</p>
                @endif
                <div class="text-gray-700 dark:text-gray-300 mt-1">
                    @if (!$appointment->all_day)
                        <span class="font-medium">{{ \Carbon\Carbon::parse($appointment->start)->format('H:i') }} - {{ \Carbon\Carbon::parse($appointment->end)->format('H:i') }}</span>
                    @else
                        <span class="font-medium">Hele dag</span>
                    @endif
                </div>
            </li>
        @empty
            <li class="py-4 font-normal text-base">Er zijn geen afspraken voor vandaag.</li>
        @endforelse
    </ul>
</div>
