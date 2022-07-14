

<div class="product-details table-responsive text-nowrap">
    <div class="container-fluid">

        <div class="row">
            <div class="col-2">
                <button class="btn btn-info-gradient" wire:click="add_exam" style="margin-bottom: 10px">{{ trans('exams_trans.add_exam') }}</button>
            </div>
            <div class="col-4">
                <div class="main-header-left ">
                    <div class="main-header-center  d-sm-none d-md-none d-lg-block">
                        <input class="form-control" wire:model="search_exams" placeholder="{{ trans('exams_trans.search_exams') }}..." type="search">
                    </div>
                </div>
            </div>
        </div>

        <br>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0 text-md-nowrap" id="example1">
            <thead>
                <tr>
                    <th class="text-right">{{ trans('exams_trans.exam_data') }}</th>
                    <th class="text-right">{{ trans('exams_trans.exam_notes') }}</th>
                    <th class="w-150">{{ trans('exams_trans.privacy') }}</th>
                    <th>
                        <a class="w-150">{{ trans('exams_trans.operations') }}</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exams as $exam)
                    <tr>
                        <td>
                            <div class="media">
                                <div class="media-body">
                                    <div class="card-item-desc mt-0">
                                        <dl class="card-item-desc-1">
                                            <dt>{{ trans('exams_trans.exam_name')}}: </dt>
                                            <dd>{{$exam->name}}  </dd>
                                        </dl>
                                        <dl class="card-item-desc-1">
                                            <dt>{{ trans('exams_trans.teacher_name')}}: </dt>
                                            <dd>
                                                <a style="color: #1554b9;
                                                pointer-events:stroke ;" class="user_link_prof"  wire:click= "show_prof({{$exam->teacher->id}})" >{{$exam->teacher->name}}</a>
                                            </dd>
                                        </dl>
                                        <dl class="card-item-desc-1">
                                            <dt>{{ trans('exams_trans.exam_duration') }}: </dt>
                                            <dd>{{$exam->duration}} {{ trans('exams_trans.mins') }} </dd>
                                        </dl>
                                        <dl class="card-item-desc-1">
                                        <dt>{{ trans('exams_trans.exam_date') }}: </dt>
                                        <dd>
                                            @if ($exam->start_date != '')
                                                {{$exam->start_date}}
                                            @else
                                                {{ trans('exams_trans.open') }}
                                            @endif
                                        </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center text-lg text-medium">{{$exam->notes}}</td>
                        <td class="text-center">
                            <div class="form-group">
                                @if ($exam->status == 0)
                                    {{ trans('exams_trans.privte') }} <br>
                                    <button class="btn btn-sm btn-info"  onclick="copyToClipboard()"> {{ trans('exams_trans.copy_code') }} <i class="fa fa-clone"></i> </button>
                                    <input type="text" disabled id="validation_code" value="{{$exam->name}}_78{{$exam->subject_id}}_45{{$exam->unite_id}}">
                                @else
                                    {{ trans('exams_trans.public') }}
                                @endif
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="social-links-icons" id="social-links-icons_{{$exam->id}}" >
                                <a href="https://www.facebook.com/sharer/sharer.php?u=http://www.exam.com/exams/create" target="_blank" class="btn btn-sm " id="face_icon"> <i class="fab fa-facebook-f"></i>  </a>
                                <a href="https://twitter.com/intent/tweet?text=my share text&amp;url=http://www.exam.com/exams/create" target="_blank" class="btn btn-sm " id="twitter_icon"> <i class="fab fa-twitter"></i> </a>
                                <a href="https://wa.me/?text=http://www.exam.com/exams/create" target="_blank" class="btn btn-sm " id="whats_icon"><i class="fab fa-whatsapp"></i></a>
                            </div>
                            <button class="btn btn-sm btn-warning" wire:click = "edit_exam({{$exam->id}})"title="{{ trans('exams_trans.edit') }}" > <i class="fa fa-edit"></i> </button>
                            <button class="btn btn-sm btn-success"   onclick="show_social({{$exam->id}})" title="{{ trans('exams_trans.share') }}"> <i class="fa fa-share"></i> </button>
                            <button class="btn btn-sm btn-info" wire:click = "go_test({{$exam->id}})" title="{{ trans('exams_trans.start_exam') }}"><i class="fa fa-eye"></i></button>
                            <button class="btn btn-sm btn-info" wire:click = "show_results({{$exam->id}})" title="{{ trans('exams_trans.show_results') }}"><i class="fa fas-list-check"></i></button>

                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#delete{{ $exam->id }}"
                                title="{{ trans('questions_trans.delete') }}">
                                <i class="fa fa-trash"></i>
                            </button>

                        </td>
                    </tr>
                    <!-- delete_modal_Exam -->
                    <div class="modal fade" id="delete{{ $exam->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        {{ trans('exams_trans.delete_exam') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <span>{{ trans('exams_trans.sure_delete_exam') }} ؟ </span>
                                    <br>
                                    <button class="btn btn-sm btn-danger" data-dismiss="modal"  wire:click = "deleteEx({{$exam->id}})" > {{ trans('exams_trans.delete') }} </button>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach


            </tbody>
        </table>
        <br>
        @if($exams->count() >= $perPage)
            <center>
                <button class="btn btn-secondary" wire:click.prevent="loadMore">{{ trans('exams_trans.view_more') }}</button>
            </center>
        @endif

</div>
