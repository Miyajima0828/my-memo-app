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
        'TabSelect' => 'tabSelect',
        'saveText'
    ];
    public $userMain, $mainIdArray = [], $userSub;
    public $isCheck, $mainCate, $subCate, $wCheck, $mainId, $currentMainId;
    public $nowSubItemArray, $currentSub, $deleteSubCheck;
    public $nowMainCategory, $deleteMainCheck ,$nowSub;
    public $currentMain;
    public $tabs,$submitText;
    public $checkedKey = 0;
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
    public function saveText(string $nowSub)
    {  
            $userId = Auth::id();
            // dd('aa');
            Sub::
            join('main', 'sub.main_id', '=', 'main.id')
            ->where('user_id', '=', "$userId")
            ->where('sub', '=', "$nowSub")
                ->update([
                    'text' => $this->submitText,
                ]);
        return redirect()->route('dashboard');
            


    }

    public function render(Request $request)
    {
        if (!empty($this->userSub)) {
            $this->tabSelect();
            // dd($this->tabs);
            $this->submitText=$this->tabs[$this->checkedKey]['text'];

        }
        // if ($request->ajax()) {
        //     $this->saveText();
        // }
        return view('livewire.tab');
    }
}
