<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    protected $table = 'main';
    use HasFactory;

    // userモデルとリレーション
    public function user()
    {
        return $this -> belongsTo(user::class);
    }

    // subモデルとリレーション
    public function subs()
    {
        return $this->hasMany(Sub::class);
    }
}
