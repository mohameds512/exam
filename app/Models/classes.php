<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class classes extends Model
{
    use HasFactory;

    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded = [];

    public function grades()
    {
        return $this->belongsTo(Grades::class , 'grade_id');
    }

    public function subjects()
    {
        return $this->hasManyThrough(subjects::class , sections::class , 'class_id' , 'section_id' , 'id' , 'id');
    }

    public function sections()
    {
        return $this->hasMany(sections::class , 'class_id');
    }

}
