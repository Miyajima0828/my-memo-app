<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Main;
use App\Models\Sub;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

class SubCategory extends Component
{
    public $userMain, $mainIdArray = [], $userSub;
    public $isCheck, $mainCate, $subCate, $wCheck;
    public $mainId;
    public $currentMainId;

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

    public function input($mainId)
    {
        $this->isCheck = true;
        $this->currentMainId = $mainId;
    }

    public function save($mainId)
    {
        $this->wCheck = true;
        $this->currentMainId = $mainId;
    }

    public function saveToDatabase()
    {
        // 現在ログインしているユーザーのIDを取得
        if ($this->isCheck) {
            $userId = Auth::id();

            Sub::create([
                'sub' => $this->subCate,
                'main_id' => $this->currentMainId,
            ]);
        }

        $this->isCheck = false;

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.subcategory');
    }
}
