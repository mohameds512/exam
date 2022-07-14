<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(2)->create();
        $this->call(LaratrustSeeder::class);
        $this->call(adminSeeder::class);
        $this->call(gradeSeeder::class);
        $this->call(classesSeeder::class);
        $this->call(sectionsSeeder::class);
        $this->call(subjectSeeder::class);
        $this->call(specialistsSeeder::class);
        $this->call(teacherSeeder::class);
        $this->call(uniteSeeder::class);
        $this->call(ExamSeeder::class);
        $this->call(questionSeeder::class);
    }
}
