<style>
.label_sel_ans{
    width: max-content;
    padding: 5px;
    border-radius: 5px;
}
#result_deg{
    border: solid 2px;
    border-radius: 50%;
    border-color: red;
    padding-top: 8px;
}
</style>
<div class="container" id="print_test" >
    <div class="row" >

        <div class="col"style="text-align: center">
            <u>{{$exam->grades->name}}</u> <br>
            <u>{{$exam->class->name}}</u> <br>
            <u>{{$exam->sections->name}}</u> <br>
            <u>{{$exam->subjects->name}}</u> <br>
            @if (!empty($exam->unites->name) )
                <u>{{$exam->unites->name}} </u><br>
            @else
                <u>{{ trans('exams_trans.all_unites') }}</u>
            @endif
        </div>
        <div class="col"style="text-align: center">
            <div class="row">
                <div class="col" style="margin-top: 25px;margin-left: 20px">
                    <p id="result_deg">
                        {{$test_degs}}/{{$all_degs}}
                    </p>
                </div>
                <div class="col">
                    <img  class="logo_test" src="{{URL::asset('assets/img/logo/logo1.PNG')}}" alt="logo">
                </div>
                <div class="col" style="margin-top: 25px;margin-left: 20px">
                    <span>
                        {{$grade_deg}} & {{$test_state}}
                    </span>
                </div>
            </div>
        </div>
        <div class="col" style="text-align: center">
            {{ trans('exams_trans.created_by') }} :  <u>{{$exam->teacher->name}}</u> <br>
            {{$exam->name}} <br>
            @if (Auth::check())
                {{ trans('exams_trans.student') }} : <u> {{ Auth::user()->name }} </u> <br>
            @endif
            {{$exam->duration}} {{ trans('exams_trans.mins') }}

        </div>
    </div>
    <hr><br>
    @if ( Auth::check() &&  Auth::user()->id == $exam->teacher_id)
        <div class="card-body">
            @foreach ($test_questions  as $key=>$question)
                @php
                    $answers = explode(',' , $question->answers);
                @endphp
                <div>
                    {{$key+1}}:{!!$question->question!!} <br><br>
                    {{-- <div class="row"> --}}
                        @foreach ($answers as $ans_key =>$answer)
                            @php
                                $str1 = trim($question->right_answer);
                                $str2 = trim($sel_answer[$key]);
                                $str3 = trim($answer);
                            @endphp
                            @if ($str2 == $str3)
                                @if ($str1 == $str2)
                                    <div class="col " >
                                        <input disabled  type="radio" id="sel_{{$answer}}"   wire:model = "sel_answer.{{$key}}" value="{{$answer}}" >
                                        <label class="label_sel_ans" style="background-color: rgba(5, 206, 5, 0.829) "  for="sel_{{$answer}}">{{$answer}}</label>
                                    </div>
                                @elseif($str1 != $str2)
                                    <div class="col label_sel_ans" style="margin: 4px;border-radius: 25px;" >
                                        <input disabled  type="radio" id="sel_{{$answer}}"   wire:model = "sel_answer.{{$key}}" value="{{$answer}}" >
                                        <label class="label_sel_ans" style="background-color:  rgba(206, 5, 5, 0.911)"  for="sel_{{$answer}}">{{$answer}}</label>
                                    </div>

                                @endif
                            @else
                                @if ($str1 == $str3 && $str1 != $str2)
                                    <div class="col label_sel_ans" style="margin: 4px;border-radius: 25px;" >
                                        <input disabled  type="radio" id="sel_{{$answer}}"   wire:model = "sel_answer.{{$key}}" value="{{$answer}}" >
                                        <label class="label_sel_ans" style="background-color: rgba(5, 206, 5, 0.829) "  for="sel_{{$answer}}">{{$answer}}</label>
                                    </div>
                                @else
                                    <div class="col label_sel_ans" style="margin: 4px;border-radius: 25px;" >
                                        <input disabled  type="radio" id="sel_{{$answer}}"   wire:model = "sel_answer.{{$key}}" value="{{$answer}}" >
                                        <label  class="label_sel_ans" for="sel_{{$answer}}">{{$answer}}</label>
                                    </div>
                                @endif

                            @endif

                        @endforeach
                    {{-- </div> --}}
                </div>
            @endforeach

            <br> <hr> <br>
            <div class="row">
                <div class="col">
                    @if ($qu_num > 1)
                        <button class="btn btn-warning btn-sm "  onclick="printDiv('print_test')"  style="margin-right: 5px"  type="button" >
                            {{trans('exams_trans.print')}} <i class="fa fa-file-download"></i>
                        </button>
                    @endif

                        @if ($count_test_qu >= $qu_num)
                            {{-- <button class="btn btn-success btn-sm " style="margin-right: 5px" type="button" wire:click="next_qu">
                                {{trans('exams_trans.next')}}
                            </button> --}}
                        @else
                            {{-- <button class="btn btn-success btn-sm " style="margin-right: 5px" type="button" wire:click="submit_answers">
                                {{trans('exams_trans.end_exam')}}
                            </button> --}}
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
    @endif



</div>


