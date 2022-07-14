<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['img_path','role_name'];

    public function getImgPathAttribute( )
    {
        return asset('uploads/users_files/'. $this->img);
    }

    public function getRoleNameAttribute()
    {
        return $this->roles[0]->name ;
    }

    // public function getGravatarUrlAttribute( )
    // {
    //     return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $this->email ) ) )
    // }



    public function exam_stud()
    {
        return $this->belongsTo(test_results::class,'stud_id');
    }


}
