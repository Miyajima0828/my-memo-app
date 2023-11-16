<x-app-layout>
    <!-- 画面上部分 -->
    <x-slot name="header">
        <x-search></x-search>
    </x-slot>

    <!-- 画面下部分 -->
    <div class="flex ">

        <x-categories>
            
        </x-categories>
        <x-tab>
        </x-tab>
    </div>
    <!-- <div class="py-12">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div> -->
</x-app-layout>