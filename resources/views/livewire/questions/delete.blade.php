{{-- delete_modal  --}}
<div class="modal" id="deleteModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('questions_trans.delete_question') }}</h6>
            </div>
            <div class="modal-body">
                <p>{{ trans('questions_trans.warning_question') }}.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn btn-sm btn-danger" wire:click = "delete">{{ trans('questions_trans.delete') }}</button>
                <button class="btn btn-sm btn-secondary" data-dismiss="modal" type="button">{{ trans('questions_trans.close') }}</button>
            </div>
        </div>
    </div>
</div>
