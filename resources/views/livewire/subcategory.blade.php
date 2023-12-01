<div>
    @php
        $userSubCount = count($userSub[$mainId]);
    @endphp
    <!-- 各mainカテゴリーに該当するsubカテゴリーが5個未満なら、 -->
    @if ($userSubCount < 5)
        <!-- 各mainカテゴリーの右端に＋マーク表示し、mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
        <h2>{{ $userMain[array_search($mainId, $mainIdArray)] }}<span>&nbsp;&nbsp;<a
                    href="#">変</a>&nbsp;</span><span>&nbsp;<a href="#">削</a>&nbsp;&nbsp;</span><span
                wire:click="input({{ $mainId }})">＋</span></h2>

        @if ($isCheck && $mainId === $currentMainId)
            <div>
                <input type="text" wire:model.defer="subCate" placeholder="サブカテゴリーを入力"><br>
                <button wire:click="save({{ $mainId }})">保存</button>
            </div>
        @endif

        @if ($wCheck && $mainId === $currentMainId)
            @if ($subCate)
                <p>"{{ $subCate }}"をサブカテゴリーとして登録しますか？</p>
                <button wire:click="saveToDatabase">保存</button>
            @endif
        @endif

        @foreach ($userSub[$mainId] as $subItemArray)
            <a href="#">
                <p>{{ $subItemArray['sub'] }}<span>&nbsp;&nbsp;<a href="#">変</a></span><span>&nbsp;&nbsp;<a
                            href="#">削</a></span></p>
            </a>
        @endforeach

        <!-- 各mainカテゴリーに該当するsubカテゴリーが5個なら、 -->
    @else
        <!-- 各mainカテゴリーを表示し、mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
        <h2>{{ $userMain[array_search($mainId, $mainIdArray)] }}<span>&nbsp;&nbsp;<a
                    href="#">変</a>&nbsp;</span><span>&nbsp;<a href="#">削</a>&nbsp;&nbsp;</span></h2>

        @foreach ($userSub[$mainId] as $subItemArray)
            <a href="#">
                <p>{{ $subItemArray['sub'] }}<span>&nbsp;&nbsp;<a href="#">変</a></span><span>&nbsp;&nbsp;<a
                            href="#">削</a></span></p>
            </a>
        @endforeach
    @endif
</div>
