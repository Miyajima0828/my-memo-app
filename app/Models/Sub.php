<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sub extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'sub';
    use HasFactory;

    // DBにsaveするときに大量代入するため
    protected $fillable = ['sub', 'main_id' ,'text'];

    // mainモデルとリレーション
    public function main()
    {
        return $this->belongsTo(Main::class);
    }
}
