<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Main;
use App\Models\Sub;
use Illuminate\Support\Facades\Auth;

class MainCategory extends Component
{
    // protected $listeners = [
    //     'show'
    // ];
    public $isCheck, $main, $sub;

    public function render()
    {
        return view('livewire.maincategory');
    }

    public function input()
    {
        $this->isCheck = true;
    }

    public function saveToDatabase()
    {
        // 現在ログインしているユーザーのIDを取得
        $userId = Auth::id();

        $mainCreate = Main::create([
        'main' => $this->main,
        'user_id' => $userId,
        ]);

        Sub::create([
        'sub' => $this->sub,
        'main_id' => $mainCreate->id,
    ]);
    
        // 変数をクリアする（任意）
        $this->main = '';
        $this->sub = '';

        // 保存後の処理を追加する（任意）
        $refresh;
    }
}
