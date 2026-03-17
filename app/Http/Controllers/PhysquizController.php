<?php

namespace App\Http\Controllers;

use App\Models\Physquiz;
use Illuminate\Http\Request;

class PhysquizController extends Controller
{
    public function index()
    {
        
       return response()->json(Physquiz::all());
        
    }
}
