<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Main;
use App\Models\Sub;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;




class Tab extends Component
{
    protected $listeners = [
        'TabSelect' => 'tabSelect'
    ];
    public $userMain, $mainIdArray = [], $userSub;
    public $isCheck, $mainCate, $subCate, $wCheck, $mainId, $currentMainId;
    public $nowSubItemArray, $currentSub, $deleteSubCheck;
    public $nowMainCategory, $deleteMainCheck, $nowSubId;
    public $currentMain;
    public $tabs,$text;
    public function mount(array $mainIdArray, array $userSub, array $userMain)
    {
        // Livewireデータを直接アクセス
        $this->userMain = $userMain;
        $this->mainIdArray = $mainIdArray;
        $this->userSub = $userSub;
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

    public function tabSelect()
    {
        $query = Sub::query();
        $userId = Auth::id();
        $cnt = 0;
        foreach ($this->userSub as $array) {
            foreach ($array as $data) {
                $cnt++;
            }
        }
        if (!empty($this->userSub)) {
            $query
                ->join('main', 'sub.main_id', '=', 'main.id')
                ->where('user_id', '=', "$userId")
                ->when($cnt >= 5, function ($tmp_query) {
                    $tmp_query
                        ->orderBy('sub.updated_at', 'desc')
                        ->take(5);
                }, function ($tmp_query) {
                $tmp_query
                    ->orderBy('sub.updated_at', 'desc');
            });

        }

        $tabs = $query->get()->toArray();
        $this->tabs = $tabs;
        // dd($this->userSub);
        // dd($tabs);

    }
    public function saveText()
    {
        
            Sub::where('id', '=', '$nowSubId')
                ->uptate([
                    'text' => $this->text,
                ]);
            dd($this);


    }

    public function render(Request $request)
    {
        if (!empty($this->userSub)) {
            $this->tabSelect();
        }
        // if ($request->ajax()) {
        //     $this->saveText();
        // }
        return view('livewire.tab');
    }
}
