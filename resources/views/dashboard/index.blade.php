<x-app-layout>
    <x-slot name="header" class="bg-gray-400">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Page Content -->
    <div class="mt-6 mb-10 max-w-7xl mx-auto bg-white dark:bg-gray-700 shadow sm:rounded-lg">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Left Sidebar (agenda) -->
            <div class="col-span-1 sm:col-span-1 lg:col-span-1">
                @include('dashboard.partials.agenda')
            </div>

            <!-- Middle Section (projects) - Larger -->
            <div class="col-span-2 sm:col-span-2 lg:col-span-2">
                @include('dashboard.partials.projects')
            </div>

            <!-- Right Sidebar (availability) -->
            <div class="col-span-1 sm:col-span-1 lg:col-span-1">
                @include('dashboard.partials.availability')
            </div>
        </div>
    </div>
</x-app-layout>
