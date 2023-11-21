<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
    protected $table = 'sub';
    use HasFactory;

    // DBにsaveするときに大量代入するため
    protected $fillable = ['sub', 'main_id'];

    // mainモデルとリレーション
    public function main()
    {
        return $this->belongsTo(Main::class);
    }
}
