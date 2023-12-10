<div class="tabs">
    <form >

        @foreach($tabs as $key=>$data)

        @if($key==0)
        <input id="tab{{$key+1}}" type="radio" name="tab_item" checked>
        @else
        <input id="tab{{$key+1}}" type="radio" name="tab_item">
        @endif

        <label class="tab_item pt-2" for="tab{{$key+1}}" wire:click="$set('checkedKey','{{$key}}')">{{$data['main']}}&nbsp;&nbsp;{{$data['sub']}}</label>


        @endforeach

       

        <div class="tab_content z-50" >
                @csrf
                <textarea style="height:86vh;" class="w-full border-none resize-none text-xl" 
                wire:change.self="saveText('{{$tabs[$checkedKey]['sub']}}')" wire:model.lazy="submitText">{{$tabs[$checkedKey]['text']}}</textarea>
        </div>
        

        </form>

    

</div>
<!-- $emitto 引数 laravel livewire -->