<div>
    @php
        $userSubCount = count($userSub[$mainId]);
        $nowMainCategory = $userMain[array_search($mainId, $mainIdArray)];
    @endphp

    <!-- 各mainカテゴリーに該当するsubカテゴリーが5個未満なら、 -->
    @if ($userSubCount < 5)
        <!-- 各mainカテゴリーの右端に＋マーク表示し、mainカテゴリーに該当するsubカテゴリーをmainカテゴリの下に表示 -->
        <h2 class="text-lg font-medium mt-3 mb-0 pb-0">{{ $nowMainCategory }}&nbsp;&nbsp;<span>
                <a href="#" wire:click="openModalMainUpdate()"><i
                        class="fa-solid fa-retweet text-xs text-gray-300"></i></a>
            </span>&nbsp;&nbsp;<span><a href="#" wire:click="openModalMainDelete()"><i
                        class="fa-solid fa-trash-can text-xs text-gray-300"></i></a></span>&nbsp;&nbsp;<span><a
                    href="#" wire:click="openModalSubCreate"><i
                        class="fa-solid fa-plus text-xs text-gray-300"></i></a></span>
        </h2>

        {{-- メインカテゴリーの変更 --}}
        <x-confirmation-modal wire:model="isModalMainUpdate">
            <x-slot name="title">
                メインカテゴリーの変更
            </x-slot>
            <x-slot name="content">
                <p>"{{ $nowMainCategory }}"を<br>
                    <input type="text" wire:model.defer="newMainCategory" placeholder="メインカテゴリー名"><br>
                    に変更しますか？
                </p>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('isModalMainUpdate')">
                    キャンセル
                </x-secondary-button>
                <x-danger-button wire:click="mainUpdate({{ $mainId }})">
                    変更
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>

        {{-- メインカテゴリーの削除 --}}
        <x-confirmation-modal wire:model="isModalMainDelete">
            <x-slot name="title">
                メインカテゴリーの削除
            </x-slot>
            <x-slot name="content">
                <p>"{{ $nowMainCategory }}"を<br>
                    削除しますか？<br>
                    このカテゴリー内のサブカテゴリーとテキストも削除されますが宜しいですか？</p>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('isModalMainDelete')">
                    キャンセル
                </x-secondary-button>
                <x-danger-button wire:click="mainDelete({{ $mainId }})">
                    削除
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>

        {{-- サブカテゴリーの追加 --}}
        <x-confirmation-modal wire:model="isModalSubCreate">
            <x-slot name="title">
                サブカテゴリーの追加
            </x-slot>
            <x-slot name="content">
                <input type="text" wire:model.defer="subCate" placeholder="サブカテゴリーを入力">
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('isModalSubCreate')">
                    キャンセル
                </x-secondary-button>
                <x-danger-button wire:click="save({{ $mainId }})">
                    保存
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>

        {{-- サブカテゴリーの表示 --}}
        @foreach ($userSub[$mainId] as $subItemArray)
            @php
                $nowSubId = $subItemArray['id'];
            @endphp
            <p class="mt-0 pt-0 indent-4">{{ $subItemArray['sub'] }}&nbsp;&nbsp;<span><a href="#"
                        wire:click="openModalSubUpdate({{ $nowSubId }})"><i
                            class="fa-solid fa-retweet text-xs text-gray-300"></i></a></span>&nbsp;&nbsp;<span><a
                        href="#" wire:click="openModalSubDelete({{ $nowSubId }})"><i
                            class="fa-solid fa-trash-can text-xs text-gray-300"></i></a></span></p>

            {{-- サブカテゴリーの変更 --}}
            @if ($nowSubId === $currentSub)
                <x-confirmation-modal wire:model="isModalSubUpdate">
                    <x-slot name="title">
                        サブカテゴリーの変更
                    </x-slot>
                    <x-slot name="content">
                        <p>"{{ $subItemArray['sub'] }}"を<br>
                            <input type="text" wire:model.defer="newSubCategory" placeholder="サブカテゴリー名"><br>
                            に変更しますか？
                        </p>
                    </x-slot>
                    <x-slot name="footer">
                        <x-secondary-button wire:click="$toggle('isModalSubUpdate')">
                            キャンセル
                        </x-secondary-button>
                        <x-danger-button wire:click="subUpdate({{ $nowSubId }})">
                            変更
                        </x-danger-button>
                    </x-slot>
                </x-confirmation-modal>
            @endif

            {{-- サブカテゴリーの削除 --}}
            @if ($nowSubId === $currentSub)
                <x-confirmation-modal wire:model="isModalSubDelete">
                    <x-slot name="title">
                        サブカテゴリーの削除
                    </x-slot>
                    <x-slot name="content">
                        <p>"{{ $subItemArray['sub'] }}"を<br>
                            削除しますか？<br>
                            このカテゴリー内のテキストも削除されますが宜しいですか？</p>
                    </x-slot>
                    <x-slot name="footer">
                        <x-secondary-button wire:click="$toggle('isModalSubDelete')">
                            キャンセル
                        </x-secondary-button>
                        <x-danger-button wire:click="subDelete({{ $nowSubId }})">
                            削除
                        </x-danger-button>
                    </x-slot>
                </x-confirmation-modal>
            @endif
        @endforeach

    <!-- 各mainカテゴリーに該当するsubカテゴリーが5個なら、 -->
    @else
        <!-- 各mainカテゴリーを表示し、mainカテゴリーに該当するsubカテゴリーをmainカテゴリ下に表示 -->
        <h2 class="text-lg font-medium mt-3 mb-0 pb-0">{{ $nowMainCategory }}&nbsp;&nbsp;<span>
                <a href="#" wire:click="openModalMainUpdate()"><i
                        class="fa-solid fa-retweet text-xs text-gray-300"></i></a>
            </span>&nbsp;&nbsp;<span><a href="#" wire:click="openModalMainDelete()"><i
                        class="fa-solid fa-trash-can text-xs text-gray-300"></i></a></span>
        </h2>

        {{-- メインカテゴリーの変更 --}}
        <x-confirmation-modal wire:model="isModalMainUpdate">
            <x-slot name="title">
                メインカテゴリーの変更
            </x-slot>
            <x-slot name="content">
                <p>"{{ $nowMainCategory }}"を<br>
                    <input type="text" wire:model.defer="newMainCategory" placeholder="メインカテゴリー名"><br>
                    に変更しますか？
                </p>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('isModalMainUpdate')">
                    キャンセル
                </x-secondary-button>
                <x-danger-button wire:click="mainUpdate({{ $mainId }})">
                    変更
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>

        {{-- メインカテゴリーの削除 --}}
        <x-confirmation-modal wire:model="isModalMainDelete">
            <x-slot name="title">
                メインカテゴリーの削除
            </x-slot>
            <x-slot name="content">
                <p>"{{ $nowMainCategory }}"を<br>
                    削除しますか？<br>
                    このカテゴリー内のサブカテゴリーとテキストも削除されますが宜しいですか？</p>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('isModalMainDelete')">
                    キャンセル
                </x-secondary-button>
                <x-danger-button wire:click="mainDelete({{ $mainId }})">
                    削除
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>

        {{-- サブカテゴリーの表示 --}}
        @foreach ($userSub[$mainId] as $subItemArray)
            @php
                $nowSubId = $subItemArray['id'];
            @endphp
            <p class="mt-0 pt-0 indent-4">{{ $subItemArray['sub'] }}&nbsp;&nbsp;<span><a href="#"
                        wire:click="openModalSubUpdate({{ $nowSubId }})"><i
                            class="fa-solid fa-retweet text-xs text-gray-300"></i></a></span>&nbsp;&nbsp;<span><a
                        href="#" wire:click="openModalSubDelete({{ $nowSubId }})"><i
                            class="fa-solid fa-trash-can text-xs text-gray-300"></i></a></span></p>

            {{-- サブカテゴリーの変更 --}}
            @if ($nowSubId === $currentSub)
                <x-confirmation-modal wire:model="isModalSubUpdate">
                    <x-slot name="title">
                        サブカテゴリーの変更
                    </x-slot>
                    <x-slot name="content">
                        <p>"{{ $subItemArray['sub'] }}"を<br>
                            <input type="text" wire:model.defer="newSubCategory" placeholder="サブカテゴリー名"><br>
                            に変更しますか？
                        </p>
                    </x-slot>
                    <x-slot name="footer">
                        <x-secondary-button wire:click="$toggle('isModalSubUpdate')">
                            キャンセル
                        </x-secondary-button>
                        <x-danger-button wire:click="subUpdate({{ $nowSubId }})">
                            変更
                        </x-danger-button>
                    </x-slot>
                </x-confirmation-modal>
            @endif

            {{-- サブカテゴリーの削除 --}}
            @if ($nowSubId === $currentSub)
                <x-confirmation-modal wire:model="isModalSubDelete">
                    <x-slot name="title">
                        サブカテゴリーの削除
                    </x-slot>
                    <x-slot name="content">
                        <p>"{{ $subItemArray['sub'] }}"を<br>
                            削除しますか？<br>
                            このカテゴリー内のテキストも削除されますが宜しいですか？</p>
                    </x-slot>
                    <x-slot name="footer">
                        <x-secondary-button wire:click="$toggle('isModalSubDelete')">
                            キャンセル
                        </x-secondary-button>
                        <x-danger-button wire:click="subDelete({{ $nowSubId }})">
                            削除
                        </x-danger-button>
                    </x-slot>
                </x-confirmation-modal>
            @endif
        @endforeach
    @endif
</div>
