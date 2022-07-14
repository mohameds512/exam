@extends('layouts.master')
@section('css')
@toastr_css
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h6 class="content-title mb-0 my-auto" style="font-family: 'Cairo', sans-serif;" >{{ trans('main_trans.main') }}</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main_trans.subjects') }}</span>
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
										<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#add_subject">
                                            <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('subjects_trans.add_subject') }}
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
												<th class="wd-15p border-bottom-0">{{ trans('subjects_trans.name') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('subjects_trans.grade_name') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('subjects_trans.class_name') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('subjects_trans.section_name') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('subjects_trans.processes') }}</th>

											</tr>
										</thead>
										<tbody>
                                            @foreach ($subjects as $subject)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$subject->name}}</td>
                                                    <td>{{$subject->grades->name}}</td>
                                                    <td>{{$subject->classes->name}}</td>
                                                    <td>{{$subject->sections->name}}</td>
                                                    <td>
                                                        <button class=" btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_subject{{$subject->id}}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete{{ $subject->id }}"
                                                            title="{{ trans('subjects_trans.delete') }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>
                                                <!-- delete_modal_subject -->
                                                <div class="modal fade" id="delete{{ $subject->id }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    {{ trans('subjects_trans.delete_subject') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('subjects.destroy', 'delete') }}" method="post">
                                                                    {{ method_field('Delete') }}
                                                                    @csrf
                                                                    {{ trans('subjects_trans.warning_subject') }}
                                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                                        value="{{ $subject->id }}">
                                                                        <br>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('subjects_trans.close') }}</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">{{ trans('subjects_trans.submit') }}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- edit_modal_subject -->
                                                <div class="modal" id="edit_subject{{$subject->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">{{ trans('subjects_trans.edit_subject') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('subjects.update','update') }}" method="POST">
                                                                    @method('patch')
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{$subject->id}}">
                                                                    <div class="row">

                                                                        <div class="col">
                                                                            <label for="Name"
                                                                                >{{ trans('subjects_trans.name_ar') }}:</label>
                                                                            <input class="form-control" type="text" name="name_ar"
                                                                                value="{{$subject->getTranslation('name' , 'ar')}}" />
                                                                        </div>

                                                                        <div class="col">
                                                                            <label for="name_en"
                                                                                >{{ trans('subjects_trans.name_en') }}:</label>
                                                                            <input class="form-control" type="text" name="name_en"
                                                                            value="{{$subject->getTranslation('name' , 'en')}}" />
                                                                        </div>
                                                                    </div><br>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label for="Name_en"
                                                                                >{{ trans('subjects_trans.grade') }}:</label>

                                                                                <select class="form-control" name="Grade_id" required>
                                                                                    <option selected value="{{$subject->grades->id}}" >{{$subject->grades->name}}</option>
                                                                                    @foreach ($grades as $grade)
                                                                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                        </div><br>
                                                                        <div class="col">
                                                                            <label for="Name_en"
                                                                                >{{ trans('subjects_trans.class_name') }}:</label>

                                                                                <select class="form-control" name="class_id" required>
                                                                                    <option selected value="{{$subject->classes->id}}" >{{$subject->classes->name}}</option>


                                                                                </select>
                                                                        </div>
                                                                    </div><br>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label for="Name_en"
                                                                                >{{ trans('subjects_trans.section_name') }}:</label>
                                                                                <select class="form-control" name="section_id" required>
                                                                                    <option selected value="{{$subject->sections->id}}" >{{$subject->sections->name}}</option>

                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                    </div><br>

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
                                                <!-- End_edit_modal_subject -->
                                            @endforeach


										</tbody>
									</table>
								</div>
                                <!-- add_modal_subject -->
                                <div class="modal" id="add_subject">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">{{ trans('subjects_trans.add_subject') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('subjects.store') }}" method="POST">
                                                    @csrf
                                                    <div class="row">

                                                        <div class="col">
                                                            <label for="Name"
                                                                >{{ trans('subjects_trans.name_ar') }}:</label>
                                                            <input class="form-control" type="text" name="name_ar"  />
                                                        </div>

                                                        <div class="col">
                                                            <label for="name_en"
                                                                >{{ trans('subjects_trans.name_en') }}:</label>
                                                            <input class="form-control" type="text" name="name_en"  />
                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name_en"
                                                                >{{ trans('subjects_trans.grade') }}:</label>

                                                                <select class="form-control" name="Grade_id" required>
                                                                    <option selected disabled >{{ trans('subjects_trans.select_grade') }}</option>
                                                                    @foreach ($grades as $grade)
                                                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div><br>
                                                        <div class="col">
                                                            <label for="Name_en"
                                                                >{{ trans('subjects_trans.class_name') }}:</label>

                                                                <select class="form-control" name="class_id" required>


                                                                </select>
                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name_en"
                                                                >{{ trans('subjects_trans.section_name') }}:</label>
                                                                <select class="form-control" name="section_id" required>

                                                                </select>
                                                        </div>
                                                    </div>
                                                    </div><br>

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
                                <!-- End Modal Add_subject-->

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
