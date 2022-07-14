<?php

namespace App\Http\Controllers\examController;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeSubjectRequest;
use App\Models\classes;
use App\Models\Grades;
use App\Models\questions;
use App\Models\sections;
use App\Models\subjects;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['grades']  = Grades::get(['id','name']);
        // $data['subjects'] = subjects::all();

        // $subject = subjects::select('name')->distinct()->get(); //

        return view('subjects.index' , $data);

    }

    public function get_sections($class_id)
    {
        $section_list = sections::where('class_id',$class_id)->pluck('name' , 'id');
        return $section_list;
    }

    public function store(storeSubjectRequest $request)
    {
        // return $request;
        try {
            $validated = $request->validated();
            subjects::create([
                'name'=> [ 'ar'=>$request->name_en , 'en'=>$request->name_en],
                'grade_id' => $request->Grade_id,
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
            ]);

            toastSuccess(trans('message.success'));
            return redirect()->route('subjects.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }
    }

    public function show($section_id)
    {
        $data['grades'] = Grades::get(['id','name']);
        $data['subjects'] = sections::findOrFail($section_id)->subjects ;
        return view('subjects.show_details', $data);
    }


    public function update(storeSubjectRequest $request)
    {
        // return $request;

        try {
            $validated = $request->validated();
            $subject = subjects::findOrFail($request->id);
            $subject->update([
                'name'=> [ 'ar'=>$request->name_en , 'en'=>$request->name_en],
                'grade_id' => $request->Grade_id,
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
            ]);

            toastWarning(trans('message.update'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function destroy(Request $request)
    {
        try {

            $question_ids = questions::where('subject_id',$request->id)->pluck('id');
            if ($question_ids->count() == 0) {

                subjects::findOrFail($request->id)->delete();
                toastError(trans('message.delete'));
                return redirect()->back();

            } else {

                toastError(trans('message.related_data'));
                return redirect()->back();

            }

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }
    }
}
