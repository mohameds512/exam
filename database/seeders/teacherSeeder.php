<?php

namespace Database\Seeders;

use App\Models\specialist;
use App\Models\teachers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class teacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->delete();

        $sp_id = specialist::first();

        teachers::create([
            'email'=> 'teacher@gg.gg',
            'password'=> Hash::make('123456789'),
            'name'=> 'Mr ahmed',
            'phone'=> '01234567894',
            'specialist_id'=> $sp_id->id,
            'address'=> 'cairo',
        ]);
    }
}
