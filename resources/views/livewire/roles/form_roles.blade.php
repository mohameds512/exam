

<div id="edit_role">
    @if ($edit_role_mode == true)
        <h3 >{{ trans('roles_trans.edit_role') }}</h3>
    @else
        <h3>{{ trans('roles_trans.add_role') }}</h3>
    @endif
    <div class="row">
        <label for="role_ame"
            >{{ trans('roles_trans.role_ame') }}:</label>
        <input class="form-control" type="text" wire:model="role_name"  />
    </div><br>

    <div class="row" >
        <label for="role_desc"
            >{{ trans('roles_trans.role_desc') }}:</label>
        <input class="form-control" type="text" wire:model="role_desc"  />
    </div><br>
    <div class="row">
        <label for="permissions"
            >{{ trans('roles_trans.permissions') }}:</label>
    </div>

    <div class="row">

        @foreach ($permissions as $permission)
            <label style="margin: 10px" > <input type="checkbox"
                wire:model.defer ="per_role"
                value="{{$permission->name}}"> <span>{{$permission->name}}</span> </label>
        @endforeach
    </div>
    <div class="row" >
        @if ($edit_role_mode == true)
            <button style="margin: 5px"   class="btn btn-sm btn-success " wire:click ="update_role" > {{ trans('roles_trans.update') }}</button>
            <button style="margin: 5px" class="btn btn-sm btn-info " wire:click ="cancel_edit_role" > {{ trans('roles_trans.cancel') }}</button>
        @else
            <button style="margin: 5px"   class="btn btn-sm btn-success " wire:click ="store_role" > {{ trans('roles_trans.save') }}</button>
            <button style="margin: 5px" class="btn btn-sm btn-info " wire:click ="clear_role" > {{ trans('roles_trans.cancel') }}</button>
        @endif

    </div>

</div>
{{-- delete_modal  --}}
<div class="modal" id="closDelRolmodel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('questions_trans.delete_question') }}</h6>
            </div>
            <div class="modal-body">
                <p>{{ trans('questions_trans.warning_question') }}.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn btn-sm btn-danger" wire:click = "delete_role">{{ trans('questions_trans.delete') }}</button>
                <button class="btn btn-sm btn-secondary" data-dismiss="modal" type="button">{{ trans('questions_trans.close') }}</button>
            </div>
        </div>
    </div>
</div>

