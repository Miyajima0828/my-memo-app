<div>
    <!-- <p>メインカテゴリー<span><a href="#" onclick="showInput()">＋</a></span></p> -->

    <div>
        <p>メインカテゴリー<span wire:click="input()">＋</span></p>

        @if($isCheck)
        <div>
        <input id="inputField" type="text" wire:model.lazy="main" wire:change="handleMouseOut" placeholder="メインカテゴリーを入力"/>
        <input id="inputField" type="text" wire:model.lazy="sub" placeholder="サブカテゴリーを入力"/>
        </div>
        @endif
        
        <p>{{$main ?? ''}}</p>
        <p>{{$sub ?? ''}}</p>
        
    </div>


</div>