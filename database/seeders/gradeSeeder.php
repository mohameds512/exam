<?php

namespace Database\Seeders;

use App\Models\Grades;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class gradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->delete();

        Grades::create([
            'name' => ['ar'=>'المرحلة الثانوية' , 'en'=> 'Hight School'],
            'notes' => ['ar'=>'المرحلة الثانوية' , 'en'=> 'Hight School']
        ]);

    }
}
