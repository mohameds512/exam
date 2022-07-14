<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class specialist extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $translatable = ['name','notes'];

    protected $guarded = [];
}
