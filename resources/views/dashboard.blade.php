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
                    <h2>{{ $userMain[array_search($mainId, $mainIdArray)] }}<span>&nbsp;&nbsp;<a href="#">変</a>&nbsp;</span><span>&nbsp;<a href="#">削</a>&nbsp;&nbsp;</span><span><a href="#">＋</a></span></h2>
                    @foreach ($userSub[$mainId] as $subItemArray)
                    <a href="#">
                        <p>{{$subItemArray['sub']}}<span>&nbsp;&nbsp;<a href="#">変</a></span><span>&nbsp;&nbsp;<a href="#">削</a></span></p>
                    </a>
                    @endforeach
                    <!-- 各mainカテゴリーに該当するsubカテゴリーが5個なら、 -->
                    @else
                    <!-- 各mainカテゴリーを表示し、mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
                    <h2>{{ $userMain[array_search($mainId, $mainIdArray)] }}<span>&nbsp;&nbsp;<a href="#">変</a>&nbsp;</span><span>&nbsp;<a href="#">削</a>&nbsp;&nbsp;</span></h2>
                    @foreach ($userSub[$mainId] as $subItemArray)
                    <a href="#">
                        <p>{{$subItemArray['sub']}}<span>&nbsp;&nbsp;<a href="#">変</a></span><span>&nbsp;&nbsp;<a href="#">削</a></span></p>
                    </a>
                    @endforeach
                    @endif
                    @endforeach

                    <!-- もしユーザーがmain_idをcount=1～4持っていたら -->
                    @elseif ($userMainCount >= 1 && 4 >= $userMainCount)
                    <!-- <p>メインカテゴリー<span><a href="#" onclick="showInput()">＋</a></span></p> -->
                    @livewire('main-category')
                    @livewire('sub-category', ['mainIdArray' => $mainIdArray, 'userSub' => $userSub, 'userMain' => $userMain])
                        <!-- もしユーザーがmain_idをcount=0持っていたら左寄せで"メインカテゴリー"と表示、右端に＋マークが表示される -->
                        @elseif ($userMainCount == 0)
                        @livewire('main-category')
                        @endif
            

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