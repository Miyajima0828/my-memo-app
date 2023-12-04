<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

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
            ->where('sub', 'LIKE', "%{$this->keyword}%")
                ->orWhere('text', 'LIKE', "%{$this->keyword}%");
        }

        $this->posts = $query->get();

    }
}