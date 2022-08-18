<div style="display: {{$mode_test == false ? '' : 'none'}} ">
    @if (!empty($Errors))
        <div class="alert alert-danger" id="danger-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $Errors }}
        </div>
    @endif


    @if ($user->hasPermission('teacher-prof'))
        @if (Auth::user()->id == $user->id)
            <div class="row row-sm" >
                <div class="col-lg-12">
                    <div class="row row-sm" >
                        <div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
                            <div class="card ">
                                <div class="card-body inf_primary">
                                    <div>
                                        <div class="mr-auto center">
                                            <h3 class="tx-13">{{ trans('users_trans.exams_num') }}</h3>
                                            <h5 class="mb-0 tx-22 mb-1 mt-1">{{$exams_num}} </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
                            <div class="card ">
                                <div class="card-body inf_warning ">
                                    <div>
                                        <div class="mr-auto center">
                                            <h5 class="tx-13">{{ trans('users_trans.examination_num') }}</h5>
                                            <h2 class="mb-0 tx-22 mb-1 mt-1">{{$examination_num}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
                            <div class="card ">
                                <div class="card-body inf_success">
                                    <div>
                                        <div class="mr-auto center">
                                            <h5 class="tx-13">{{ trans('users_trans.succeeded_num') }}</h5>
                                            <h2 class="mb-0 tx-22 mb-1 mt-1">{{$succeeded_num}}</h2>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
                            <div class="card ">
                                <div class="card-body inf_danger">

                                    <div>
                                        <div class="mr-auto center">
                                            <h5 class="tx-13">{{ trans('users_trans.failed_num') }}</h5>
                                            <h2 class="mb-0 tx-22 mb-1 mt-1">{{$failed_num}}</h2>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif




    <div class="card">
        <div class="card-body">
            @include('livewire.users.user_exams')
        </div>
    </div>
</div>
