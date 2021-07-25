<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectModel;

class ProjectsController extends Controller
{
    function ProjectsIndex()
    {
        return view('Projects');
    }


    function getProjectsData()
    {
       $result = json_encode(ProjectModel::orderBy('id','desc')->get());
       return $result;
    }


    function getProjectDelete(Request $request)
    {
        $id = $request->input('id');
        $result = ProjectModel::where('id','=',$id)->delete();

        if($result == true)
        {
            return 1;
        }
        else
        {
            return  0;
        }
    }


    function getProjectDetails(Request $request)
    {
        $id = $request->input('id');
        $result = json_encode(ProjectModel::where('id','=',$id)->get());
        return $result;
    }

    function getUpdateDetails(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $desc = $request->input('desc');
        $link = $request->input('link');
        $img = $request->input('img');

        $result = ProjectModel::where('id','=',$id)->update([
           'project_name' => $name,
           'project_desc' => $desc,
           'project_link' => $link,
           'project_img' => $img
        ]);

        if($result == true)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }



    function ProjectAdd(Request $req){
        $project_name= $req->input('project_name');
        $project_desc= $req->input('project_desc');
        $project_link= $req->input('project_link');
        $project_img = $req->input('project_img');
        $result= ProjectModel::insert([
            'project_name'=>$project_name,
            'project_desc'=>$project_desc,
            'project_link'=>$project_link,
            'project_img'=>$project_img,
        ]);

        if($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
}
