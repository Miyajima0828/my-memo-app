@php
$userMainCount = count($userMain);
@endphp

<p>$userMainCount</p>
@foreach($userMain as $main)
    <p>{{$main}}</p>
@endforeach

<!-- もしユーザーがDBにmain_idをcount=5持っていたら -->
@if ($userMainCount == 5)
    @foreach ($userMain as $main)
        @foreach ($userSub as $sub)
<!-- 各mainカテゴリーに該当するsubカテゴリーが5個未満なら、 -->
            @if ($userSubCount < 5)
<!-- 各mainカテゴリーの右端に＋マーク表示し、
mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
                <h2>{{ $main }}<span>＋</span></h2>
                <p><small>{{ $sub }}</small></p>
<!-- 各mainカテゴリーに該当するsubカテゴリーが5個なら、 -->
            @else
<!-- 各mainカテゴリーを表示し、
mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
                <h2>{{ $main }}</h2>
                <p><small>{{ $sub }}</small></p>
            @endif
        @endforeach
    @endforeach
@endif


<!-- もしユーザーがmain_idをcount=1～4持っていたら -->
@if ($userMainCount >= 1 && 4 >= $userMainCount)
    <p>メインカテゴリー<span>＋</span></p>
    @foreach ($userMain as $main)
        @foreach ($userSub as $sub)
<!-- 各mainカテゴリーに該当するsubカテゴリーが5個未満なら、 -->
            @if ($userSubCount < 5)
<!-- 各mainカテゴリーの右端に＋マーク表示し、
mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
                    <h2>{{ $main }}<span>＋</span></h2>
                    <p><small>{{ $sub }}</small></p>
<!-- 各mainカテゴリーに該当するsubカテゴリーが5個なら、 -->
            @else
<!-- 各mainカテゴリーを表示し、
mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
                <h2>{{ $main }}</h2>
                <p><small>{{ $sub }}</small></p>
            @endif
        @endforeach
    @endforeach
@endif --}}


<!-- もしユーザーがmain_idをcount=0持っていたら
左寄せで"メインカテゴリー"と表示、右端に＋マークが表示される -->
{{-- @if ($userMainCount == 0)
    <p>メインカテゴリー<span>＋</span></p>
@endif --}}


<!-- 左寄せで"メインカテゴリー"と表示されている行の、右端の＋マークを押すと
一番下のsubカテゴリーの下にカーソルが移り、テキストが入力できるようになる -->
{{-- <input type="text" name="sub"> --}}

<!-- テキストを入力しエンターを押すと
その場所へ、打ち込んだテキストがpでmainカテゴリーとして表示され、
更にその下にカーソルが移り、テキストが入力できるようになる -->


<!-- テキストを入力しエンターを押すと
その場所へ、打ち込んだテキストがp,smallでsubカテゴリーとして表示され、
そのsubカテゴリーを保有しているmainカテゴリーの右端に＋マークが表示され、
画面上のmainカテゴリーの数がcount=5なら、
左寄せで"メインカテゴリー"と表示、右端に＋マークが表示されている行が消える -->



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
