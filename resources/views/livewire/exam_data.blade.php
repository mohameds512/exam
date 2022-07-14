
@if ($currentStep != 1)
<div style="display: none" class="row setup-content" id="step-1">
@endif
    <div class="col-xs-12">
        <div class="col-md-12">
            <div class="form-row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="name">{{trans('exams_trans.exam_name')}}</label>
                    <input class="form-control" type="text" wire:model= "name">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="notes">{{trans('exams_trans.exam_notes')}}</label>
                    <textarea class="form-control" type="text" wire:model= "notes"></textarea>
                    @error('notes')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


            </div><br>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="duration"
                                >{{ trans('exams_trans.exam_duration') }} :</label>
                    <select  wire:model = "duration" class="form-control" >
                        <option selected value="">{{ trans('exams_trans.select_exam_duration') }}...</option>
                        @for ($x = 15; $x < 121; $x = $x + 15 )
                            <option value="{{$x}}">  {{$x}} {{ trans('exams_trans.mins') }}</option>
                        @endfor

                    </select>
                </div> <br>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="status">{{ trans('exams_trans.exam_status') }}</label> <br>
                    <input type="radio" id="public" name="status" wire:model = "status" value="1" >
                    <label for="public">{{ trans('exams_trans.public') }}</label><br>
                    <input type="radio" id="private"  name="status" wire:model = "status" value="0" >
                    <label for="private">{{ trans('exams_trans.privte') }}</label><br>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <br><br>
                    <label class="ckbox" wire:click = "check_exam_date({{$check_date_time + 1}})"><input type="checkbox" {{ $check_date_time % 2 == 0 ? 'checked' : '' }} ><span>{{ trans('exams_trans.specific_date') }}</span></label>
                </div>
            </div> <br>


            <div class="row" id="get_exam_date" style="display: {{ $check_date_time % 2 == 0 ? '' : 'none' }}" >
            {{-- <div class="row"> --}}
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="date"
                                >{{ trans('exams_trans.exam_date') }} :</label>
                                @php
                                    $current = date("Y-m-d");
                                    $min_time = $current.'T00:00:00';
                                @endphp
                    <input type="datetime-local" class="form-control" wire:model ="start_date"  min="{{$min_time}}" >

                </div> <br>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <label for="date"
                                >{{ trans('exams_trans.end_date') }} :</label>
                                @php
                                    $current = date("Y-m-d");
                                    $min_time = $current.'T00:00:00';
                                @endphp
                    <input type="datetime-local" class="form-control" wire:model ="end_date"  min="{{$min_time}}" >
                    @error('end_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br>
                </div>
            </div>
            @if ($edit_mode == true)
                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button" wire:click="update_exam">
                    {{trans('exams_trans.update')}}
                </button>
            @else
                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button" wire:click="go_2_step">
                    {{trans('exams_trans.next')}}
                </button>
            @endif
        </div>
    </div>
</div>


