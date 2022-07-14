

<div><br>

    <head>
        <link href="{{URL::asset('assets/plugins/xdsoft_dateTimePicker/css/jquery.datetimepicker.css')}}" rel="stylesheet" />
    </head>

    @if (!empty($Errors))
        <div class="alert alert-danger" id="danger-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $Errors }}
        </div>
    @endif

    <div class="row">
        <div class="col" style="text-align: right">
            @if ($grade_id != '')
                <button class="btn btn-secondary btn-sm" wire:click = "back_Previse" > <i class="fas fas-arrow-right-long"></i> <i class="fas fa-forward" aria-hidden="true"></i> </button><br>

            @endif
        </div>
        @if (!($test || $test_result ))
            <div class="col" style="text-align: left" >
                <u>
                    @if ($grade_id != '')
                        @php
                            $grade = App\Models\Grades::where('id' , $grade_id)->get('name')->first();
                        @endphp
                        {{$grade->name}}
                    @endif
                    @if ($class_id != '')
                        @php
                            $class = App\Models\classes::where('id' , $class_id)->get('name')->first();
                        @endphp
                        /{{$class->name}}
                    @endif
                    @if ($section_id != '')
                        @php
                            $section = App\Models\sections::where('id' , $section_id)->get('name')->first();
                        @endphp
                        /{{$section->name}}
                    @endif
                    @if ($subject_id != '')
                        @php
                            $subject = App\Models\subjects::where('id' , $subject_id)->get('name')->first();
                        @endphp
                        /{{$subject->name}}
                    @endif
                    @if ($unite_id != '')
                        @if ($unite_id == 'all')
                            /{{ trans('exams_trans.all_unites') }}
                        @else
                            @php
                            $unite = App\Models\unite::where('id' , $unite_id)->get('name')->first();
                            @endphp
                            {{$unite->name}}
                        @endif

                    @endif
                </u>


            </div>
        @endif

    </div>

    </span>
    <br>
    @if ($show_exams_table)
        @if ($sh_prof)
            @include('livewire.profile')
        @else
            @include('livewire.index')
        @endif

    @elseif($create_exam)
        {{-- create_exam  --}}
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button"
                        class="btn btn-circle {{ $currentStep != 1 ? 'btn-warning' : 'btn-success' }}">1</a>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button"
                        class="btn btn-circle {{ $currentStep != 2 ? 'btn-warning' : 'btn-success' }}">2</a>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button"
                        class="btn btn-circle {{ $currentStep != 3 ? 'btn-warning' : 'btn-success' }}"
                        disabled="disabled">3</a>
                </div>
            </div>
        </div><br>

        @include('livewire.exam_data')

        @if ( $currentStep == 2)
            @include('livewire.sel_from_list_qu')
        @endif

        @if ($currentStep == 3 )
            @include('livewire.exam_submit')
        @endif

    @else
        {{-- get_category --}}
        @include('livewire.category')

    @endif


    @if ($test)
        @include('livewire.test_exam')
    @endif

    {{-- @if ($test_result)
        @include('livewire.test_result');
    @endif --}}

</div>

