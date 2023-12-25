<form id="form" wire:focusin="setWord()">
    <input type="search" id="search"
        class=" w-full h-8 text-center border-[grey] border-t-[2px] border-[2px] rounded-[15px] z-51"
        wire:model.live.debounce.500ms="keyword" value="{{request('search')}}" placeholder="検索">
    <div id="result" class="relative d-flex justify-content-center ">

        @if(filled($keyword) && !is_null($posts))
        <div style="width: 100vw; height: 100vh;" class="overflow-clip fixed bg-slate-300 opacity-50  top-0 right-0 "
            wire:click="searchReset()"></div>
        <div class="absolute z-50 mr-2 w-full bg-white rounded-md shadow-lg">
            <ul id="list1" >
                <li class="list-none">
                    <p class="relative absolute top-0 lg:pl-10 max-lg:text-xs text-justify rounded-md bg-slate-100"><span
                            class="inline-block text-center w-1/3">メイン</span><span
                            class="inline-block text-center w-1/3">サブ</span><span class="inline-block text-center w-1/3">本文</span>
                    </p>
                </li>
                
                @foreach ($posts as $key=>$post)
                <label>
                    <li class="list-none">
                        <p class="relative absolute top-0 lg:pl-10 text-justify rounded-md max-lg:text-xs hover:bg-sky-100 focus:bg-sky-100"
                            tabindex="0" wire:keydown.enter="onClickUpdate('{{$post->id}}','{{$post->sub}}')"
                            wire:click="onClickUpdate('{{$post->id}}','{{$post->sub}}')"><span
                                class="inline-block text-center w-1/3 max-lg:hidden">{{Str::limit($post->main, 40)}}</span><span
                                class="inline-block text-center w-1/3 max-lg:hidden">{{Str::limit($post->sub, 40)}}</span><span
                                class="inline-block text-center w-1/3 max-lg:hidden">{{Str::limit($post->text, 40)}}</span>
                                <span
                                class="inline-block  w-1/3 lg:hidden">{{Str::limit($post->main, 10)}}</span><span
                                class="inline-block  w-1/3 lg:hidden">{{Str::limit($post->sub, 10)}}</span><span
                                class="inline-block  w-1/3 lg:hidden">{{Str::limit($post->text, 10)}}</span></p>
                    </li>
                </label>
                @endforeach
            </ul>

        </div>
        @endif

    </div>

</form>