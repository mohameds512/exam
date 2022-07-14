{{-- <div class="container" >
    <div class="row">
        @php
            $grade = App\Models\Grades::where('id' , $grade_id)->get('name')->first();
            $class = App\Models\classes::where('id' , $class_id)->get('name')->first();
            $section = App\Models\sections::where('id' , $section_id)->get('name')->first();
            $subject = App\Models\subjects::where('id' , $subject_id)->get('name')->first();

            if ($unite_id != 'all') {
                $unite = App\Models\unite::where('id' , $unite_id)->get('name')->first();
            }
        @endphp
        <div class="col"style="text-align: center">
            <u>{{$grade->name}}</u> <br>
            <u>{{$class->name}}</u> <br>
            <u>{{$section->name}}</u> <br>
            <u>{{$subject->name}}</u> <br>
            @if ($unite_id != 'all')
                <u>{{$unite->name}} </u><br>
            @else
                <u>{{ trans('exams_trans.all_unites') }}</u>
            @endif
        </div>
        <div class="col"style="text-align: center">
            <div class="col">
                <img   src="{{URL::asset('assets/img/logo/logo1.PNG')}}" alt="logo">
            </div>
        </div>
        <div class="col" style="text-align: center">
            {{ trans('exams_trans.created_by') }} :  {{$test_exam->teacher->name}} <br>
            {{$test_exam->name}} <br>
            {{ trans('exams_trans.student') }} : <u> {{ Auth::user()->name }} </u> <br>

            <p id="cuteDown" style="color: rgb(247, 6, 6) ; font-size: 1ypx" > {{$time}}</p> <br>


        </div>
    </div>
    <hr><br>
    <div style="display: {{ $start_test == false ? '' : 'none' }} ; hight : 150px ; text-align: center">
        <button class="btn btn-info" wire:click="start_test" > start </button>
    </div>
    <div style="display: {{ $start_test == true ? '' : 'none' }}">

        @foreach ($test_questions  as $key=>$question)
            @php
                $answers = explode(',' , $question->answers);
            @endphp
            <div style="display: {{ $key+1 == $qu_num ? '' : 'none' }}">
                {{$key+1}}:{!! $question->question !!} <br><br>

                    @foreach ($answers as $answer)
                        <div class="col">
                            <input type="radio" id="sel_{{$answer}}"   wire:model = "sel_answer.{{$key}}" value="{{$answer}}" >

                            <label for="sel_{{$answer}}">{{$answer}}</label>
                        </div>
                    @endforeach

            </div>
        @endforeach

        <div style="display: {{$count_test_qu < $qu_num ? '' : 'none'}}">
            <div  style="text-align: center">
                <span >
                    {{ trans('exams_trans.questions_ended') }} &#128512;
                </span>



            </div>

        </div>

        <br> <hr> <br>
        <div class="row">
            <div class="col">
                @if ($qu_num > 1)
                    <button class="btn btn-warning btn-sm " style="margin-right: 5px"  type="button" wire:click="previse_qu ">
                        {{trans('exams_trans.back')}}
                    </button>
                @endif

                    @if ($count_test_qu >= $qu_num)
                        <button class="btn btn-success btn-sm " style="margin-right: 5px" type="button" wire:click="next_qu">
                            {{trans('exams_trans.next')}}
                        </button>
                    @else
                        <button class="btn btn-success btn-sm " style="margin-right: 5px" type="button" wire:click="submit_answers">
                            {{trans('exams_trans.end_exam')}}
                        </button>
                    @endif

            </div>

            <div class="col" style="text-align: left " >
                <p>

                    @if ($qu_num >= $count_test_qu)
                        <a href="#"> {{$count_test_qu}} </a>  / {{$count_test_qu}}
                    @elseif($qu_num < $count_test_qu)
                        <a href="#"> {{$qu_num}} </a>  / {{$count_test_qu}}
                    @endif

                </p>
            </div>
        </div>



    </div>


</div> --}}

<div>
    <livewire:test.test/>
</div>


