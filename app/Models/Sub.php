<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
    protected $table = 'sub';
    use HasFactory;

    // mainモデルとリレーション
    public function main()
    {
        return $this->belongsTo(Main::class);
    }
}
