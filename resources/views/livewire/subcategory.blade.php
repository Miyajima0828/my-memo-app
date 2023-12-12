<div>
    @php
    $userSubCount = count($userSub[$mainId]);
    $nowMainCategory = $userMain[array_search($mainId, $mainIdArray)];
    @endphp

    <!-- 各mainカテゴリーに該当するsubカテゴリーが5個未満なら、 -->
    @if ($userSubCount < 5)

        <!-- 各mainカテゴリーの右端に＋マーク表示し、mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
        <h2 class="text-lg font-medium mt-0.5">{{ $nowMainCategory }}<span>&nbsp;&nbsp;
                <a href="#" wire:click="updateMainCategory()"><i class="fa-solid fa-retweet text-xs text-gray-300"></i></a>
                &nbsp;</span><span>&nbsp;<a href="#" wire:click="deleteMainCategory()"><i class="fa-solid fa-trash-can text-xs text-gray-300"></i></a>&nbsp;&nbsp;</span><span
                wire:click="input({{ $mainId }})"><i class="fa-solid fa-plus text-xs text-gray-300"></i></span></h2>

        {{-- メインカテゴリーの変更 --}}
        @if ($updateMainCheck)
            <div>
                <p>"{{ $nowMainCategory }}"を<br>
                    <input type="text" wire:model.defer="newMainCategory"
                        placeholder="メインカテゴリー名"><br>
                        に変更しますか？</p>
                <button wire:click="updateMain({{ $mainId }})">変更</button>
            </div>
        @endif

        {{-- メインカテゴリーの削除 --}}
        @if ($deleteMainCheck)
            <div>
                <p>"{{ $nowMainCategory }}"を<br>
                    削除しますか？<br>
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
                <p>"{{ $subCate }}"を<br>
                    サブカテゴリーとして登録しますか？</p>
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
                            wire:click="updateSubCategory({{ $nowSubId }})"><i class="fa-solid fa-retweet"></i></a></span><span>&nbsp;&nbsp;<a
                            href="#" wire:click="deleteSubCategory({{ $nowSubId }})"><i class="fa-solid fa-trash-can"></i></a></span></p>
            </a>

            {{-- サブカテゴリーの変更 --}}
            @if ($updateSubCheck && $nowSubId === $currentSub)
                <div>
                    <p>"{{ $subItemArray['sub'] }}"を<br>
                        <input type="text" wire:model.defer="newSubCategory" placeholder="サブカテゴリー名"><br>
                        に変更しますか？
                    </p>
                    <button wire:click="updateSub({{ $nowSubId }})">変更</button>
                </div>
            @endif

            {{-- サブカテゴリーの削除 --}}
            @if ($deleteSubCheck && $nowSubId === $currentSub)
                <div>
                    <p>"{{ $subItemArray['sub'] }}"を<br>
                        削除しますか？<br>
                        このカテゴリー内のテキストも削除されますが宜しいですか？</p>
                    <button wire:click="deleteSub({{ $nowSubId }})">削除</button>
                </div>
            @endif
        @endforeach


    <!-- 各mainカテゴリーに該当するsubカテゴリーが5個なら、 -->
    @else

        <!-- 各mainカテゴリーを表示し、mainカテゴリーに該当するsubカテゴリーをmainカテゴリのpの下にp,smallで表示 -->
        <h2 class="text-lg font-medium mt-0.5">{{ $nowMainCategory }}<span>&nbsp;&nbsp;<a href="#"
                    wire:click="updateMainCategory()"><i class="fa-solid fa-retweet"></i></a>&nbsp;</span><span>&nbsp;<a href="#"
                    wire:click="deleteMainCategory()"><i class="fa-solid fa-trash-can"></i></a>&nbsp;&nbsp;</span></h2>

        {{-- メインカテゴリーの変更 --}}
        @if ($updateMainCheck)
            <div>
                <p>"{{ $nowMainCategory }}"を<br>
                    <input type="text" wire:model.defer="newMainCategory" placeholder="メインカテゴリー名"><br>
                    に変更しますか？
                </p>
                <button wire:click="updateMain({{ $mainId }})">変更</button>
            </div>
        @endif

        {{-- メインカテゴリーの削除 --}}
        @if ($deleteMainCheck)
            <div>
                <p>"{{ $nowMainCategory }}"を<br>
                    削除しますか？<br>
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
                <p><span wire:click="onClickUpdate('{{ $subItemArray['sub'] }}')">{{ $subItemArray['sub'] }}</span><span>&nbsp;&nbsp;<a href="#"
                            wire:click="updateSubCategory({{ $nowSubId }})"><i class="fa-solid fa-retweet"></i></a></span><span>&nbsp;&nbsp;<a
                            href="#" wire:click="deleteSubCategory({{ $nowSubId }})"><i class="fa-solid fa-trash-can"></i></a></span></p>
            </a>

            {{-- サブカテゴリーの変更 --}}
            @if ($updateSubCheck && $nowSubId === $currentSub)
                <div>
                    <p>"{{ $subItemArray['sub'] }}"を<br>
                        <input type="text" wire:model.defer="newSubCategory" placeholder="サブカテゴリー名"><br>
                        に変更しますか？
                    </p>
                    <button wire:click="updateSub({{ $nowSubId }})">変更</button>
                </div>
            @endif

            {{-- サブカテゴリーの削除 --}}
            @if ($deleteSubCheck && $nowSubId === $currentSub)
                <div>
                    <p>"{{ $subItemArray['sub'] }}"を<br>
                        削除しますか？<br>
                        このカテゴリー内のテキストも削除されますが宜しいですか？</p>
                    <button wire:click="deleteSub({{ $nowSubId }})">削除</button>
                </div>
            @endif
        @endforeach
    @endif
</div>
