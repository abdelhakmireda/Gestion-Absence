<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attendance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Response;



class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function index(){
        
        $user = DB::table('attendances')
            ->join('students', 'students.id', '=', 'attendances.student_id')
            ->join('elements', 'elements.id', '=', 'attendances.element_id')
            ->select('students.firstname','students.lastname','students.filliere','students.semester','elements.name','attendances.date',"attendances.id","attendances.*")
            ->get();
            
           return $user;
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
        $validatedData = $request->validate([
            'justification' => ['required', 'string', 'max:255'],
            'hours' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date', 'max:255'],
            'student_id' => ['required', 'integer', 'max:255'],
            'element_id' => ['required', 'integer', 'max:255'],
        ]);

        if($validatedData){
        $Attendance = new Attendance();
        $Attendance->justification = $request->justification;
        $Attendance->hours = $request->hours;
        $Attendance->type = $request->type;
        $Attendance->date = $request->date;
        $Attendance->student_id = $request->student_id;
        $Attendance->element_id = $request->element_id;
        $Attendance->save();
        }
          return response()->json([
            'message' => 'Successfully added new event!',
            'status' => Response::HTTP_CREATED
        ]);
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
        
        $Attendance = Attendance::findOrFail($id);  
        $request->validate([
            'justification' => ['required', 'string', 'max:255'],
            'hours' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'date' => ['required', 'string', 'max:255'],
            'student_id' => ['required', 'integer', 'max:255'],
            'element_id' => ['required', 'integer', 'max:255'],
        ]);
        
        $Attendance->update($request->all());
           return response()->json([
            'message' => 'Successfully updated attendance!',
            'status' => Response::HTTP_ACCEPTED
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Attendance::findOrFail($id)->delete();
        return response('Attendance removed successfully!', Response::HTTP_NO_CONTENT);

    }
}
