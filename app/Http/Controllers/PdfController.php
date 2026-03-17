<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\PathPots;

class PdfController extends Controller
{
    
    public function index(){
            
             return Response::make(file_get_contents('images/image1.pdf'), 200, [
                            'content-type'=>'application/pdf',
                        ]);
        }
    //public function showPDFpots(){
    //$pots = PathPots::all();
    //return view('index', compact('pots'));
    
    
}
//    public function generatePDF()
//    {
//        $pdf = PDF::loadView('pdf.document');
//        return $pdf->stream('document.pdf');
//    }

}
