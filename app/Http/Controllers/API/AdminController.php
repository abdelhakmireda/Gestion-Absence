<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Admin::latest()->paginate(10);

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
        $validateData = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:admins'],
            'password' => ['required','min:3','string'],
            'cin' => ['required', 'string', 'max:10','unique:admins'],
            'phone' => ['required', 'string','min:6'],
        ]);

        if($validateData){

        $Admin = new Admin();    
         $Admin->firstname = $request->firstname;
         $Admin->lastname = $request->lastname;
         $Admin->email = $request->email;
         $Admin->password = Hash::make($request->password);
         $Admin->cin = $request->cin;
         $Admin->phone = $request->phone;
         $Admin->save();
         
         $User = new User();
         $User->name = $request->firstname .' '.$request->lastname;
         $User->email = $Admin->email;
         $User->password = Hash::make($request->password);
         $User->user_type = 'admin'; 
         $User->save();
     }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Admin = Admin::findOrFail($id);
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required','string','email','max:255','unique:admins,email,'.$Admin->id],
            'password' => ['sometimes', 'string', 'min:6'],
            'cin' => ['required', 'string', 'max:8'],
            'phone' => ['sometimes', 'string'],
        
        ]);
        $Admin->update($request->all());
        return ['message' => 'Admin updated successfully'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Admin = Admin::findOrFail($id)->delete();
        return "Admin deleted successfully";

    }
}
