<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Controllers\Auth\Controller;

class NovaResetPasswordController extends Controller
{
    /**
         * Get the guard to be used during password reset.
         *
         * @return \Illuminate\Contracts\Auth\StatefulGuard
         */
        protected function guard()
        {
            return Auth::guard(Config::get('nova.guard'));
        }
}
