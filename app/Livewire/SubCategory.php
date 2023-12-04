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
    public $isCheck, $mainCate, $subCate, $wCheck, $mainId, $currentMainId;
    public $nowSubItemArray, $currentSub, $deleteSubCheck;
    public $nowMainCategory, $deleteMainCheck, $nowSubId;
    public $currentMain;

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

    public function deleteSubCategory($nowSubId)
    {
        $this->deleteSubCheck = true;
        $this->currentSub = $nowSubId;
    }

    public function deleteSub($nowSubId)
    {
        Sub::where('id', $nowSubId)
        ->delete();

        $this->deleteSubCheck = false;

        return redirect()->route('dashboard');
    }

    public function deleteMainCategory($mainId)
    {
        $this->deleteMainCheck = true;
        $this->currentMain = $mainId;
    }

    public function deleteMain($mainId)
    {
        Main::where('id', $mainId)
        ->delete();

        Sub::where('main_id', $mainId)
        ->delete();

        $this->deleteMainCheck = false;

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.subcategory');
    }
}
