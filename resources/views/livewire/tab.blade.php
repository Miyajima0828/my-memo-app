<div class="tabs">
    <form action="#" method="POST">
        @if($userSub[1][0])
        @foreach($userSub as $array)
        @foreach($array as $key=> $data)
            
                
                @if($key==0)
                <input id="tab{{$key+1}}" type="radio" name="tab_item" checked>
                @else
                <input id="tab{{$key+1}}" type="radio" name="tab_item">
                @endif
                
                <label class="tab_item" for="tab{{$key+1}}">{{$data['sub']}}</label>
            @endforeach
        @endforeach
        @foreach($userSub as $array)
        @foreach($array as $key=> $data)
            
                <div class="tab_content" id="tab{{$key+1}}_content">
                    <div class="tab_content_description">
                        <textarea style="height:80vh;" class="w-full border-none" name="text">{{$data['text']}}</textarea>
                    </div>
                </div>
                @endforeach
        @endforeach
        @endif
            
          
    </form>

</div>
<!-- $emitto 引数 laravel livewire -->