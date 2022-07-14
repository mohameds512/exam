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


    public $perPage = 5 ;
    public
        $currentStep = 1 , $show_exams_table = false, $create_exam = false ,
        $check_date_time = 1 , $duration , $Errors = '', $search_exams = '' , $ex_qus;


    // exam_data
    public
        $name , $notes,
        $classes =[],$sections  = [], $subjects = [],$unites = [],$exams = [],
        $status ,$check_date , $start_date , $end_date  ,$question,$answers,$right_answer , $qu_deg;

    public
    $grade_id  , $class_id , $section_id ,$subject_id, $unite_id , $edit_mode = false ;
    public $sh_prof = false ;
    // for_edit_questions
    public
        $sel_exam_id, $check_edit_qu ;

        protected function getListeners()
        {
            return [
                'go_to_3_step' => 'go_to_3_step',
                'back' => 'back_exams'
            ];
        }

        public function show_prof( $user_id)
        {
            $this->emit('show_prof_fr_ex' , $user_id);
            $this->sh_prof = true ;

        }

        public function back_exams( )
        {
            $this->get_exams();
            $this->mode_test = false ;
            $this->test = false ;
            $this->show_exams_table = true ;
            $this->create_exam = true ;
        }

    // protected $listeners  = [ 'copy_to_clipboard' => 'do_Emit' ];
    // public function do_Emit ()
    // {
    //     $this->dispatchBrowserEvent('copy_to_clipboard');
    // }



    public function get_exams()
    {
        if ($this->unite_id == 'all') {
            $data = exams_table::where('subject_id' , $this->subject_id )->latest()->paginate($this->perPage);
            $this->exams = collect($data->items());
        } else {
            $data = exams_table::where('unite_id' , $this->unite_id)->latest()->paginate($this->perPage);
            $this->exams = collect($data->items());
        }
    }

    public function updated($propertyName)
    {


        $rules = [
            'name' => 'required|max:255|unique:exams,name,'.$this->id,
            'notes' => 'required',
            'grade_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required'];
            if ($this->check_date_time % 2 == 0 ) {
                $rules += [
                    'start_date' => 'date',
                'end_date'   => 'date|after:start_date',
                ];
        }
        $this->validateOnly($propertyName , $rules);


        // search_in_exams
        if ($this->search_exams != '') {
            $this->perPage = 10 ;
            if ($this->unite_id == 'all' ) {
                $data = exams_table::sear_by_subId($this->subject_id , $this->search_exams , $this->perPage);
                $this->exams = collect($data->items());
            } else {
                $data = exams_table::sear_by_uId($this->unite_id , $this->search_exams , $this->perPage);
                $this->exams = collect($data->items());
            }
        }else{
            $this->get_exams();
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
        $rules = [
            'name' => 'required|max:255|unique:exams,name,'.$this->id,
            'notes' => 'required',
            'grade_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required'
        ];
        if ($this->check_date_time % 2 == 0 ) {
            $rules += [
                'start_date' => 'date',
            'end_date'   => 'date|after:start_date',
            ];
        }
        $this->validate($rules);
        $this->currentStep = 2 ;

        $pass_ids = [
                'unite_id' => $this->unite_id ,
                'subject_id' => $this->subject_id ,
            ];
        // dd($pass_ids);
        $this->emit('sel_qu', $pass_ids );

    }

    public function back_1_step()
    {
        $this->currentStep = 1 ;
    }



    public function go_to_3_step($sel_qus)
    {
        $this->currentStep = 3;
        $this->ex_qus = $sel_qus ;
        // dd($this->ex_qus);
    }


    public function back_2_step()
    {
        $pass_ids = [
            'unite_id' => $this->unite_id ,
            'subject_id' => $this->subject_id ,
        ];
        $this->currentStep = 2 ;
        $this->emit('sel_qu', $pass_ids );

    }

    public function go_4_step()
    {
        $this->currentStep = 4;
    }



    public function back_Previse()
    {

        $this->perPage = 10 ;
        $this->get_exams();
        if($this->sh_prof == true){
            $this->sh_prof = false ;
        }elseif($this->test_result == true) {

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
            $data = exams_table::where('subject_id' , $this->subject_id)->latest()->paginate($this->perPage);
            $this->exams = collect($data->items());
        } else {
            $data = exams_table::where('unite_id', $this->unite_id)->latest()->paginate($this->perPage);
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
            $exam->section_id = $this->section_id;
            $exam->class_id = $this->class_id;
            $exam->grade_id = $this->grade_id;
            if ($this->unite_id != 'all') {
                $exam->unite_id  = $this->unite_id;
            }

            if ($this->check_date_time % 2 == 0) {
                $exam->start_date = $this->start_date;
                $exam->end_date = $this->end_date;
            }
            $exam->save();

            foreach ($this->ex_qus as $qu_id) {
                $question = questions::findOrFail($qu_id);
                $question->exams()->attach($exam->id);
            }


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
            // $this->questions = $exam->questions;
            // to_pass_exam_id
            $this->sel_exam_id = $exam->id ;

        } catch (\Exception $e) {

            $this->Errors = $e->getMessage();

        }

    }

    // public function edit_back_1_step()
    // {
    //     $this->currentStep = 2;
    //     $this->qu_edit = 0 ;
    // }

    // public function edit_next_4_step()
    // {
    //     $this->currentStep = 4 ;
    //     $this->qu_edit = 1 ;
    // }

    // public function sel_edit_qu($ed_val)
    // {
    //     if ($ed_val == 1) {

    //         $this->currentStep = 3 ;
    //         $this->qu_edit = 1 ;

    //     } elseif ($ed_val == 2 ) {

    //         $this->currentStep = 4 ;
    //         $this->qu_edit = 1 ;
    //     }


    //     $this->check_edit_qu = $ed_val;


    // }

    public function update_exam()
    {

        if ($this->check_date_time % 2 != 0) {
            $this->start_date = null ;
            $this->end_date = null ;
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
        // $this->qu_edit = 0 ;
        $this->edit_mode = false ;
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

    // test_exam

    public
        $test = false , $test_questions ,$qu_num = 1 ,$sel_answer , $count_test_qu , $all_degs = 0 ,
        $test_degs = 0 , $test_exam , $test_result = false ,$spc_time , $time , $start_test = false ,
        $grade_deg , $test_state , $result_status , $test_exam_id ;
    public $mode_test = false ;


    public function go_test($exam_id)
    {
        // dd($exam_id);
        $this->emit('pass_test_id' , $exam_id );
        $this->mode_test = true;
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



    // store_exam_id_in_session_and_pass_to_show_results
    public function show_results($exam_id)
    {
        session()->put('exam_id_to_sh_results', $exam_id);
        return redirect()->route('results');
    }

    public function export()
    {
        return Excel::download(new testExport , 'test.xlsx');
        // return (new testExport)->download('test.pdf', \Maatwebsite\Excel\Excel::MPDF);

    }




}
