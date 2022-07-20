@extends('layouts.master')
@section('css')
@toastr_css
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('main_trans.main') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('questions_trans.add_question') }}</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">

					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
                                    <div class="col-sm-6 col-md-4 col-xl-3">
										{{-- <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"  href="{{ route('questions.create') }}">
                                            <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('questions_trans.add_question') }}
                                        </a> --}}
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

                                <!-- add_modal_question -->

                                    <div class="modal-body">
                                            <form  action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="teacher_id" value="{{Auth::user()->id}}">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="grades"
                                                            >{{ trans('questions_trans.grade_name') }} :</label>
                                                        <select class="form-control" name="Grade_id" required>
                                                            <option selected disabled >{{ trans('subjects_trans.select_grade') }}</option>
                                                            @foreach ($grades as $grade)
                                                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <label for="Name_en"
                                                            >{{ trans('subjects_trans.class_name') }}:</label>
                                                            <select class="form-control" name="class_id" required>

                                                            </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="section_name"
                                                            >{{ trans('questions_trans.section_name') }}:</label>
                                                            <select class="form-control" name="section_id" required>

                                                            </select>
                                                    </div>
                                                </div><br>
                                                <div class="row">

                                                    <div class="col">
                                                        <label for="subject_name"
                                                            >{{ trans('questions_trans.subject_name') }}:</label>
                                                            <select class="form-control" name="subject_id" required>

                                                            </select>
                                                    </div>

                                                    <div class="col">
                                                        <label for="unite_name"
                                                            >{{ trans('questions_trans.unite_name') }}:</label>
                                                        <select name="unite_id" class="form-control" required>

                                                        </select>
                                                    </div>


                                                </div><br>


                                                <div class="row">

                                                    <div class="col">

                                                        <label for="question"
                                                            >{{ trans('questions_trans.question') }} :</label>
                                                        <textarea name="question" id="hh" class=" editor" ></textarea>
                                                        @error('question')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                        @enderror
                                                    </div>


                                                </div> <br>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="answers"
                                                            >{{ trans('questions_trans.answers') }} :</label>
                                                        <textarea name="answers" id="ck_text" class="form-control"></textarea>
                                                    </div>
                                                </div><br>



                                                <div class="row">
                                                    <div class="col">
                                                        <label for="right_answer"
                                                            >{{ trans('questions_trans.right_answer') }} :</label>
                                                        <textarea name="right_answer" class="form-control" ></textarea>
                                                    </div>
                                                    <div class="col">
                                                        <div class="col">
                                                            <label for="qu_deg"
                                                                >{{ trans('questions_trans.qu_deg') }}:</label>
                                                                <select class="form-control" name="qu_deg" required>
                                                                    <option disabled selected> {{trans('questions_trans.select_deg')}} </option>
                                                                    @for ($i = 1 ; $i < 6; $i++)
                                                                        <option value="{{$i}}"> {{$i}} </option>
                                                                    @endfor
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>



                                                </div><br>

                                                <div class="modal-footer">
                                                    <button class="btn ripple btn-primary" type="submit">
                                                        {{ trans('grades_trans.save') }}
                                                    </button>
                                                </div>
                                            </form>

                                    </div>


                                <!-- End Modal Add_question-->

                            </div>

							</div>
						</div>
					</div>
					<!--/div-->

				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection

@section('js')
@toastr_js
@toastr_render
{{-- repeater --}}
<script src="{{URL::asset('assets/plugins/jquery/jquery.repeater.js')}}"></script>
<script>
    $(function testFun() {
        $(".editor").each(function () {
            let id = $(this).attr('id');
            if (!(CKEDITOR.instances[id])) {
                    console.log(id);
                    CKEDITOR.replace(id);
            }
            CKEDITOR.replace(id);
            console.log('ddd'.id);
        });
    })
</script>



@endsection
