@extends('layouts.master')
@section('css')
@toastr_css
<!--Internal  Font Awesome -->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!--Internal  treeview -->
<link href="{{URL::asset('assets/plugins/treeview/treeview-rtl.css')}}" rel="stylesheet" type="text/css" />
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

                                <div class="row">
                                    @foreach ($grades as $grade)
                                        <div class="col-lg-4 mt-4 mt-lg-0">
                                            <ul id="treeview{{$loop->iteration}}">
                                                <li><a href="#">{{ $grade->name }}</a>
                                                    <ul>
                                                        @foreach ($grade->classes as $class)
                                                            <li>
                                                                <a href="sections/{{$class->id}}">{{$class->name}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach


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
<!-- Internal Treeview js -->
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
@toastr_js
@toastr_render
@endsection
