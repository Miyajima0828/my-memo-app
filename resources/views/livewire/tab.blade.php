<div class="tabs">
    
        <form wire:submit.prevent="saveText">
        @foreach($tabs as $key=>$data)

        @if($key==0)
        <input id="tab{{$key+1}}" type="radio" name="tab_item" checked>
        @else
        <input id="tab{{$key+1}}" type="radio" name="tab_item">
        @endif

        <label class="tab_item pt-2" for="tab{{$key+1}}">{{$data['main']}}&nbsp;&nbsp;{{$data['sub']}}</label>


        @endforeach

        @foreach($tabs as $key=>$data)
        @php
        $nowSubId=$data['id'];
        @endphp

        <div class="tab_content" id="tab{{$key+1}}_content">
            <div class="tab_content_description">
                <textarea style="height:80vh;" class="w-full border-none relative" name="text" wire:model.defer="text">{{$data['text']}}</textarea>
                <!-- <input style="height:80vh;" class="w-full border-none" name="text" wire:model.lazy="text">{{$data['text']}} -->
                <button class="absolute bottom-0 right-0 bg-sky-500/100 p-1 font-bold text-white" type="submit" wire:click="$set('nowSub','{{$data['sub']}}')">保存</button>
            </div>
        </div>


        @endforeach

        </form>

    

</div>
<!-- $emitto 引数 laravel livewire -->