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

    public $keyword, $posts;

    // この部分は編集不要
    public function render()
    {
        if($this->keyword > 0) {
            $this->getKeyword();
        }
        return view('livewire.search');
    }

    public function getKeyword() {
        $query = Post::query();
        $userId = Auth::id();

        if(!empty($this->keyword)) {
            $query
            ->join('main','sub.main_id','=','main.id')
            ->where('user_id','=',"$userId")
            ->where('sub.deleted_at','=',null)
            ->where(function($tmp_query){
                $tmp_query->where('sub', 'LIKE', "%{$this->keyword}%")
                ->orWhere('text', 'LIKE', "%{$this->keyword}%");
            });
        }
        
        $this->posts = $query->get();
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
}