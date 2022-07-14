<div class="row" >
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <div class="col-lg-6 col-md-12">
        <div class="card overflow-hidden">

            <div class="card-body">
                <div class="card-header pb-0">
                    <h3 class="card-title">{{ trans('roles_trans.roles') }}</h3>
                </div>

                @foreach ($roles as $role)
                <div class="panel-group1" id="accordion11">
                    <div class="panel panel-default  mb-4">
                        <div class="panel-heading1 bg-primary ">
                            <h4 class="panel-title1">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion11" href="#col_{{$role->id}}" aria-expanded="false"> {{$role->name}} <i class="fe fe-arrow-left ml-2"></i></a>
                            </h4>
                        </div>
                        <div id="col_{{$role->id}}" class="collapse" role="tabpanel" aria-expanded="false">
                            <div><br>
                                <div class="row">
                                    {{-- <button style="margin: 5px"  class="btn btn-sm btn-warning" wire:click= "edit_role({{$role->id}})" > {{ trans('roles_trans.edit') }} </button> --}}
                                    <div class="col" >
                                        <a href="#edit_role" style="margin: 5px"  class="btn btn-sm btn-warning" wire:click= "edit_role({{$role->id}})" > {{ trans('roles_trans.edit') }} </a>
                                        <button style="margin: 5px"  class="btn btn-sm btn-danger" wire:click= "delete_role_form({{$role->id}})" > {{ trans('roles_trans.delete') }} </button>
                                    </div>
                                </div>
                                <h5>{{ trans('roles_trans.permissions') }}</h5><br>
                                @foreach ($permissions as $permission)
                                    <label style="margin: 10px" > <input type="checkbox" disabled
                                        {{ in_array($permission->id ,  $role->perm_ids) ? 'checked' : ''  }}
                                        value="{{$permission->name}}"> <span>{{$permission->name}}</span> </label>
                                @endforeach
                            </div>

                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="card overflow-hidden">
            <div class="card-body">
                @include('livewire.roles.form_permission')
            </div>
        </div>
        <div class="card overflow-hidden">
            <div class="card-body">
                @include('livewire.roles.form_roles')
            </div>
        </div>
    </div>
</div>
