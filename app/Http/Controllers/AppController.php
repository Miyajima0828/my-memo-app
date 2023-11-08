<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Text;

class AppController extends Controller
{
    // // 特定のユーザーに関連つけられたMainの全レコード取得
    // public function getUserMainData($userId)
    // {
    //     $user = User::find($userId);

    //     if ($user) {
    //         $mainRecords = $user->main;
    //         $mainData = $mainRecords -> pluck('main') -> all();
    //         return view('layouts.app', ['mainData' => $mainData]);
    //     } else {
    //         // ユーザーが見つからない場合の処理
    //         return view('errors.user_not_found');
    //     }
    // }

    // とりあえず、生のモデルから変数としてひっぱる
    public function getAllTexts()
    {
        $texts = Text::all('text');

        return view('layouts.app', ['texts'=>$texts]);
    }
}
