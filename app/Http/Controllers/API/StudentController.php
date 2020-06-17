<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\User;
use Illuminate\Support\Facades\Hash;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Student::latest()->paginate(10);
    }

    public function popSelect(){
        $total = Student::get()->count();
        return Student::latest()->paginate($total);
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
            'email' => ['required', 'string', 'email', 'max:255','unique:students'],
            'password' => ['required','min:3','string'],
            'cne' => ['required', 'string', 'max:10','unique:students'],
            'phone' => ['required', 'string','min:6'],
            'filliere' => ['required', 'string'],
            'anneescolaire' => ['required', 'string'],
            'dob' => ['required', 'string'],
            'semester' => ['required', 'string'],
        ]);

         $Student = new Student();
         $Student->firstname = $request->firstname;
         $Student->lastname = $request->lastname;
         $Student->email = $request->email;
         $Student->password = Hash::make($request->password);
         $Student->cne = $request->cne;
         $Student->phone = $request->phone;
         $Student->filliere = $request->filliere;
         $Student->anneescolaire = $request->anneescolaire;
         $Student->dob = $request->dob;
         $Student->semester = $request->semester;
         $Student->save();
         $User = new User();
         $User->name = $request->firstname .' '.$request->lastname;
         $User->email = $Student->email;
         $User->password = Hash::make($request->password);
         $User->user_type = 'student';
         $User->save();
    }
    public function update(Request $request, $id)
    {
        $Student = Student::findOrFail($id);
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required','string','email','max:255','unique:students,email,'.$Student->id],
            'password' => ['sometimes','min:3','string'],
            'cne' => ['required', 'string', 'max:10','unique:students,cne,'.$Student->id],
            'phone' => ['required', 'string','min:6'],
            'filliere' => ['required', 'string'],
            'anneescolaire' => ['required', 'string'],
            'dob' => ['required', 'string'],
            'semester' => ['required', 'string'],

        ]);

        $Student->update($request->all());
        return "Student Updated Successfully";
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return Student::findOrFail($id)->delete();
    }
}
