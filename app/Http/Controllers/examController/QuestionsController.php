<?php

namespace App\Http\Controllers\examController;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeQuestionsRequest;
use App\Models\Grades;
use App\Models\questions;
use App\Repository\questionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class QuestionsController extends Controller
{
    protected $question;

    public function __construct(questionRepositoryInterface $question)
    {
        $this->question = $question;
    }

    public function index()
    {

        return $this->question->index();
    }

    public function show_question($id)
    {
        return $this->question->get_question($id);
    }
    //show_trashed_questions

    public function trashed_questions()
    {
        return $this->question->trashed_questions();

    }
    public function show($unite_id)
    {
        return $this->question->show($unite_id);

    }


    public function create()
    {
        return $this->question->create();
    }

    public function get_subjects($section_id)
    {

        return $this->question->get_subjects($section_id);
    }
    public function get_unites($subject_id)
    {
        // return 'dddddd';
        return $this->question->get_unites($subject_id);
    }
    public function store(storeQuestionsRequest $request)
    {

        return $this->question->store($request);
    }

    public function edit($id)
    {

        return $this->question->edit($id);
    }

    public function update(storeQuestionsRequest $request)
    {

        return $this->question->update($request);
    }


    public function destroy(Request $request)
    {

        return $this->question->destroy($request);
    }


    public function destroy_trashed(Request $request)
    {
        return $this->question->destroy_trashed($request);
    }

    public function restore_question(Request $request)
    {
        return $this->question->restore_question($request);
    }

    public function delete_all_selected(Request $request)
    {
        return $this->question->delete_all_selected($request);
    }

    public function restore_all_selected(Request $request)
    {
        return $this->question->restore_all_selected($request);
    }


}
