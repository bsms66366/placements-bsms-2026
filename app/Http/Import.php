<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\NotesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class import extends Controller
{
    public function import()
        {
            Excel::Import(new NotesImports, 'notes.csv');
            
            return redirect('/')->with('success', 'All good!');
        }
}
