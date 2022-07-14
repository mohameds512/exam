<?php

namespace App\Http\Controllers\examController;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeSectionRequest;
use App\Models\classes;
use App\Models\Grades;
use App\Models\sections;
use App\Models\subjects;
use Illuminate\Http\Request;

class SectionsController extends Controller
{

    public function index()
    {
        $data['grades']  = Grades::get(['id','name']);
        return view('sections.index', $data );
    }

    public function get_classes($id)
    {

        $list_classes =  classes::where('grade_id' , $id )->pluck('name','id');
        return $list_classes;
    }


    public function store(storeSectionRequest $request)
    {
        // return $request;
        try {
            $validated = $request->validated();
            sections::create([
                'name'=> ['ar'=> $request->name_ar , 'en'=> $request->name_en],
                'class_id' => $request->class_id,
                'grade_id' => $request->Grade_id,
            ]);

            toastSuccess(trans('message.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }

    }

    public function show($class_id)
    {
        $data['sections'] = classes::findOrFail($class_id)->sections ;
        $data['grades']  = Grades::get(['id','name']);

        return view('sections.show_details',$data);
    }


    public function update(storeSectionRequest $request)
    {
        try {
            $validated = $request->validated();
            $section = sections::findOrFail($request->id);
            $section->update([
                'name'=> ['ar'=> $request->name_ar , 'en'=> $request->name_en],
                'class_id' => $request->class_id,
                'grade_id' => $request->Grade_id,
            ]);

            toastWarning(trans('message.update'));
            return redirect()->route('sections.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        try {

            $subject_ids = subjects::where('section_id' , $request->id)->pluck('id');
            if ($subject_ids->count() == 0) {

                sections::findOrFail($request->id)->delete();
                toastError(trans('message.delete'));
                return redirect()->route('sections.index');

            } else {
                toastError(trans('message.related_data'));
                return redirect()->route('sections.index');
            }


        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }


    }
}
