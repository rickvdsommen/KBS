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

@if ($user->profile_picture)
    <img src="{{ asset('images/' . $user->profile_picture) }}" alt="Profile Picture"
        class="w-9 h-9 p-0.5 rounded-full mr-2 ring-2 {{ $ringColor }} object-cover">
@else
    <div
        class="relative p-1 inline-flex items-center justify-center w-9 h-9 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600 mr-2 ring-2 {{ $ringColor }} ">
        <span
            class="font-medium text-gray-600 dark:text-gray-300">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
    </div>
@endif
