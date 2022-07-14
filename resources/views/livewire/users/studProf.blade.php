<div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped mg-b-0 text-md-nowrap">
                    <thead>
                        <tr>
                            <th class="wd-5p border-bottom-0">#</th>
                            <th class="wd-10p border-bottom-0">{{ trans('exams_trans.exam_name') }} </th>
                            <th class="wd-15p border-bottom-0">{!! trans('users_trans.teacher_name') !!}</th>
                            <th class="wd-15p border-bottom-0">{!! trans('users_trans.result_deg') !!}</th>
                            <th class="wd-15p border-bottom-0">{!! trans('users_trans.result_grade') !!}</th>
                            <th class="wd-15p border-bottom-0">{!! trans('users_trans.re_status') !!}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($results->count() > 0)
                            @foreach ($results as $result)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$result->exam->name}}</td>
                                    <td>{{$result->teacher->name}}</td>
                                    <td>{{$result->result_deg}}</td>
                                    <td>{{$result->result_grade}}</td>
                                    <td>{{$result->re_status}}</td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <div class="alert alert-info">
                                    {{ trans('users_trans.no_data') }}
                                </div>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div><br>
            <div class="center" >
                @if($results->count() >= $perPage)
                    <button class=" btn btn-sm btn-primary " wire:click="loadMore">{{ trans('users_trans.load_more') }}</button>
                @endif
            </div>
        </div>
    </div>
</div>
