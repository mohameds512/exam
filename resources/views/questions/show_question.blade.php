@extends('layouts.master')
@section('css')
@toastr_css
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('main_trans.main') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('questions_trans.show_question') }}</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

                <!-- row -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body h-100">
								<div class="row row-sm ">
									<div class=" col-xl-5 col-lg-12 col-md-12">

										<h4 class="product-title mb-1"><u>{{ trans('questions_trans.question') }} :</u></h4>
										<p class="product-description tx-13 mb-2 " style="margin-right: 4em" >    {!! $question->question !!} . </p>
                                        <div class="sizes d-flex mb-1"><u> {{ trans('questions_trans.answers') }} : </u></div>
										<p class="product-description tx-13 mb-2" style="margin-right: 4em">    {!! $question->answers !!} . </p>
                                        <div class="sizes d-flex mb-1"><u>{{ trans('questions_trans.right_answer') }} :</u></div>
										<p class="product-description tx-13 mb-2" style="margin-right: 4em">   {!! $question->right_answer !!} . </p>
                                        <div class="sizes d-flex mb-1"><u>{{ trans('questions_trans.processes') }} :</u></div>

                                        <div class="action">

                                            <button type="button" class="btn btn-danger " data-toggle="modal"
                                                data-target="#delete{{ $question->id }}"
                                                title="{{ trans('questions_trans.delete') }}">
                                                {{ trans('questions_trans.delete_question') }}
                                                </button>


                                            @if ($trashed == 1)
                                            <button class=" btn  btn-info-gradient" data-toggle="modal" data-target="#restore{{$question->id}}">
                                                {{ trans('questions_trans.restore_question') }}
                                            </button>
                                            @else
                                            <button class=" btn btn-warning" data-toggle="modal" data-target="#edit_question{{$question->id}}">
                                                {{ trans('questions_trans.edit_question') }}
                                            </button>
                                            @endif


										</div>

									</div>
									<div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">

                                        <h4 class="sizes d-flex mb-1"><u>{{ trans('questions_trans.created_by') }} :</u></h4>
										<p class="product-description tx-13 mb-2" style="margin-right: 4em">    {{$question->created_by}}  </p>
                                        <div class="sizes d-flex mb-1"><u>{{ trans('questions_trans.grade_name') }} :</u></div>
										<p class="product-description tx-13 mb-1" style="margin-right: 4em" >   {{$question->grades->name}} . </p>
                                        <div class="sizes d-flex mb-1"><u>{{ trans('questions_trans.class_name') }} :</u></div>
										<p class="product-description tx-13 mb-1" style="margin-right: 4em">    {{$question->classes->name}} . </p>
                                        <div class="sizes d-flex mb-1"><u>{{ trans('questions_trans.subject_name') }} :</u></div>
										<p class="product-description tx-13 mb-1" style="margin-right: 4em">   {{$question->subjects->name}} . </p>
                                        <div class="sizes d-flex mb-1"><u>{{ trans('questions_trans.unite_name') }} :</u></div>
										<p class="product-description tx-13 mb-1" style="margin-right: 4em">   {{$question->unite_name}} . </p>


									</div>
								</div>
							</div>
                            <!-- restore_modal_question -->
                            <div class="modal fade" id="restore{{ $question->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('questions_trans.restore_question') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('restore_question') }}" method="get">
                                                @csrf
                                                {{ trans('questions_trans.warning_restore_question') }}
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
                            <!-- end_of_restore-->
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
                                            @if ($trashed == 1)
                                                <form action="{{ route('destroy_trashed', 'delete') }}" method="GET">
                                            @else
                                                <form action="{{ route('questions.destroy', 'delete') }}" method="POST">
                                            @endif

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
                                        <textarea class="form-control ckeditor"  name="question">{!!$question->question !!}</textarea>

                                    </div>


                                </div> <br>

                                <div class="row">
                                    <div class="col">
                                        <label for="answers"
                                            >{{ trans('questions_trans.answers') }} :</label>
                                        <textarea name="answers" class="form-control">{{$question->answers}}</textarea>
                                    </div>


                                </div><br>

                                    <div class="row">
                                        <div class="col">
                                        <label for="right_answer"
                                            >{{ trans('questions_trans.right_answer') }} :</label>
                                        <input type="text" name="right_answer" class="form-control"
                                            value = "{{$question->right_answer}}">
                                    </div>

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


                                </div><br>

                                <div class="row">
                                    <div class="col">
                                        <label for="Name_en"
                                            >{{ trans('subjects_trans.class_name') }}:</label>
                                            <select class="form-control" name="class_id" required>
                                                <option selected value = "{{$question->classes->id}}" >{{ $question->classes->name }}</option>
                                            </select>
                                    </div>
                                    <div class="col">
                                        <label for="section_name"
                                            >{{ trans('questions_trans.section_name') }}:</label>
                                            <select class="form-control" name="section_id" required>
                                                <option selected value = "{{$question->sections->id}}" >{{ $question->sections->name }}</option>
                                            </select>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="subject_name"
                                            >{{ trans('questions_trans.subject_name') }}:</label>
                                            <select class="form-control" name="subject_id" required>
                                                <option selected value = "{{$question->subjects->id}}" >{{ $question->subjects->name }}</option>
                                            </select>
                                    </div>
                                    <div class="col">
                                        <label for="unite_name"
                                            >{{ trans('questions_trans.subject_name') }}:</label>
                                            <select class="form-control" name="unite_id" required>
                                                <option selected value = "{{$question->unites->id}}" >{{ $question->unites->name }}</option>
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
                            <!-- end_of_the_edit -->

						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
