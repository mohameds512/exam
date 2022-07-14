@extends('layouts.master')
@section('css')
@toastr_css
<!--Internal  Font Awesome -->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h6 class="content-title mb-0 my-auto" style="font-family: 'Cairo', sans-serif;" >{{ trans('main_trans.main') }}</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('users_trans.add_user') }}</span>
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
                                    {{-- <div class="col-sm-6 col-md-4 col-xl-3">
										<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="{{ route('users.create') }}">
                                            <i class="fa fa-user-plus" aria-hidden="true"></i> {{ trans('users_trans.add_user') }}
                                        </a>
									</div> --}}

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



                                <!-- add_user -->
                                <div class="card-body pt-0">
                                    <form class="form-horizontal"  method="POST" action="{{ route('users.update', 'update') }}" enctype="multipart/form-data" >
                                        {{csrf_field()}}
                                        {{method_field('patch')}}
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" placeholder="{{ trans('users_trans.name') }}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}"  placeholder="{{ trans('users_trans.email') }}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{$user->phoneNumber}}"  placeholder="{{ trans('users_trans.phone_number') }}">
                                                </div>
                                                {{-- <div class="form-group">
                                                    <input type="password" class="form-control" id="password" name="password"  placeholder="{{ trans('users_trans.password') }}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ trans('users_trans.confirmed_password') }}">
                                                </div> --}}
                                            </div>
                                            <div class="col-3">
                                                <label for="img">{{ trans('users_trans.choose_profile_img') }}:</label>
										        <input type="file" accept="image/*" class="dropify" name="img" data-default-file="{{URL::asset('uploads/users_files/'.$user->img)}}" data-height="200" data-width="200"  />

                                            </div>
                                        </div>



                                        <div class="main-content-label mg-b-5">
                                            {{ trans('users_trans.user_role') }} :
                                        </div>
                                        <div class="row mg-t-10">
                                            @foreach ($roles as $role)
                                                <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                                    <label class="rdiobox"><input  {{$user->roles()->first()->id == $role->id ? 'checked' : ''}}  name="role" value="{{$role->id}}" type="radio"> <span>{{$role->name}}</span></label>
                                                </div>
                                            @endforeach

                                        </div>
                                        <div class="form-group mb-0 mt-3 justify-content-end">
                                            <div>
                                                <button type="submit" class="btn btn-primary">{{ trans('users_trans.edit') }}</button>
                                            </div>
                                        </div>

                                    </form>
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
<!--Internal Fileuploads js-->
<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
@toastr_js
@toastr_render
@endsection
