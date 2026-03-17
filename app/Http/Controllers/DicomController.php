<?php

namespace App\Http\Controllers;

use App\Models\Dicom; // Import the Dicom model
use Illuminate\Http\Request;

class DicomController extends Controller
{
    // Handle File Uploads
    public function upload(Request $request)
    {
        $request->validate([
            'dicom_files.*' => 'required|mimes:dcm|max:2048', // Adjust max file size as needed
        ]);

        foreach ($request->file('dicom_files') as $file) {
            // Specify the path where you want to store the file
            $path = 'dicom_files';

            // Use the original filename for storing
            $filename = $file->getClientOriginalName();

            // Specify the disk name
            $diskName = 'public';

            // Store the file with the original filename
            $storedFilePath = $file->storeAs($path, $filename, $diskName);

            // Save file metadata in the database and associate it with a DICOM record
            Dicom::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'urlCode' => $storedFilePath, // Store the file path in the 'urlCode' column
                'user_id' => $request->input('user_id'),
                'category_id' => $request->input('category_id'),
                // Add other fields from the form or session data
                'filename' => $filename, // Save the original filename
                'extension' => $file->extension(), // Get file extension
                // Add additional metadata attributes here
            ]);
        }

        return redirect()->back()->with('success', 'DICOM files uploaded successfully.');
    }
}
