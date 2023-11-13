<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sub;
use App\Models\User;
use App\Models\Main;

class AppController extends Controller
{
    // 特定のユーザーに関連つけられたレコード取得
    public function getAll()
    {
        // ログインしているユーザーのIDを取得
        $userId = auth()->user()->id;
       
        // Userモデルから$userIdに該当するレコードを取得
        $user = User::find($userId);

        // $userが存在する場合にのみ処理を続行
        if ($user) {
            // 取得したUserモデルに関連するMainカラムのデータを取得
            $userMain = $user->mains()->pluck('main')->toArray();
        }

        // ログインしているuserのSubデータを取得
        $test = Main::find(1);
        foreach($test->subs as $data) {
            dd($data->sub);
        }




        // // Userモデルを使って、ログインしているユーザーに関連するMainカラムのデータを取得
        // $user = User::with(['mains' => function ($query) {
        //     // Mainモデルの中から取得したいカラムを指定
        //     $query->select('main');
        // }])->find($userId);


        // // ログインしているユーザーに関連するMainカラムのデータを取得
        // $userMain = $user->mains;

        // $user = User::with('mains')->find($userId);
        // $userMain = $user->all('main');

        // Mainモデルを使って、$userMainに該当するsubの全データを取得

        // dd($userMain);
        return view('components.categories', compact('userMain'));
    }

    // とりあえず、生のモデルから変数としてひっぱる
    public function getTest()
    {
        $texts = Sub::all('text');
        $user = User::all();
        // $texts = Text::select('text')->get();
        dd($texts);
        return view('layouts.app', compact('texts', 'user'));
    }
}
