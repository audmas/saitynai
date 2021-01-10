<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class TeachersController extends Controller
{
    protected function guard()
    {
        return Auth::guard();

    }//end guard()

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->user = $this->guard()->user();

    }//end __construct()

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'subject' => 'required|string|max:255'
        ]);
        if($validator -> fails())
        {
            return response()->json($validator -> errors()->toJson(), 400);
        }
        
        $teacher = new Teacher([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'subject' => $request['subject']
        ]);
        $teacher->save();
        return response()->json(['teacher' => $teacher], 200);        

    } 
    public function index()
    {   
        $teachers = Teacher::All();
        return response()->json($teachers, 200);
    }
    public function show($id)
    {
        $teachers = Teacher::find($id);
        return response()->json(['teacher' => $teachers], 200);
    }

    public function delete($id)
    {
        $teacher = Teacher::find($id);
        if($teacher != null)
        {
        $teacher->delete();
        return response()->json('deleted', 200);
        }
        else
        {
            return response()->json('teacher not exsist', 200);
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'subject' => 'required|string|max:255'
        ]);
        if($validator -> fails())
        {
            return response()->json($validator -> errors()->toJson(), 400);
        }

        $teacher = Teacher::find($id);
        if($teacher != null)
        {
        $teacher ->name = $request['name'];
        $teacher ->surname = $request['surname'];
        $teacher ->subject = $request['subject'];
        $teacher -> save();
        return response()->json(['teacher' => $teacher],200);
        }
        else
        {
            return response()->json('teacher not exsist', 200);
        }
    }

}
