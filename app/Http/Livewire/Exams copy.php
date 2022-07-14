<?php

namespace App\Http\Livewire;

use App\Exports\testExport;
use App\Models\classes;
use App\Models\Exams as exams_table;
use App\Models\Grades;
use App\Models\questions;
use App\Models\sections;
use App\Models\subjects;
use App\Models\test_results;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Session\Session;

class Exams extends Component
{


    public $perPage = 3 , $type  , $type_id;
    public
        $currentStep = 1 , $show_exams_table = false, $create_exam = false , $edit_mode = false,
        $check_date_time = 1 , $duration , $Errors = '', $sel_add_qu_method = 0 ,
        $count_selected_questions = '', $search_qu = '', $search_exams = '',
        $updateMode , $question_rows = [0,1,2,3,4,5,6,7,8,9] , $selected_questions = [];


    // exam_data
    public
        $name , $notes,
        $classes =[],$sections  = [], $subjects = [],$unites = [],$exams = [],
        $status ,$check_date , $start_date , $end_date  ,$question,$answers,$right_answer , $qu_deg;

    public
    $grade_id  , $class_id , $section_id ,$subject_id, $unite_id  ;

    // for_edit_questions
    public
        $qu_edit = 0 , $sel_exam_id, $check_edit_qu ;

    // protected $listeners  = [ 'copy_to_clipboard' => 'do_Emit' ];
    // public function do_Emit ()
    // {
    //     $this->dispatchBrowserEvent('copy_to_clipboard');
    // }


    public function get_exams()
    {
        if ($this->unite_id == 'all') {
            $data = exams_table::where('subject_id' , $this->subject_id )->paginate($this->perPage);
            $this->exams = collect($data->items());
        } else {
            $data = exams_table::where('unite_id' , $this->unite_id)->paginate($this->perPage);
            $this->exams = collect($data->items());
        }
    }

    public function updated($propertyName)
    {


        $this->validateOnly($propertyName , [

                'name' => 'required|max:255|unique:exams,name,'.$this->id,
                'notes' => 'required',
                'grade_id' => 'required',
                'class_id' => 'required',
                'section_id' => 'required',
                'subject_id' => 'required',
            ]
        );

        // count_sel_qu
        if (count($this->selected_questions) != 0 ) {
            $this->count_selected_questions = count($this->selected_questions);
        } else {
            $this->count_selected_questions = '';
        }

        // search_in_questions
        if ($this->search_qu != '') {
            if ($this->unite_id == 'all' ) {
                $this->questions = questions::sear_by_subId($this->subject_id , $this->search_qu );
            } else {
                $this->questions = questions::sear_by_subId($this->unite_id , $this->search_qu );
            }
        }else{
            if ($this->unite_id == 'all') {
                $this->questions = questions::where('subject_id' , $this->subject_id )->get();
            } else {
                $this->questions = questions::where('unite_id' , $this->unite_id)->get();
            }
        }

        // search_in_exams
        if ($this->search_exams != '') {
            $this->perPage = 1 ;
            if ($this->unite_id == 'all' ) {
                $data = exams_table::sear_by_subId($this->subject_id , $this->search_exams , $this->perPage);
                $this->exams = collect($data->items());
            } else {
                $data = exams_table::sear_by_uId($this->unite_id , $this->search_exams , $$this->perPage);
                $this->exam = collect($data->items());
            }
        }else{
            $this->get_exams();
        }



    }

    public function updatedCountQu()
    {
        if (count($this->selected_questions) > 2 ) {
            $this->count_selected_questions = 10 ;
        }
    }

    public function render()
    {
        $grades = Grades::get();

        return view('livewire.exams' , compact('grades'));
    }

    public function loadMore()
    {
        $this->perPage += 10 ;
        $this->get_exams();

    }

    public function check_exam_date($count){
        $this->check_date_time = $count;

    }

    public function go_2_step()
    {
        $this->validate([
            'name' => 'required|max:255|unique:exams,name,'.$this->id,
            'notes' => 'required',
            'grade_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
        ]);

        $this->currentStep = 2 ;

        if ($this->unite_id == 'all') {
            $this->emit('sel_qu', 'subject_id' , $this->subject_id);
        } else {
            $this->emit('sel_qu', 'unite_id' , $this->unite_id);
        }


    }

    // public function go_3_step()
    // {
    //     $this->currentStep = 3;
    // }

    public function go_4_step()
    {
        $this->currentStep = 4;
    }
    public function back_1_step()
    {
        $this->currentStep = 1 ;
    }
    public function back_2_step()
    {
        $this->currentStep = 2 ;
    }
    public function back_3_step()
    {
        if ($this->edit_mode) {

            $this->qu_edit = 0 ;
            if ($this->check_edit_qu == 2 ) {
                $this->currentStep = 2 ;
            } elseif($this->check_edit_qu == 1) {
                $this->currentStep = 3 ;
            }

        } else {
            $this->currentStep = 3 ;
        }
    }

    public function back_Previse()
    {

        $this->perPage = 10 ;
        $this->get_exams();
        if ($this->test_result == true) {

            $this->test_result = false;
            $this->show_exams_table = true;
            $this->test_questions = [] ;
            $this->qu_num = 1 ;
            $this->count_test_qu = '' ;
            $this->test_degs = 0 ;
            $this->all_degs = 0 ;
            $this->test_exam = '';
            $this->sel_answer = '';
            $this->spc_time = 0 ;
            $this->start_test = false;
            $this->grade_deg = '';
            $this->test_state = '';

        }elseif($this->test == true){

            $this->test = false;
            $this->show_exams_table = true;
            $this->test_questions = [] ;
            $this->qu_num = 1 ;
            $this->count_test_qu = '' ;
            $this->test_degs = 0 ;
            $this->all_degs = 0 ;
            $this->test_exam = '';
            $this->sel_answer = '';
            $this->spc_time = 0 ;
            $this->start_test = false;

        }elseif($this->create_exam == true){

            if ($this->unite_id == 'all') {
                $this->type = 'subject_id' ;
                $this->type_id = $this->subject_id;
            }else{
                $this->type = 'unite_id' ;
                $this->type_id = $this->unite_id;
            }
            $this->show_exams_table = true;
            $this->create_exam =  false;
            $this->edit_mode = false ;
            $this->clear();
        }elseif ($this->unite_id != '' ) {

            $this->unite_id = '';
            $this->show_exams_table = false;

        }elseif ($this->subject_id != '' ) {
            $this->subject_id = '';
            $this->unites = [] ;

        }elseif ($this->section_id != '' ) {
            $this->section_id = '';
            $this->subjects = [] ;

        }elseif ($this->class_id != '' ) {
            $this->class_id = '';
            $this->sections = [] ;


        }elseif($this->grade_id != ''){
            $this->grade_id = '';
            $this->classes = [];
        }



    }




    public function sel_add_qu_meth($val)
    {
        $this->sel_add_qu_method = $val;
        $this->currentStep = 3 ;

        // if ($val == 1) {
        //     if ($this->unite_id == 'all' ) {
        //         // $this->questions = questions::where('subject_id' , $this->subject_id )->get();
        //         $this->questions = questions::rand_qu_by_sub($this->subject_id);


        //     } else {
        //         // $this->questions = questions::where('unite_id' , $this->unite_id)->get();
        //         $this->questions = questions::rand_qu_by_unite($this->unite_id);

        //     }


        // }
    }

    // to_get_classes_by_grade_id
    public function pass_Classes($grade_id)
    {
        $this->grade_id= $grade_id;
        $this->classes = Grades::find($this->grade_id)->classes;

    }
    public function updatedGradeId()
    {

        if ($this->grade_id != '') {

            $this->classes = Grades::find($this->grade_id)->classes;

        } else {

            $this -> classes = [];
        }
    }
    // to_get_sections_by_class_id
    public function pass_Sections($class_id)
    {
        $this->class_id= $class_id;
        $this->sections = classes::find($this->class_id)->sections;
    }
    public function updatedClassId()
    {
        if ($this->class_id != '') {

            $this->sections = classes::find($this->class_id)->sections;

        } else {

            $this -> sections = [];
        }
    }

    // to_get_subjects_by_section_id
    public function pass_subjects($section_id)
    {
        $this->section_id= $section_id;
        $this->subjects = sections::find($this->section_id)->subjects;
    }
    public function updatedSectionId()
    {

        if ($this->section_id != '') {

            $this->subjects = sections::find($this->section_id)->subjects;

        } else {

            $this -> subjects = [];
        }
    }

    public function pass_unite($subject_id)
    {

        $this->subject_id = $subject_id;
        $this->unites = subjects::find($this->subject_id)->unites;
    }

    public function pass_unite_id($unite_id)
    {
        $this->show_exams_table = true;
        $this->unite_id = $unite_id;

        if ($unite_id == 'all' ) {
            $data = exams_table::where('subject_id' , $this->subject_id)->paginate($this->perPage);
            $this->exams = collect($data->items());
        } else {
            $data = exams_table::where('unite_id', $this->unite_id)->paginate($this->perPage);
            $this->exams = collect($data->items());
        }
    }

    public function add_exam()
    {
        $this->show_exams_table = false;
        $this->create_exam = true;
    }
    public function submitForm()
    {
        // dd($this->exam_date);
        DB::beginTransaction();
        try {

            $exam = new exams_table();

            $exam->name = $this->name;
            $exam->notes = $this->notes;
            $exam->teacher_id = Auth::user()->id ;
            $exam->duration = $this->duration;
            $exam->status = $this->status;
            $exam->subject_id = $this->subject_id;
            if ($this->unite_id != 'all') {
                $exam->unite_id  = $this->unite_id;
            }

            if ($this->check_date_time % 2 == 0) {
                $exam->start_date = $this->start_date;
                $exam->end_date = $this->end_date;
            }
            $exam->save();

            // if ($this->sel_add_qu_method == 1 ) {

            //     foreach ($this->selected_questions as $selected_id) {
            //         $question = questions::findOrFail($selected_id);
            //         // insert_in_exams_questions
            //         $question->exams()->attach($exam->id);
            //     }

            // } elseif($this->sel_add_qu_method == 2) {

            //     foreach ($this->question as $key => $value) {
            //         $question = new questions();
            //         $question->question  = $this->question[$key];
            //         $question->answers  = $this->answers[$key];
            //         $question->qu_deg  = $this->qu_deg[$key];
            //         $question->right_answer  = $this->right_answer[$key];
            //         $question->teacher_id  = Auth::user()->id;
            //         $question->pending  =  0 ;
            //         $question->grade_id  = $this->grade_id;
            //         $question->class_id  = $this->class_id;
            //         $question->section_id  = $this->section_id;
            //         $question->subject_id  = $this->subject_id;

            //         if ($this->unite_id != 'all') {
            //             $exam->unite_id  = $this->unite_id;
            //         }
            //         $question->save();
            //         // insert_in_exams_questions
            //         $question->exams()->attach($exam->id);

            //     }
            // }

            DB::commit();
            $this->clear();

            $this->get_exams();

            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'success',
                'message' => trans('message.success'),
            ]);

        } catch (\Exception $e) {

            DB::rollBack();
            $this->Errors = $e->getMessage();
        }

    }

    public function clear()
    {
        $this->check_date_time = 1 ;
        $this->duration = '' ;
        $this->Errors = '';
        $this->name = '' ;
        $this->notes = '';
        $this->status = '' ;
        $this->check_date = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->question = '';
        $this->answers = '';
        $this->right_answer = '';
        $this->qu_deg = '';
        $this->selected_questions = [] ;

        $this->sel_add_qu_method = 0;

        $this->currentStep = 1;
    }


    // edit_exam

    public function edit_exam($id)
    {
        $this->create_exam = true;
        $this->show_exams_table = false;
        $this->edit_mode = true;


        try {
            //get_the_exam
            $exam = exams_table::findOrFail($id);
            $this->duration = $exam->duration ;
            $this->name = $exam->name ;
            $this->notes = $exam->notes ;
            $this->status = $exam->status ;
            $this->check_date = $exam->check_date;
            $this->question = $exam->question;
            $this->answers = $exam->answers;
            $this->right_answer = $exam->right_answer;
            $this->qu_deg = $exam->qu_deg;

            if ($exam->start_date == '') {
                $this->check_date_time = 1;
            } else {
                $this->check_date_time = 2;
                //to_show_time
                $DT = explode(' ' , $exam->start_date);
                $D = $DT[0];
                $T = $DT[1];
                $this->start_date = $D.'T'.$T ;

                $DT = explode(' ' , $exam->end_date);
                $D = $DT[0];
                $T = $DT[1];
                $this->end_date = $D.'T'.$T ;
            }

            // to_show_exam_questions
            $this->questions = $exam->questions;
            // to_pass_exam_id
            $this->sel_exam_id = $exam->id ;

        } catch (\Exception $e) {

            $this->Errors = $e->getMessage();

        }

    }

    public function edit_back_1_step()
    {
        $this->currentStep = 2;
        $this->qu_edit = 0 ;
    }

    public function edit_next_4_step()
    {
        $this->currentStep = 4 ;
        $this->qu_edit = 1 ;
    }

    public function sel_edit_qu($ed_val)
    {
        if ($ed_val == 1) {

            $this->currentStep = 3 ;
            $this->qu_edit = 1 ;

        } elseif ($ed_val == 2 ) {

            $this->currentStep = 4 ;
            $this->qu_edit = 1 ;
        }


        $this->check_edit_qu = $ed_val;


    }

    public function update_exam()
    {

        if ($this->check_date_time % 2 != 0) {
            $this->start_date = null ;
        }
        $exam = exams_table::findOrFail($this->sel_exam_id);
        $exam->update([
            'duration' => $this->duration,
            'name' => $this->name,
            'notes' => $this->notes,
            'status' => $this->status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);



        $this->clear();
        $this->show_exams_table = true ;
        $this->qu_edit = 0 ;

        $this->get_exams();

        $this->dispatchBrowserEvent('toastr' ,[
            'type' => 'warning',
            'message' => trans('message.update'),
        ]);
    }

    public function deleteEx($ex_id)
    {
        try {
            $exam = exams_table::findOrFail($ex_id);
            $exam->delete();

            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'error',
                'message' => trans('message.delete'),
            ]);

            $this->get_exams();

        } catch (\Exception $e) {
            $this->Errors = $e->getMessage();
        }
    }

    //delete_questions

    public function deleteQu($qu_id)
    {

        try {

            $question = questions::findOrFail($qu_id);
            $question->delete();

            $exam = exams_table::findOrFail($this->sel_exam_id);
            // $this->questions = $exam->questions;
            $this->questions = $exam->questions ;

            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'error',
                'message' => trans('message.delete'),
            ]);

        } catch (\Exception $e) {
            $this->Errors = $e->getMessage();
        }
    }

    // test_exam

    public
        $test = false , $test_questions ,$qu_num = 1 ,$sel_answer , $count_test_qu , $all_degs = 0 ,
        $test_degs = 0 , $test_exam , $test_result = false ,$spc_time , $time , $start_test = false ,
        $grade_deg , $test_state , $result_status , $test_exam_id ;


    public function test($exam_id)
    {

        $this->test = true;
        $this->show_exams_table = false ;
        $this->create_exam = false ;
        $this->edit_mode = false ;

        // $this->test_exam_id = $exam_id ;
        $this->test_exam  = exams_table::findOrFail($exam_id);
        $this->test_questions = $this->test_exam->questions ;
        $this->count_test_qu = $this->test_questions->count();

    }

    public function start_test()
    {
        $this->start_test = true ;
        $duration =  $this->test_exam->duration ;
        $this->dispatchBrowserEvent('time_cute_down',[
            'time_duration' => $duration ,
            'msg_time_out' => trans('exams_trans.time_out'),
        ]);
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

        //get_grade
        $this->get_grade();

        // store_in_results_table
        $results_table  = new test_results();
        $results_table->result_deg = $this->all_degs / $this->test_degs ;
        $results_table->result_grade = $this->grade_deg;
        $results_table->result_status = $this->result_status ;
        $results_table->stud_id = auth()->user()->id;
        $results_table->teacher_id = $this->test_exam->teacher_id ;
        $results_table->exam_id = $this->test_exam->id;
        $results_table->save();



        $this->test = false ;
        $this->test_result = true;

    }

    public function get_grade()
    {
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


    // store_exam_id_in_session_and_pass_to_show_results
    public function show_results($exam_id)
    {
        // Session::put('exam_id_to_sh_results', $exam_id);
        session()->put('exam_id_to_sh_results', $exam_id);
        return redirect()->route('results');
    }

    public function export()
    {
        return Excel::download(new testExport , 'test.xlsx');
        // return (new testExport)->download('test.pdf', \Maatwebsite\Excel\Excel::MPDF);

    }




}
