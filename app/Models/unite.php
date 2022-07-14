<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class unite extends Model
{
    use HasFactory;

    use HasTranslations;
    public $translatable = ['name','note'];

    protected $guarded = [];

    public function subjects()
    {
        return $this->belongsTo(subjects::class, 'subjects_id');
    }

    public function questions()
    {
        return $this->hasMany(questions::class , 'unite_id');
    }
}
