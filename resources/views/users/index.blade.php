@extends('layouts.master')
@section('css')
@toastr_css
<!--Internal  Font Awesome -->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!--Internal  treeview -->
<link href="{{URL::asset('assets/plugins/treeview/treeview-rtl.css')}}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{URL::asset('css/edit_style.css')}}" >
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h6 class="content-title mb-0 my-auto" style="font-family: 'Cairo', sans-serif;" >{{ trans('main_trans.main') }}</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main_trans.users') }}</span>
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
										<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" href="{{ route('users.create') }}">
                                            <i class="fa fa-user-plus" aria-hidden="true"></i> {{ trans('users_trans.add_user') }}
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
												<th class="wd-15p border-bottom-0">{{ trans('users_trans.name') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('users_trans.email') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('users_trans.role') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('users_trans.phone_number') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('users_trans.img') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('users_trans.processes') }}</th>

											</tr>
										</thead>
										<tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->role_name}}</td>
                                                    <td>{{$user->phoneNumber}}</td>
                                                    <td><img  src="{{$user->img_path}}" alt="{{ trans('users_trans.profile_img') }}" class="profile_img"    ></td>
                                                    <td>
                                                        {{-- <button class=" btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_user{{$user->id}}">
                                                            <i class="fa fa-edit"></i>
                                                        </button> --}}

                                                        {{-- <a href="{{ route('users.edit', 'us_'.$user->id + 521 ) }}"  class=" btn btn-sm btn-warning"> --}}
                                                            <a href="{{ route('users.edit',Crypt::encrypt($user->id) ) }}"  class=" btn btn-sm btn-warning">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete{{ $user->id }}"
                                                            title="{{ trans('userss_trans.delete') }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>
                                                <!-- delete_modal_class -->
                                                <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    {{ trans('users_trans.delete_user') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('users.destroy', 'delete') }}" method="post">
                                                                    {{ method_field('Delete') }}
                                                                    @csrf
                                                                    {{ trans('users_trans.warning_delete') }}
                                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                                        value="{{ $user->id }}">
                                                                        <br>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('users_trans.close') }}</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">{{ trans('users_trans.submit') }}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- edit_modal_user -->
                                                <div class="modal"  id="edit_user{{$user->id}}">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">{{ trans('users_trans.edit_user') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form class="form-horizontal"  method="POST" action="{{ route('users.update', 'update') }}">
                                                                    {{csrf_field()}}
                                                                    {{method_field('patch')}}
                                                                    <div class="row">
                                                                        <div class="col-9">
                                                                            <input type="hidden"
                                                                                class="form-control" name="id" value="{{$user->id}}">
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" placeholder="{{ trans('users_trans.name') }}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}"  placeholder="{{ trans('users_trans.email') }}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{$user->phoneNumber}}"  placeholder="{{ trans('users_trans.phone_number') }}">
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
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <div class="form-group">
                                                                                <label for="img">{{ trans('users_trans.choose_profile_img') }}:</label>
                                                                                <img  id="img_preview" class="user_preview_img img-thumbnail"  src="{{ asset('uploads/users_files/'.$user->img) }}" alt="default_img">
                                                                                <br><br>
                                                                                <input  type="file" name="img"  value="{{old('img')}}"
                                                                                    onchange="document.getElementById('img_preview').src = window.URL.createObjectURL(this.files[0])"  >
                                                                                {{-- <input type="file" class="dropify" accept="image/*" name="img" data-default-file="{{URL::asset('uploads/users_files/default.png')}}" data-height="225" data-width="225"  /> --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group mb-0 mt-3 justify-content-end">
                                                                        <div>
                                                                            <button type="submit" class="btn btn-primary">{{ trans('users_trans.edit') }}</button>
                                                                            <button data-dismiss="modal" class="btn btn-secondary">{{ trans('users_trans.close') }}</button>
                                                                        </div>
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


                                <!-- add_modal_user -->
                                    {{-- <div class="modal" id="add_class">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">{{ trans('users_trans.add_class') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('classes.store') }}" method="POST">
                                                        @csrf
                                                        <div class="row">

                                                            <div class="col">
                                                                <label for="Name"
                                                                    >{{ trans('users_trans.name_ar') }}:</label>
                                                                <input class="form-control" type="text" name="name_ar"  />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="name_en"
                                                                    >{{ trans('users_trans.name_en') }}:</label>
                                                                <input class="form-control" type="text" name="name_en"  />
                                                            </div>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="Name_en"
                                                                    >{{ trans('users_trans.grade') }}:</label>

                                                                    <select class="form-control" name="Grade_id" required>
                                                                        <option selected disabled >{{ trans('users_trans.select_grade') }}</option>
                                                                        @foreach ($grades as $grade)
                                                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                            </div><br>
                                                            <div class="col">
                                                                <label for="Name_en"
                                                                    >{{ trans('users_trans.academic_year') }}:</label>

                                                                    <select class="form-control" name="acd_year" required>
                                                                        <option selected disabled >{{ trans('users_trans.select_acd_year') }}</option>
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
                                    </div> --}}
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
