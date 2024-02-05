<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_course';

    protected $fillable =[
        'id_course',
        'name',
        'chapter',
        'year_related'
    ];

    public function grades (){
        return $this->hasMany(Grades::class );
    }
}
