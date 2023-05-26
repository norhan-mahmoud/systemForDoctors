<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class InfoUserController extends Controller
{
    public $roles ;
    public $departments ;
    public function __construct(){
        $this->roles= DB::table('roles')->get();
        $this->departments= DB::table('departments')->get();
    }
    public function index(){
        $users= User::all();
        return view("administration.user-management",compact('users'));
    }
    
    public function edit(Request $request)
    {
        $userInformation = User::find($request->id);
        return view('administration.user-profile',['userInformation'=>$userInformation,'roles'=> $this->roles,'departments'=>$this->departments]);
    }
    public function create()
    {
        return view('administration.new-user',['roles'=> $this->roles,'departments'=>$this->departments]);
    }

    public function store(Request $request)
    {
        

         request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', 'unique:users'],
            'username'     => ['required', 'max:50', 'unique:users'],
            'password' => ['required','max:70'],
            'role'    => ['required',' numeric'],
            'department'    => ['max:150'],
        ]);
        
        
        
        User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'username'  => $request->username,
            'password' => Hash::make($request->password),
            'role_id'    => $request->role,
            'department_id'    => $request->department,
        ]);


        return back()->with('success','New user added successfully');
    }
    public function update(Request $request)
    {

        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50'],
            'username'     => ['required', 'max:50'],
            'password' => ['nullable','max:70'],
            'role'    => ['required',' numeric'],
            'department'    => ['max:150'],
        ]);
        
        if(empty($request->password) ){
            User::where('id',$request->id)
            ->update([
                'name'    => $attributes['name'],
                'email' => $attributes['email'],
                'username'     => $attributes['username'],
                'role_id'    => $attributes["role"],
                'department_id'    => $attributes["department"],
            ]);
        }else{
            User::where('id',$request->id)
            ->update([
            'name'    => $attributes['name'],
            'email' => $attributes['email'],
            'username'     => $attributes['username'],
            'password' => Hash::make($attributes['password']),
            'role_id'    => $attributes["role"],
            'department_id'    => $attributes["department"],
        ]);
        }

        
        


        return back()->with('success','Profile updated successfully');
    }
    public function destroy(Request $request)
    {   
    
        User::where('id',$request->id)->delete();


        return back()->with('success','User delete successfully');
    }
}
