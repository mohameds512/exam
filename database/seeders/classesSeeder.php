<?php

namespace Database\Seeders;

use App\Models\classes;
use App\Models\Grades;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class classesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->delete();

        $grades = Grades::get('id');
        $classes = [
            ['ar' => 'الصف الاول' , 'en'=> 'first Year'],
            ['ar' => 'الصف الثاني' , 'en'=> 'second Year'],
            ['ar' => 'الصف الثالث' , 'en'=> 'Third Year'],
        ];

        foreach ($grades as $grade) {
            foreach ($classes as $class) {
                classes::create([
                    'name'=> $class,
                    'grade_id' => $grade->id,
                    'academic_year'=>'2021|2022',
                ]);
            }
        }
    }
}
