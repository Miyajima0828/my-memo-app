<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> <!-- Scripts
        -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    {{-- font awesome --}}
    <script src="https://kit.fontawesome.com/84fcae9cc5.js" crossorigin="anonymous"></script>
</head>

<body class="font-sans antialiased ">
    <div class="flex items-center h-16 mr-16">
        <div class="basis-1/5">
            @livewire('navigation-menu')
        </div>
        @if (isset($header))
        <header class="bg-white text-right basis-4/5">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif
    </div>

    <!-- Page Heading -->

    <!-- Page Content -->
    <main>
      {{$slot}}
    </main>
    </div>
    @stack('modals')
    @livewireScripts
</body>

</html>
