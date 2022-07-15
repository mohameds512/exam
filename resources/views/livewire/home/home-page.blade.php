@section('css')
<link href="{{URL::asset('assets/css-rtl/style.css')}}" rel="stylesheet">

@endsection

<div>
    <div class="col-12 ">
        @if ($mode_test == false )
        <br>
        <div class="row" >
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
                                    {{-- @if (!(empty($exam->grades->name))) --}}
                                        {{$exam->grades->name}}/
                                        {{$exam->class->name}}/
                                        {{$exam->sections->name}}/
                                        {{$exam->subjects->name}}/
                                        @if (!(empty($exam->unites->name) ))
                                            {{$exam->unites->name}}
                                        @else
                                            {{ trans('users_trans.all_unites') }}
                                        @endif
                                    {{-- @else
                                        {{ trans('users_trans.undefined') }}
                                    @endif --}}
                                </span>
                            </div>
                            <div class="card-footer">
                                <div class="social-links-icons" id="social-links-icons_{{$exam->id}}" >
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=http://www.exam.com/exams/create" target="_blank" class="btn btn-sm " id="face_icon"> <i class="fab fa-facebook-f"></i>  </a>
                                    <a href="https://twitter.com/intent/tweet?text=my share text&amp;url=http://www.exam.com/exams/create" target="_blank" class="btn btn-sm " id="twitter_icon"> <i class="fab fa-twitter"></i> </a>
                                    <a href="https://wa.me/?text=http://www.exam.com/exams/create" target="_blank" class="btn btn-sm " id="whats_icon"><i class="fab fa-whatsapp"></i></a>
                                </div>
                                <button  class="btn btn-sm btn-info" wire:click="go_test({{$exam->id}})" >{{ trans('users_trans.start_exam') }}</button>
                                <button class="btn btn-sm btn-success"   onclick="show_social({{$exam->id}})" title="{{ trans('exams_trans.share') }}"> <i class="fa fa-share"></i> </button>
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
        @elseif ($mode_test == true)
            <div>
                <livewire:test.test/>
            </div>
        @endif

    </div>
</div>
