<?php

namespace Database\Seeders;

use App\Models\subjects;
use App\Models\unite;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class uniteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unites')->delete();

        $unites = [
            ['ar' => 'الوحدة الاولي' , 'en' => ' unite 1'],
            ['ar' => 'الوحدة الثانية' , 'en' => ' unite 2'],
            ['ar' => 'الوحدة الثالثة' , 'en' => ' unite 3'],
            ['ar' => 'الوحدة الرابعة' , 'en' => ' unite 4'],
            ['ar' => 'الوحدة الخامسة' , 'en' => ' unite 5'],
            ['ar' => 'الوحدة السادسة' , 'en' => ' unite 6'],
            ['ar' => 'الوحدة السابعة' , 'en' => ' unite 7'],
            ['ar' => 'الوحدة الثامنة' , 'en' => ' unite 8'],
            ['ar' => 'الوحدة التاسعة' , 'en' => ' unite 9'],
            ['ar' => 'الوحدة العاشرة' , 'en' => ' unite 10'],
            ['ar' => 'الوحدة الحادية عشر' , 'en' => ' unite 11'],
            ['ar' => 'الوحدة الثانية عشر' , 'en' => ' unite 12'],
        ];

        $subjects = subjects::get('id');

        foreach ($subjects as $subject ) {
            foreach ($unites as $unite) {
                unite::create([
                    'name'=> $unite,
                    'note' => $unite,
                    'subjects_id' => $subject->id,
                ]);
            }
        }

    }
}
