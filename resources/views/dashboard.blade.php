<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pb-12 pt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 shadow sm:rounded-lg">
                    {{ __("Je bent ingelogd!") }} <br/><br/>

                    <h1>Welkom bij de K.B.S.</h1>
                    <p>Je kan hier veel bekijken zoals lopende projecten, onze team en je eigen agenda.</p>        
                    @role('admin')
                        <br><p>Je bent ingelogd als een ADMIN!</p>
                    @else
                        <br><p>Je bent ingelogd als een GEBRUIKER!</p>
                    @endrole

                    <br><div class="min-h-screen w-80" id="calendarDash"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
