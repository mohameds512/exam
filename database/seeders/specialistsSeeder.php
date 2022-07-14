<?php

namespace Database\Seeders;

use App\Models\specialist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class specialistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialists')->delete();

        $specialists = [
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

        foreach ($specialists as $specialist) {
            specialist::create([
                'name'=>$specialist,
                'notes'=>'',
            ]);
        }

    }
}
