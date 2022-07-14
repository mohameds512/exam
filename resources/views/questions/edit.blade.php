@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('main_trans.main') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('questions_trans.edit_question') }}</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">

					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
                <!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
                                    <div class="col-sm-6 col-md-4 col-xl-3">

									</div>

								</div>

							</div>
                            <div class="card-body">
                                <div class="modal-body">
                                    <form action="{{ route('questions.update' , 'update') }}" method="POST">
                                    @method('patch')
                                    @csrf
                                    <input type= "hidden" name = "created_by" value="{{Auth::user()->email}}">
                                    <input type= "hidden" name = "id" value="{{$question->id}}">
                                    <div class="row">

                                        <div class="col">
                                            <label for="Name"
                                                >{{ trans('questions_trans.question') }} :</label>
                                            <textarea class="form-control ckeditor"  name="question" id="" cols="30" rows="10">
                                                {!! $question->question !!}
                                            </textarea>
                                            {{-- <textarea class="form-control ckeditor" type="text" name="question"
                                                value = "{{$question->question}}"  /> --}}
                                        </div>

                                    </div> <br>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <label for="answers"
                                                >{{ trans('questions_trans.answers') }} :</label>
                                            <textarea name="answers" class="form-control">{{$question->answers}}</textarea>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="right_answer"
                                                >{{ trans('questions_trans.right_answer') }} :</label>
                                            <input type="text" name="right_answer" class="form-control"
                                                value = "{{$question->right_answer}}">
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col">
                                            <label for="answers"
                                                >{{ trans('questions_trans.grade_name') }} :</label>
                                            <select class="form-control" name="Grade_id" required>
                                                <option selected value = "{{$question->Grades->id}}" >{{ $question->Grades->name }}</option>
                                                @foreach ($grades as $grade)
                                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="Name_en"
                                                >{{ trans('subjects_trans.class_name') }}:</label>
                                                <select class="form-control" name="class_id" required>
                                                    <option selected value = "{{$question->classes->id}}" >{{ $question->classes->name }}</option>
                                                </select>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col">
                                            <label for="section_name"
                                                >{{ trans('questions_trans.section_name') }}:</label>
                                                <select class="form-control" name="section_id" required>
                                                    <option selected value = "{{$question->sections->id}}" >{{ $question->sections->name }}</option>
                                                </select>
                                        </div>

                                        <div class="col">
                                            <label for="subject_name"
                                                >{{ trans('questions_trans.subject_name') }}:</label>
                                                <select class="form-control" name="subject_id" required>
                                                    <option selected value = "{{$question->subjects->id}}" >{{ $question->subjects->name }}</option>
                                                </select>
                                        </div>
                                        <div class="col">
                                            <label for="unite_name"
                                                >{{ trans('questions_trans.unite_name') }}:</label>
                                            <select name="unite_id" class="form-control" >
                                                <option selected value = "{{$question->unites->id}}" >{{ $question->unites->name }}</option>
                                            </select>
                                        </div>

                                    </div>
                                    </div><br>

                                    <div class="modal-footer">
                                        <button class="btn ripple btn-primary" type="submit">
                                            {{ trans('questions_trans.edit') }}
                                        </button>
                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">
                                            {{ trans('questions_trans.close') }}
                                        </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
