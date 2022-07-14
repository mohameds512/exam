<?php

namespace Database\Seeders;

use App\Models\classes;
use App\Models\Grades;
use App\Models\sections;
use App\Models\subjects;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class subjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->delete();
        $grades = Grades::get('id');
        // $classes = classes::get('id');
        $sections = sections::all();

        $subjects = [
            ['ar'=> 'اللغة العربية', 'en'=>'Arabic'],
            ['ar'=> 'اللغة الانجليزية ', 'en'=>'English'],
            ['ar'=> 'اللغةالفرنسية', 'en'=>'French language'],
            ['ar'=> 'اللغه الالمانية', 'en'=>'German language'],
            ['ar'=> 'الفزياء', 'en'=>'Physics'],
            ['ar'=> 'الكمياء', 'en'=>'chemistry'],
            ['ar'=> 'الفلسفة و المنطق', 'en'=>'Philosophy and Logic'],
            ['ar'=> 'الاحياء', 'en'=>'Biology'],
            ['ar'=> 'الجولوجيا', 'en'=>'geology'],
            ['ar'=> 'الرياضيات البحته', 'en'=>'pure mathematics'],
            ['ar'=> 'الرياضيات التطبيقيه', 'en'=>'Applied Mathematics'],
            ['ar'=> 'علم النفس', 'en'=>'psychology'],
            ['ar'=> 'التربيه الدينيه', 'en'=>'Religious Education'],
            ['ar'=> 'التربيه القوميه', 'en'=>'National Education'],
            ['ar'=> 'الاحصاء و الاقتصاد', 'en'=>'Statistics and economics'],
        ];


        foreach ($sections as $section) {
            foreach ($subjects as $subject) {
                subjects::create([
                    'name'=> $subject,
                    'class_id' => $section->classes->id,
                    'grade_id' => $section->grades->id,
                    'section_id' => $section->id,
                ]);
            }
        }



    }
}
