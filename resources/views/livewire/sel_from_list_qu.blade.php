
@if ($currentStep != 2 )
<div style="display: none" class="row setup-content" id="step-2">
@endif




    <livewire:questions.questions>



    <button class="btn btn-warning btn-sm  btn-lg pull-right" type="button" wire:click="back_1_step">
        {{trans('exams_trans.back')}}
    </button>

</div>




