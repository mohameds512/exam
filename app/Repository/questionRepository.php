<?php

namespace App\Repository;

use App\Models\classes;
use App\Models\Grades;
use App\Models\questions;
use App\Models\subjects;
use App\Models\unite;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Stmt\TryCatch;
use Intervention\Image\Facades\Image;


class questionRepository  implements questionRepositoryInterface
{
    public function index()
    {

        // $questions = questions::paginate(10);
        $grades = Grades::get(['id', 'name']);

        return view('questions.index', compact('grades'));
    }

    public function show($unite_id)
    {
        try {
            $data['grades'] = Grades::get(['id','name']);
            $data['questions'] = unite::findOrFail($unite_id)->questions ;

            return view('questions.show_details',$data);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }
    public function get_question($id)
    {
        try {
            $question_id = crypt::decrypt($id);
            $question = questions::find($question_id);
            $trashed = 0;
            if (empty($question)) {
                $question = questions:: onlyTrashed()->findOrFail($id);
                $trashed = 1;
            }
            $grades = Grades::all();

            return view('questions.show_question',compact('question','grades' , 'trashed'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);

        }

    }

    public function trashed_questions()
    {

        $questions = questions::onlyTrashed()->get();

        return view('questions.trashed' , compact('questions'));
    }

    public function create()
    {
        $grades = Grades::all();
        $unites = unite::all();
        return view('questions.create',compact('grades', 'unites'));
    }

    public function get_subjects($section_id)
    {
        $subjects_list = subjects::where('section_id', $section_id)->pluck('name' , 'id');
        return $subjects_list;
    }
    public function get_unites($subject_id)
    {
        $unites_list = unite::where('subjects_id', $subject_id)->pluck('name' , 'id');
        return $unites_list;
    }


    public function store($request)
    {
        try {

            $validated = $request ->validated();

            // if ($request->photo) {

            //     $img_name = time().$request->photo->hashName();
            //     Image::make($request->photo)->resize(300, null, function ($constraint) {
            //         $constraint->aspectRatio();
            //     })->save(public_path('assets/imgs/qu_img/'.$img_name));

            // }

            questions::create([
                'question' => $request->question,
                'answers' => $request->answers,
                'right_answer' => $request->right_answer,
                'teacher_id' => $request->teacher_id,
                // 'photo' => $img_name,
                'qu_deg' => $request->qu_deg,
                'grade_id' => $request->Grade_id,
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'subject_id' => $request->subject_id,
                'unite_id' => $request->unite_id,
                'pending' => true,
            ]);

            toastSuccess(trans('message.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {

            $question_id = ($id/11);
            $question = questions::findOrFail($question_id);
            $grades = Grades::all();
            $unites = unite::all();
            return view('questions.edit' , compact('question','grades','unites'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }

    }

    public function update($request)
    {

        try {
            $validated = $request->validated();

            $question = questions::findOrFail($request->id);
            // return $question;
            $question->update([
                'question' => $request->question,
                'answers' => $request->answers,
                'right_answer' => $request->right_answer,
                // 'teacher_id' => $request->teacher_id,
                'grade_id' => $request->Grade_id,
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'subject_id' => $request->subject_id,
            ]);

            toastWarning(trans('message.update'));

            return redirect()->route('questions.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([ 'error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {

        try {

            questions::destroy($request->id);

            toastError(trans('message.delete'));
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function restore_question($request)
    {
        try {

            questions::onlyTrashed()->where('id' ,$request->id)->restore();
            toastInfo(trans('message.restore'));
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }

    }

    public function destroy_trashed($request)
    {
        try {

            questions::onlyTrashed()->where('id' ,$request->id)->forceDelete();

            toastError(trans('message.delete'));
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }

    }


    public function delete_all_selected($request)
    {
        try {
            $delete_all_id = explode("," , $request->delete_all_id);

            if ($request->status == 'trashed') {

                questions::onlyTrashed()->whereIn('id',$delete_all_id)->forceDelete();
                toastError(trans('message.delete_selected'));

            } else {

                questions::whereIn('id',$delete_all_id)->delete();
                toastError(trans('message.delete_selected'));

            }
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }


    }

    public function restore_all_selected($request)
    {
        try {

            $restore_all_id = explode("," , $request->restore_all_id);
            questions::onlyTrashed()->whereIn('id' , $restore_all_id)->restore();
            toastInfo(trans('message.restore_all_selected'));
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }

    }







}

