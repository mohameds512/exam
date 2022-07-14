@extends('layouts.master')
@section('css')
@toastr_css
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h6 class="content-title mb-0 my-auto" style="font-family: 'Cairo', sans-serif;" >{{ trans('main_trans.main') }}</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main_trans.grade_school') }}</span>
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
										<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">
                                            <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('grades_trans.add_grade') }}
                                        </a>
									</div>

								</div>

							</div>
							<div class="card-body">

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
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-5p border-bottom-0">#</th>
												<th class="wd-15p border-bottom-0">{{ trans('grades_trans.name') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('grades_trans.notes') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('grades_trans.processes') }}</th>

											</tr>
										</thead>
										<tbody>
                                            @foreach ($grades as $grade)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$grade->name}}</td>
                                                    <td>{{$grade->notes}}</td>
                                                    <td>
                                                        <a href="{{ route('grades.edit', encrypt($grade->id)) }}" class="btn btn-info btn-sm" title="{{ trans('grades_trans.edit') }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete{{ $grade->id }}"
                                                            title="{{ trans('grades_trans.delete') }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>
                                                <!-- delete_modal_Grade -->
                                                <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    {{ trans('grades_trans.delete_grade') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('grades.destroy', 'delete') }}" method="post">
                                                                    {{ method_field('Delete') }}
                                                                    @csrf
                                                                    {{ trans('grades_trans.warning_grade') }}
                                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                                        value="{{ $grade->id }}">
                                                                        <br>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('grades_trans.close') }}</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">{{ trans('grades_trans.submit') }}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


										</tbody>
									</table>
								</div>

                                {{-- modal add_grade --}}
                                <div class="modal" id="modaldemo8">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">{{ trans('grades_trans.add_grade') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('grades.store') }}" method="POST">
                                                    @csrf
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label for="name" >
                                                                {{ trans('grades_trans.name_ar') }}
                                                            </label>
                                                            <input type="text" class="form-control" name="name_ar">
                                                        </div>
                                                        <div class="col">
                                                            <label for="name" >
                                                                {{ trans('grades_trans.name_en') }}
                                                            </label>
                                                            <input type="text" class="form-control" name="name_en">
                                                        </div>
                                                    </div><br>
                                                    <div class="form-group">
                                                        <div class="col">
                                                            <label for="exampleFormControlTextarea1" >
                                                                {{ trans('grades_trans.note_ar') }}
                                                            </label>
                                                            <textarea name="note_ar" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleFormControlTextarea1" >
                                                                {{ trans('grades_trans.note_en') }}
                                                            </label>
                                                            <textarea name="note_en" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn ripple btn-primary" type="submit">
                                                            {{ trans('grades_trans.save') }}
                                                        </button>
                                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">
                                                            {{ trans('grades_trans.close') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal add_grad-->
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
