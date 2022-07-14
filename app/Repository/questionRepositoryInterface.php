<?php

namespace App\Repository;

interface questionRepositoryInterface {

    public function index();
    public function show($unite_id);
    public function get_question($id);
    public function trashed_questions();
    public function create();
    public function get_subjects($section_id);
    public function get_unites($subject_id);
    public function store($request);
    public function edit($id);
    public function update($request);
    public function destroy($request);
    public function destroy_trashed($request);
    public function restore_question($request);
    public function delete_all_selected($request);
    public function restore_all_selected($request);

}

