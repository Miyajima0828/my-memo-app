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


            if (!empty($this->mainCate) && !empty($this->subCate)) {
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
        }



        $this->isCheck = false;



        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.maincategory');
    }
}
