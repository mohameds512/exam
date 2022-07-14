
@if ($currentStep != 3)
<div style="display: none" class="row setup-content" id="step-3">
@endif

    <div>
        <p>{{ trans('main_trans.are_you_sure_previse_data') }} </p>
    </div>
    <hr>
    <button class="btn btn-warning btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back_2_step">
        {{trans('exams_trans.back')}}
    </button>
    <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button" wire:click="submitForm">
        {{trans('exams_trans.save')}}
    </button>




</div>




