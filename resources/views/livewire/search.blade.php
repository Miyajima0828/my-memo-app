<form id="form"  wire:focusin="setWord()">
    <input type="search" id="search" class="w-full h-8 text-center border-[grey] border-t-[2px] border-[2px] rounded-[15px] " wire:model.live.debounce.500ms="keyword" value="{{request('search')}}" placeholder="検索">
    <div id="result" class="relative d-flex justify-content-center ">

        @if(filled($keyword) && !is_null($posts))
        <div style="width: 200vw; height: 200vh;" class="overflow-hidden absolute bg-slate-300 right-0 z-49"></div>
        <div class="absolute z-50 mr-2 w-full bg-white rounded-md shadow-lg" >
            <ul id="list1" class="z-51">
                <li class="list-none">
                    <p class="relative absolute top-0 pl-10 text-justify rounded-md bg-slate-100"><span class="inline-block w-1/3">メインカテゴリー</span><span class="inline-block w-1/3">サブカテゴリー</span><span class="inline-block w-1/3">検索結果</span>
                    </p>
                </li>
                @foreach ($posts as $key=>$post)
                <label>
                    <li class="list-none">
                        <p class="relative absolute top-0 pl-10 text-justify rounded-md hover:bg-sky-100 focus:bg-sky-100" tabindex="0" wire:click="onClickUpdate('{{$post->sub}}')"><span class="inline-block w-1/3">{{$post->main}}</span><span class="inline-block w-1/3">{{$post->sub}}</span><span class="inline-block w-1/3">{{$keyword}}</span></p>
                    </li>
                </label>
                @endforeach
            </ul>
        
        </div>
        @endif

    </div>
    <script>
        const result = document.querySelector('#result');
        result.addEventListener('keydown', function(event) {
            const listId = document.getElementById('list1');
            if (listId !== null) {
                console.log('aaa');
                listId.addEventListener('keydown', function(event) {
                    let target = event.target;
                    let next = null;

                    // 矢印キーの判定とフォーカス移動先の取得
                    if (event.key === 'ArrowDown') {
                        next = target.nextElementSibling;
                    } else if (event.key === 'ArrowUp') {
                        next = target.previousElementSibling;
                    }

                    // フォーカスを移動
                    if (next && next.tagName === 'LI') {
                        next.focus();
                        event.preventDefault();
                    }
                });
            } else {
                console.log('bbb');
            }
        });

        // const listId = document.getElementById('list1');
        // if (listId !== null) {
        //     console.log('aaa');
        //     listId.addEventListener('keydown', function(event) {
        //         let target = event.target;
        //         let next = null;

        //         // 矢印キーの判定とフォーカス移動先の取得
        //         if (event.key === 'ArrowDown') {
        //             next = target.nextElementSibling;
        //         } else if (event.key === 'ArrowUp') {
        //             next = target.previousElementSibling;
        //         }

        //         // フォーカスを移動
        //         if (next && next.tagName === 'LI') {
        //             next.focus();
        //             event.preventDefault();
        //         }
        //     });
        // } else {
        //     console.log('bbb');
        // }
    </script>
</form>