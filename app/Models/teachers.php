<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teachers extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function specialists()
    {
        return $this->belongsTo(specialist::class,'specialist_id');
    }
}
