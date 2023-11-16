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
            @if ($userSubCount < 5)
            <!-- 各mainカテゴリーの右端に＋マーク表示しmainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->            
                <h2>{{ $userMain[array_search($mainId, $mainIdArray)] }}<span><a href="#">＋</a></span></h2>
                @foreach ($userSub[$mainId] as $subItemArray)
                    <p>{{$subItemArray['sub']}}</p>
                @endforeach
            <!-- 各mainカテゴリーに該当するsubカテゴリーが5個なら、 -->
            @else
            <!-- 各mainカテゴリーを表示し、mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
                <h2>{{ $userMain[array_search($mainId, $mainIdArray)] }}</h2>
                @foreach ($userSub[$mainId] as $subItemArray)
                    <p>{{$subItemArray['sub']}}</p>
                @endforeach
            @endif
    @endforeach

<!-- もしユーザーがmain_idをcount=1～4持っていたら -->
@elseif ($userMainCount >= 1 && 4 >= $userMainCount)
    <p>メインカテゴリー<span><a href="#">＋</a></span></p>
    @foreach ($mainIdArray as $mainId)
        @php    
            $userSubCount = count($userSub[$mainId])
        @endphp
        <!-- 各mainカテゴリーに該当するsubカテゴリーが5個未満なら、 -->
            @if ($userSubCount < 5)
            <!-- 各mainカテゴリーの右端に＋マーク表示し、mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->            
                <h2>{{ $userMain[array_search($mainId, $mainIdArray)] }}<span><a href="">＋</a></span></h2>
                @foreach ($userSub[$mainId] as $subItemArray)
                    <p>{{$subItemArray['sub']}}</p>
                @endforeach
            <!-- 各mainカテゴリーに該当するsubカテゴリーが5個なら、 -->
            @else
            <!-- 各mainカテゴリーを表示し、mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
                <h2>{{ $userMain[array_search($mainId, $mainIdArray)] }}</h2>
                @foreach ($userSub[$mainId] as $subItemArray)
                    <p>{{$subItemArray['sub']}}</p>
                @endforeach
            @endif
    @endforeach
<!-- もしユーザーがmain_idをcount=0持っていたら左寄せで"メインカテゴリー"と表示、右端に＋マークが表示される -->
@elseif ($userMainCount == 0)
    <p>メインカテゴリー<span>＋</span></p>
@endif