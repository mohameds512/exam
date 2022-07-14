@extends('layouts.master')
@section('css')
@toastr_css
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h6 class="content-title mb-0 my-auto" style="font-family: 'Cairo', sans-serif;" >{{ trans('main_trans.main') }}</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main_trans.classes_school') }}</span>
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
										<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#add_class">
                                            <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('classes_trans.add_class') }}
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
												<th class="wd-15p border-bottom-0">{{ trans('classes_trans.name') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('classes_trans.grade_name') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('classes_trans.processes') }}</th>

											</tr>
										</thead>
										<tbody>
                                            @foreach ($classes as $class)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$class->name}}</td>
                                                    <td>{{$class->grades->name}}</td>
                                                    <td>
                                                        <button class=" btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_class{{$class->id}}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete{{ $class->id }}"
                                                            title="{{ trans('classes_trans.delete') }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>
                                                <!-- delete_modal_class -->
                                                <div class="modal fade" id="delete{{ $class->id }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    {{ trans('classes_trans.delete_class') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('classes.destroy', 'delete') }}" method="post">
                                                                    {{ method_field('Delete') }}
                                                                    @csrf
                                                                    {{ trans('classes_trans.warning_class') }}
                                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                                        value="{{ $class->id }}">
                                                                        <br>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('classes_trans.close') }}</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">{{ trans('classes_trans.submit') }}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- edit_modal_class -->
                                                <div class="modal" id="edit_class{{$class->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">{{ trans('classes_trans.edit_class') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('classes.update', 'updte') }}" method="POST">
                                                                    @method('patch')
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{$class->id}}">
                                                                    <div class="row">

                                                                        <div class="col">
                                                                            <label for="Name"
                                                                                >{{ trans('classes_trans.name_ar') }}:</label>
                                                                            <input class="form-control" type="text" name="name_ar"
                                                                                value="{{$class->getTranslation('name', 'ar')}}"  />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label for="name_en"
                                                                                >{{ trans('classes_trans.name_en') }}:</label>
                                                                            <input class="form-control" type="text" name="name_en"
                                                                            value="{{$class->getTranslation('name', 'en')}}" />
                                                                        </div>
                                                                    </div><br>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label for="Name_en"
                                                                                >{{ trans('classes_trans.grade') }}:</label>

                                                                                <select class="form-control" name="Grade_id" required>
                                                                                    <option selected value="{{$class->grades->name}}" >{{$class->grades->name}}</option>
                                                                                    @foreach ($grades as $grade)
                                                                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                        </div><br>
                                                                        <div class="col">
                                                                            <label for="Name_en"
                                                                                >{{ trans('classes_trans.academic_year') }}:</label>

                                                                                <select class="form-control" name="acd_year" required>
                                                                                    <option selected value="{{$class->academic_year}}" >{{$class->academic_year}}</option>
                                                                                    @php
                                                                                        $cur_year = date('Y');
                                                                                    @endphp
                                                                                    @for ($year = $cur_year ; $year <= $cur_year + 1 ; $year++)
                                                                                        <option value="{{$year - 1}} | {{ $year}}"> {{$year - 1}} | {{ $year}}  </option>
                                                                                    @endfor

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
                                <div class="modal" id="add_class">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">{{ trans('classes_trans.add_class') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('classes.store') }}" method="POST">
                                                    @csrf
                                                    <div class="row">

                                                        <div class="col">
                                                            <label for="Name"
                                                                >{{ trans('classes_trans.name_ar') }}:</label>
                                                            <input class="form-control" type="text" name="name_ar"  />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="name_en"
                                                                >{{ trans('classes_trans.name_en') }}:</label>
                                                            <input class="form-control" type="text" name="name_en"  />
                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name_en"
                                                                >{{ trans('classes_trans.grade') }}:</label>

                                                                <select class="form-control" name="Grade_id" required>
                                                                    <option selected disabled >{{ trans('classes_trans.select_grade') }}</option>
                                                                    @foreach ($grades as $grade)
                                                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div><br>
                                                        <div class="col">
                                                            <label for="Name_en"
                                                                >{{ trans('classes_trans.academic_year') }}:</label>

                                                                <select class="form-control" name="acd_year" required>
                                                                    <option selected disabled >{{ trans('classes_trans.select_acd_year') }}</option>
                                                                    @php
                                                                        $cur_year = date('Y');
                                                                    @endphp
                                                                    @for ($year = $cur_year ; $year <= $cur_year + 1 ; $year++)
                                                                        <option value="{{$year - 1}} | {{ $year}}"> {{$year - 1}} | {{ $year}}  </option>
                                                                    @endfor

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
