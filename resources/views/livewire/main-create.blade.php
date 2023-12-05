<div>
    <div>
        <p class="text-lg font-semibold mb-1">メインカテゴリー&nbsp;&nbsp;<span wire:click="openModal"><i
                    class="fa-solid fa-plus text-xs text-gray-300"></i></span></p>
    </div>
    
    <x-confirmation-modal wire:model="isModal">
        <x-slot name="title">
            メインカテゴリー、サブカテゴリーの追加
        </x-slot>

        <x-slot name="content">
            <input type="text" wire:model.defer="mainCate" placeholder="メインカテゴリーを入力"><br>
            <input type="text" wire:model.defer="subCate" placeholder="サブカテゴリーを入力">
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('isModal')">
                キャンセル
            </x-secondary-button>
            <x-danger-button wire:click="save()">
                保存
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
