<?php

namespace App\Http\Controllers\examController;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Exams;
use App\Http\Requests\storeClassRequest;
use App\Models\classes;
use App\Models\Exams as ModelsExams;
use App\Models\Grades;
use App\Models\sections;
use finfo;
use Illuminate\Http\Request;

class ClassesController extends Controller
{

    public function index()
    {

        $grades = Grades::get(['id','name']);

        return view('class.index',compact('grades'));
    }

    public function store(storeClassRequest $request)
    {
        try {

            $validated = $request->validated();

            // return $request;
            classes::create([
                'name'=> ['ar'=>$request->name_ar , 'en'=>$request->name_en],
                'grade_id' => $request->Grade_id,
                'academic_year'=>$request->acd_year,
            ]);


            toastSuccess(trans('message.success'));
            return redirect()->route('classes.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }


    }


    public function show($grade_id)
    {
        $grades = Grades::get(['id','name']);
        $classes = Grades::findOrFail($grade_id)->classes;
        return view('class.show_details',compact('classes', 'grades'));

    }




    public function update(storeClassRequest  $request)
    {
        // return $request;
        try {

            $validated = $request->validated();
            $name_ar = json_encode($request->name_ar);
            $class = classes::findOrFail($request->id);
            $class->update([
                'name'=> ['ar'=>$name_ar , 'en'=>$request->name_en],
                'grade_id' => $request->Grade_id,
                'academic_year'=>$request->acd_year,
            ]);

            toastSuccess(trans('message.update'));
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }

    }

    public function destroy(Request $request)
    {


        try {

            $section_ids = sections::where('class_id' , $request->id )->pluck('id');
            if ($section_ids->count() == 0) {
                $class = classes::findOrFail($request->id);
                $class ->delete();

                toastError(trans('message.delete'));
                return redirect()->route('classes.index');
            } else {

                toastError(trans('message.related_data'));
                return redirect()->route('classes.index');
            }



        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }

    }
}
