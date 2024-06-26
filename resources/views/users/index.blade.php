<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gebruikerbeheer') }}
        </h2>
    </x-slot>

    <div class="pb-10 pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('users.components.add-user')

            @include('users.components.user-list')
        </div>
    </div>
</x-app-layout>