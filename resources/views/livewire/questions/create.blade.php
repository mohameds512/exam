
            <div class="modal-header" id="add_qu">
                @if ($update_mode == true)
                    <h6 class="modal-title"> {{ trans('questions_trans.edit_question') }} </h6>
                @else
                    <h6 class="modal-title"> {{ trans('questions_trans.add_question') }} </h6>
                @endif
            </div>

            <div class="modal-body">
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                @if (Auth::check())
                    <input type="hidden" wire:model="teacher_id" value="{{Auth::user()->id}}">
                @endif
                <div class="row" >
                    <div class="col" >
                        <div wire:ignore >
                            <label for="question"
                            >{{ trans('questions_trans.question') }} :</label>
                            <textarea  id="create_editor" data-question_name = "@this" class="form-control"
                                wire:model.defer="question_name" name="question_name" > </textarea>
                            @error('question_name')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>

                    </div>


                </div> <br>
                <div class="row">
                    <div class="col">
                        <label for="answers"
                            >{{ trans('questions_trans.answers') }} :</label>
                        <textarea  id="ck_text"  wire:model.defer = "answers" class="form-control"></textarea>
                        @if (session()->get('first_qu') != 1 )
                            <div class="alert alert-danger"> يجب ان تفصل بين الأجابات بستخدام ( , )</div>
                        @endif
                        @error('answers')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div><br>

                <div class="row">
                    <div class="col">
                        <label for="right_answer"
                            >{{ trans('questions_trans.right_answer') }} :</label>
                        <textarea  wire:model.defer = "right_answer" class="form-control" ></textarea>
                        @error('right_answer')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="col">
                            <label for="qu_deg"
                                >{{ trans('questions_trans.qu_deg') }}:</label>
                                <select class="form-control" wire:model.defer="qu_deg" required>
                                    <option  selected value=""> {{trans('questions_trans.select_deg')}} </option>
                                    @for ($i = 1 ; $i < 6; $i++)
                                        <option value="{{$i}}"> {{$i}} </option>
                                    @endfor
                                </select>
                                @error('qu_deg')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                </div>

                </div><br>

                <div class="modal-footer">

                    @if ($update_mode==true)
                        <button  wire:click="update_que"  class="btn btn-sm btn-primary" >
                            {{ trans('questions_trans.update_data') }}
                        </button>
                    @else
                        <button  wire:click="store_qu"  class="btn btn-sm btn-primary" >
                            {{ trans('questions_trans.add_question') }}
                        </button>
                    @endif

                </div>

                <div style="position: fixed ; bottom:10px ; margin-right: 75px;   align-content: center">
                    <button class="btn btn-success btn-sm  btn-lg pull-right" type="button" wire:click="check_qus">
                        {{trans('exams_trans.next')}}
                    </button>
                </div>
            </div>
