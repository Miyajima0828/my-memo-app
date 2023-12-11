<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Sub;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class Search extends Component
{

    public $keyword,$setKeyword, $posts;

    // この部分は編集不要
    public function render()
    {
        if($this->keyword > 0) {
            $this->getKeyword();
        }
        
        return view('livewire.search');
    }
    public function test() {
        // dd($this);
    }

    public function getKeyword() {
        $query = Post::query();
        $userId = Auth::id();
        
        if(filled($this->keyword)) {
            $query
            ->join('main','main.id','=','sub.main_id')
            ->where('user_id','=',"$userId")
            ->whereNull('sub.deleted_at')
            ->where(function($tmp_query){
                $tmp_query->where('sub', 'LIKE', "%{$this->keyword}%")
                ->orWhere('text', 'LIKE', "%{$this->keyword}%")
                ->orWhere('main', 'LIKE', "%{$this->keyword}%");
            });
            $this->posts = $query->get();
        }
        
        // dd($this->keyword);

        
    }
    public function searchReset(){
        $this->setKeyword = $this->keyword;
        $this->reset('keyword');
        // dd($this);
    }
    public function setWord(){
        if($this->setKeyword){
            $this->keyword = $this->setKeyword;
            $this->getKeyword();
            // dd($this);
        }
        
    }
    
    public function onClickUpdate($nowSub)
    {
        $query = Post::query();
        $userId = Auth::id();
        $query
            ->join('main', 'sub.main_id', '=', 'main.id')
            ->where('user_id', '=', "$userId")
            ->where('sub','=', "$nowSub")
            ->update(['updated_at' => Carbon::now()]);

        // $this->dispatch('TabSelect');
        return redirect()->route('dashboard');


    }
}