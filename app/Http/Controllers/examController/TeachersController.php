<?php

namespace App\Http\Controllers\examController;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeTeacherRequest;
use App\Models\specialist;
use App\Models\teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $specialists = specialist::all();
        $teachers = teachers::all();

        return view('teachers.index',compact('teachers','specialists'));

    }


    public function store(storeTeacherRequest $request)
    {
        // return $request;
        try {
            $validated = $request->validated();
            teachers::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'specialist_id' => $request->specialist_id,
                'address' => $request->address,
            ]);

            toastSuccess(trans('message.success'));
            return redirect()->route('teachers.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }
    }

    public function update(storeTeacherRequest $request)
    {
        // return $request;
        try {
            $validated = $request->validated();
            $teacher = teachers::findOrFail($request->id);
            $teacher->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'specialist_id' => $request->specialist_id,
                'address' => $request->address,
            ]);
            toastWarning(trans('message.update'));
            return redirect()->route('teachers.index');

            } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        // return $request;
        try {
            teachers::findOrFail($request->id)->delete();
            toastError(trans('message.update'));
            return redirect()->route('teachers.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }
    }
}
