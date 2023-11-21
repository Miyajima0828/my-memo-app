<x-app-layout>
    <!-- 画面上部分 -->
    <x-slot name="header">
        <x-search></x-search>
    </x-slot>

    <!-- 画面下部分 -->
    <div class="flex ">

        <div id="categories">
            <div id="whenLogin">
                @php
                $userMainCount = count($userMain)
                @endphp

                <!-- もしユーザーがDBにmain_idをcount=5持っていたら -->
                @if ($userMainCount == 5)
                @foreach ($mainIdArray as $mainId)
                @php
                $userSubCount = count($userSub[$mainId])
                @endphp
                <!-- 各mainカテゴリーに該当するsubカテゴリーが5個未満なら、 -->
                @if ($userSubCount < 5) <!-- 各mainカテゴリーの右端に＋マーク表示しmainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
                    <h2>{{ $userMain[array_search($mainId, $mainIdArray)] }}<span><a href="#">＋</a></span></h2>
                    @foreach ($userSub[$mainId] as $subItemArray)
                    <a href="#">
                        <p>{{$subItemArray['sub']}}</p>
                    </a>
                    @endforeach
                    <!-- 各mainカテゴリーに該当するsubカテゴリーが5個なら、 -->
                    @else
                    <!-- 各mainカテゴリーを表示し、mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
                    <h2>{{ $userMain[array_search($mainId, $mainIdArray)] }}</h2>
                    @foreach ($userSub[$mainId] as $subItemArray)
                    <a href="#">
                        <p>{{$subItemArray['sub']}}</p>
                    </a>
                    @endforeach
                    @endif
                    @endforeach

                    <!-- もしユーザーがmain_idをcount=1～4持っていたら -->
                    @elseif ($userMainCount >= 1 && 4 >= $userMainCount)
                    <!-- <p>メインカテゴリー<span><a href="#" onclick="showInput()">＋</a></span></p> -->
                    @livewire('main-category')
                    @foreach ($mainIdArray as $mainId)
                    @php
                    $userSubCount = count($userSub[$mainId])
                    @endphp
                    <!-- 各mainカテゴリーに該当するsubカテゴリーが5個未満なら、 -->
                    @if ($userSubCount < 5) <!-- 各mainカテゴリーの右端に＋マーク表示し、mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示
                        -->
                        <h2>{{ $userMain[array_search($mainId, $mainIdArray)] }}<span><a href="">＋</a></span></h2>
                        @foreach ($userSub[$mainId] as $subItemArray)
                        <a href="#">
                            <p>{{$subItemArray['sub']}}</p>
                        </a>
                        @endforeach
                        <!-- 各mainカテゴリーに該当するsubカテゴリーが5個なら、 -->
                        @else
                        <!-- 各mainカテゴリーを表示し、mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
                        <h2>{{ $userMain[array_search($mainId, $mainIdArray)] }}</h2>
                        @foreach ($userSub[$mainId] as $subItemArray)
                        <a href="#">
                            <p>{{$subItemArray['sub']}}</p>
                        </a>
                        @endforeach
                        @endif
                        @endforeach
                        <!-- もしユーザーがmain_idをcount=0持っていたら左寄せで"メインカテゴリー"と表示、右端に＋マークが表示される -->
                        @elseif ($userMainCount == 0)
                        @livewire('main-category')
                        @endif
            <!-- </div>
            <div id="outputText"></div>
            <div id="hiddenInput" style="display: none;">
                <input id="inputField" type="text" onkeydown="handleKeyDown(event)" />
                <div id="subHiddenInput" style="display: none;">
                    <input id="subInputField" type="text" onkeydown="handleKeyDown(event)" />
            </div> -->

            <script>

                // let hiddenInput = document.getElementById('hiddenInput');

                // function showInput() {
                //     hiddenInput.style.display = 'block';
                //     document.getElementById('inputField').focus();
                // }

                // let enterCount = 0;

                // function handleKeyDown(event) {
                //     if (event.key === 'Enter') {
                //         event.preventDefault(); // Enterのデフォルト動作をキャンセル

                //         // 入力されたテキストを取得
                //         let inputText = event.target.value;

                //         // 新しいp要素を作成して表示
                //         let newParagraph = document.createElement('p');
                //         newParagraph.textContent = inputText;
                //         document.getElementById('outputText').appendChild(newParagraph);

                //         // 入力フィールドをクリア
                //         event.target.value = '';

                //         // カウントをインクリメント
                //         enterCount++;

                //             // 2回目のエンターキーが押されたとき
                //             if (enterCount === 2) {
                //                 // 入力されたテキストを取得
                //                 let inputText = event.target.value;

                //                 // 新しいp要素を作成して表示
                //                 let newParagraph = document.createElement('p');
                //                 newParagraph.textContent = inputText;
                //                 document.getElementById('outputText').appendChild(newParagraph);

                //                 // 入力フィールドを削除
                //                 hiddenInput.style.display = 'none';
                //             }
                //         }
                //     }

            </script>
        </div>
        <x-tab>
        </x-tab>
    </div>
    <!-- <div class="py-12">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome /> -->
    </div>
    </div>
    </div>
    @livewireScripts
</x-app-layout>