<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Main;
use App\Models\Sub;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

class MainCategory extends Component
{
    // protected $listeners = [
    //     'show'
    // ];
    public $isCheck, $main, $sub, $wCheck, $emit;

    public function render()
    {
        return view('livewire.maincategory');
    }

    public function input()
    {
        $this->isCheck = true;
    }

    public function save()
    {
        $this->wCheck = true;
    }
        public function saveToDatabase()
    {    // 現在ログインしているユーザーのIDを取得
        $userId = Auth::id();

        $mainCreate = Main::create([
            'main' => $this->main,
            'user_id' => $userId,
        ]);

        Sub::create([
            'sub' => $this->sub,
            'main_id' => $mainCreate->id,
        ]);

        // TODO データベースに挿入後、Livewireのステートを更新
        $this->emitTo('subcategory', 'refresh');

        // 変数をクリアする（任意）
        $this->main = '';
        $this->sub = '';

    }
}
