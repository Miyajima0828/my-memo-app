<div>
    <!-- <p>メインカテゴリー<span><a href="#" onclick="showInput()">＋</a></span></p> -->

    <div>
        <p>メインカテゴリー<span wire:click="input()">＋</span></p>
        <!-- @dump($mainCate) -->
        @if($isCheck)
        <div>
            <input type="text" wire:model.defer="mainCate" placeholder="メインカテゴリーを入力"><br>
            <input type="text" wire:model.defer="subCate" placeholder="サブカテゴリーを入力"><br>
            <button wire:click="save">保存</button>
        </div>
        @endif

        @if($wCheck)
        @if($mainCate && $subCate)
        <p>"{{$mainCate}}"をメインカテゴリーとして登録しますか？<br>
            "{{$subCate}}"をサブカテゴリーとして登録しますか？</p>
        <button wire:click="saveToDatabase">保存</button>
        @endif
        @endif

    </div>
    <!-- <script> -->
    <!-- // Livewire.on('refreshSubcategory', () => {
        // データベースの保存が完了した後に行いたい処理をここに記述
        // 例: リダイレクト
        //     window.location.href = "{{ route('dashboard') }}";
        // }); -->
    <!-- </script> -->
    <!-- <script> -->
    <!-- // Livewire.on('dataSaved', function() {
    // // データ保存後にページを再読み込み
    // location.reload();
    // }); -->
    <!-- </script> -->
</div>