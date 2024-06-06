@if($user->device && $user->device->status == 'aanwezig')
    <span class="inline-flex items-center">
        <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
    </span>
@else
    @if($user->device && $user->device->status == 'bezet')
        <span class="inline-flex items-center">
            <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
        </span>
    @else
        <span class="inline-flex items-center">
            <span class="w-2 h-2 me-1 bg-gray-500 rounded-full"></span>
        </span>
    @endif
@endif