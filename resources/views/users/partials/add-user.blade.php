<div class="text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6 mb-6">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">
        Nieuwe gebruiker aanmaken
    </h2>
    <div class="flex flex-wrap items-start space-y-5 md:space-y-0 md:space-x-2">

        {{-- Invite function --}}
        <form id="invite-form" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-wrap w-full items-center">
            @csrf
            <x-text-input class="w-full md:w-1/5 mb-2 mx-1" type="text" name="name" id="name"
                placeholder="Naam" required />
            <x-text-input class="w-full md:w-1/5 mb-2 mx-1" type="email" name="email" id="email"
                placeholder="E-mailadres" required />
            <x-text-input class="w-full md:w-1/5 mb-2 mx-1" type="text" name="function" id="function"
                placeholder="Functie" required />
            <x-text-input class="w-full md:w-1/5 mb-2 mx-1" type="password" name="password" id="password"
                placeholder="Wachtwoord" required />

            <div class="w-full flex flex-wrap md:space-x-2">
                <label class="w-full md:w-auto mb-2 mx-1 self-center">Periode van</label>

                @php
                    $currentYear = now()->year;
                    $nextYear = $currentYear + 1;
                @endphp

                <select name="start_month" id="start_month"
                    class="w-full md:w-fit mb-2 mx-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Geen</option>
                    <option value="1">Januari</option>
                    <option value="2" selected>Februari</option>
                    <option value="3">Maart</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Augustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>

                <select name="start_year" id="start_year"
                    class="w-full md:w-fit mb-2 mx-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Geen</option>
                    <option value="{{ $currentYear }}" selected>{{ $currentYear }}</option>
                    <option value="{{ $nextYear }}">{{ $nextYear }}</option>
                </select>

                <label class="w-full md:w-auto mb-2 mx-1 self-center">tot</label>

                <select name="end_month" id="end_month"
                    class="w-full md:w-fit mb-2 mx-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Geen</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maart</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8" selected>Augustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>

                <select name="end_year" id="end_year"
                    class="w-full md:w-fit mb-2 mx-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Geen</option>
                    <option value="{{ $currentYear }}">{{ $currentYear }}</option>
                    <option value="{{ $nextYear }}" selected>{{ $nextYear }}</option>
                </select>
                <x-primary-button class="md:ml-4 mt-2 md:mt-0 h-fit self-center">Aanmaken</x-primary-button>
            </div>

        </form>

        {{-- Success message --}}
        @if (session('status') === 'added')
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                class="text-green-600 text-lg ml-4">
                Gebruiker is aangemaakt!
            </div>
        @endif

        {{-- Error message --}}
        @if (session('status') === 'error')
            <div class="text-red-600 text-lg ml-4">
                {{ session('error') }}
            </div>
        @elseif ($errors->any())
            <div class="text-red-600 text-lg ml-4">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
    </div>
</div>
