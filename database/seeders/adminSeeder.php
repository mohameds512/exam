<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $user = User::create([
            'name' => 'mhmd',
            'email' => 'mhmd@dd.com',
            'bio'  => 'super Admin',
            'phoneNumber' => '01026993056',
            'password' => Hash::make('123456789'),
        ]);

        $user->attachRole(1);

        $role = Role::findOrFail(1);
        $permissions =  $role->permissions;
        $permission_name = [];
        foreach ($permissions as $permission) {
            array_push($permission_name , $permission->name);
        }

        $user->syncPermissions($permission_name);

    }
}
