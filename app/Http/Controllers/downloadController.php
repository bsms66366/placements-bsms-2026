<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class downloadController extends Controller
{
    public function download(Request $request, $filename)
    {
        // Get the file from storage
        $file = Storage::disk('public')->get('dicom_files/' . $filename);

        // Return the file as a response
        return response($file, 200)
            ->header('Content-Type', 'application/dicom');
    }
}
