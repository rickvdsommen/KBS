<form method="POST" action="{{ route('availability.update') }}" class="rounded-lg border border-gray-200 mx-2 w-fit" id="availabilityForm">
    @csrf
    <div class="flex flex-col sm:flex-row">
        <label for="available" class="cursor-pointer flex-1">
            <input type="radio" name="availability" id="available" class="peer sr-only" value="aanwezig" {{ Auth::user()->device->status === 'aanwezig' ? 'checked' : '' }} />
            <span class="relative inline-flex h-9 items-center space-x-2 py-2 pl-7 pr-3 text-sm peer-checked:bg-green-200 rounded-md">
                <span class="before:absolute before:left-3 before:top-[14px] before:h-2 before:w-2 before:rounded-full before:bg-green-500">Aanwezig</span>
            </span>
        </label>
        <label for="busy" class="cursor-pointer flex-1">
            <input type="radio" name="availability" id="busy" class="peer sr-only" value="bezet" {{ Auth::user()->device->status === 'bezet' ? 'checked' : '' }} />
            <span class="relative inline-flex h-9 items-center space-x-2 py-2 pl-7 pr-3 text-sm peer-checked:bg-red-200 rounded-lg">
                <span class="before:absolute before:left-3 before:top-[14px] before:h-2 before:w-2 before:rounded-full before:bg-red-500">Bezet</span>
            </span>
        </label>
        <label for="away" class="cursor-pointer flex-1">
            <input type="radio" name="availability" id="away" class="peer sr-only" value="afwezig" {{ Auth::user()->device->status === 'afwezig' ? 'checked' : '' }} />
            <span class="relative inline-flex h-9 items-center space-x-2 py-2 pl-7 pr-3 text-sm peer-checked:bg-gray-200 rounded-lg">
                <span class="before:absolute before:left-3 before:top-[14px] before:h-2 before:w-2 before:rounded-full before:bg-gray-500">Afwezig</span>
            </span>
        </label>
    </div>
</form>