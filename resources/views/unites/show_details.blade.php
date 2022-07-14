@extends('layouts.master')
@section('css')
@toastr_css
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h6 class="content-title mb-0 my-auto" style="font-family: 'Cairo', sans-serif;" >{{ trans('main_trans.main') }}</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main_trans.unites') }}</span>
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
										<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#add_unite">
                                            <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('unites_trans.add_unite') }}
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
									<table class="table text-md-nowrap " id="example1">
										<thead>
											<tr>
												<th class="wd-5p border-bottom-0 ">#</th>
												<th class="wd-15p border-bottom-0">{{ trans('unites_trans.name') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('unites_trans.notes') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('unites_trans.processes') }}</th>

											</tr>
										</thead>
										<tbody>
                                            @foreach ($unites as $unite)
                                                <tr id="tr{{$unite->id}}">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$unite->name}}</td>
                                                    <td>{{$unite->note}}</td>
                                                    <td>

                                                        <a href="javascript:void(0)" onclick="editUnite({{$unite->id}})" class=" btn btn-sm btn-warning" >
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" onclick="deleteUnite({{$unite->id}})" class=" btn btn-sm btn-danger" >
                                                            <i class="fa fa-trash"></i>
                                                        </a>

                                                    </td>
                                                </tr>

                                            @endforeach

                                        </tbody>
                                    </table>

                                    <!-- model_add_unite -->
                                    <div class="modal" id="add_unite">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">{{ trans('unites_trans.add_unite') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form  id="add_unite_form">
                                                        @csrf
                                                        <input type="hidden" id="lang" name="lang" value="{{config('app.locale')}}">
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

                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="section_name"
                                                                    >{{ trans('questions_trans.section_name') }}:</label>
                                                                    <select class="form-control" name="section_id" required>
                                                                    </select>
                                                            </div>
                                                            <div class="col">
                                                                <label for="subject_name"
                                                                    >{{ trans('questions_trans.subject_name') }}:</label>
                                                                    <select class="form-control" name="subject_id" required>
                                                                    </select>
                                                            </div>
                                                        </div><br>
                                                        <div class="form-row">
                                                            <div class="col">
                                                                <label for="name" >
                                                                    {{ trans('grades_trans.name_ar') }}
                                                                </label>
                                                                <input type="text" class="form-control" name="name_ar" id="name_ar">
                                                            </div>
                                                            <div class="col">
                                                                <label for="name" >
                                                                    {{ trans('grades_trans.name_en') }}
                                                                </label>
                                                                <input type="text" class="form-control" name="name_en" id="name_en">
                                                            </div>
                                                        </div><br>
                                                        <div class="form-group">
                                                            <div class="col">
                                                                <label for="exampleFormControlTextarea1" >
                                                                    {{ trans('grades_trans.note_ar') }}
                                                                </label>
                                                                <textarea name="note_ar" class="form-control" id="note_ar" rows="3"></textarea>
                                                            </div>
                                                            <div class="col">
                                                                <label for="exampleFormControlTextarea1" >
                                                                    {{ trans('grades_trans.note_en') }}
                                                                </label>
                                                                <textarea name="note_en" class="form-control" id="note_en" rows="3"></textarea>
                                                            </div>
                                                        </div>
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
                                    <!-- model_edit_unite -->
                                    <div class="modal" id="form_edit_unite">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">{{ trans('unites_trans.edit_unite') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form  id="edit_unite_form" >
                                                        @csrf
                                                        {{method_field('PATCH')}}
                                                        <input type="hidden" id="lang" name="lang">
                                                        <input type="hidden" id="id" name="id" >
                                                        <div class="form-row">
                                                            <div class="col">
                                                                <label for="name" >
                                                                    {{ trans('grades_trans.name_ar') }}
                                                                </label>
                                                                <input type="text" class="form-control" name="name_ar" id="name_ar">
                                                            </div>
                                                            <div class="col">
                                                                <label for="name" >
                                                                    {{ trans('grades_trans.name_en') }}
                                                                </label>
                                                                <input type="text" class="form-control" name="name_en" id="name_en" >
                                                            </div>
                                                        </div><br>
                                                        <div class="form-group">
                                                            <div class="col">
                                                                <label for="exampleFormControlTextarea1" >
                                                                    {{ trans('grades_trans.note_ar') }}
                                                                </label>
                                                                <textarea name="note_ar" class="form-control" id="note_ar" rows="3"></textarea>
                                                            </div>
                                                            <div class="col">
                                                                <label for="exampleFormControlTextarea1" >
                                                                    {{ trans('grades_trans.note_en') }}
                                                                </label>
                                                                <textarea name="note_en" class="form-control" id="note_en" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn ripple btn-warning" type="submit">
                                                                {{ trans('grades_trans.update') }}
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

                                    <!-- delete_modal_question -->
                                    <div class="modal fade" id="deleteUnite" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('unites_trans.delete_unite') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form  id="deleteUnite" >
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        {{ trans('unites_trans.warning_unite') }}
                                                        <input id="id" type="hidden" name="id" class="form-control">
                                                            <br>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('unites_trans.close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ trans('unites_trans.delete') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

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

{{-- for_new_unite --}}
<script>
    $("#add_unite_form").submit(function(e){
        e.preventDefault();

        var data_form = new FormData($("#add_unite_form")[0]);
        var lang = $("#lang").val();
        $.ajax({
            url  :"{{route('unites.store')}}",
            type :"POST",
            data : data_form,
            processData: false,
            contentType: false,
            cache : false,

            success:function(response){
                if (response) {
                    $("#add_unite_form")[0].reset();
                    $("#add_unite").modal('hide');
                    $("#example1 tbody").prepend('<tr id="tr'+response.unite.id+'" ><td class = "alert-info">{{trans('unites_trans.new_record')}}</td><td>'+response.unite.name[lang]+'</td><td>'+response.unite.note[lang]+'</td><td> <a href="javascript:void(0)" onclick="editUnite('+response.unite.id+')" class=" btn btn-sm btn-warning" ><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" onclick="deleteUnite('+response.unite.id+')" class=" btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a></td></tr>');

                    setTimeout(() => {
                    toastr.info(response.msg.message);
                    },500)
                }


            },
            error   : function() {
                console.log( "Ajax Not Working" );
            }

        });
    });

</script>

{{-- get_to_edit_unite --}}
<script>
    function editUnite(id){

        $.get('/unites/'+id , function(unite){

            console.log(unite);
            $("#edit_unite_form #id").val(unite.id);
            $("#edit_unite_form #name_ar").val(unite.name['ar']);
            $("#edit_unite_form #name_en").val(unite.name['en']);
            $("#edit_unite_form #note_ar").val(unite.note['ar']);
            $("#edit_unite_form #note_en").val(unite.note['en']);

            $("#form_edit_unite").modal('toggle');
        });
    }
</script>


{{-- update_unite --}}
<script>
    $("#edit_unite_form").submit(function(event){

        event.preventDefault();

        var data_form = new FormData($("#edit_unite_form")[0]);
        var lang = $("#lang").val();
        var id = $("#id").val();

        $.ajax({
            url  :"{{route('unites.update', 'update')}}",
            type :"POST",
            data : data_form,
            processData: false,
            contentType: false,
            cache : false,

            success:function(response){

                if (response) {
                    $("#form_edit_unite").modal('hide');
                    $("#edit_unite_form")[0].reset();
                    $("#example1 tbody #tr"+id+"").remove();
                    $("#example1 tbody").prepend('<tr id="tr'+response.unite.id+'" ><td class = "alert-warning">{{trans('unites_trans.update_record')}}</td><td>'+response.unite.name[lang]+'</td><td>'+response.unite.note[lang]+'</td><td> <a href="javascript:void(0)" onclick="editUnite('+response.unite.id+')" class=" btn btn-sm btn-warning" ><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" onclick="deleteUnite('+response.unite.id+')" class=" btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a></td></tr>');

                    setTimeout(() => {
                    toastr.warning(response.msg.message);
                    },500);
                }
            },
            error   : function() {
                console.log( "Ajax Not Working" );
            }

        });
    })
</script>
{{-- get_to_delete --}}
<script>
    function deleteUnite(id){

        $.get('/unites/'+id , function(unite){

            console.log(unite);
            $("#deleteUnite #id").val(unite.id);
            $("#deleteUnite").modal('toggle');
        });
    }
</script>

{{-- delete_unite --}}
<script>
    $("#deleteUnite").submit(function(event){

        event.preventDefault();
        var delete_data_form = new FormData($("#deleteUnite #deleteUnite")[0]);
        var id = $("#deleteUnite #id").val();

        $.ajax({
            url  :"{{ route('unites.destroy', 'delete') }}",
            type :"POST",
            data : delete_data_form ,
            processData: false,
            contentType: false,
            cache : false,

            success:function(data){

                $("#deleteUnite").modal('hide');
                $("#example1 tbody #tr"+id+"").remove();

                setTimeout(() => {
                toastr.error(data.message);
                },500);

            },
            error   : function() {
                console.log( "Ajax Not Working" );
            }

        });
    })
</script>
@toastr_js
@toastr_render
@endsection
