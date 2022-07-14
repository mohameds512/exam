<div>
    <div class="row form-group" id="get_ex_by_cat"  >
        <div class="col-lg-4 col-md-6 col-sm-12 get_cat " >
            <select wire:model= "sear_gr_id" class="form-control"  id="ex_gr_id"   required>
                <option value=""  selected >{!! trans('subjects_trans.select_grade') !!}</option>
                @foreach ($grades as $grade)
                    <option value="{!! $grade->id !!}">{!! $grade->name !!}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 get_cat ">
            <select wire:model ="sear_cls_id" class="form-control"  required>
                <option value=""  selected >{!! trans('users_trans.sel_class') !!}</option>
                @foreach ($classes as $class)
                    <option value="{!! $class->id !!}">{!! $class->name !!}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 get_cat ">
            <select  wire:model ="sear_sct_id" class="form-control"  required>
                <option value=""  selected >{!! trans('users_trans.sel_sec') !!}</option>
                @foreach ($sections as $section)
                    <option value="{!! $section->id !!}">{!! $section->name !!}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 get_cat ">
            <select  wire:model ="sear_sbt_id" class="form-control"  required>
                <option value=""  selected >{!! trans('users_trans.sel_subject') !!}</option>
                @foreach ($subjects as $subject)
                    <option value="{!! $subject->id !!}">{!! $subject->name !!}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 get_cat  ">
            <select  wire:model = "sear_unt_id" class="form-control" required>
                <option value=""  selected >{!! trans('users_trans.sel_unite') !!}</option>
                @foreach ($unites as $unite)
                    <option value="{!! $unite->id !!}">{!! $unite->name !!}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 get_cat  ">
            <input type="search" class="form-control" wire:model="sear_by_name" placeholder="{{ trans('exams_trans.search_exams') }}" >
        </div>

    </div>
    {{-- editexam--modal  --}}
    <br>
    <div id="edit_ex" class="card" style="display: {{ $mode_edit_ex == true ? '' : 'none' }}" >
        <div class="card-header">
            <h6 class="modal-title">{{ trans('exams_trans.edit_exam') }}</h6>
        </div>
        <div class="card-body">
            <div class="form-row">
                <input type="hidden" wire:model = "sel_ex_id" >
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="name">{{trans('exams_trans.exam_name')}}</label>
                    <input class="form-control" type="text" wire:model.defer= "sel_ex_name">
                    @error('sel_ex_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="notes">{{trans('exams_trans.exam_notes')}}</label>
                    <textarea class="form-control" type="text" wire:model.defer= "sel_ex_notes"></textarea>
                    @error('sel_ex_notes')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


            </div><br>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="duration"
                                >{{ trans('exams_trans.exam_duration') }} :</label>
                    <select  wire:model.defer = "sel_ex_duration" class="form-control" >
                        <option  value="">{{ trans('exams_trans.select_exam_duration') }}...</option>
                        @for ($x = 15; $x < 121; $x = $x + 15 )
                            <option value="{{$x}}">  {{$x}} {{ trans('exams_trans.mins') }}</option>
                        @endfor

                    </select>
                    @error('sel_ex_duration')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> <br>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="status">{{ trans('exams_trans.exam_status') }}</label> <br>
                    <input type="radio" id="public" name="status" wire:model.defer = "sel_ex_status" value="1" >
                    <label for="public">{{ trans('exams_trans.public') }}</label><br>
                    <input type="radio" id="private"  name="status" wire:model.defer = "sel_ex_status" value="0" >
                    <label for="private">{{ trans('exams_trans.privte') }}</label><br>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <br><br>
                    <label class="ckbox" wire:click = "check_exam_date({{$check_date_time + 1}})"><input type="checkbox" {{ $check_date_time % 2 == 0 ? 'checked' : '' }} ><span>{{ trans('exams_trans.specific_date') }}</span></label>
                </div>
            </div> <br>
            <div class="row" id="get_exam_date" style="display: {{ $check_date_time % 2 == 0 ? '' : 'none' }}" >

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="date"
                                >{{ trans('exams_trans.exam_date') }} :</label>
                                @php
                                    $current = date("Y-m-d");
                                    $min_time = $current.'T00:00:00';
                                @endphp
                    <input type="datetime-local" class="form-control" wire:model.defer ="start_date"  min="{{$min_time}}" >

                </div> <br>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="date"
                                >{{ trans('exams_trans.end_date') }} :</label>
                                @php
                                    $current = date("Y-m-d");
                                    $min_time = $current.'T00:00:00';
                                @endphp
                    <input type="datetime-local" class="form-control" wire:model.defer ="end_date"  min="{{$min_time}}" >
                    @error('end_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br>
                </div>
            </div>
        </div>
        <div class="card-footer justify-content-center">
            <button class="btn btn-sm btn-warning" wire:click = "update_exam">{{ trans('exams_trans.update') }}</button>
            <button class="btn btn-sm btn-secondary"  wire:click = "cancel_edit_ex" type="button">{{ trans('exams_trans.close') }}</button>
        </div>
    </div>
    <div class="row">
        @if (!(empty($exams)))
            @foreach ($exams as $exam)

                <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="card-title mb-0 pb-0">{{$exam->name}}</h5>
                            <p> {{$exam->teacher->name}} </p>
                        </div>
                        <div class="card-body">
                            <span>

                                @if (!(empty($exam->grades->name)))
                                    {{$exam->grades->name}}/
                                    {{$exam->class->name}}/
                                    {{$exam->sections->name}}/
                                    {{$exam->subjects->name}}/
                                    @if (!(empty($exam->unites->name) ))
                                        {{$exam->unites->name}}
                                    @else
                                        {{ trans('users_trans.all_unites') }}
                                    @endif
                                @else
                                    {{ trans('users_trans.undefined') }}
                                @endif

                            </span>
                        </div>
                        <div class="card-footer">
                            <div class="social-links-icons" id="social-links-icons_{{$exam->id}}" >
                                <a href="https://www.facebook.com/sharer/sharer.php?u=http://www.exam.com/exams/create" target="_blank" class="btn btn-sm " id="face_icon"> <i class="fab fa-facebook-f"></i>  </a>
                                <a href="https://twitter.com/intent/tweet?text=my share text&amp;url=http://www.exam.com/exams/create" target="_blank" class="btn btn-sm " id="twitter_icon"> <i class="fab fa-twitter"></i> </a>
                                <a href="https://wa.me/?text=http://www.exam.com/exams/create" target="_blank" class="btn btn-sm " id="whats_icon"><i class="fab fa-whatsapp"></i></a>
                            </div>
                            <button  class="btn btn-sm btn-info" wire:click="go_test({{$exam->id}})" >{{ trans('users_trans.start_exam') }}</button>
                            <button  class="btn btn-sm btn-primary" wire:click="get_test_results({{$exam->id}})" >{{ trans('users_trans.show_results') }}</button>
                            <button class="btn btn-sm btn-success"   onclick="show_social({{$exam->id}})" title="{{ trans('exams_trans.share') }}"> <i class="fa fa-share"></i> </button>
                            @if ($user->id == Auth::user()->id)
                                <a href="#edit_ex"  class="btn btn-sm btn-warning" wire:click="edit_ex({{$exam->id}})" >  <i class="fa fa-edit" aria-hidden="true"></i></a>
                                <button  class="btn btn-sm btn-danger" wire:click="del_ex({{$exam->id}})" >  <i class="fa fa-trash-alt" aria-hidden="true"></i></button>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="center">  {{ trans('users_trans.no_results') }} </div>
        @endif

        </div>
        <div class="center" >
            @if($exams->count() >= $perPage)
                <button class=" btn btn-sm btn-primary " wire:click="loadMore">{{ trans('users_trans.load_more') }}</button>
            @endif
        </div>
    </div>
        {{-- delete-modal  --}}
    <div class="modal" id="closDelRolmodel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ trans('questions_trans.delete_question') }}</h6>
                </div>
                <div class="modal-body">
                    <p>{{ trans('questions_trans.warning_question') }}.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-sm btn-danger" wire:click = "delete_role">{{ trans('questions_trans.delete') }}</button>
                    <button class="btn btn-sm btn-secondary" data-dismiss="modal" type="button">{{ trans('questions_trans.close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
