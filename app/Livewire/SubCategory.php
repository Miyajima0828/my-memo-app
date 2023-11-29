<?php

namespace App\Livewire;

use Livewire\Component;

class SubCategory extends Component
{
    public $userMain, $mainIdArray = [], $userSub;

    public $listeners = [
        'refresh' => '$refresh'
    ];

    // public function __construct($id = null)
    // {
    //     parent::__construct($id);

    //     // $this->livewire プロパティを使用して Livewire データにアクセスできます
    //     $userMain = $this->livewire('userMain');
    //     $mainIdArray = $this->livewire('mainIdArray');
    //     $userSub = $this->livewire('userSub');

    //     $this->userMain = $userMain;
    //     $this->mainIdArray = $mainIdArray;
    //     $this->userSub = $userSub;
    // }

    // public function mount()
    // {
    //     // $this->livewire プロパティを使用して Livewire データにアクセスできます
    //     $this->userMain = $this->livewire('userMain');
    //     $this->mainIdArray = $this->livewire('mainIdArray');
    //     $this->userSub = $this->livewire('userSub');
    // }

    public function mount(array $mainIdArray, array $userSub, array $userMain)
    {
        // Livewireデータを直接アクセス
        $this->userMain = $userMain;
        $this->mainIdArray = $mainIdArray;
        $this->userSub = $userSub;
    }

    public function render()
    {
        return view('livewire.subcategory');
    }


}
