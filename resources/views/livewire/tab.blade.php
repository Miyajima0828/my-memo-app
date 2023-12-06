<div class="tabs">
    <form action="#" method="POST">
        @php
            $num_id=0;
        @endphp
        @foreach($tabs as $data)
        
        @if($num_id==0)
        <input id="tab{{$num_id+1}}" type="radio" name="tab_item" checked>
        @else
        <input id="tab{{$num_id+1}}" type="radio" name="tab_item">
        @endif

        <label class="tab_item pt-2" for="tab{{$num_id+1}}">{{$data['main']}}&nbsp;&nbsp;{{$data['sub']}}</label>

        @php
            $num_id++;
        @endphp
        @endforeach
        @php
            $num_id=0;
        @endphp
        @foreach($tabs as $data)
        @php
            $nowSubId=$data['id'];
        @endphp

        <div class="tab_content" id="tab{{$num_id+1}}_content">
            <div class="tab_content_description">
                <textarea style="height:80vh;" class="w-full border-none" name="text">{{$data['text']}}</textarea>
            </div>
        </div>
        @php
            $num_id++;
        @endphp
        @endforeach



    </form>

</div>
<!-- $emitto 引数 laravel livewire -->