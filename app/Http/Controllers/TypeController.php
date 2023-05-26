<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = DB::table('types')->get();
        return view('administration.types.all',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administration.types.add');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
        
        ]);
        
        
        DB::table('types')->insert
        ([
            'name'  => $attributes['name'],
        
        ]);


        return back()->with('success','New department added successfully');
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $type = DB::table('types')->where('id',$request->id)->first();
       return view('administration.types.edit',compact('type'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            
        ]);
        
        
        DB::table('types')->where('id',$request->id)->update
        ([
            'name'    => $attributes['name'],
            
        ]);


        return back()->with('success','department updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::table('types')->where('id',$request->id)->delete();

        return back()->with('success','department delete successfully');

    }
}
