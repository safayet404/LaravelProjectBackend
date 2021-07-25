<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReviewModel;

class ReviewController extends Controller
{
    function ReviewIndex(){
        return view('Review');
    }


    function ReviewData(Request $request)
    {
        $result  = json_encode(ReviewModel::all());

        return $result;
    }

    function ReviewDelete(Request $request)
    {
        $id = $request->input('id');

        $result = ReviewModel::where('id','=',$id)->delete();

        if($result == true)
        {
            return 1;
        }
        else
        {
            return  0;
        }
    }


    function ReviewAdd(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $desc = $request->input('desc');
        $img = $request->input('img');

        $result = ReviewModel::insert(['name' => $name,'desc' => $desc , 'img' => $img]);

        if($result == true)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }


    function ReviewDetails(Request $request){
        $id = $request->input('id');
        $result = json_encode(ReviewModel::where('id','=',$id)->get());
        return $result;
    }


    function ReviewUpdate(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $desc = $request->input('desc');
        $img = $request->input('img');

        $result = ReviewModel::where('id', '=', $id)->update(['name' => $name ,'desc' => $desc, 'img' => $img]);

        if($result == true)
        {
            return 1;
        }
        else
        {
            return  0;
        }



    }


}
