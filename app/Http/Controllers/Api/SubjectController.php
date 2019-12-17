<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subject= subject::all();
        return response()->json($subject);
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
            'subject_name' => 'required|unique:subjects|max:25',
            'subject_code' => 'required|unique:subjects',
        ]);

        
        $subject = new subject();
        $subject->subject_name = $request->subject_name;
        $subject->subject_code = $request->subject_code;
        $subject->save();


        return response()->json(array(
            'status' => 200,
            'message' => "Data Inserted Succesful"
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return subject::findorfail($id);
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
        $validatedData = $request->validate([
            'subject_name' => 'required|max:25',
            'subject_code' => 'required',
        ]);

        
        $subject = subject::find($id);
        $subject->subject_name = $request->subject_name;
        $subject->subject_code = $request->subject_code;
        $subject->save();


        return response()->json(array(
            'status' => 200,
            'message' => "Data Updated Successfully"
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        subject::where('id',$id)->delete();
        return response()->json(array(
            'status' => 200,
            'message' => "Data Deleted Successfully"
        ));
    }
}
