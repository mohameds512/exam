<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class sections extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $translatable = ['name'];
    protected $guarded = [];

    public function grades()
    {
        return $this->belongsTo(Grades::class , 'grade_id');
    }
    public function classes()
    {
        return $this->belongsTo(classes::class , 'class_id');
    }

    public function subjects()
    {
        return $this->hasMany(subjects::class , 'section_id');
    }
}
