<div>
    <div>
        <p class="text-lg font-semibold mb-1">メインカテゴリー&nbsp;&nbsp;<span wire:click="input()"><i class="fa-solid fa-plus"></i></span></p>
        @if ($isCheck)
            <div>
                <input type="text" wire:model.defer="mainCate" placeholder="メインカテゴリーを入力"><br>
                <input type="text" wire:model.defer="subCate" placeholder="サブカテゴリーを入力"><br>
                <button wire:click="save">保存</button>
            </div>
        @endif

        @if ($wCheck)
            @if ($mainCate && $subCate)
                <p>"{{ $mainCate }}"をメインカテゴリーとして登録しますか？<br>
                    "{{ $subCate }}"をサブカテゴリーとして登録しますか？</p>
                <button wire:click="saveToDatabase">保存</button>
            @endif
        @endif

    </div>
</div>
