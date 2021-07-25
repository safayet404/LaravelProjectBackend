<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactModel;
use App\Models\CoursesModel;
use App\Models\ProjectModel;
use App\Models\ReviewModel;
use App\Models\servicesModel;
use App\Models\VisitorModel;

class HomeController extends Controller
{
    function HomeIndex(){


        $totalContact = ContactModel::count();
        $totalProject = ProjectModel::count();
        $totalCourse = CoursesModel::count();
        $totalReview = ReviewModel::count();
        $totalService = servicesModel::count();
        $totalVisitor = VisitorModel::count();

        return view('home',[
            'totalContact' => $totalContact,
            'totalCourse' => $totalCourse,
            'totalProject' => $totalProject,
            'totalReview' => $totalReview,
            'totalService' => $totalService,
            'totalVisitor' => $totalVisitor
        ]);
    }



}
