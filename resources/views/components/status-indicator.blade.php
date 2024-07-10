@if($user->availability && $user->availability->status == 'aanwezig' && $user->availability->updated_at->isToday())
    <span class="inline-flex items-center h-5">
        <span class="w-2 h-2 mr-1 bg-green-500 rounded-full"></span>
    </span>
@else
    @if($user->availability && $user->availability->status == 'bezet' && $user->availability->updated_at->isToday())
        <span class="inline-flex items-center h-5">
            <span class="w-2 h-2 mr-1 bg-red-500 rounded-full"></span>
        </span>
    @else
        <span class="inline-flex items-center h-5">
            <span class="w-2 h-2 mr-1 bg-gray-500 rounded-full"></span>
        </span>
    @endif
@endif