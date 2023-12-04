<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
     </head>
     <body class="font-sans antialiased">
        <!-- <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            <!-- @if (isset($header)) -->
                <!-- <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header> -->
            <!-- @endif -->

            <!-- Page Content -->

        <!-- @stack('modals') -->

        @livewireScripts
        <div class="tabs">
        <input id="all" type="radio" name="tab_item" checked>
        <label class="tab_item" for="all">総合</label>
        <input id="programming" type="radio" name="tab_item">
        <label class="tab_item" for="programming">プログラミング</label>
        <input id="design" type="radio" name="tab_item">
        <label class="tab_item" for="design">デザイン</label>
        <input id="test" type="radio" name="tab_item">
        <label class="tab_item" for="test">テスト</label>
        <input id="document" type="radio" name="tab_item">
        <label class="tab_item" for="document">書類</label>
        <div class="tab_content" id="all_content">
            <div class="tab_content_description">
            <p class="c-txtsp">総合の内容がここに入ります</p>
            <p>@php echo $mainData; @endphp</p>
            </div>
        </div>
        <div class="tab_content" id="programming_content">
            <div class="tab_content_description">
            <p class="c-txtsp">プログラミングの内容がここに入ります</p>
            </div>
        </div>
        <div class="tab_content" id="design_content">
            <div class="tab_content_description">
            <p class="c-txtsp">デザインの内容がここに入ります</p>
            </div>
        </div>
        <div class="tab_content" id="test_content">
            <div class="tab_content_description">
            <p class="c-txtsp">テストの内容がここに入ります</p>
            </div>
        </div>
        <div class="tab_content" id="document_content">
            <div class="tab_content_description">
            <p class="c-txtsp">書類の内容がここに入ります</p>
            </div>
        </div>
        </div>
    </body>
</html>
