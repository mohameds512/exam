<?php

namespace Database\Seeders;

use App\Models\classes;
use App\Models\Grades;
use App\Models\sections;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class sectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();

        $grades = Grades::get('id');
        $classes = classes::get('id');
        $sections = [
            ['ar' => 'الفصل الاول' , 'en'=> 'first section'],
            ['ar' => 'الفصل الثاني' , 'en'=> 'second section'],
        ];

        foreach ($grades as $grade) {
            foreach ($classes as $class) {
                foreach ($sections as $section) {
                    sections::create([
                        'name' => $section,
                        'grade_id' => $grade->id,
                        'class_id' => $class->id
                    ]);
                }
            }
        }
    }
}
