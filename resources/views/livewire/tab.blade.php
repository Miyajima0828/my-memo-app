<div class="tabs max-lg:w-full" id="tabs">
        <form>
                @if(!is_null($tabs))

                <div class="flex items-center relative">
                        @foreach($tabs as $key=>$data)

                        @if($key==0)
                        <input id="tab{{$key+1}}" type="radio" name="tab_item" checked>
                        @else
                        <input id="tab{{$key+1}}" type="radio" name="tab_item">
                        @endif

                        <label class="tab_item " for="tab{{$key+1}}" wire:click="checked({{$key}})">
                                <p>{{Str::limit($data['main'], 10)}}</p>
                                <p>{{Str::limit($data['sub'], 10)}}</p>
                        </label>


                        @endforeach
                        <p id="saveArea"
                                class="blinking w-full absolute top-9 left-0 bg-emerald-200 h-11 flex items-center justify-center text-xl font-bold rounded-b-2xl text-emerald-950 hidden max-lg:hidden">
                                保存は&nbsp;<span class="border border-black">&nbsp;ctrl&nbsp;</span>&nbsp;+&nbsp;<span
                                        class="border border-black">&nbsp;S&nbsp;</span>&nbsp;もしくは、こちらをクリック</p>
                </div>

                <div class="tab_content relative">
                        @csrf
                        <textarea id="myTextarea" style="height:86vh;"
                                class="scrollbar w-full border-none resize-none text-xl"
                                wire:change.self="saveText('{{$tabs[$checkedKey]['id']}}','{{$tabs[$checkedKey]['sub']}}')"
                                wire:model.lazy="submitText"
                                wire:keydown.ctrl.s="saveText('{{$tabs[$checkedKey]['id']}}','{{$tabs[$checkedKey]['sub']}}')">{{$submitText}}</textarea>
                        <p id="saveAreaLg"
                                class="blinking h-full absolute top-0 right-0 bg-emerald-200 w-11 flex items-center justify-center text-xl font-bold rounded-l-2xl text-emerald-950 hidden lg:hidden  [writing-mode:vertical-rl]">
                                こちらをタップで保存</p>

                </div>

                @endif

        </form>



</div>