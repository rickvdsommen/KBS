<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gebruikerbeheer') }}
        </h2>
        @php
            $currentYear = now()->year;
            $nextYear = $currentYear + 1;
            $startDate = null;
            $endDate = null;
            if($user->start_date){
                $startDate = \Carbon\Carbon::parse($user->start_date);
            } 
            if($user->end_date){
                $endDate = \Carbon\Carbon::parse($user->end_date);
            }
            
        @endphp
    </x-slot>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6">
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="my-3">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Voor- &
                        Achternaam</label>
                    <x-text-input type="text" name="name" class="mt-1 block w-80 sm:text-sm"
                        value="{{ $user->name }}" required />
                </div>
                <div class="my-3">
                    <label for="function"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Functie</label>
                    <x-text-input type="text" name="function" class="mt-1 block w-80 sm:text-sm"
                        value="{{ $user->function }}" required />
                </div>
                <div class="my-3">
                    <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Start
                        datum:</label>
                    <div class="flex items-center">
                        <select name="start_month" id="start_month"
                            class="w-full md:w-fit mb-2 mx-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="" @if (!$startDate) selected @endif>Geen</option>
                            <option value="1" @if ($startDate && $startDate->format('n') == 1) selected @endif>Januari</option>
                            <option value="2" @if ($startDate && $startDate->format('n') == 2) selected @endif>Februari</option>
                            <option value="3" @if ($startDate && $startDate->format('n') == 3) selected @endif>Maart</option>
                            <option value="4" @if ($startDate && $startDate->format('n') == 4) selected @endif>April</option>
                            <option value="5" @if ($startDate && $startDate->format('n') == 5) selected @endif>Mei</option>
                            <option value="6" @if ($startDate && $startDate->format('n') == 6) selected @endif>Juni</option>
                            <option value="7" @if ($startDate && $startDate->format('n') == 7) selected @endif>Juli</option>
                            <option value="8" @if ($startDate && $startDate->format('n') == 8) selected @endif>Augustus</option>
                            <option value="9" @if ($startDate && $startDate->format('n') == 9) selected @endif>September</option>
                            <option value="10" @if ($startDate && $startDate->format('n') == 10) selected @endif>Oktober</option>
                            <option value="11" @if ($startDate && $startDate->format('n') == 11) selected @endif>November</option>
                            <option value="12" @if ($startDate && $startDate->format('n') == 12) selected @endif>December</option>
                        </select>



                        <select name="start_year" id="start_year"
                            class="w-full md:w-fit mb-2 mx-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="" @if (!$startDate) selected @endif>Geen</option>
                            <option value="{{ $currentYear }}" @if ($startDate && $startDate->format('Y') == $currentYear) selected @endif>
                                {{ $currentYear }}</option>
                            <option value="{{ $nextYear }}" @if ($startDate && $startDate->format('Y') == $nextYear) selected @endif>
                                {{ $nextYear }}</option>
                        </select>
                    </div>
                </div>
                <div class="my-3">
                    <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Eind
                        datum:</label>
                    <div class="flex items-center">
                        <select name="end_month" id="end_month"
                        class="w-full md:w-fit mb-2 mx-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="" @if (!$endDate) selected @endif>Geen</option>
                            <option value="1" @if ($endDate && $endDate->format('n') == 1) selected @endif>Januari</option>
                            <option value="2" @if ($endDate && $endDate->format('n') == 2) selected @endif>Februari</option>
                            <option value="3" @if ($endDate && $endDate->format('n') == 3) selected @endif>Maart</option>
                            <option value="4" @if ($endDate && $endDate->format('n') == 4) selected @endif>April</option>
                            <option value="5" @if ($endDate && $endDate->format('n') == 5) selected @endif>Mei</option>
                            <option value="6" @if ($endDate && $endDate->format('n') == 6) selected @endif>Juni</option>
                            <option value="7" @if ($endDate && $endDate->format('n') == 7) selected @endif>Juli</option>
                            <option value="8" @if ($endDate && $endDate->format('n') == 8) selected @endif>Augustus</option>
                            <option value="9" @if ($endDate && $endDate->format('n') == 9) selected @endif>September</option>
                            <option value="10" @if ($endDate && $endDate->format('n') == 10) selected @endif>Oktober</option>
                            <option value="11" @if ($endDate && $endDate->format('n') == 11) selected @endif>November</option>
                            <option value="12" @if ($endDate && $endDate->format('n') == 12) selected @endif>December</option>
                        </select>


                        <select name="end_year" id="end_year"
                            class="w-full md:w-fit mb-2 mx-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="" @if (!$endDate) selected @endif>Geen</option>
                            <option value="{{ $currentYear }}" @if ($endDate && $endDate->format('Y') == $currentYear) selected @endif>
                                {{ $currentYear }}</option>
                            <option value="{{ $nextYear }}" @if ($endDate && $endDate->format('Y') == $nextYear) selected @endif>
                                {{ $nextYear }}</option>
                        </select>
                    </div>
                </div>
                <div class="my-3">
                    <label for="admin"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Admin</label>
                    <input type="checkbox" name="admin"
                        class="mt-1 block rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        @if ($user->admin) checked @endif>
                </div>
                <div class="my-3">
                    <label for="deactivated"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Deactiveren</label>
                    <input type="checkbox" name="deactivated"
                        class="mt-1 block rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        @if ($user->deactivated) checked @endif>
                </div>
                <x-primary-button class="my-3">Opslaan</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
