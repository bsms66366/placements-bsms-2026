<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PotController extends Controller
{
    public function index()
    {

        $pathpot = pathpot::latest()->paginate(5);
    
        return view('PathPots.index',compact('pathpots'))
            ->with('i', (request()->input('page', 1) - 1) * 5);        
        //return response()->json(PathPots::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pathpots.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        PathPots::create($request->all());
     
        return redirect()->route('pathpots.index')
                        ->with('success','Pot created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\PathPots  $product
     * @return \Illuminate\Http\Response
     */
    public function show(PathPots $pathpot)
    {
        return view('pathpots.show',compact('pathpots'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PathPots  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(PathPots $pathpot)
    {
        return view('pathpots.edit',compact('pathpots'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PathPots  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PathPots $pathpot)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        $product->update($request->all());
    
        return redirect()->route('pathpots.index')
                        ->with('success','Pot updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PathPots  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(PathPots $pathpot)
    {
        $product->delete();
    
        return redirect()->route('pathpots.index')
                        ->with('success','Pot deleted successfully');
    }
}

