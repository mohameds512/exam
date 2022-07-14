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

                                <div class="row">
                                    @foreach ($grades as $grade)
                                            <div class="col-lg-4 mt-4 mt-lg-0">
                                                <ul id="treeview{{$loop->iteration}}">
                                                    <li><a href="#">{{ $grade->name }}</a>
                                                        <ul>
                                                            @foreach ($grade->classes as $class)
                                                                <li> <a href="#">{{$class->name}}</a>
                                                                    <ul>
                                                                        @foreach ($class->sections as $section)
                                                                            <li><a href="#">{{$section->name}}</a>
                                                                                <ul>
                                                                                    @foreach ($section->subjects as $subject)
                                                                                        <li> <a href="#">{{$subject->name}}</a>
                                                                                            <ul>
                                                                                                @foreach ($subject->unites as $unite)
                                                                                                    <li><a href="questions/{{$unite->id}}">{{$unite->name}}</a></li>
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endforeach
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

<!-- Internal Treeview js -->
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
@toastr_js
@toastr_render
@endsection
