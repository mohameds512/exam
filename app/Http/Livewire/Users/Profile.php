<?php

namespace App\Http\Livewire\Users;

use App\Models\classes;
use App\Models\Exams;
use App\Models\Grades;
use App\Models\sections;
use App\Models\subjects;
use App\Models\test_results;
use App\Models\unite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{

    use WithFileUploads;

    public $exams_num , $examination_num , $succeeded_num , $failed_num , $user_id , $user_bio ;
    public $mode_edit_bio = false , $exams = []  , $Errors = '' , $grades = [], $classes= [] ,
            $sections = [] , $subjects = [] , $unites = [];
    public $grades_ids = [] , $class_ids = [] , $sections_ids = [] , $subjects_ids = [] , $unites_ids = [] ;
    public $sear_gr_id , $sear_unt_id ,$sear_cls_id , $sear_sct_id , $sear_sbt_id ;
    public $perPage = 1  , $mode_test = false , $sear_by_name = '' , $user ;
    public $mode_edit_avt = false, $avt_prof , $pho  , $mode_edit_name = false , $user_name ,
            $mode_edit_email = false , $mode_edit_phone = false , $user_phone ;

    public $sel_ex_id , $sel_ex_name , $sel_ex_notes , $sel_ex_status , $sel_ex_duration ,
            $check_date_time = 1 , $start_date , $end_date  ,$mode_edit_ex = false ;
    public $results ;


    protected function getListeners()
    {
        return [
            'back' => 'get_prof',
            'show_prof_fr_ex' => 'show_prof',
        ];
    }
    public function show_prof($user_id)
    {
        $this->user_id = $user_id;
        $this->user_info();
    }

    public function user_info( )
    {
        if ($this->user_id == null) {
            $this->user_id = Auth::user()->id ;
        }

        $this->user = User::findOrFail($this->user_id);
    }

    public function test_results( )
    {
        $result_data = test_results::where('stud_id' , $this->user_id)->latest()->paginate($this->perPage);
        $this->results = collect($result_data->items());
    }

    public function check_exam_date($count){
        $this->check_date_time = $count;
    }

    public function get_test_results($ex_id)
    {
        session()->put('exam_id_to_sh_results', $ex_id);
        return redirect()->route('results');
    }

    public function cancel_edit_ex()
    {
        $this->sel_ex_name = ''  ;
        $this->sel_ex_notes = '' ;
        $this->sel_ex_duration = '' ;
        $this->sel_ex_status ='' ;
        $this->check_date_time = 1;
        $this->start_date = '' ;
        $this->end_date = '' ;
        $this->mode_edit_ex = false ;
    }
    public function edit_ex($ex_id)
    {

        try {
            $this->mode_edit_ex = true;
            $this->sel_ex_id =  $ex_id;
            $exam = Exams::findOrFail($ex_id);
            $this->sel_ex_name = $exam->name ;
            $this->sel_ex_notes = $exam->notes ;
            $this->sel_ex_duration = $exam->duration ;
            $this->sel_ex_status = $exam->status ;
            if ($exam->start_date == '') {
                $this->check_date_time = 1;
            } else {
                $this->check_date_time = 2;
                $DT = explode(' ' , $exam->start_date);
                $D = $DT[0];
                $T = $DT[1];
                $this->start_date = $D.'T'.$T ;
                $DT = explode(' ' , $exam->end_date);
                $D = $DT[0];
                $T = $DT[1];
                $this->end_date = $D.'T'.$T ;
            }
        } catch (\Exception $e) {
            $this->Errors = $e->getMessage();
        }

    }

    public function update_exam()
    {
        $rules = [
            'sel_ex_name' => 'required|max:255|unique:exams,name,'.$this->sel_ex_id,
            'sel_ex_notes' => 'required',
            'sel_ex_duration' => 'required',
        ];
        if ($this->check_date_time % 2 == 0 ) {
            $rules += [
                'start_date' => 'date',
                'end_date'   => 'date|after:start_date',
            ];
        }
        $this->validate($rules);
        try {

            if ($this->check_date_time % 2 != 0) {
                $this->start_date = null ;
                $this->end_date = null ;
            }

            $exam = Exams::findOrFail($this->sel_ex_id);
            $exam->update([
                'duration' => $this->sel_ex_duration,
                'name' => $this->sel_ex_name,
                'notes' => $this->sel_ex_notes,
                'status' => $this->sel_ex_status,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);
            $this->cancel_edit_ex();

            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'warning',
                'message' => trans('message.update'),
            ]);
        } catch (\Exception $e) {
            $this->Errors = $e->getMessage();
        }

    }
    public function del_ex( $ex_id )
    {
        $this->dispatchBrowserEvent('openEdExMod');
    }

    public function go_test($id )
    {
        $this->emit('pass_test_id' , $id );
        $this->mode_test = true;
    }

    public function edit_phone( )
    {
        $this->mode_edit_phone = true;
    }
    public function cancel_update_phone( )
    {
        $this->mode_edit_phone = true ;
    }
    public function update_phone ( )
    {

        $this->validate([
            'user_phone' => 'required|numeric|digits:11|unique:users,phoneNumber,'.$this->id,
        ]);
        $this->user->phoneNumber = $this->user_phone ;
        $this->user->save();
        $this->mode_edit_phone = false ;
    }
    public function edit_email( )
    {
        $this->mode_edit_email = true ;
    }

    public function cancel_update_email( )
    {
        $this->mode_edit_email = false ;
    }

    public function update_email( )
    {
        $this->validate([
            'user_email' => 'required|email|unique:users,email,'.$this->user_id,
        ]);
        $this->user->email = $this->user_email ;
        $this->user->save();
        $this->mode_edit_email = false ;
    }

    public function edit_name( )
    {
        $this->mode_edit_name = true ;
    }
    public function cancel_update_name ( )
    {
        $this->mode_edit_name = false;
    }
    public function update_name( )
    {
        $this->validate([
            'user_name' => 'required|max:255|unique:users,name,'.$this->user_id,
        ]);
        $this->user->name = $this->user_name ;
        $this->user->save();
        $this->mode_edit_name = false ;
    }
    public function get_prof( )
    {
        $this->mode_test = false ;
    }

    public function sear_by_ex_name( )
    {
        if ($this->sear_by_name != '' ) {
            $data = Exams::where('teacher_id', $this->user_id)
                            ->where('name','like' , '%'.$this->sear_by_name.'%')
                            ->latest()->paginate($this->perPage);
            $this->exams = collect($data->items());
            // dd($this->exams);
        }
    }
    public function edit_avt( )
    {
        $this->search_ex();
        $this->mode_edit_avt = true ;
        $this->dispatchBrowserEvent('add_dropify');
    }
    public function update_avt( )
    {
        $this->validate([
            'avt_prof' => 'image|max:1024', // 1MB Max
        ]);
        if ($this->avt_prof == null) {
            $this->mode_edit_avt = false ;
        }else {

            $avt_info =  $this->avt_prof->store('users_files');
            $avt_data = explode('/' , $avt_info);
            $avt_name = $avt_data[1];
            $user = User::findOrFail($this->user_id);
            if ($user->img != 'default.png') {
                Storage::disk('upload_img')->delete('/users_files/'.$user->img);
            }
            $user->img = $avt_name ;
            $user->save();
            $this->user = $user;
            $this->mode_edit_avt = false ;
        }
    }

    public function cancel_edit_avt( )
    {
        $this->mode_edit_avt = false ;
    }
    public function edit_bio( )
    {
        $this->search_ex();
        $this->mode_edit_bio = true ;
    }

    public function update_bio ( )
    {
        if ($this->user_bio == null) {
            $this->search_ex();
            $this->mode_edit_bio = false ;
        } else {
            $user = User::findOrFail($this->user_id);
            $user->bio = $this->user_bio ;
            $user->save();
            $this->search_ex();
            $this->mode_edit_bio = false ;
        }

    }


    public function cancel_update_bio( )
    {
        $this->search_ex();
        $this->mode_edit_bio = false ;
    }


    public function updated( $propertyName )
    {

        $rules = [
            'sel_ex_name' => 'required|max:255|unique:exams,name,'.$this->sel_ex_id,
            'sel_ex_notes' => 'required',
        ];
        if ($this->check_date_time % 2 == 0 ) {
            $rules += [
                'start_date' => 'date',
                'end_date'   => 'date|after:start_date',
            ];
        }
        $this->validateOnly($propertyName , $rules);
        $this->sear_by_ex_name();
        $this->search_ex();
        $this->find_selectors();
        if ($this->sear_by_name != '' ) {
            $data = Exams::where('teacher_id', $this->user_id)
                            ->where('name','like' , '%'.$this->sear_by_name.'%')
                            ->latest()->paginate($this->perPage);
            $this->exams = collect($data->items());
        }
    }

    public function loadMore( )
    {
        $this->perPage += 1  ;
        $this->search_ex();
    }
    public function search_ex( )
    {
        if ($this->user->hasPermission('stud_prof')) {
            $this->test_results();
        }

        if ($this->user->hasPermission('teacher_prof')) {
            if ($this->sear_by_name != '' ) {
                $this->sear_by_ex_name();
            }else {
                $data = Exams::where('teacher_id', $this->user_id)->latest()->paginate($this->perPage);
                $this->exams = collect($data->items());

                if ($this->sear_gr_id != null ) {
                    $data = Exams::where('teacher_id', $this->user_id)->where('grade_id', $this->sear_gr_id)->latest()->paginate($this->perPage);
                    $this->exams = collect($data->items());
                }
                if ($this->sear_cls_id != null) {
                    $data = Exams::where('teacher_id', $this->user_id)
                                    ->where('grade_id', $this->sear_gr_id)
                                    ->where('class_id', $this->sear_cls_id)
                                    ->latest()->paginate($this->perPage);
                    $this->exams = collect($data->items());
                }
                if ($this->sear_sct_id != null) {

                    $data = Exams::where('teacher_id', $this->user_id)
                                    ->where('grade_id', $this->sear_gr_id)
                                    ->where('class_id', $this->sear_cls_id)
                                    ->where('section_id', $this->sear_sct_id)
                                    ->latest()->paginate($this->perPage);
                    $this->exams = collect($data->items());
                }
                if ($this->sear_sbt_id != null) {
                    $data = Exams::where('teacher_id', $this->user_id)
                                    ->where('grade_id', $this->sear_gr_id)
                                    ->where('class_id', $this->sear_cls_id)
                                    ->where('section_id', $this->sear_sct_id)
                                    ->where('subject_id', $this->sear_sbt_id)
                                    ->latest()->paginate($this->perPage);
                    $this->exams = collect($data->items());
                }
                if ($this->sear_unt_id != null) {
                    $data = Exams::where('teacher_id', $this->user_id)
                                    ->where('grade_id', $this->sear_gr_id)
                                    ->where('class_id', $this->sear_cls_id)
                                    ->where('section_id', $this->sear_sct_id)
                                    ->where('subject_id', $this->sear_sbt_id)
                                    ->where('unite_id', $this->sear_unt_id)
                                    ->latest()->paginate($this->perPage);
                    $this->exams = collect($data->items());
                }
            }
        }

    }

    public function find_selectors( )
    {
        $this->grades = Grades::whereIn('id' , $this->grades_ids)->get(['id' , 'name']);
        $this->classes = classes::whereIn('id' , $this->class_ids)->where('grade_id',$this->sear_gr_id)->get(['id' , 'name']);
        $this->sections = sections::whereIn('id' , $this->sections_ids)->where('class_id', $this->sear_cls_id)->get(['id' , 'name']);
        $this->subjects = subjects::whereIn('id' , $this->subjects_ids)->where('section_id', $this->sear_sct_id)->get(['id' , 'name']);
        $this->unites = unite::whereIn('id' , $this->unites_ids)->where('subjects_id', $this->sear_sbt_id)->get(['id' , 'name']);

    }
    public function get_ex_num( )
    {
        // get_exams_num
        $user_exams = Exams::where('teacher_id', $this->user_id )->get();
        $this->exams_num = $user_exams->count();
        $result =  test_results::where('teacher_id', $this->user_id)->get(['result_status']) ;
        $this->examination_num = $result->count();

        $this->succeeded_num = $result->where('result_status' , '1' )->count();
        $this->failed_num    = $result->where('result_status' , '0' )->count();

        $this->grades = Grades::get(['id', 'name']);

        foreach ($user_exams as  $exam) {
            if ( !(in_array($exam->grade_id, $this->grades_ids))) {
                array_push($this->grades_ids , $exam->grade_id);
            }
            if ( !(in_array($exam->class_id, $this->class_ids))) {
                array_push($this->class_ids , $exam->class_id);
            }
            if ( !(in_array($exam->section_id, $this->sections_ids))) {
                array_push($this->sections_ids , $exam->section_id);
            }
            if ( !(in_array($exam->subject_id, $this->subjects_ids))) {
                array_push($this->subjects_ids , $exam->subject_id);
            }
            if ( !(in_array($exam->unite_id, $this->unites_ids))) {
                array_push($this->unites_ids , $exam->unite_id);
            }
            // dd($this->grades_ids[0]);
        };
    }
    public function mount( )
    {
        $this->user_info();
        $this->user_bio = $this->user->bio ;
        $this->user_name = $this->user->name ;
        $this->user_email = $this->user->email ;
        $this->user_phone = $this->user->phoneNumber;
        $this->get_ex_num();
        $this->find_selectors();

        $this->search_ex();
    }


    public function render()
    {
        $this->search_ex();
        $this->user_info();
        $this->get_ex_num();
        return view('livewire.users.profile');
    }
}
