@extends('layouts.master')
@section('css')
@toastr_css
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h6 class="content-title mb-0 my-auto" style="font-family: 'Cairo', sans-serif;" >{{ trans('main_trans.main') }}</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main_trans.specialist_school') }}</span>
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
                                            <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('specialists_trans.add_specialist') }}
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
												<th class="wd-15p border-bottom-0">{{ trans('specialists_trans.name') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('specialists_trans.notes') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('specialists_trans.processes') }}</th>

											</tr>
										</thead>
										<tbody>
                                            @foreach ($specialists as $specialist)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$specialist->name}}</td>
                                                    <td>{{$specialist->notes}}</td>
                                                    <td>
                                                        <button class=" btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_specialist{{$specialist->id}}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete{{ $specialist->id }}"
                                                            title="{{ trans('specialists_trans.delete') }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>
                                                <!-- delete_modal_specialist -->
                                                <div class="modal fade" id="delete{{ $specialist->id }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    {{ trans('specialists_trans.delete_specialist') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('specialists.destroy', 'delete') }}" method="post">
                                                                    {{ method_field('Delete') }}
                                                                    @csrf
                                                                    {{ trans('specialists_trans.warning_specialist') }}
                                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                                        value="{{ $specialist->id }}">
                                                                        <br>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('specialists_trans.close') }}</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">{{ trans('specialists_trans.submit') }}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- edit_modal_subject -->
                                                <div class="modal" id="edit_specialist{{$specialist->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">{{ trans('specialists_trans.edit_specialist') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('specialists.update' , 'update') }}" method="POST">
                                                                    @method('patch')
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{$specialist->id}}">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label for="name" >
                                                                                {{ trans('specialists_trans.name_ar') }}
                                                                            </label>
                                                                            <input type="text" class="form-control" name="name_ar"
                                                                                value="{{$specialist->getTranslation('name' , 'ar')}}">
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="name" >
                                                                                {{ trans('specialists_trans.name_en') }}
                                                                            </label>
                                                                            <input type="text" class="form-control" name="name_en"
                                                                                value="{{$specialist->getTranslation('name' , 'en')}}">
                                                                        </div>
                                                                    </div><br>
                                                                    <div class="form-group">
                                                                        <div class="col">
                                                                            <label for="exampleFormControlTextarea1" >
                                                                                {{ trans('specialists_trans.note_ar') }}
                                                                            </label>
                                                                            <textarea name="note_ar" class="form-control" id="exampleFormControlTextarea1"
                                                                                rows="3">{{$specialist->getTranslation('notes' , 'ar')}}</textarea>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="exampleFormControlTextarea1" >
                                                                                {{ trans('specialists_trans.note_en') }}
                                                                            </label>
                                                                            <textarea name="note_en" class="form-control" id="exampleFormControlTextarea1"
                                                                                rows="3">{{$specialist->getTranslation('notes' , 'en')}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="btn ripple btn-primary" type="submit">
                                                                            {{ trans('specialists_trans.edit') }}
                                                                        </button>
                                                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">
                                                                            {{ trans('specialists_trans.close') }}
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
                                <div class="modal" id="modaldemo8">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">{{ trans('specialists_trans.add_specialist') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('specialists.store') }}" method="POST">
                                                    @csrf
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label for="name" >
                                                                {{ trans('specialists_trans.name_ar') }}
                                                            </label>
                                                            <input type="text" class="form-control" name="name_ar">
                                                        </div>
                                                        <div class="col">
                                                            <label for="name" >
                                                                {{ trans('specialists_trans.name_en') }}
                                                            </label>
                                                            <input type="text" class="form-control" name="name_en">
                                                        </div>
                                                    </div><br>
                                                    <div class="form-group">
                                                        <div class="col">
                                                            <label for="exampleFormControlTextarea1" >
                                                                {{ trans('specialists_trans.note_ar') }}
                                                            </label>
                                                            <textarea name="note_ar" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleFormControlTextarea1" >
                                                                {{ trans('specialists_trans.note_en') }}
                                                            </label>
                                                            <textarea name="note_en" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn ripple btn-primary" type="submit">
                                                            {{ trans('specialists_trans.save') }}
                                                        </button>
                                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">
                                                            {{ trans('specialists_trans.close') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal effects-->
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
