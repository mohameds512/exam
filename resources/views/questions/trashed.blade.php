@extends('layouts.master')
@section('css')
@toastr_css
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h6 class="content-title mb-0 my-auto" style="font-family: 'Cairo', sans-serif;" >{{ trans('main_trans.main') }}</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main_trans.trashed_questions') }}</span>
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

                                <button  class=" btn btn-danger-gradient " id="btn_delete_all">
                                    {{ trans('main_trans.delete_all_selected') }} <i class="fas fa-trash-alt"></i>
                                </button>

                                <button  class=" btn btn-warning-gradient " id="btn_restore_all">
                                    {{ trans('questions_trans.restore_all_selected') }} <i class="fas fa-trash-alt"></i>
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
									<table  class="table text-md-nowrap select_all_data" id="example1">
										<thead>
											<tr>
                                                <th class="wd-6p border-bottom-0">
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
												<th class="wd-15p border-bottom-0">{{ trans('questions_trans.subject_name') }}</th>
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
                                                <td>{{$question->subjects->name}}</td>
                                                <td>
                                                    <button class=" btn btn-sm btn-warning" data-toggle="modal" data-target="#restore{{$question->id}}">
                                                        <i class="fas fa-trash-restore"></i>
                                                    </button>

                                                    <a href="{{ route('get_question', [$question->id] ) }}" class="btn btn-sm btn-info">
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
                                                            <form action="{{ route('destroy_trashed', 'delete') }}" method="GET">
                                                                {{ method_field('delete') }}
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
                                                                <input id="status" type="hidden" name="status" value="trashed">
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
                                            <!-- restore_all_sellected_question -->

                                            <div class="modal fade" id="restore_all" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                id="exampleModalLabel">
                                                                {{ trans('questions_trans.restore_all_selected') }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('restore_all_selected') }}" method="POST">
                                                                @csrf
                                                                {{ trans('questions_trans.warning_restore_all_selected') }}
                                                                <input id="restore_all_id" type="hidden" name="restore_all_id" value="">
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
			</div>
            </div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@toastr_js
@toastr_render

@endsection
