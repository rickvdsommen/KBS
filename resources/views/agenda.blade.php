<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agenda') }}
        </h2>
        <script>
            window.isAdmin = @json($isAdmin);
        </script>
    </x-slot>

    <div class="pb-12 pt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 shadow sm:rounded-lg">
                <div class="min-h-screen" id="calendar"></div>
            </div>
        </div>
    </div>
</x-app-layout>