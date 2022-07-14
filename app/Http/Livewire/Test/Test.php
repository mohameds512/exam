<?php

namespace App\Http\Livewire\Test;

use App\Models\Exams;
use App\Models\test_results;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Test extends Component
{

    public $ex_id , $exam  ,$time , $start_test = false , $mode_test  = false , $get_result = false;
    public $test_questions , $count_test_qu , $qu_num = 1 , $sel_answer , $test_degs = 0 , $all_degs = 0 ;
    public $grade_deg  , $test_state ;

    protected function getListeners()
    {
        return ['pass_test_id' => 'get_test'];
    }

    public function back()
    {
        $this->emit('back');
        $this->mode_test = false;
        $this->get_result = false;
    }

    public function get_test($id)
    {
        $this->ex_id = $id;
        $this->get_exam();
        $this->mode_test = true ;
    }

    public function start_test( )
    {
        $this->start_test = true ;
        $this->mode_test  = true ;
    }
    public function get_exam( )
    {
        try {
            $this->exam = Exams::findOrFail($this->ex_id);
            // $this->exam = Exams::findOrFail(3);
            $this->test_questions = $this->exam->questions ;
            $this->count_test_qu = $this->test_questions->count();
        } catch (\Exception $e) {
            $this->Errors = $e->getMessage();
        }
    }
    public function next_qu()
    {
        $this->validate([
            'sel_answer' =>'required',
        ]);
        $this->qu_num ++ ;
    }
    public function previse_qu()
    {
        $this->qu_num -- ;
    }

    public function submit_answers()
    {

        //  $this->test_questions
        foreach ($this->test_questions as $key => $question) {

            $this->dispatchBrowserEvent('end_timer');

            $str1 = trim($question->right_answer)  ;
            $str2 = trim($this->sel_answer[$key])  ;

            if ($str1 == $str2 ) {

                $this->test_degs =  $this->test_degs + $question->qu_deg ;
            }
            $this->all_degs  = $this->all_degs + $question->qu_deg ;
        }

        $this->get_grade();

        // store_in_results_table
        if (Auth::check()) {
        $results_table  = new test_results();
        $results_table->result_grade = $this->grade_deg;
        $results_table->result_status = $this->result_status ;
        $results_table->result_deg =  $this->test_degs;
        $results_table->stud_id = auth()->user()->id;
        $results_table->teacher_id = $this->exam->teacher_id ;
        $results_table->exam_id = $this->exam->id;
        $results_table->save();
        }




        $this->test = false ;
        $this->get_result = true;

    }

    public function get_grade()
    {
        if ($this->test_degs == 0) {
            $this->grade_deg = trans('exams_trans.weak');
            $this->test_state = trans('exams_trans.fail');
            $this->result_status = 0 ;
        } else {
            if (($this->test_degs/$this->all_degs )*100 >= 85 ) {
                $this->grade_deg = trans('exams_trans.excellent');
                $this->test_state = trans('exams_trans.succeed');
                $this->result_status = 1 ;
            } elseif(($this->test_degs/$this->all_degs )*100 >= 75 ) {
                $this->grade_deg = trans('exams_trans.very_good');
                $this->test_state = trans('exams_trans.succeed');
                $this->result_status = 1 ;
            }elseif(($this->test_degs/$this->all_degs )*100 >= 65 ) {
                $this->grade_deg = trans('exams_trans.good');
                $this->test_state = trans('exams_trans.succeed');
                $this->result_status = 1 ;
            }elseif(($this->test_degs/$this->all_degs )*100 >= 55 ) {
                $this->grade_deg = trans('exams_trans.accepted');
                $this->test_state = trans('exams_trans.succeed');
                $this->result_status = 1 ;
            }elseif(($this->test_degs/$this->all_degs )*100 < 55 ) {
                $this->grade_deg = trans('exams_trans.weak');
                $this->test_state = trans('exams_trans.fail');
                $this->result_status = 0 ;
            }
        }


    }

    public function mount()
    {
        $this->get_exam();
    }

    public function render()
    {

        return view('livewire.test.test');
    }
}
