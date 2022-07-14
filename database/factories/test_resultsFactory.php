<?php

namespace Database\Factories;

use App\Models\Exams;
use App\Models\test_results;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class test_resultsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = test_results::class;


    public function definition()
    {
        $stud = User::first();
        $teacher = User::first();
        $exam = Exams::first();

        $result_deg  = $this->faker->randomElement(['1','20', '15' , '5']);
        $result_grade = $this->faker->randomElement(['جيد' , 'ممتاز' , 'ضعيف']);
        $result_status = $this->faker->randomElement(['ناجح' , 'راسب']);
        return [
            'result_deg' => $result_deg ,
            'result_grade' => $result_grade ,
            'result_status' => $result_status ,
            'stud_id' => $stud->id ,
            'teacher_id' => $teacher->id ,
            'exam_id' => $exam->id ,
        ];
    }
}
