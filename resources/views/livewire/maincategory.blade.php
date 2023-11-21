<div>
    <!-- <p>メインカテゴリー<span><a href="#" onclick="showInput()">＋</a></span></p> -->

    <div>
        <p>メインカテゴリー<span wire:click="input()">＋</span></p>

        @if($isCheck)
        <div>
            <!-- <input id="inputField" type="text" wire:model.lazy="main" placeholder="メインカテゴリーを入力"/>
        <input id="inputField" type="text" wire:model.lazy="sub" placeholder="サブカテゴリーを入力"/> -->
            <input type="text" wire:model="main" placeholder="メインカテゴリーを入力"><br>
            <input type="text" wire:model="sub" placeholder="サブカテゴリーを入力"><br>
            <button wire:click="saveToDatabase">保存</button>
        </div>
        @endif

        <!-- @if($main && $sub)
        <p>"{{$main ?? ''}}"をメインカテゴリーとして登録しますか？<br>
            "{{$sub ?? ''}}"をサブカテゴリーとして登録しますか？</p>
        <form action="#">
            <input type="submit" value="登録する">
        </form>
        @endif -->

    </div>

</div>