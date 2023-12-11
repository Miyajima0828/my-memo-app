<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Main;
use App\Models\Sub;
use Illuminate\Support\Facades\Auth;
// use Livewire\Livewire;
use App\Livewire\Tab;
use Carbon\Carbon;

class SubCategory extends Component
{
    public $userMain, $mainIdArray = [], $userSub;
    public $isCheck, $mainCate, $subCate, $wCheck, $mainId, $currentMainId;
    public $nowSubItemArray, $currentSub, $deleteSubCheck;
    public $nowMainCategory, $deleteMainCheck, $nowSubId;
    public $currentMain;
    public $updateMainCheck, $newMainCategory;
    public $updateSubCheck, $newSubCategory;

    protected $listeners = [
        'onClickUpdate'
    ];
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
                'text' => ''
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

    public function deleteMainCategory()
    {
        $this->deleteMainCheck = true;
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
    public function onClickUpdate($nowSub)
    {
        $query = Sub::query();
        $userId = Auth::id();
        $query
            ->join('main', 'sub.main_id', '=', 'main.id')
            ->where('user_id', '=', "$userId")
            ->where('sub','=', "$nowSub")
            ->update(['updated_at' => Carbon::now()]);

        // $this->dispatch('TabSelect');
        return redirect()->route('dashboard');


    }
    public function render()
    {
        // dd($this);

        return view('livewire.subcategory');
    }
}
