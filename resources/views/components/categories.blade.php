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


<!-- テキストを入力しエンターを押すと
その場所へ、打ち込んだテキストがpでmainカテゴリーとして表示され、
更にその下にカーソルが移り、テキストが入力できるようになる -->


<!-- テキストを入力しエンターを押すと
その場所へ、打ち込んだテキストがp,smallでsubカテゴリーとして表示され、
そのsubカテゴリーを保有しているmainカテゴリーの右端に＋マークが表示され、
画面上のmainカテゴリーの数がcount=5なら、
左寄せで"メインカテゴリー"と表示、右端に＋マークが表示されている行が消える -->

@php
    $userMainCount = count($userMain)
@endphp

@foreach($userMain as $main)
    <p>{{$main}}</p>
@endforeach




<!-- mainカテゴリーの右の＋マークをクリックすると、
そのmainカテゴリーに表示されているsubカテゴリーの一番下のpの下に、カーソル？が移りテキスト入力が可能となる

テキストを入力しエンターを押すと
その場所へ、打ち込んだテキストがp,smallでsubカテゴリーとして表示され
そのmainカテゴリーに対するsubカテゴリーがcount=5なら、mainカテゴリーの右の＋マークが消える -->



<!-- subカテゴリーにカーソルを持っていったら、
その行の背景が変わり、右端に×が表示される

背景色が変わったsubカテゴリーをクリックすると、
texts.blade.phpの表示がクリックされたカテゴリーのテキストページに切り替わる

subカテゴリーの右端に表示された×をクリックすると、
そのsubカテゴリーの名前が変更される -->
