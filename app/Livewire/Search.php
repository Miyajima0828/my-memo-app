<?php
namespace App\Livewire;

use App\Models\Main;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Sub;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class Search extends Component
{
    protected $listeners = [
        'getKeyword'
    ];
    public $keyword,$setKeyword, $posts;

    // この部分は編集不要
    public function render()
    {
        if($this->keyword > 0) {
            $this->getKeyword();
        }
        
        return view('livewire.search');
    }

    public function getKeyword() {
        $query = Main::query();
        $userId = Auth::id();
        
        if(filled($this->keyword)) {
            $query
            ->join('sub','main.id','=','main_id')
            ->where('user_id','=',"$userId")
            ->whereNull('sub.deleted_at')
            ->where(function($tmp_query){
                $tmp_query->where('sub', 'LIKE', "%{$this->keyword}%")
                ->orWhere('text', 'LIKE', "%{$this->keyword}%")
                ->orWhere('main', 'LIKE', "%{$this->keyword}%");
            });
            $this->posts = $query->get();
        }
        

        
    }
    public function searchReset(){
        $this->setKeyword = $this->keyword;
        $this->reset('keyword');
    }
    public function setWord(){
        if($this->setKeyword){
            $this->keyword = $this->setKeyword;
            $this->getKeyword();
        }
        
    }
    
    public function onClickUpdate($nowSubId,$nowSub)
    {
        $query = Sub::query();
        $userId = Auth::id();


        $query
            ->join('main', 'main.id', '=', 'sub.main_id')
            ->where('user_id', '=', "$userId")
            ->where('sub.id','=',"$nowSubId")
            ->where('sub','=', "$nowSub")
            ->update(['updated_at' => Carbon::now()]);

        return redirect()->route('dashboard');


    }
}