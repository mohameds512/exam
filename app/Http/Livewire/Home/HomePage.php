<?php

namespace App\Http\Livewire\Home;

use App\Models\Exams;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomePage extends Component
{
    public $perPage = 3 , $exams ,$test_exam, $mode_test = false , $get_result = false ;


    public function go_test($ex_id)
    {
        if (Auth::guest()) {
            if (session()->get('guest_experiment') == 1 ) {
                return redirect()->route('login');
            }
        }

        $this->emit('pass_test_id' , $ex_id );
        $this->mode_test = true;

        if (Auth::guest()) {
            session()->put('guest_experiment', 1 );
        }

    }
    public function getExams()
    {
        $data = Exams::latest()->paginate($this->perPage);
        $this->exams = collect($data->items());
    }

    public function loadMore( )
    {
        $this->perPage += 3;
        $this->getExams();
    }

    public function mount( )
    {
        $this->getExams();
    }
    public function render()
    {
        return view('livewire.home.home-page');
    }
}
