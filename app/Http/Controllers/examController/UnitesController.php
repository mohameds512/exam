<?php

namespace App\Http\Controllers\examController;

use App\Http\Controllers\Controller;
use App\Models\Grades;
use App\Models\subjects;
use App\Models\unite;
use Illuminate\Http\Request;

class UnitesController extends Controller
{
    public function index(){

        $unites = unite::get();
        $grades = Grades::get();
        return view('unites.index' , compact('unites','grades'));
    }

    public function store(Request $request){

        try {
            $unite = new unite();
            $unite->name = ['ar' => $request->name_ar , 'en' => $request->name_en ];
            $unite->note = [ 'ar' => $request->note_ar , 'en' => $request->note_en ];
            $unite->subjects_id = $request->subject_id;
            $unite->save();

            $msg = ['message' => trans("message.success") ];

            $data['unite'] = $unite;
            $data['msg']   = $msg;
            return response()->json($data);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);

        }

    }

    // to_get_unite
    public function show($subject_id)
    {
        $data['grades'] = Grades::get(['id','name']);
        $data['unites'] = subjects::findOrFail($subject_id)->unites;

        return view('unites.show_details', $data);
    }

    public function update(Request $request)
    {

        try {
            $unite = unite::findOrFail($request->id);
            $unite->name = ['ar' => $request->name_ar , 'en' => $request->name_en ];
            $unite->note = [ 'ar' => $request->note_ar , 'en' => $request->note_en ];
            $unite->save();

            // return $unite;
            $msg = ['message' => trans("message.update") ];
            $data['unite'] = $unite;
            $data['msg'] = $msg;
            return response()->json($data );

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);

        }
    }

    public function destroy(Request $request)
    {
        try {

            $unite =  unite::findOrFail($request->id);
            $unite->delete();

            $data = ['message' => trans("message.delete") , 'id' => $request->id];
            return response()->json($data);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }

    }
}
