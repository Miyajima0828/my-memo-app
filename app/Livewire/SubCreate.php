<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Main;
use App\Models\Sub;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

class SubCreate extends Component
{
    // public $isCheck, $wCheck, $currentMainId;
    public $userMain, $mainIdArray = [], $userSub;
    public $mainCate, $subCate, $mainId, $isModalSubCreate;

    public $isModalSubDelete;

    public $isModalMainDelete;

    // public $nowSubItemArray, $deleteSubCheck;
    public $nowMainCategory, $deleteMainCheck, $nowSubId;

    public $currentMain;
    public $updateMainCheck, $newMainCategory;
    public $updateSubCheck, $newSubCategory;
    public $currentSub;

    public function mount(array $mainIdArray, array $userSub, array $userMain)
    {
        // Livewireデータを直接アクセス
        $this->userMain = $userMain;
        $this->mainIdArray = $mainIdArray;
        $this->userSub = $userSub;
    }

    // サブカテゴリー追加機能
    public function openModalSubCreate()
    {
        $this->isModalSubCreate = true;
    }
    public function save($mainId)
    {
        $userId = Auth::id();

        Sub::create([
            'sub' => $this->subCate,
            'main_id' => $mainId,
        ]);

        return redirect()->route('dashboard');
    }

    // サブカテゴリー削除機能
    public function openModalSubDelete($nowSubId)
    {
        $this->isModalSubDelete = true;
        $this->currentSub = $nowSubId;
    }
    public function subDelete($nowSubId)
    {
        $this->currentSub = $nowSubId;

        Sub::where('id', $nowSubId)
            ->delete();

        return redirect()->route('dashboard');
    }

    // メインカテゴリー削除機能
    public function openModalMainDelete()
    {
        $this->isModalMainDelete = true;
    }

    public function deleteMain($mainId)
    {
        Main::where('id', $mainId)
            ->delete();

        Sub::where('main_id', $mainId)
            ->delete();

        // $this->deleteMainCheck = false;

        return redirect()->route('dashboard');
    }

    public function updateMainCategory()
    {
        $this->updateMainCheck = true;
    }

    public function updateMain($mainId)
    {
        $mainRecord = Main::find($mainId);
        $mainRecord->update(['main' => $this->newMainCategory]);

        $this->updateMainCheck = false;

        return redirect()->route('dashboard');
    }

    public function updateSubCategory($nowSubId)
    {
        $this->updateSubCheck = true;
        $this->currentSub = $nowSubId;
    }

    public function updateSub($nowSubId)
    {
        $subRecord = Sub::find($nowSubId);
        $subRecord->update(['sub' => $this->newSubCategory]);

        $this->updateSubCheck = false;

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.sub-create');
    }
}
