<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Teacher;
use App\User;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Teacher::latest()->paginate(10);

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
        $this->validate($request , [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:teachers'],
            'password' => ['required','min:3','string'],
            'cin' => ['required', 'string', 'max:10','unique:teachers'],
            'phone' => ['required', 'string','min:6'],
        ]);

         $Teacher = new Teacher();
         $Teacher->firstname = $request->firstname;
         $Teacher->lastname = $request->lastname;
         $Teacher->email = $request->email;
         $Teacher->password = Hash::make($request->password);
         $Teacher->cin = $request->cin;
         $Teacher->phone = $request->phone;
         $Teacher->save();

         $User = new User();
         $User->name = $request->firstname .' '.$request->lastname;
         $User->email = $Teacher->email;
         $User->password = Hash::make($request->password);
         $User->user_type = 'teacher';
         $User->save();
        return 'Teacher Created Succesfully';
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
        $Teacher = Teacher::findOrFail($id);
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required','string','email','max:255','unique:teachers,email,'.$Teacher->id],
            'password' => ['sometimes'],
            'cin' => ['required', 'string', 'max:8'],
            'phone' => ['sometimes', 'string'],

        ]);

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request->password)]);
        }else{
            $request->merge(['password' => Hash::make($Teacher->password)]);
        }
        $Teacher->update($request->all());
        return ['message' => 'Teacher updated successfully',
                'Teacher' => $Teacher];

     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        return $Teacher = Teacher::findOrFail($id)->delete();
    }
}
