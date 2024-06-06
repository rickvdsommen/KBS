@if($user->device && $user->device->status == 'aanwezig')
    <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
        <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
        Beschikbaar
    </span>
@else
    @if($user->device && $user->device->status == 'bezet')
        <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
            <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
            Bezet
        </span>
    @else
        <span class="inline-flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-gray-800 dark:text-gray-300">
            <span class="w-2 h-2 me-1 bg-gray-500 rounded-full"></span>
            Afwezig
        </span>
    @endif
@endif