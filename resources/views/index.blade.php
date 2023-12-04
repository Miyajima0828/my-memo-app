//* 検索機能ここから *//
<div>
    <form action="" method="GET">
        <input type="text" name="keyword" value="{{ $keyword }}">

        <input type="submit" value="検索">
    </form>
</div>

//*検索機能ここまで*//




<p>{{$keyword}}</p>
@foreach ($posts as $post)
{{ $post }}<br>
@endforeach