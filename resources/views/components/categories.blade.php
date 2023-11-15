{{ $userMainCount = count($userMain) }}


@foreach($userMain as $main)
    <p>{{$main}}</p>
@endforeach


<!-- もしユーザーがDBにmain_idをcount=5持っていたら -->
@if ($userMainCount == 3)
    @foreach ($mainIdArray as $mainId)
        {{ $userSubCount = count($userSub[$mainId]) }}
        @foreach ($userSub as $sub)
<!-- 各mainカテゴリーに該当するsubカテゴリーが5個未満なら、 -->
            @if ($userSubCount < 5)
<!-- 各mainカテゴリーの右端に＋マーク表示し、
mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
                <h2>{{ $userMain[0] }}<span>＋</span></h2>
                {{ $subitem = $sub['0']['sub'] }}
                <p><small>{{ $subitem }}</small></p>
<!-- 各mainカテゴリーに該当するsubカテゴリーが5個なら、 -->
            @else
<!-- 各mainカテゴリーを表示し、
mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
                <h2>{{ $userMain[0] }}</h2>
                {{ $subitem = $sub['0']['sub'] }}
                <p><small>{{ $subitem }}</small></p>
            @endif
        @endforeach
    @endforeach
@endif
