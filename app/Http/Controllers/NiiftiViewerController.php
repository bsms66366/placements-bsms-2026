<?php

namespace App\Http\Controllers;

use App\Models\niiftViewer;
use Illuminate\Http\Request;

class NiiftiViewerController extends Controller
{
    public function show($fileId)
    {
        // Logic to get the file URL from the file ID
        $fileUrl = asset('storage/nifti-files/' . $fileId . '.dcm');

        return view('nifti-viewer', compact('fileUrl'));
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\niiftViewer  $niiftViewer
     * @return \Illuminate\Http\Response
     */
    public function show(niiftViewer $niiftViewer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\niiftViewer  $niiftViewer
     * @return \Illuminate\Http\Response
     */
    public function edit(niiftViewer $niiftViewer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\niiftViewer  $niiftViewer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, niiftViewer $niiftViewer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\niiftViewer  $niiftViewer
     * @return \Illuminate\Http\Response
     */
    public function destroy(niiftViewer $niiftViewer)
    {
        //
    }
}
