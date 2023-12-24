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

        // ログインしているユーザーのmainデータ取得
        // Userモデルから$idに該当するレコードを取得
        $userIdRecords = User::find($userId);
        // 取得したUserモデルに関連するMainカラムのデータを配列として取得
        if ($userIdRecords) {
            $userMain = $userIdRecords->mains()->pluck('main')->toArray();
        }

        // ログインしているユーザーのsubデータを取得
        // Mainモデルから$idに該当するレコードを取得      
        $mainIdRecords = Main::where('user_id', $userId)->get();
        // $mainIdRecordからMainモデルのidを取得
        $mainIds = $mainIdRecords->pluck('id')->toArray();
        // Subモデルからsubカラムを$userSub[]=[ユーザーが持つ1番目のmain_idの値、ユーザーが持つ2番目の・・・]として取得
        $mainIdArray = [];
        $userSub = [];
        $testCount = [];
        foreach ($mainIds as $mainId) {
            $mainIdArray[] = $mainId;
            $userSub[$mainId] = Sub::where('main_id', $mainId)->get()->toArray();
            $testCount[$mainId] = count($userSub[$mainId]);
        }
        
        return view('dashboard', compact('userMain', 'mainIdArray', 'userSub'));
       
    }

}
