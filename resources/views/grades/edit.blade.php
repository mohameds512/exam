@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('main_trans.grades_list') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('grades_trans.edit') }}</span>
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

                                <form action="{{ route('grades.update', 'update') }}" method="POST">
                                    {{method_field('patch')}}
                                    @csrf
                                    <div class="form-row">
                                        <input type="hidden" name="id" value="{{$grade->id}}">
                                        <div class="col">
                                            <label for="name" >
                                                {{ trans('grades_trans.name_ar') }}
                                            </label>
                                            <input type="text" class="form-control" name="name_ar" value="{{$grade->getTranslation('name' , 'ar')}}">
                                        </div>
                                        <div class="col">
                                            <label for="name" >
                                                {{ trans('grades_trans.name_en') }}
                                            </label>
                                            <input type="text" class="form-control" name="name_en" value="{{$grade->getTranslation('name' , 'ar')}}" >
                                        </div>
                                    </div><br>
                                    <div class="form-group">
                                        <div class="col">
                                            <label for="exampleFormControlTextarea1" >
                                                {{ trans('grades_trans.note_ar') }}
                                            </label>
                                            <textarea name="note_ar" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$grade->getTranslation('notes' , 'ar')}}
                                            </textarea>
                                        </div>
                                        <div class="col">
                                            <label for="exampleFormControlTextarea1" >
                                                {{ trans('grades_trans.note_en') }}
                                            </label>
                                            <textarea name="note_en" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$grade->getTranslation('notes' , 'en')}}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn ripple btn-primary" type="submit">
                                            {{ trans('grades_trans.edit') }}
                                        </button>
                                    </div>
                                </form>
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
@endsection
