@extends('layouts.master')
@section('css')
@toastr_css
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h6 class="content-title mb-0 my-auto" style="font-family: 'Cairo', sans-serif;" >{{ trans('main_trans.main') }}</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main_trans.sections') }}</span>
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
										<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#add_section">
                                            <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('sections_trans.add_section') }}
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
												<th class="wd-15p border-bottom-0">{{ trans('sections_trans.name') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('sections_trans.grade_name') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('sections_trans.class_name') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('sections_trans.processes') }}</th>

											</tr>
										</thead>
										<tbody>
                                            @foreach ($sections as $section)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$section->name}}</td>
                                                    <td>{{$section->grades->name}}</td>
                                                    <td>{{$section->classes->name}}</td>
                                                    <td>
                                                        <button class=" btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_section{{$section->id}}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete{{ $section->id }}"
                                                            title="{{ trans('sections_trans.delete') }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>
                                                <!-- delete_modal_section -->
                                                <div class="modal fade" id="delete{{ $section->id }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    {{ trans('sections_trans.delete_section') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('sections.destroy', 'delete') }}" method="post">
                                                                    {{ method_field('Delete') }}
                                                                    @csrf
                                                                    {{ trans('sections_trans.warning_section') }}
                                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                                        value="{{ $section->id }}">
                                                                        <br>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('sections_trans.close') }}</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">{{ trans('sections_trans.submit') }}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- edit_modal_class -->
                                                <div class="modal" id="edit_section{{$section->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">{{ trans('sections_trans.edit_section') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('sections.update', 'update') }}" method="POST">
                                                                    @method('patch')
                                                                    @csrf
                                                                    <div class="row">
                                                                        <input type="hidden" name="id" value="{{$section->id}}">
                                                                        <div class="col">
                                                                            <label for="Name"
                                                                                >{{ trans('sections_trans.name_ar') }}:</label>
                                                                            <input class="form-control" type="text" name="name_ar"
                                                                                value="{{$section->getTranslation('name','ar')}}"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label for="name_en"
                                                                                >{{ trans('sections_trans.name_en') }}:</label>
                                                                            <input class="form-control" type="text" name="name_en"
                                                                            value="{{$section->getTranslation('name','en')}}"/>
                                                                        </div>
                                                                    </div><br>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label for="Name_en"
                                                                                >{{ trans('sections_trans.grade') }}:</label>

                                                                                <select class="form-control" name="Grade_id" required>
                                                                                    <option selected value="{{$section->grades->id}}"  >{{$section->grades->name}}</option>
                                                                                    @foreach ($grades as $grade)
                                                                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                        </div><br>
                                                                        <div class="col">
                                                                            <label for="Name_en">{{ trans('sections_trans.class') }}:</label>

                                                                                <select class="form-control" name="class_id" required>
                                                                                    <option value="{{$section->classes->id}}"> {{$section->classes->name}} </option>
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                    </div><br>

                                                                    <div class="modal-footer">
                                                                        <button class="btn ripple btn-primary" type="submit">
                                                                            {{ trans('grades_trans.edit') }}
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
                                                <!-- End_edit_modal_class-->
                                            @endforeach


										</tbody>
									</table>
								</div>
                                <!-- add_modal_class -->
                                <div class="modal" id="add_section">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">{{ trans('sections_trans.add_section') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('sections.store') }}" method="POST">
                                                    @csrf
                                                    <div class="row">

                                                        <div class="col">
                                                            <label for="Name"
                                                                >{{ trans('sections_trans.name_ar') }}:</label>
                                                            <input class="form-control" type="text" name="name_ar"  />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="name_en"
                                                                >{{ trans('sections_trans.name_en') }}:</label>
                                                            <input class="form-control" type="text" name="name_en"  />
                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name_en"
                                                                >{{ trans('sections_trans.grade') }}:</label>

                                                                <select class="form-control" name="Grade_id" required>
                                                                    <option selected disabled >{{ trans('sections_trans.select_grade') }}</option>
                                                                    @foreach ($grades as $grade)
                                                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div><br>
                                                        <div class="col">
                                                            <label for="Name_en"
                                                                >{{ trans('sections_trans.class') }}:</label>

                                                                <select class="form-control" name="class_id" required>
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
                                <!-- End Modal Add_class-->

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
