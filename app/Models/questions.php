<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class questions extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function grades()
    {
        return $this->belongsTo(Grades::class , 'grade_id');
    }

    public function classes()
    {
        return $this->belongsTo(classes::class , 'class_id');
    }

    public function sections()
    {
        return $this->belongsTo(sections::class , 'section_id');
    }

    public function subjects()
    {
        return $this->belongsTo(subjects::class , 'subject_id');
    }
    public function unites()
    {
        return $this->belongsTo(unite::class , 'unite_id');
    }

    public function exams()
    {
        return $this->belongsToMany(Exams::class , 'exams_questions');
    }

    public static function rand_qu_by_sub($id){
        $questions = questions::where('subject_id' , $id)->inRandomOrder()->limit(10)->get();
        return $questions;
    }

    public static function rand_qu_by_unite($id){
        $questions = questions::where('unite_id' , $id)->inRandomOrder()->limit(10)->get();
        return $questions;
    }

    public static function sear_by_uId($un_id , $search_val)
    {
        $questions = questions::where('unite_id' , $un_id)
                                ->where('question','like' , '%'.$search_val.'%')->get();
        return $questions;
    }
    public static function sear_by_subId($sub_id , $search_val)
    {
        $questions = questions::where('subject_id' , $sub_id)
                                ->where('question','like' , '%'.$search_val.'%')->get();
        return $questions;
    }


}
