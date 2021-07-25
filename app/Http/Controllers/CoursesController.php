<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoursesModel;
class CoursesController extends Controller
{
   function CoursesIndex(){
       return view('Courses');
   }

   function getCoursesData(){
       $result = json_encode(CoursesModel::orderBy('id','desc')->get());
       return $result;
   }

   function getCourseDelete(Request $request){

       $id = $request->input('id');
       $result = CoursesModel::where('id','=',$id)->delete();

       if($result == 1)
       {
           return 1;
       }
       else
       {
           return 0;
       }
   }

   function getCourseDetails(Request $request){

       $id = $request->input('id');
       $result = json_encode(CoursesModel::where('id', '=', $id)->get());

       return $result;
   }


    function CoursesAdd(Request $request){

       $CourseName = $request->input('name');
       $CourseDesc = $request->input('desc');
       $CourseFee = $request->input('fee');
       $CourseEnroll = $request->input('enroll');
       $CourseClass = $request->input('class');
       $CourseLink = $request->input('link');
       $CourseImg = $request->input('img');
       $result = CoursesModel::insert([
           'course_name' => $CourseName,
           'course_desc' => $CourseDesc,
           'course_fee' => $CourseFee,
           'course_totalenroll' => $CourseEnroll,
           'course_total_class' => $CourseClass,
           'course_link' => $CourseLink,
           'course_img' => $CourseImg
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


    function Details(Request $request){

        $id = $request->input('id');
        $result = json_encode(CoursesModel::where('id', '=', $id)->get());

        return $result;
    }


    function CourseUpdate(Request $request){

        $id = $request->input('id');
        $name = $request->input('name');
        $desc = $request->input('desc');
        $fee = $request->input('fee');
        $enroll = $request->input('enroll');
        $class = $request->input('class');
        $link = $request->input('link');
        $img = $request->input('img');
        $result = CoursesModel::where('id','=',$id)->update([
            'course_name'=>$name,
            'course_desc'=>$desc,
            'course_fee' => $fee,
            'course_totalenroll' => $enroll,
            'course_total_class' => $class,
            'course_link' => $link,
            'course_img'=>$img
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


}
