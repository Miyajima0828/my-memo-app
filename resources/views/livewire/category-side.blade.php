<div>
    @php
    $userMainCount = count($userMain)
    @endphp

    <!-- もしユーザーがDBにmain_idをcount=5持っていたら -->
    @if ($userMainCount >= 5)
    <div>
        @foreach ($mainIdArray as $mainId)
        @livewire('sub-create', ['mainIdArray' => $mainIdArray, 'userSub' => $userSub, 'userMain' => $userMain,
        'mainId' => $mainId])
        @endforeach
    </div>

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

</div>