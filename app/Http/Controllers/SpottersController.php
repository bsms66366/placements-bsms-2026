<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spotters;

class SpottersController extends Controller
{
    public function index()
       {
           //$spotters = spotters::all();
          return response()->json(spotters::all());
           // $spotters = ->json(Spotters::all());
           //return 'spotters '.$id;
           //return view('spotters.index', compact('spotters'));
       }
}
