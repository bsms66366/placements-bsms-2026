<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;

class DataController extends Controller
{
    public function index(Request $request)
       {
           $category = \App\Models\Category::find(1); // Replace 1 with the desired category ID
           
           $categoryId = $request->query('category_id');

           $data = Data::where('category_id', $categoryId)->get();

           return response()->json(['notes' => $data]);
       }
}
