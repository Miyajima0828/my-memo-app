<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sub;

class TabController extends Controller
{
    //
    public function reorder(Request $request)
    {
        $userId = auth()->user()->id;

        $tabs = Sub::all();

        foreach ($tabs as $tab) {
            $tab->order = $request->order[$tab->id];
            $tab->save();
        }
        
        return view('並び順を変更しました！', 200);
    }
}
