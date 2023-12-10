<div>
    @php
        $userSubCount = count($userSub[$mainId]);
        $nowMainCategory = $userMain[array_search($mainId, $mainIdArray)];
    @endphp

    <!-- 各mainカテゴリーに該当するsubカテゴリーが5個未満なら、 -->
    @if ($userSubCount < 5)
        <!-- 各mainカテゴリーの右端に＋マーク表示し、mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->

        <h2>{{ $nowMainCategory }}<span>&nbsp;&nbsp;<a href="#"
                    wire:click="updateMainCategory()">変</a>&nbsp;</span><span>&nbsp;<a href="#"
                    wire:click="deleteMainCategory()">削</a>&nbsp;&nbsp;</span><span
                wire:click="input({{ $mainId }})">＋</span></h2>

        {{-- メインカテゴリーの変更 --}}
        @if ($updateMainCheck)
            <div>
                <p>"{{ $nowMainCategory }}"を<input type="text" wire:model.defer="newMainCategory"
                        placeholder="メインカテゴリー名">に変更しますか？</p>
                <button wire:click="updateMain({{ $mainId }})">変更</button>
            </div>
        @endif

        {{-- メインカテゴリーの削除 --}}
        @if ($deleteMainCheck)
            <div>
                <p>"{{ $nowMainCategory }}"を削除しますか？<br>
                    このカテゴリー内のサブカテゴリーとテキストも削除されますが宜しいですか？</p>
                <button wire:click="deleteMain({{ $mainId }})">削除</button>
            </div>
        @endif

        {{-- サブカテゴリーの追加 --}}
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
        {{-- サブカテゴリーの追加ここまで --}}

        @foreach ($userSub[$mainId] as $subItemArray)
            <a href="#">

                @php
                    $nowSubId = $subItemArray['id'];
                @endphp

                <p><span wire:click="onClickUpdate('{{ $subItemArray['sub'] }}')">{{ $subItemArray['sub'] }}</span><span>&nbsp;&nbsp;<a href="#"
                            wire:click="updateSubCategory({{ $nowSubId }})">変</a></span><span>&nbsp;&nbsp;<a href="#"
                            wire:click="deleteSubCategory({{ $nowSubId }})">削</a></span></p>
            </a>

            {{-- サブカテゴリーの変更 --}}
            @if ($updateSubCheck && $nowSubId === $currentSub)
                <div>
                    <p>"{{ $subItemArray['sub'] }}"を<input type="text" wire:model.defer="newSubCategory"
                            placeholder="サブカテゴリー名">に変更しますか？</p>
                    <button wire:click="updateSub({{ $nowSubId }})">変更</button>
                </div>
            @endif

            {{-- サブカテゴリーの削除 --}}
            @if ($deleteSubCheck && $nowSubId === $currentSub)
                <div>
                    <p>"{{ $subItemArray['sub'] }}"を削除しますか？<br>
                        このカテゴリー内のテキストも削除されますが宜しいですか？</p>
                    <button wire:click="deleteSub({{ $nowSubId }})">削除</button>
                </div>
            @endif
        @endforeach


        <!-- 各mainカテゴリーに該当するsubカテゴリーが5個なら、 -->
    @else
        <!-- 各mainカテゴリーを表示し、mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
        <h2>{{ $nowMainCategory }}<span>&nbsp;&nbsp;<a href="#"
                    wire:click="updateMainCategory()">変</a>&nbsp;</span><span>&nbsp;<a href="#"
                    wire:click="deleteMainCategory()">削</a>&nbsp;&nbsp;</span></h2>

        {{-- メインカテゴリーの変更 --}}
        @if ($updateMainCheck)
            <div>
                <p>"{{ $nowMainCategory }}"を<input type="text" wire:model.defer="newMainCategory"
                        placeholder="メインカテゴリー名">に変更しますか？</p>
                <button wire:click="updateMain({{ $mainId }})">変更</button>
            </div>
        @endif

        {{-- メインカテゴリーの削除 --}}
        @if ($deleteMainCheck)
            <div>
                <p>"{{ $nowMainCategory }}"を削除しますか？<br>
                    このカテゴリー内のサブカテゴリーとテキストも削除されますが宜しいですか？</p>
                <button wire:click="deleteMain({{ $mainId }})">削除</button>
            </div>
        @endif
        {{-- メインカテゴリーの削除ここまで --}}

        @foreach ($userSub[$mainId] as $subItemArray)
            <a href="#">

                @php
                    $nowSubId = $subItemArray['id'];
                @endphp

                <p>{{ $subItemArray['sub'] }}<span>&nbsp;&nbsp;<a href="#"
                            wire:click="updateSubCategory({{ $nowSubId }})">変</a></span><span>&nbsp;&nbsp;<a href="#"
                            wire:click="deleteSubCategory({{ $nowSubId }})">削</a></span></p>
            </a>

            {{-- サブカテゴリーの変更 --}}
            @if ($updateSubCheck && $nowSubId === $currentSub)
                <div>
                    <p>"{{ $subItemArray['sub'] }}"を<input type="text" wire:model.defer="newSubCategory"
                            placeholder="サブカテゴリー名">に変更しますか？</p>
                    <button wire:click="updateSub({{ $nowSubId }})">変更</button>
                </div>
            @endif

            {{-- サブカテゴリーの削除 --}}
            @if ($deleteSubCheck && $nowSubId === $currentSub)
                <div>
                    <p>"{{ $subItemArray['sub'] }}"を削除しますか？<br>
                        このカテゴリー内のテキストも削除されますが宜しいですか？</p>
                    <button wire:click="deleteSub({{ $nowSubId }})">削除</button>
                </div>
            @endif
        @endforeach

    @endif
</div>
