@php
    // Determine the ring color based on the user's status
    $ringColor = 'ring-gray-500'; // Default ring color
    if ($user->deactivated) {
        $ringColor = 'ring-gray-500';
    } elseif ($user->availability && $user->availability->status == 'aanwezig' && $user->availability->updated_at->isToday()) {
        $ringColor = 'ring-green-500';
    } elseif ($user->availability && $user->availability->status == 'bezet' && $user->availability->updated_at->isToday()) {
        $ringColor = 'ring-red-500';
    }
@endphp

<div class="flex justify-center items-center w-full">
    @if ($user->profile_picture)
        <img src="{{ asset('images/' . $user->profile_picture) }}" alt="Profile Picture"
            class="w-20 h-20 p-0.5 rounded-full ring-2 {{ $ringColor }} object-cover">
    @else
        <div class="relative flex justify-center items-center w-20 h-20 bg-gray-100 rounded-full dark:bg-gray-600 ring-2 {{ $ringColor }}">
            <span class="font-medium text-2xl text-gray-600 dark:text-gray-300">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
        </div>
    @endif
</div>
