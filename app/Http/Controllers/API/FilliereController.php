<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Filliere;
use Symfony\Component\HttpFoundation\Response;


class FilliereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Filliere::latest()->paginate(10);
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
       $validatedData =  $this->validate($request,[
            'name' => 'required | string | unique:fillieres',
            'abbreviation' => 'required | string ',
        ]);
       
        if($validatedData){
        $new_filliere = Filliere::create($request->all());
        return response()->json([
            'message' => 'Successfully added new event!',
            'status' => Response::HTTP_CREATED
        ]);
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
            $validatedData =  $this->validate($request,[
            'name' => 'required | string',
            'abbreviation' => 'required | string',
             ]);

             if($validatedData){   
            $filliere = Filliere::findOrFail($id);        
            $filliere->update($request->all());
            return response()->json([
            'message' => 'Successfully updated event!',
            'status' => Response::HTTP_ACCEPTED
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $filliere = Filliere::findOrFail($id);        
         $filliere->delete();
        return response('Filliere removed successfully!', Response::HTTP_NO_CONTENT);
    }
}
