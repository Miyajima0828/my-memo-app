<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head> 
    <meta charset="utf-8"> <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> <!-- Scripts
        -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    </head>

    <body class="font-sans antialiased "> 
        <!-- 画面上部分 -->
        <div class="flex items-center h-16 mr-16">
            <div class="basis-1/5">
                @livewire('navigation-menu')
            </div>
            <div class="text-right basis-4/5">
                <form action="#" method="get">
                    <input class="w-2/5 h-8 text-center" type="text" name="search" placeholder="検索">
                </form>
            </div>
        </div>

        <!-- 画面下部分 -->
        <div class="flex ">

            <div class="category">
            </div>
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
        
        </div>
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        </div>
        @stack('modals')
        @livewireScripts
    </body>

    </html>