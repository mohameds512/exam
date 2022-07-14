<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grades extends Model
{
    use HasTranslations;
    public $translatable = ['name', 'notes'];

    protected $guarded = [] ;

    public function classes()
    {
        return $this->hasMany(classes::class , 'grade_id' );
    }
    public function exams( )
    {
        return $this->hasMany(exams::class , 'grade_id') ;
    }
}
