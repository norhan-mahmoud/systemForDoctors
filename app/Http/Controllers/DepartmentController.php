<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = DB::table('departments')->get();
        return view('administration.departments.all',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administration.departments.add');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
        
        ]);
        
        
        DB::table('departments')->insert
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
        $department = DB::table('departments')->where('id',$request->id)->first();
       return view('administration.departments.edit',compact('department'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            
        ]);
        
        
        DB::table('departments')->where('id',$request->id)->update
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
        DB::table('departments')->where('id',$request->id)->delete();

        return back()->with('success','department delete successfully');

    }
}
