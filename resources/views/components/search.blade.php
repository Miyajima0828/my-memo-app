<form action="index" method="GET">
    @csrf
    <input type="search" id="search" class="w-full h-8 text-center border-[grey] border-t-[2px] border-[2px] rounded-[15px] " type="text" name="keyword" value="{{$keyword}}" placeholder="検索">
</form>