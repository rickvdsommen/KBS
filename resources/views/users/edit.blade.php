<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gebruikerbeheer') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6">
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="my-3">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Voor- & Achternaam</label>
                    <input type="text" name="name" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $user->name }}" required>
                </div>
                <div class="my-3">
                    <label for="birthday" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Geboortedatum</label>
                    <input type="date" name="birthday" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $user->birthday }}" required>
                </div>
                <div class="my-3">
                    <label for="function" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Functie</label>
                    <input type="text" name="function" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $user->function }}" required>
                </div>
                <div class="my-3">
                    <label for="admin" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Admin</label>
                    <input type="checkbox" name="admin" class="mt-1 block rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" @if($admin) checked @endif>
                </div>
                <x-primary-button class="my-3">Opslaan</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>