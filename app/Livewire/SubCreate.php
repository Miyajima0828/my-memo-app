<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Main;
use App\Models\Sub;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

class SubCreate extends Component
{
    public $userMain, $mainIdArray = [], $userSub;
    public $mainCate, $subCate, $mainId, $isModalSubCreate;
    public $isModalSubDelete, $currentSub;
    public $isModalMainDelete;
    public $isModalMainUpdate, $newMainCategory;
    public $isModalSubUpdate, $newSubCategory;

    // Livewireデータを直接アクセス
    public function mount(array $mainIdArray, array $userSub, array $userMain)
    {
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
        Sub::where('id', $nowSubId)
            ->delete();

        return redirect()->route('dashboard');
    }

    // メインカテゴリー削除機能
    public function openModalMainDelete()
    {
        $this->isModalMainDelete = true;
    }

    public function mainDelete($mainId)
    {
        Main::where('id', $mainId)
            ->delete();

        Sub::where('main_id', $mainId)
            ->delete();

        return redirect()->route('dashboard');
    }

    // メインカテゴリー変更機能
    public function openModalMainUpdate()
    {
        $this->isModalMainUpdate = true;
    }

    public function mainUpdate($mainId)
    {
        $mainRecord = Main::find($mainId);
        $mainRecord->update(['main' => $this->newMainCategory]);

        return redirect()->route('dashboard');
    }

    // サブカテゴリーの変更機能
    public function openModalSubUpdate($nowSubId)
    {
        $this->isModalSubUpdate = true;
        $this->currentSub = $nowSubId;
    }

    public function subUpdate($nowSubId)
    {
        $subRecord = Sub::find($nowSubId);
        $subRecord->update(['sub' => $this->newSubCategory]);

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.sub-create');
    }
}
