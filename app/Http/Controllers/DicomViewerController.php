<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DicomViewerController extends Controller
{
    public function show($fileId)
    {
        // Logic to get the file URL from the file ID
        $fileUrl = asset('storage/dicom-files/' . $fileId . '.dcm');

        return view('dicom-viewer', compact('fileUrl'));
    }
}
