<div>
    @foreach ($mainIdArray as $mainId)
    @php
    $userSubCount = count($userSub[$mainId])
    @endphp
    <!-- 各mainカテゴリーに該当するsubカテゴリーが5個未満なら、 -->
    @if ($userSubCount < 5) <!-- 各mainカテゴリーの右端に＋マーク表示し、mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
        <h2>{{ $userMain[array_search($mainId, $mainIdArray)] }}<span wire:click="input()">＋</span></h2>
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
</div>