<div class="border-l border-gray-300 dark:border-gray-600 py-5 px-4 sm:h-full">
    <h2 class="my-2 text-2xl font-semibold text-center">Wie is er vandaag aanwezig?</h2>
    <div class="grid grid-cols-2 gap-4 mt-4" wire:poll.5s="refreshItems">
        @forelse ($users as $user)
            <div class="flex flex-col items-center border border-gray-300 dark:border-gray-600 rounded-lg py-3 shadow-lg hover:shadow-xl">
                <a href="{{ route('team.show', $user->id) }}" class="block text-center w-full">
                    <div class="mb-2 flex justify-center items-center w-full">
                        @include('components.profile_picture_middle', ['user' => $user])
                    </div>
                    <span class="text-lg font-semibold text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600 block text-center">{{ $user->name }}</span>
                </a>
            </div>
        @empty
            <div class="py-2 font-normal text-base text-center col-span-2">Niemand :(</div>
        @endforelse
    </div>
</div>