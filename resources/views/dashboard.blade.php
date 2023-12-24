<x-app-layout>
    <!-- 画面上部分 -->
    <div class="flex items-center h-16 mr-16">
        <div class="basis-1/5">
            @include('navigation-menu',['mainIdArray' => $mainIdArray, 'userSub' => $userSub, 'userMain' => $userMain])
        </div>

        <header class="bg-white text-right basis-4/5">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 relative">
                @livewire('search')
            </div>
        </header>

    </div>


    <!-- 画面下部分 -->
    <div class="flex justify-between">
        <div style="width: 17vw;padding-left:2vw;" class="max-lg:hidden">
            @livewire('category-side', ['mainIdArray' => $mainIdArray, 'userSub' => $userSub, 'userMain' => $userMain])
        </div>
        @livewire('tab', ['mainIdArray' => $mainIdArray, 'userSub' => $userSub, 'userMain' => $userMain])
    </div>
</x-app-layout>