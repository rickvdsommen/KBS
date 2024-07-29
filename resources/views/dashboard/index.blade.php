<x-app-layout>

    <!-- Page Content -->
    <div class="mt-8 max-w-7xl mx-auto bg-white dark:bg-gray-700 shadow sm:rounded-lg">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Left Sidebar (agenda) -->
            <div class="col-span-1 sm:col-span-1 lg:col-span-1">
                @livewire('agenda')
            </div>

            <!-- Middle Section (projects) - Larger -->
            <div class="col-span-2 sm:col-span-2 lg:col-span-2">
                @livewire('projects')
            </div>

            <!-- Right Sidebar (availability) -->
            <div class="col-span-1 sm:col-span-1 lg:col-span-1">
                @livewire('availability')
            </div>
        </div>
    </div>
</x-app-layout>
