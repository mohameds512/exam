<div class="table-responsive">


    <div class="container-fluid">
        <div  style="display: {{ $count_selected_questions != 0 ? ''  :'none' }} ;
            position: fixed ; left : 2% ; top:75px; align-content: center"
            >
            <span class="btn btn-info">{{ trans('exams_trans.questions_numbers') }} : {{$count_selected_questions}}</span>
        </div>
        <div class="row">
            <div class="col-2">
			    <a href="#add_qu" class="btn  btn-info" wire:click = "create_qu" >{{ trans('questions_trans.add_question') }}</a>
            </div>
            <div class="col-4">
                <div class="main-header-left ">
                    <div class="main-header-center  d-sm-none d-md-none d-lg-block">
                        <input class="form-control" wire:model="search_qu" placeholder="{{ trans('exams_trans.search_qu') }}..." type="search">
                    </div>
                </div>
            </div>
        </div>

        <br>
    </div>

    <br>
    <table class="table text-md-nowrap select_all_data" id="example1">
        <thead>
            <tr>
                <th class="wd-5p border-bottom-0">#</th>
                <th class="wd-10p border-bottom-0">{{ trans('exams_trans.select_questions') }} </th>
                <th class="wd-15p border-bottom-0">{!! trans('questions_trans.question') !!}</th>
                <th class="wd-15p border-bottom-0">{!! trans('questions_trans.answers') !!}</th>
                <th class="wd-15p border-bottom-0">{!! trans('questions_trans.right_answer') !!}</th>
                <th class="wd-15p border-bottom-0">{!! trans('questions_trans.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $question)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <input type="checkbox"  wire:model = "selected_questions"  class="box1" value="{{$question['id']}}">
                    </td>
                    <td>{!! $question['question'] !!}</td>
                    <td>{!! $question['answers'] !!}</td>
                    <td>{!! $question['right_answer'] !!}</td>
                    <td>
                        {{-- <a href="" target="_blanck" class="btn btn-sm btn-success" wire:click = "selectedItem({{$question['id'] }}, 'update')">{{ trans('questions_trans.edit') }}</a> --}}
                        <a href="#add_qu" class="btn btn-sm btn-success" wire:click = "selectedItem({{$question['id'] }}, 'update')">{{ trans('questions_trans.edit') }}</a>
                        <button class="btn btn-sm btn-danger" wire:click = "selectedItem({{$question['id'] }}, 'delete')">{{ trans('questions_trans.delete') }}</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        {{-- delete_modal  --}}
        @include('livewire.questions.delete')


    </table>
    @if (! empty($questions))
        @if($questions->count() >= $perPage)
            <center>
                <button class="btn btn-secondary" wire:click.prevent="loadMore">{{ trans('exams_trans.view_more') }}</button>
            </center>
        @endif
    @endif

    @include('livewire.questions.create')

    <div style="position: fixed ; bottom:10px ;align-content: center">
        <button class="btn btn-warning btn-sm  btn-lg pull-right" type="button" wire:click="back_1_step">
            {{trans('exams_trans.back')}}
        </button>
        {{-- <button class="btn btn-success btn-sm  btn-lg pull-right" type="button" wire:click="check_qus">
            {{trans('exams_trans.next')}}
        </button> --}}
    </div>


</div>


