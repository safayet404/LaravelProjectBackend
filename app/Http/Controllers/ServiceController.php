<?php

namespace App\Http\Controllers;

use App\Models\servicesModel;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    function  ServiceIndex(){
        return view('Services');

    }
    function  getServiceData(){
        $result = json_encode(servicesModel::orderBy('id','desc')->get());

        return $result;
    }

    function getServiceDetails(Request $request){

        $id = $request->input('id');
        $result = json_encode(servicesModel::where('id','=',$id)->get());
        return $result;
    }


    function ServiceDelete(Request $request){

        $id = $request->input('id');
        $result = servicesModel::where('id','=',$id)->delete();
        if($result == true)
        {
            return 1;

        }
        else
        {
            return 0;
        }
    }

    function ServiceUpdate(Request $request){

        $id = $request->input('id');
        $name = $request->input('name');
        $desc = $request->input('desc');
        $img = $request->input('img');
        $result = servicesModel::where('id','=',$id)->update(['service_name'=>$name,'service_desc'=>$desc,'service_img'=>$img]);
        if($result == true)
        {
            return 1;

        }
        else
        {
            return 0;
        }
    }


    function ServiceAdd(Request $request){
        $name = $request->input('name');
        $desc = $request->input('desc');
        $img = $request->input('img');
        $result = servicesModel::insert(['service_name'=>$name,'service_desc'=>$desc,'service_img'=>$img]);

        if($result == true)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

}
