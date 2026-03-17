<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserRegistrationController extends Controller
{
    public function create()
    {
      $this->authorize('invite', User::class);
    return view('userinvites.create');
    }

   public function store()
    {

   }
}
