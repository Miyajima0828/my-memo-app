<form id="form" wire:focusout="searchReset()" wire:focusin="setWord()">
    <input type="search" id="search"
        class="w-full h-8 text-center border-[grey] border-t-[2px] border-[2px] rounded-[15px] "
        wire:model.live.debounce.500ms="keyword" value="{{request('search')}}" placeholder="検索">
    <div id="result" class="relative d-flex justify-content-center ">
        <ul>
            @if(filled($keyword) && !is_null($posts))
            <div class="absolute z-50 mr-2 w-full bg-white rounded-md shadow-lg"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95">
                <ul>
                    <li class="list-none">
                        <p class="relative absolute top-0 pl-10 text-justify rounded-md bg-slate-100"><span
                                class="inline-block w-1/3">メインカテゴリー</span><span
                                class="inline-block w-1/3">サブカテゴリー</span><span class="inline-block w-1/3">検索結果</span>
                        </p>
                    </li>
                    @foreach ($posts as $key=>$post)
                    <label>
                        <li class="list-none" tabindex="0">
                            <p class="relative absolute top-0 pl-10 text-justify rounded-md hover:bg-sky-100"
                                wire:click="onClickUpdate('{{$post->sub}}')"><span
                                    class="inline-block w-1/3">{{$post->main}}</span><span
                                    class="inline-block w-1/3">{{$post->sub}}</span><span
                                    class="inline-block w-1/3">{{$keyword}}</span></p>
                        </li>
                    </label>
                    @endforeach
                </ul>
            </div>
            @endif
        </ul>
    </div>
    
</form>