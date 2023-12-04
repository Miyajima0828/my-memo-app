<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Main extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'main';
    use HasFactory;

    // DBにsaveするときに大量代入するため
    protected $fillable = ['main', 'user_id'];


    // userモデルとリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // subモデルとリレーション
    public function subs()
    {
        return $this->hasMany(Sub::class);
    }
}
