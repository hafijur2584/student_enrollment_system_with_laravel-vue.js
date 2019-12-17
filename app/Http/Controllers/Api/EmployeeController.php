<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Employee;
use Image;

class EmployeeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return response()->json($employee);
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
            'name' => 'required|max:255',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required',
            'salary' => 'required',
            'nid' => 'required'
        ]);

        if($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0,$position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(280, 200);
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;
            $employee->date = $request->date;
            $employee->photo = $image_url;
            $employee->save();
        }
        else{
            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;
            $employee->date = $request->date;
            $employee->photo = $image_url;
            $employee->save();
        }
        

        return response()->json(array(
            'status' => 200,
            'message' => "Data Inserted Successfully."
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
        $employee = Employee::where('id',$id)->firstOrfail();
        return response()->json($employee);
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
            'name' => 'required|max:255',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required',
            'salary' => 'required',
            'nid' => 'required'
        ]);
        if($request->newphoto){
            $position = strpos($request->newphoto, ';');
            $sub = substr($request->newphoto, 0,$position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($request->newphoto)->resize(280, 200);
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            $success = $img->save($image_url);
            if($success){
                $img = Employee::where('id',$id)->firstOrfail();
                $img_path = $img->photo;
                unlink($img_path);
                $employee = Employee::where('id',$id)->firstOrfail();
                $employee->name = $request->name;
                $employee->email = $request->email;
                $employee->phone = $request->phone;
                $employee->address = $request->address;
                $employee->salary = $request->salary;
                $employee->nid = $request->nid;
                $employee->date = $request->date;
                $employee->photo = $image_url;
                $employee->save();
            }

        }else{
            $oldphoto = $request->photo;
            $employee = Employee::where('id',$id)->firstOrfail();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;
            $employee->date = $request->date;
            $employee->photo = $oldphoto;
            $employee->save();
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
        $employee = Employee::where('id',$id)->firstOrfail();
        $photo = $employee->photo;
        if($photo){
            unlink($photo);
            Employee::where('id',$id)->delete();
        }
        else{
            Employee::where('id',$id)->delete();
        }

    }
}
