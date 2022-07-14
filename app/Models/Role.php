<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];

    protected $appends = ['perm_ids'];

    public function getPermIdsAttribute()
    {
        $ids = [] ;

        foreach ($this->permissions as $perm) {
            array_push($ids , $perm->id);
        }
        return $ids ;
    }

}
