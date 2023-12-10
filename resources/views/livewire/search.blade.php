<form method="GET">
    <input type="search" id="search" class="w-full h-8 text-center border-[grey] border-t-[2px] border-[2px] rounded-[15px] " type="text" wire:model.live.debounce.500ms="keyword" name="keyword" value="{{request('search')}}" placeholder="検索">
    <div class="relative d-flex justify-content-center ">
        <ul>
            @if(!is_null($posts))
            <div class="absolute z-50 m-2 w-full bg-white rounded-md shadow-lg" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                <ul>
                    @foreach ($posts as $key=>$post)
                    <label>
                        <li class="list-none" ><p class="relative absolute top-0 left-0 text-justify" wire:click="onClickUpdate('{{$post->sub}}')">{{$post->main}} &nbsp;&nbsp; {{$post->sub}} &nbsp;&nbsp; {{$post->text}}</p></li>
                    </label>
                    @endforeach
                </ul>
            </div>
            @endif
        </ul>
    </div>

</form>