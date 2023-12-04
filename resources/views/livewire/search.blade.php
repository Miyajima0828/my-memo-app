<form method="GET">
    <input type="search" id="search" class="w-full h-8 text-center border-[grey] border-t-[2px] border-[2px] rounded-[15px] " type="text" wire:model.live.debounce.500ms="keyword" name="keyword" value="{{request('search')}}" placeholder="検索">
    <div class="d-flex justify-content-center ">
        <ul>
            @if(!is_null($posts))
            @foreach ($posts as $post)
            <label>
            {{ $post->sub }} {{ $post-> text}}<br>
            </label>
            @endforeach
            @endif
        </ul>
    </div>
    
</form>