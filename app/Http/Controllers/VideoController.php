<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
    * Uploads the records in a csv file or excel using maatwebsite package
    *
    * @param Request $request
    * @return mixed
    */
    public function uploadContentWithPackage(Request $request)
    {
    if ($request->file) {
    $file = $request->file;
    $name = $file->getClientOriginalName();
    $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
    $fileSize = $file->getSize(); //Get size of uploaded file in bytes
    //Checks to see that the valid file types and sizes were uploaded
    $this->checkUploadedFileProperties($extension, $fileSize);
    $import = new VideoImport();
    Excel::import($import, $request->file);
    foreach ($import->data as $user) {
    //sends email to all users
    $this->sendEmail($user->email, $user->name);
    }
    //Return a success response with the number if records uploaded
    return response()->json([
    'message' => $import->data->count() ." records successfully uploaded"
    ]);
    } else {
    throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
    }
    }
    
    /**
    * Checks to see that the uploaded file valid and within acceptable size limits
    *
    * @param string $extension
    * @param integer $fileSize
    * @return void
    */
    public function checkUploadedFileProperties($extension, $fileSize) : void
    {
    $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
    $maxFileSize = 2097152; // Uploaded file size limit is 2mb
    if (in_array(strtolower($extension), $valid_extension)) {
    if ($fileSize <= $maxFileSize) {
    } else {
    throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
    }
    } else {
    throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
    }
    }
    /**
    * Sends email to the uploaded players
    *
    * @param string $email
    * @param string $name
    * @return void
    */
    public function sendEmail($email, $name) :void
    {
    $data = array(
    'email' => $email,
    'name' => $name,
    'subject' => 'Welcome Message',
    );
    Mail::send('welcomeEmail', $data, function ($message) use ($data) {
    $message->from('welcome@myapp.com');
    $message->to($data['email']);
    $message->subject($data['subject']);
    });
    }
    public function show($category)
        {
             // access the category_id parameter
             $category = Video::find($category);

             // return a JSON response
             return response()->json(['category' => $category]);
        }
}
