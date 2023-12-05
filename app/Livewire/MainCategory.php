<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Main;
use App\Models\Sub;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

class MainCategory extends Component
{
    public $isCheck, $mainCate, $subCate, $wCheck;
    public $mainIdArray, $userSub, $userMain;

    public function input()
    {
        $this->isCheck = true;
    }

    public function save()
    {
        $this->wCheck = true;
    }

    public function saveToDatabase()
    {
        // 現在ログインしているユーザーのIDを取得
        if ($this->isCheck) {
            $userId = Auth::id();


            $mainCreate =
                Main::create([
                    'user_id' => $userId,
                    'main' => $this->mainCate,
                ]);

            Sub::create([
                'sub' => $this->subCate,
                'main_id' => $mainCreate->id,
            ]);
        }

        // TODO データベースに挿入後、Livewireのステートを更新
        // $this->emitTo('subcategory', 'refresh');

        // Livewireのステートを更新
        // $this->setName('refresh');

        // JavaScriptイベントを発火して非同期通信が完了したことを通知
        // $this->dispatch('database-save-complete');

        // 変数をクリアする（任意）
        // $this->reset(['mainCate', 'subCate', 'isCheck', 'wCheck']);

        $this->isCheck = false;

        // $this->main = '';
        // $this->sub = '';
        // $mainCreate = '';
        // $userId = '';

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.maincategory');
    }
}
