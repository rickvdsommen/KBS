<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">

    <!-- Scripts -->
    <script>
        window.APP_URL = "{{ env('APP_URL') }}";
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-screen-2xl max-h-[90vh] w-full bg-white dark:bg-gray-700 shadow sm:rounded-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 overflow-auto">
                <!-- Left Sidebar (agenda) -->
                <div class="col-span-1 sm:col-span-1 lg:col-span-1 overflow-auto max-h-[90vh]">
                    @include('dashboard.partials.agenda')
                </div>

                <!-- Middle Section (projects) - Larger -->
                <div class="col-span-2 sm:col-span-2 lg:col-span-2 overflow-auto max-h-[90vh]">
                    @include('dashboard.partials.projects')
                </div>

                <!-- Right Sidebar (availability) -->
                <div class="col-span-1 sm:col-span-1 lg:col-span-1 overflow-auto max-h-[90vh]">
                    @include('dashboard.partials.availability')
                </div>
            </div>
        </div>
    </div>
</body>

</html>
