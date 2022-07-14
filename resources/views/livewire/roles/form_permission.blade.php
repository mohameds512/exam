
{{-- view_all_permissions  --}}

<div>
    <div class="panel-group1" id="accordion11">
        <div class="panel panel-default  mb-4">
            <div class="panel-heading1 bg-primary ">
                <h4 class="panel-title1">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion11" href="#col_permissions" aria-expanded="false"><i class="fe fe-arrow-left ml-2"></i> {{ trans('roles_trans.permissions') }} </a>
                </h4>
            </div>
            <div id="col_permissions" class="collapse" role="tabpanel" aria-expanded="false">
                <br>
                <div class="table-responsive">
                    <table class="table table-striped mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('roles_trans.name') }}</th>
                                <th>{{ trans('roles_trans.description') }}</th>
                                <th>{{ trans('roles_trans.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td> {{$permission->name}} </td>
                                    <td> {{$permission->description}} </td>
                                    <td>
                                        <button style="margin: 5px"  class="btn btn-sm btn-warning" wire:click= "edit_permission({{$permission->id}})" > <i class="fa fa-edit"></i> </button>
                                        <button style="margin: 5px"  class="btn btn-sm btn-danger" wire:click= "delete_permission_form({{$permission->id}})" > <i class="fa fa-trash-alt"></i> </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- bd -->

            </div>
        </div>
    </div>
    <hr>
    {{-- form_permission  --}}
    <div >
        <div>
            <h3>{{ trans('roles_trans.add_per') }}</h3>
            <div class="row">
                <label for="per_ame"
                    >{{ trans('roles_trans.per_name') }}:</label>
                <input class="form-control" type="text" wire:model="per_name"  />
            </div><br>

            <div class="row">
                <label for="per_desc"
                    >{{ trans('roles_trans.per_desc') }}:</label>
                <input class="form-control" type="text" wire:model="per_desc"  />
            </div><br>

            <div class="row" >
                <button style="margin: 5px"   class="btn btn-sm btn-success " wire:click ="store_per" > {{ trans('roles_trans.save') }}</button>
                <button style="margin: 5px" class="btn btn-sm btn-info " wire:click ="clear_per" > {{ trans('roles_trans.cancel') }}</button>

            </div>


        </div>
    </div>

</div>
{{-- edit_permission  --}}
<div class="modal" id="openeditpermodel" wire:ignore >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('roles_trans.edit_per') }}</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="per_ame"
                        >{{ trans('roles_trans.per_name') }}:</label>
                    <input class="form-control" type="text" wire:model="per_name_ed"  />
                </div><br>

                <div class="row">
                    <label for="per_desc"
                        >{{ trans('roles_trans.per_desc') }}:</label>
                    <input class="form-control" type="text" wire:model="per_desc_ed"  />
                </div><br>
            </div>
            <div class="modal-footer justify-content-center">
                <button style="margin: 5px"   class="btn btn-sm btn-success " wire:click ="update_per" > {{ trans('roles_trans.update') }}</button>
                <button style="margin: 5px" class="btn btn-sm btn-info " wire:click ="cancel_edit_perm" > {{ trans('roles_trans.cancel') }}</button>
            </div>
        </div>
    </div>
</div>
{{-- delete_modal  --}}
<div class="modal" id="DelPermodel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('questions_trans.delete_question') }}</h6>
            </div>
            <div class="modal-body">
                <p>{{ trans('questions_trans.warning_question') }}.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn btn-sm btn-danger" wire:click = "delete_perm">{{ trans('roles_trans.delete') }}</button>
                <button class="btn btn-sm btn-secondary" data-dismiss="modal" type="button">{{ trans('roles_trans.cancel') }}</button>
            </div>
        </div>
    </div>
</div>



