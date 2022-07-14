<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class sociolController extends Controller
{

    public function redirectSocial($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function callbackSocial($service)
    {
        return $user = Socialite::with($service)->user();
    }
}
