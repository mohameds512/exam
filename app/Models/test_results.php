<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class test_results extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = [ 're_status' ];

    public function getReStatusAttribute( )
    {

        if ($this->result_status == 0 ) {
            return trans('exams_trans.fail');
        }else{
            return trans('exams_trans.succeed');
        }
    }

    public function teacher()
    {
        return $this->belongsTo(User::class , 'teacher_id');
    }
    public function exam()
    {
        return $this->belongsTo(Exams::class , 'exam_id');
    }

    public function student()
    {
        return $this->hasMany(User::class , 'stud_id');
    }
}
