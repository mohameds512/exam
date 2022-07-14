<?php

namespace App\Http\Controllers\examController;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradesRequest;
use App\Models\classes;
use App\Models\Grades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Crypt;

class GradesController extends Controller
{

    public function index()
    {

        // return App::getLocale();

        // if (Auth::user()->hasRole('student')) {
        //     return 'student';
        // } elseif(Auth::user()->hasRole('teacher')) {
        //     return  'teacher';
        // }

        $grades = Grades::all();
        return view('grades.index',compact('grades'));

    }



    public function store(StoreGradesRequest $request)
    {


        $validated = $request->validated();
        // dd($request->all());

        try {


            Grades::create([
                'name'=>['ar'=> $request->name_ar , 'en'=> $request->name_en],
                'notes'=>['ar'=> $request->note_ar , 'en'=> $request->note_en],
            ]);


            toastr()->success(trans('message.success'));
            // toastSuccess(trans('message.success'));
            return redirect()->route('grades.index');

        } catch (\Exception $e) {

            return  redirect()->back()->withErrors(['error'=> $e->getMessage()]);

        }

    }



    public function edit( $id)
    {
        try {
            $grade_id = Crypt::decrypt($id);
            $grade = Grades::findOrFail($grade_id);
            return view('grades.edit',compact('grade'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }

    }


    public function update(StoreGradesRequest $request)
    {
        try {

            $validated = $request->validated();

            $grade = Grades::findOrFail($request->id);

            $grade->update([
                'name' =>['ar'=> $request->name_ar , 'en'=> $request->name_en],
                'notes' =>['ar'=> $request->note_ar , 'en'=> $request->name_en],
            ]);

            toastr()->success(trans('message.update'));
            // toastWarning(trans('message.update'));
            return redirect()->route('grades.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }



    }

    public function destroy(Request $request)
    {
        try {

            $class_ids = classes::where('grade_id' , $request->id)->pluck('id');

            if ($class_ids->count() == 0) {

                Grades::findOrFail($request->id)->delete();
                toastError(trans('message.delete'));
                return redirect()->route('grades.index');

            } else {

                toastError(trans('message.related_data'));
                return redirect()->route('grades.index');

            }



        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }
    }
}
