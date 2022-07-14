<?php

namespace App\Http\Controllers\examController;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeUsersRequest;
use App\Http\Requests\updateUsersRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:users-read'])->only('index');
        $this->middleware(['permission:users-create'])->only('create');
        $this->middleware(['permission:users-update'])->only('edit');
        $this->middleware(['permission:users-delete'])->only('destroy');
    }

    public function index()
    {

        // return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) ;
        // return 'https://www.gravatar.com/avatar/'.md5(strtolower(trim('mada57222@gmail.com')));
        $users = User::whereRoleIs(['admin','teacher','student'])->get();
        $roles = Role::get()->except(['1']);
        return view('users.index' , compact('users' , 'roles'));
    }

    public function show($role)
    {
        $users = User::whereRoleIs($role)->get();
        $roles = Role::get()->except(['1']);
        return view('users.index' , compact('users' , 'roles'));
    }

    public function get_page($page)
    {
        if(view()->exists($page)){
            return view($page);
        }
        else
        {
            return view('404');
        }

        // return view($page);
    }

    public function create()
    {
        $roles = Role::get();
        $roles = $roles->except(['1']);
        return view('users.create',compact('roles'));
    }

    public function store(storeUsersRequest $request)
    {

        // "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $request->email ) ) );

        try {

            DB::beginTransaction();

            $request_data =$request->except(['password','password_confirmation','role','img']);
            $request_data['password'] = Hash::make($request->password);


            if ($request->img) {
                Image::make($request->img)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/users_files/'. $request->img->hashName()));

                $request_data['img'] = $request->img->hashName();

            }else{

            }

            $user = User::create($request_data);

            $user->attachRole($request->role);

            $role = Role::find($request->role);
            $permissions =  $role->permissions;
            $permission_name = [];

            foreach ($permissions as $permission) {
                array_push($permission_name , $permission->name);
            }

            $user->syncPermissions($permission_name);


            DB::commit();

            toastSuccess(trans('message.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function edit($id)
    {
        $us_id = explode('_',$id);
        $user_id = $us_id[1] - 521 ;

        try {

            $user = User::findOrFail($user_id);
            $roles = Role::get()->except(['1']);
            return view('users.edit', compact('roles', 'user'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }

    }

    public function update(storeUsersRequest $request )
    {

        DB::beginTransaction();

        try {


            $user = User::findOrFail($request->id);

            $request_data = $request->except(['img', 'role']);


            if ($request->img) {

                if ($request->img != 'default.png') {
                    Storage::disk('upload_img')->delete('/users_files/'.$user->img);
                }

                Image::make($request->img)->resize(300,null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/users_files/'. $request->img->hashName()));

                $request_data['img'] = $request->img->hashName();

            }elseif(empty($request->img)){
                if ($user->img != 'default.png') {
                    Storage::disk('upload_img')->delete('/users_files/'.$user->img);
                    $request_data['img'] = 'default.png';
                }
            }

            $user->update($request_data);

            if ($user->roles['0']->id != $request->role) {

                $user->detachRole($user->roles['0']->name);
                $user->attachRole($request->role);

                $role = Role::find($request->role);
                $permissions =  $role->permissions;
                $permission_name = [];
                foreach ($permissions as $permission) {
                    array_push($permission_name , $permission->name);
                }

                $user->syncPermissions($permission_name);

            }


            DB::commit();
            toastWarning(trans('message.update'));
            return redirect()->route('users.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {

            $user = User::findOrFail($request->id);

            if ($user->img != 'default.png') {
                Storage::disk('upload_img')->delete('/users_files/'.$user->img);
            }


            $user->delete();
            toastError(trans('message.delete'));
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([ 'error' => $e->getMessage()]);
        }
    }

}
