<?php

namespace Database\Seeders;

use App\Models\classes;
use App\Models\Grades;
use App\Models\questions;
use App\Models\sections;
use App\Models\subjects;
use App\Models\unite;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class questionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->delete();

        $grade = Grades::first();
        $section = sections::first();
        $class = classes::first();
        $subject = subjects::first();

        $user = User::first();
        $unites = unite::all();
        foreach ($unites as $unite) {
            questions::create([
                'question' => 'اين ولد الرسول عليه الصلاة و أتم التسليم ',
                'answers' => 'مصر , مكه , الامارات',
                'right_answer' => 'مكه',
                'pending'=>true,
                'teacher_id' => $user->id,
                'grade_id' => $grade->id,
                'class_id' => $class->id,
                'section_id' => $section->id,
                'subject_id' => $subject->id,
                'unite_id' => $unite->id,
            ]);
        }

    }
}
