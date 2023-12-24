<?php

namespace App\Livewire;

use Livewire\Component;

class CategorySide extends Component
{
    public $userMain, $mainIdArray = [], $userSub;
    public function mount(array $mainIdArray, array $userSub, array $userMain)
    {
        // Livewireデータを直接アクセス
        $this->userMain = $userMain;
        $this->mainIdArray = $mainIdArray;
        $this->userSub = $userSub;
    }
    public function render()
    {
        return view('livewire.category-side');
    }
}
