<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Main;
use App\Models\Sub;
use Illuminate\Queue\Listener;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

class MainCreate extends Component
{
    public $mainCate, $subCate;
    // public $mainIdArray, $userSub, $userMain; 
    public $isModal;

    // protected $listeners = ['openModal']; 

    public function openModal()
    {
        $this->isModal = true;
    }

    public function save()
    {
        // 現在ログインしているユーザーのIDを取得
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
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.main-create');
    }
}
