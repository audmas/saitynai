<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProjectController extends Controller
{
    public function index()
    {   
        $projects = Project::All();
        return response()->json($projects, 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255'
        ]);
        if($validator -> fails())
        {
            return response()->json($validator -> errors()->toJson(), 400);
        }
        
        $project = new Project([
            'name' => $request['name'],
            'description' => $request['description']
        ]);
        $project->save();
        return response()->json(['project' => $project], 200);        

    } 
    

    public function show($id)
    {
        $project = Project::find($id);
        return response()->json(['project' => $project], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255'
        ]);
        if($validator -> fails())
        {
            return response()->json($validator -> errors()->toJson(), 400);
        }
        $project = Project::find($id);
        if($project != null)
        {
        $project ->name = $request['name'];
        $project ->description = $request['description'];
        $project -> save();
        return response()->json(['project' => $project],200);
        }
        else
        {
            return response()->json('project not exsist', 200);
        }
    }

    public function delete($id)
    {
        $project = Project::find($id);
        if($project != null)
        {
        $project->delete();
        return response()->json('deleted', 200);
        }
        else
        {
            return response()->json('project not exsist', 200);
        }
    }

   



}
