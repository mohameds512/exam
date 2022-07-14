@extends('layouts.master')
@section('css')
@toastr_css
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h6 class="content-title mb-0 my-auto" style="font-family: 'Cairo', sans-serif;" >{{ trans('main_trans.main') }}</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main_trans.questions') }}</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
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
                                <a class=" btn btn-outline-primary" data-effect="effect-scale"  href="{{ route('questions.create') }}">
                                    <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('questions_trans.add_question') }}
                                </a>
                                <button  class=" btn btn-danger-gradient " id="btn_delete_all">
                                    {{ trans('main_trans.delete_all_selected') }} <i class="fas fa-trash-alt"></i>
                                </button>
                                <br><br>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

								<div class="table-responsive">
									<table class="table text-md-nowrap select_all_data" id="example1">
										<thead>
											<tr>
												<th class="wd-10p border-bottom-0">
                                                    <div class="row">
                                                        {{ trans('main_trans.select_all') }} :
                                                        <input type="checkbox"
                                                        name="select_all" onclick="checkAll('box1',this)" name="" id="select_all">

                                                    </div>
                                                </th>
												<th class="wd-5p border-bottom-0">#</th>
												<th class="wd-15p border-bottom-0">{{ trans('questions_trans.question') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('questions_trans.answers') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('questions_trans.right_answer') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('questions_trans.processes') }}</th>

											</tr>
										</thead>
										<tbody>
                                            @foreach ($questions as $question)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="box1" value="{{$question->id}}">
                                                    </td>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{!! $question->question !!}</td>
                                                    <td>{{$question->answers}}</td>
                                                    <td>{{$question->right_answer}}</td>
                                                    <td>
                                                        {{-- <button class=" btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_question{{$question->id}}">
                                                            <i class="fa fa-edit"></i>
                                                        </button> --}}
                                                        <a href="{{ route('questions.edit', ($question->id*11)) }}" class=" btn btn-sm btn-warning">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('get_question', encrypt($question->id) ) }}" class="btn btn-sm btn-info">
                                                            <i class="fa fa-eye"></i>
                                                        </a>

                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete{{ $question->id }}"
                                                            title="{{ trans('questions_trans.delete') }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>
                                                <!-- delete_modal_question -->

                                                <div class="modal fade" id="delete{{ $question->id }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    {{ trans('questions_trans.delete_question') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('questions.destroy', 'delete') }}" method="POST">
                                                                    {{ method_field('Delete') }}
                                                                    @csrf
                                                                    {{ trans('questions_trans.warning_question') }}
                                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                                        value="{{ $question->id }}">
                                                                        <br>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('questions_trans.close') }}</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">{{ trans('questions_trans.submit') }}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- edit_modal_class -->
                                                <div class="modal fade" id="edit_question{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" >
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                                    {{ trans('questions_trans.edit_question') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

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
                                                                    {{$question->question}}
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
                                                        </div>
                                                        </div><br>

                                                        <div class="modal-footer">
                                                            <button class="btn ripple btn-primary" type="submit">
                                                                {{ trans('questions_trans.save') }}
                                                            </button>
                                                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">
                                                                {{ trans('questions_trans.close') }}
                                                            </button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- End_edit_modal_class-->
                                        @endforeach


                                            <!-- delete_all_sellected_question -->

                                            <div class="modal fade" id="delete_all" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                id="exampleModalLabel">
                                                                {{ trans('questions_trans.delete_all_selected') }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('delete_all_selected') }}" method="POST">
                                                                @csrf
                                                                {{ trans('questions_trans.warning_delete_all_selected') }}
                                                                <input type="hidden" name="status" id="trashed" value="not_trashed">
                                                                <input id="delete_all_id" type="hidden" name="delete_all_id" value="">
                                                                    <br>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('questions_trans.close') }}</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">{{ trans('questions_trans.submit') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

							</div>
						</div>
					</div>
					<!--/div-->

				</div>
				<!-- /row -->

		<!-- main-content closed -->
@endsection
@section('js')

@toastr_js
@toastr_render
@endsection
