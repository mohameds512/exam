<?php

namespace App\Http\Controllers\examController;

use App\Http\Controllers\Controller;
use App\Http\Requests\specialistRequest;
use App\Models\specialist;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialists = specialist::all();

        return view('specialists.index',compact('specialists'));
    }

    public function store(specialistRequest $request)
    {
        // return $request;
        try {

            $validated = $request->validated();

            specialist::create([
                'name' => ['ar' => $request->name_ar , 'en'=> $request->name_en],
                'notes' => ['ar' => $request->note_ar , 'en'=> $request->note_en],
            ]);

            toastSuccess(trans('message.success'));
            return redirect()->route('specialists.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }

    }


    public function update(specialistRequest $request)
    {
        // return $request;
        try {
            $validated = $request->validated();
            $specialist = specialist::findOrFail($request->id);
            $specialist->update([
                'name' => ['ar' => $request->name_ar , 'en'=> $request->name_en],
                'notes' => ['ar' => $request->note_ar , 'en'=> $request->note_en],
            ]);

            toastWarning(trans('message.update'));
            return redirect()->route('specialists.index');

        } catch (\Exception $e ) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        // return $request;
        try {
            $specialist = specialist::findOrFail($request->id);
            $specialist->delete();

            toastError(trans('message.delete'));
            return redirect()->route('specialists.index');

        } catch (\Exception $e ) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }
    }
}
