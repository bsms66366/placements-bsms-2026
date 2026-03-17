<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($category)
    {
         // access the category_id parameter
         $category = Category::find($category);

         // return a JSON response
         return response()->json(['category' => $category]);
    }
}
