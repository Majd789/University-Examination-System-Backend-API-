<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'body',
        'image',
    ];
    public function user() {

        return $this->belongsTo(user::class ,'user_id','id' );

    }
}
