<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Search extends Component
{

    // public $text;

    // public function __construct($text)
    // {

    //     $this->text = $text;
    // }

    // この部分は編集不要
    public function render()
    {
        return view('components.search');
    }
}