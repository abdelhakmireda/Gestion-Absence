<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Element;
use Symfony\Component\HttpFoundation\Response;

class ElementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Element::latest()->paginate(10);
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
          $validatedData =  $request->validate([
                'professor' => 'required|string',
                'name' => 'required|string',
                'type' => 'required|string',
                'total' => 'required|integer',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
            ]);

         if($validatedData){
            $new_element = Element::create($request->all());
            return response()->json([
                'message' => 'Successfully added new element!',
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
          $validatedData =  $request->validate([
                'professor' => 'required|string',
                'name' => 'required|string',
                'type' => 'required|string',
                'total' => 'required|integer',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
            ]);

        if($validatedData){
            $element = Element::findOrFail($id);        
            $element->update($request->all());
            return response()->json([
            'message' => 'Successfully updated element!',
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
        $element = Element::findOrFail($id);        
        $element->delete();
        return response('Element removed successfully!', Response::HTTP_NO_CONTENT);
    }
}
