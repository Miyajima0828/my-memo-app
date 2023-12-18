<x-app-layout>
    <!-- 画面上部分 -->
    <x-slot name="header">
        @livewire('search')
    </x-slot>

    <!-- 画面下部分 -->
    <div class="flex justify-between">
        <div style="width: 17vw; padding-left:2vw;" class="max-sm:hidden">
            @php
            $userMainCount = count($userMain)
            @endphp

            <!-- もしユーザーがDBにmain_idをcount=5持っていたら -->
            @if ($userMainCount == 5)
            @foreach ($mainIdArray as $mainId)
            @livewire('sub-create', ['mainIdArray' => $mainIdArray, 'userSub' => $userSub, 'userMain' => $userMain,
            'mainId' => $mainId])
            @endforeach

            <!-- もしユーザーがmain_idをcount=1～4持っていたら -->
            @elseif ($userMainCount >= 1 && 4 >= $userMainCount)
            @livewire('main-create')

            <div>
                @foreach ($mainIdArray as $mainId)
                @livewire('sub-create', ['mainIdArray' => $mainIdArray, 'userSub' => $userSub, 'userMain' =>
                $userMain, 'mainId' => $mainId])
                @endforeach
            </div>

            <!-- もしユーザーがmain_idをcount=0持っていたら -->
            @elseif ($userMainCount == 0)
            @livewire('main-create')
            @endif
            @livewire('navigation-menu', ['mainIdArray' => $mainIdArray, 'userSub' => $userSub, 'userMain' => $userMain,
            'mainId' => $mainId])
        </div>
        @livewire('tab', ['mainIdArray' => $mainIdArray, 'userSub' => $userSub, 'userMain' => $userMain])
    </div>

</x-app-layout>
