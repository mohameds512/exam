<?php

namespace App\Http\Livewire\Results;

use App\Models\test_results;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Symfony\Component\HttpFoundation\Session\Session;

class ResultDatatables extends LivewireDatatable
{
    // public $model = test_results::class;


    public function builder()
    {
        // $exam_id = Session::get('exam_id_to_sh_results');
        $exam_id = Session('exam_id_to_sh_results');
        $teacher_id = Auth()->user()->id;

        return test_results::query()
            ->where('exam_id' , $exam_id )
            ->where('teacher_id', $teacher_id)
            ->leftJoin('users', 'test_results.stud_id', 'users.id');
    }
    public function columns()
    {

        return [

            Column::index($this),

            // NumberColumn::name('id')
            //     ->label('ID')
            //     ->sortBy('id')
            //     ->defaultSort('asc'),

                Column::name('users.Name')
                ->label(trans('users_trans.name')),


                Column::name('result_deg')
                ->label('result_deg'),
                // ->searchable(),

                Column::name('result_grade')
                ->label('result_grade'),

                Column::name('result_status')
                ->label('result_status'),


                DateColumn::name('created_at')
                    ->label('Creation Date'),

                TimeColumn::name('updated_at')
                ->label('Creation Time')
        ];

    }


}
