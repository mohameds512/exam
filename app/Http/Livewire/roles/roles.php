<?php

namespace App\Http\Livewire\Roles;

use App\Http\Livewire\Roles\Roles as RolesRoles;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Roles extends Component
{

    public $roles = [] ,  $perPage = 10 , $users = [] , $permissions = [];

    public $per_name  , $per_desc ,$role_name , $role_desc , $per_role = [] , $edit_role_mode = false ,$sel_role_id ;
    public $sel_perm_id , $per_desc_ed , $per_name_ed;

    protected function getListeners()
    {
        return ['update_role' => 'update_role'];
    }


    public function edit_permission( $per_id )
    {

        try {
            $this->dispatchBrowserEvent('openEdPerMod');
            $this->sel_perm_id =  $per_id;
            $perm = Permission::findOrFail($per_id);
            $this->per_name_ed = $perm->name ;
            $this->per_desc_ed = $perm->description ;
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

    }

    public function update_per( )
    {
        try {
            $perm = Permission::findOrFail($this->sel_perm_id);
            $perm->name = $this->per_name_ed ;
            $perm->description = $this->per_desc_ed ;
            $perm->save();

            $this->cancel_edit_perm();
            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'warning',
                'message' => trans('message.update'),
            ]);


        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function delete_permission_form( $perm_id)
    {
        $this->sel_perm_id = $perm_id ;
        $this->dispatchBrowserEvent('openDelPerModel');
    }
    public function delete_perm( )
    {
        try {
            Permission::destroy($this->sel_perm_id);
            $this->dispatchBrowserEvent('closDelPerModel');
            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'error',
                'message' => trans('message.delete'),
            ]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'error',
                'message' => $e->getMessage() ,
            ]);
        }
    }
    public function cancel_edit_perm( )
    {
        $this->dispatchBrowserEvent('closEdPerMod');
        $this->clear_per();
    }
    public function delete_role_form( $role_id)
    {
        $this->sel_role_id = $role_id ;
        $this->dispatchBrowserEvent('openDelRole');
    }

    public function delete_role()
    {
        try {

            Role::destroy($this->sel_role_id);
            $this->dispatchBrowserEvent('closDelRol');

            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'error',
                'message' => trans('message.delete'),
            ]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function edit_role( $role_id )
    {
        try {
            $this->cancel_edit_role();
            $this->sel_role_id =  $role_id;

            $this->edit_role_mode = true ;
            $role = Role::findOrFail($role_id);
            $this->role_name = $role->name ;
            $this->role_desc = $role->description ;
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

    }
    public function cancel_edit_role()
    {
        $this->edit_role_mode = false;
        $this->sel_role_id = '';
        $this->clear_role();
    }

    public function update_role( )
    {
        try {
            $role = Role::findOrFail($this->sel_role_id);
            $role->name = $this->role_name ;
            $role->description = $this->role_desc ;

            if (!empty($this->per_role)) {
                $role->syncPermissions($this->per_role);
                $role->save();
                //get all perm_for_role
                $permissions =  $role->permissions;
                $permission_name = [];
                foreach ($permissions as $permission) {
                    array_push($permission_name , $permission->name);
                }
                //get all users_related_with_the_role
                $users = User::whereHas( 'roles' , function($q){
                    $q->where('name' , $this->role_name);
                } )->get();
                //attach_new_perms_with_users
                foreach ($users as $user) {
                    $user->syncPermissions($permission_name);
                }
            }else{
                $role->save();
            }


            $this->cancel_edit_role();
            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'warning',
                'message' => trans('message.update'),
            ]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

    }

    public function clear_per()
    {
        $this->per_desc = '';
        $this->per_name = '';
    }

    public function clear_role( )
    {
        $this->role_desc = '';
        $this->role_name = '';
        $this->per_role  = [];
    }

    public function store_role( )
    {
        // dd($this->per_role);

        DB::beginTransaction();
        try {
            $role = new Role();
            $role->name = $this->role_name ;
            $role->display_name =  $this->role_name;
            $role->description =  $this->role_desc ;
            $role->save();

            $role->syncPermissions($this->per_role);

            DB::commit();

            $this->clear_role();

            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'success',
                'message' => trans("message.success"),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function store_per()
    {

        try {
            Permission::firstOrCreate([
                'name' => $this->per_name,
                'display_name' => $this->per_name,
                'description' => $this->per_desc,
            ]);
            $this->clear_per();

            $this->get_roles_and_permissions();

            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'success',
                'message' => trans('message.success') ,
            ]);


        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toastr' ,[
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function get_roles_and_permissions()
    {
        $this->roles = Role::latest()->get();
        // $this->roles = collect($data->items());
        $this->permissions = Permission::latest()->get();

    }


    public function render()
    {
        // $this->per_role_for_ed;

        $this->get_roles_and_permissions();
        return view('livewire.roles.roles');
    }

}
