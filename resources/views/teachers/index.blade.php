@extends('layouts.master')
@section('css')
@toastr_css
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h6 class="content-title mb-0 my-auto" style="font-family: 'Cairo', sans-serif;" >{{ trans('main_trans.main') }}</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main_trans.teachers') }}</span>
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
										<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#add_teacher">
                                            <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('teachers_trans.add_teacher') }}
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
												<th class="wd-15p border-bottom-0">{{ trans('teachers_trans.name') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('teachers_trans.specialist') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('teachers_trans.email') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('teachers_trans.phone') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('teachers_trans.address') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('teachers_trans.processes') }}</th>

											</tr>
										</thead>
										<tbody>
                                            @foreach ($teachers as $teacher)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$teacher->name}}</td>
                                                    <td>{{$teacher->specialists->name}}</td>
                                                    <td>{{$teacher->email}}</td>
                                                    <td>{{$teacher->phone}}</td>
                                                    <td>{{$teacher->address}}</td>
                                                    <td>
                                                        <button class=" btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_teacher{{$teacher->id}}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete{{ $teacher->id }}"
                                                            title="{{ trans('teachers_trans.delete') }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>
                                                <!-- delete_modal_teacher -->

                                                <div class="modal fade" id="delete{{ $teacher->id }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    {{ trans('teachers_trans.delete_teacher') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('teachers.destroy', 'delete') }}" method="post">
                                                                    {{ method_field('Delete') }}
                                                                    @csrf
                                                                    {{ trans('teachers_trans.warning_teacher') }}
                                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                                        value="{{ $teacher->id }}">
                                                                        <br>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('teachers_trans.close') }}</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">{{ trans('teachers_trans.submit') }}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- edit_modal_class -->
                                                <div class="modal fade" id="edit_teacher{{$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" >
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                                    {{ trans('teachers_trans.edit_teacher') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form action="{{ route('teachers.update', 'update') }}" method="POST">
                                                                    @method('patch')
                                                                    @csrf
                                                                    <div class="row">
                                                                        <input type="hidden" name="id" value="{{$teacher->id}}">
                                                                        <div class="col">
                                                                            <label for="Name"
                                                                                >{{ trans('teachers_trans.name') }} :</label>
                                                                            <input class="form-control" type="text" name="name"  value="{{$teacher->name}}" />
                                                                        </div>

                                                                        <div class="col">
                                                                            <label for="specialist"
                                                                                >{{ trans('teachers_trans.specialist') }} :</label>
                                                                                <select class="form-control" name="specialist_id" required>
                                                                                    <option selected  >{{$teacher->specialists->name}}</option>
                                                                                    @foreach ($specialists as $specialist)
                                                                                        <option value="{{ $specialist->id }}">{{ $specialist->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                        </div>

                                                                    </div> <br>

                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label for="email"
                                                                                >{{ trans('teachers_trans.email') }} :</label>
                                                                            <input type="email" name="email" class="form-control" value="{{$teacher->email}}" >
                                                                        </div>

                                                                    </div><br>

                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label for="name_en"
                                                                                >{{ trans('teachers_trans.phone') }}:</label>
                                                                            <input class="form-control" type="text" name="phone" value="{{$teacher->phone}}" />
                                                                        </div>
                                                                    </div><br>
                                                                    <div class="row">

                                                                        <div class="col">
                                                                            <label for="Name_en"
                                                                                >{{ trans('teachers_trans.address') }}:</label>
                                                                            <textarea name="address" class="form-control" required >{{$teacher->address}}</textarea>
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
                                                <!-- End_edit_modal_class-->
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                <!-- add_modal_class -->

                                <div class="modal fade" id="add_teacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                    {{ trans('teachers_trans.add_teacher') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('teachers.store') }}" method="POST">
                                                    @csrf
                                                    <div class="row">

                                                        <div class="col">
                                                            <label for="Name"
                                                                >{{ trans('teachers_trans.name') }} :</label>
                                                            <input class="form-control" type="text" name="name"  />
                                                        </div>

                                                        <div class="col">
                                                            <label for="specialist"
                                                                >{{ trans('teachers_trans.specialist') }} :</label>
                                                                <select class="form-control" name="specialist_id" required>
                                                                    <option selected disabled >{{ trans('teachers_trans.select_specialist') }}</option>
                                                                    @foreach ($specialists as $specialist)
                                                                        <option value="{{ $specialist->id }}">{{ $specialist->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div>

                                                    </div> <br>

                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label for="email"
                                                                >{{ trans('teachers_trans.email') }} :</label>
                                                            <input type="email" name="email" class="form-control">
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="password"
                                                                >{{ trans('teachers_trans.password') }} :</label>
                                                            <input type="password" name="password" class="form-control">
                                                        </div>
                                                    </div><br>

                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="name_en"
                                                                >{{ trans('teachers_trans.phone') }}:</label>
                                                            <input class="form-control" type="text" name="phone"  />
                                                        </div>
                                                    </div><br>
                                                    <div class="row">

                                                        <div class="col">
                                                            <label for="Name_en"
                                                                >{{ trans('teachers_trans.address') }}:</label>
                                                            <textarea name="address" class="form-control"></textarea>
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
