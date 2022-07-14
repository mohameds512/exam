<?php

namespace App\Http\Livewire\Questions;

use App\Models\questions as ModelsQuestions;
use Livewire\Component;

class Questions extends Component
{
    public $perPage = 10 ;
    public  $search_qu = '' , $sear_type , $sear_id , $questions = [] , $question_name , $answers = []  ,$selected_questions = [],
            $right_answer , $qu_deg , $subject_id , $unite_id , $teacher_id;
    public $selectedItem_id , $action , $qu_id ;
    public $update_mode = false , $count_selected_questions = 0 ;

    // protected $listeners  = ['sel_qu' => 'check_sub_Or_unite'];

    protected function getListeners()
    {
        return ['sel_qu' => 'check_sub_Or_unite'];
    }

    public function get_ques()
    {
        $data = ModelsQuestions::where( $this->sear_type , $this->sear_id)->latest()->paginate($this->perPage);
        $this->questions = collect($data->items());
    }

    public function check_sub_Or_unite($pass_ids)
    {
        $this->unite_id = $pass_ids['unite_id'];
        $this->subject_id = $pass_ids['subject_id'];

        // to_active_ckeditor
        $this->dispatchBrowserEvent('add_editor');

        if ($this->unite_id == 'all') {
            $this->sear_type = 'subject_id';
            $this->sear_id = $this->subject_id;
        } else {
            $this->sear_type = 'unite_id';
            $this->sear_id = $this->unite_id;
        }

        $this->get_ques();

    }

    public function loadMore( )
    {
        $this->perPage += 10  ;
        $this->get_ques();
    }

    public function resetInputs()
    {
        $this->question_name = '';
        $this->answers = '';
        $this->right_answer = '';
        $this->qu_deg = '';
    }

    public function create_qu( )
    {
        $this->resetInputs();
        $this->update_mode = false;
    }

    public function store_qu( )
    {
        try {
            $this->validate([
                'question_name' => 'required',
                'answers' => 'required',
                'right_answer' => 'required',
                'qu_deg' => 'required|numeric',
            ]);

            $question = new ModelsQuestions();

            $question->question = $this->question_name;
            $question->answers = $this->answers;
            $question->right_answer = $this->right_answer;
            $question->qu_deg = $this->qu_deg;
            $question->pending = 1;
            $question->teacher_id = auth()->id();

            if ($this->unite_id == 'all') {
                $question->subject_id = $this->subject_id;
            }else {
                $question->subject_id = $this->subject_id;
                $question->unite_id = $this->unite_id;
            }

            $question->save();
            $this->get_ques();

            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'success',
                'message' => trans('message.success'),
            ]);
            $this->resetInputs();
            $this->dispatchBrowserEvent('reset_qu_editor');

        } catch (\Exception $e) {
            $this->Errors = $e->getMessage();
            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'error',
                'message' =>$e->getMessage(),
            ]);
        }

        session()->put('first_qu', 1 );

    }


    public function selectedItem( $item_id , $action )
    {
        $this->selectedItem_id = $item_id ;
        $this->action = $action ;
        if ($action =='update') {
            $this->resetInputs();
            $this->update_mode = true;
            $selected_que = ModelsQuestions::findOrFail($this->selectedItem_id);
            // dd($selected_que);

            // $this->question_name  = $selected_que->question;
            $this->answers  = $selected_que->answers;
            $this->right_answer  = $selected_que->right_answer;
            $this->qu_deg  = $selected_que->qu_deg;
            $this->dispatchBrowserEvent('update_qu_name', $selected_que->question );
            // $this->update_que();
        } elseif ($action == 'delete' ) {
            $this->dispatchBrowserEvent('openDeleteModel');

        }

    }

    public function update_que( )
    {
        try {
            $this->validate([

                'question_name' => 'required',
                'answers' => 'required',
                'right_answer' => 'required',
                'qu_deg' => 'required|numeric',
            ]);

            $selected_que = ModelsQuestions::findOrFail($this->selectedItem_id);
            $selected_que ->update([
                'question'=> $this->question_name ,
                'answers'=> $this->answers,
                'right_answer'=> $this->right_answer ,
                'qu_deg'=> $this->qu_deg ,
            ]);
            $this->resetInputs();
            $this->dispatchBrowserEvent('closUpdateModel');
            $this->get_ques();

            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'warning',
                'message' => trans('message.update'),
            ]);

            $this->update_mode = false;
            $this->dispatchBrowserEvent('reset_qu_editor');

        } catch (\Exception $e) {
            $this->Errors = $e->getMessage();
            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'error',
                'message' =>$e->getMessage(),
            ]);
        }

    }

    public function delete( )
    {
        ModelsQuestions::destroy($this->selectedItem_id);
        $this->dispatchBrowserEvent('closDeleteModel');
        $this->get_ques();

        $this->dispatchBrowserEvent('toastr' ,[
            'type' => 'error',
            'message' => trans('message.delete'),
        ]);
    }

    // public function updatedCountQu()
    // {
    //     if (count($this->selected_questions) > 2 ) {
    //         $this->count_selected_questions = 10 ;
    //     }
    // }

    public function check_qus()
    {
        if ($this->count_selected_questions != 0 ) {
            if ($this->count_selected_questions > 50) {
                $this->dispatchBrowserEvent('toastr' ,[
                    'type' => 'warning',
                    'message' => trans('questions_trans.qu_must_more_than_50'),
                ]);
            } else {
                $this->emit('go_to_3_step' , $this->selected_questions);
            }

        } else {
            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'warning',
                'message' => trans('questions_trans.sel_ques'),
            ]);
        }

    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName , [

            'question_name' => 'required',
            'answers' => 'required',
            'right_answer' => 'required',
            'qu_deg' => 'required|numeric',
        ]);
        // count_sel_qu
        if (count($this->selected_questions) != 0 ) {
            $this->count_selected_questions = count($this->selected_questions);
        } else {
            $this->count_selected_questions = '';
        }

        // search_in_exams
        if ($this->search_qu != '') {
            $this->perPage = 10 ;
            $data = ModelsQuestions::where( $this->sear_type , $this->sear_id)
                                    ->where('question','like' , '%'.$this->search_qu.'%')
                                    ->latest()->paginate($this->perPage);
            $this->questions = collect($data->items());
        }else{
            $this->get_ques();
        }


    }
    public function render()
    {
        // $data = ModelsQuestions::where( $this->sear_type , $this->sear_id)->paginate($this->perPage);
        // $questions = collect($data->items());

        return view('livewire.questions.questions');
    }

}
