<?php

namespace Database\Seeders;

use App\Models\classes;
use App\Models\Exams;
use App\Models\Grades;
use App\Models\sections;
use App\Models\subjects;
use App\Models\unite;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exams')->delete();
        $user = User::first();
        $section  = sections::first();
        $class  = classes::first();
        $grade  = Grades::first();
        $subject  = subjects::first();
        $unite = unite::first();
        Exams::create([
            'name' => 'first Exam',
            'notes' => 'first Exam note',
            'status' => 1 ,
            'grade_id' => $grade->id,
            'class_id' => $class->id,
            'section_id' => $section->id,
            'subject_id' => $subject->id,
            'unite_id' => $unite->id,
            'duration' => 20 ,
            'teacher_id' => $user->id ,

        ]);
    }
}
