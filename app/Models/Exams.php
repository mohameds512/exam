<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Exams extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function grades( )
    {
        return $this->belongsTo(Grades::class , 'grade_id');
    }
    public function class( )
    {
        return $this->belongsTo(classes::class , 'class_id');
    }
    public function sections( )
    {
        return $this->belongsTo(sections::class , 'section_id');
    }
    public function subjects( )
    {
        return $this->belongsTo(subjects::class , 'subject_id');
    }
    public function unites( )
    {
        return $this->belongsTo(unite::class , 'unite_id');
    }
    public function questions()
    {
        return $this->belongsToMany(questions::class , 'exams_questions');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class , 'teacher_id');
    }


    public static function rand_ex_by_sub($id){
        $exams = Exams::where('subject_id' , $id)->paginate(10);
        return $exams;
    }

    public static function rand_ex_by_unite($id){
        $exams = Exams::where('unite_id' , $id)->inRandomOrder()->limit(10)->get();
        return $exams;
    }

    public static function sear_by_uId ($unite_id, $search_val,$perpage){

        $exams = Exams::where('unite_id' , $unite_id)
                        ->where('name','like' , '%'.$search_val.'%')->paginate($perpage);

        return $exams;
    }

    public static function sear_by_subId ($subject_id, $search_val , $perpage){

        $exams = Exams::where('subject_id' , $subject_id)
                        ->where('name','like' , '%'.$search_val.'%')->paginate($perpage);

        return $exams;
    }

}
