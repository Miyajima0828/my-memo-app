<?php

namespace App\Livewire;

use Livewire\Component;

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

    public function handleMouseOut()
    {
        
    }
}
