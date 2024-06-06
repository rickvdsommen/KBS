@if($user->device && $user->device->status == 'aanwezig' && $user->device->updated_at->isToday())
    <span class="inline-flex items-center">
        <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
    </span>
@else
    @if($user->device && $user->device->status == 'bezet' && $user->device->updated_at->isToday())
        <span class="inline-flex items-center">
            <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
        </span>
    @else
        <span class="inline-flex items-center">
            <span class="w-2 h-2 me-1 bg-gray-500 rounded-full"></span>
        </span>
    @endif
@endif