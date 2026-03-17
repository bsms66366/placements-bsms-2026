<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PathPotController extends Controller
{
    public function index()
    {
        return response()->json(PathPots::all());
    }

}
