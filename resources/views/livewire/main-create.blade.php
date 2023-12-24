<div >
    <div class="flex items-end justify-between max-lg:border-solid max-lg:border-b-2 max-lg:border-white">
        <p class="text-lg font-semibold max-lg:px-8">メインカテゴリー</p>
        <a href="#"><i wire:click="openModal" class="fa-solid fa-plus text-lg text-gray-400 max-lg:text-white max-lg:px-4" ></i></a>
    </div>

    <x-confirmation-modal wire:model="isModal">
        <x-slot name="title">
            メインカテゴリー、サブカテゴリーの追加
        </x-slot>

        <x-slot name="content">
            <input type="text" required wire:model.defer="mainCate" placeholder="メインカテゴリーを入力"><br>
            <input type="text" required wire:model.defer="subCate" placeholder="サブカテゴリーを入力">
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
