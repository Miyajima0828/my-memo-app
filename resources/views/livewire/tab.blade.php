<div class="tabs max-lg:w-full">
        <form>
                @if(!is_null($tabs))

                <div class="flex items-center">
                        @foreach($tabs as $key=>$data)

                        @if($key==0)
                        <input id="tab{{$key+1}}" type="radio" name="tab_item" checked>
                        @else
                        <input id="tab{{$key+1}}" type="radio" name="tab_item">
                        @endif

                        <label class="tab_item " for="tab{{$key+1}}" wire:click="checked({{$key}})"><p>{{Str::limit($data['main'], 10)}}</p><p>{{Str::limit($data['sub'], 10)}}</p></label>


                        @endforeach

                </div>
                <div class="tab_content ">
                        @csrf
                        <textarea style="height:86vh;" class="scrollbar w-full border-none resize-none text-xl" wire:change.self="saveText('{{$tabs[$checkedKey]['id']}}','{{$tabs[$checkedKey]['sub']}}')" wire:model.lazy="submitText">{{$submitText}}</textarea>
                </div>

                @endif

        </form>



</div>
