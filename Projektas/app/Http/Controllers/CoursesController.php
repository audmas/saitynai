<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
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
        $user = $this->guard()->user();
        $role = $user['role'];
        if($role == "admin")
        {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:50',
            'fk_teacher' => 'required|integer'
        ]);
        if($validator -> fails())
        {
            return response()->json($validator -> errors()->toJson(), 400);
        }
        $teacher = Teacher::find($request['fk_teacher']);
        if($teacher == null)
        {
      
        return response()->json('teacher not exsist', 200);
        }
        else
        {
            $course = new Course([
            'name' => $request['name'],
            'description' => $request['description'],
            'fk_teacher' => $request['fk_teacher']
        ]);
        $course->save();
        return response()->json(['course' => $course], 200);        
        }
    }
        else 
        {
            return response()->json("neturite teisiu", 200);
        }
    } 

    public function TeacherIndex($id)
    {
        $user = $this->guard()->user();
        $role = $user['role'];
        if($role == "admin")
        {
        $teacher = Teacher::find($id);
        if($teacher == null)
        {
            return response()->json('teacher not exsist', 200);
        }
        else
        {
             $courses = Course::select('courses.*')
             ->where('courses.fk_teacher','=',$id)
             ->get();

        return response()->json(['courses' => $courses], 200);
        }
    }
        else 
        {
            return response()->json("neturite teisiu", 200);
        }
    }

    public function TeacherOneIndex($id, $id2)
    {
        $user = $this->guard()->user();
        $role = $user['role'];
        if($role == "admin")
        {
        $teacher = Teacher::find($id);
        if($teacher == null)
        {
            return response()->json('teacher not exsist', 200);
        }
        else
        {
             $courses = Course::select('courses.*')
             ->where('courses.fk_teacher','=',$id)
             ->where('courses.id','=',$id2)
             ->get();

        return response()->json(['courses' => $courses], 200);
        }
         return response()->json($courses, 200);
        }
        else 
        {
            return response()->json("neturite teisiu", 200);
        }
    }

    public function index()
    {   

        $user = $this->guard()->user();
        $role = $user['role'];
        if($role == "admin")
        {
        $courses = Course::All();
        return response()->json($courses, 200);
        }
        else 
        {
            return response()->json("neturite teisiu", 200);
        }
    }
    public function show($id)
    {
        $user = $this->guard()->user();
        $role = $user['role'];
        if($role == "admin")
        {
        $courses = Course::find($id);
        return response()->json(['course' => $courses], 200);
        
        }
        else 
        {
            return response()->json("neturite teisiu", 200);
        }    
    }

    public function delete($id)
    {
        $user = $this->guard()->user();
        $role = $user['role'];
        if($role == "admin")
        {
        $course = Course::find($id);
        if($course != null)
        {
        $course->delete();
        return response()->json('deleted', 200);
        }
        else
        {
            return response()->json('course not exsist', 200);
        }
    }
        else 
        {
            return response()->json("neturite teisiu", 200);
        }
    }

}
