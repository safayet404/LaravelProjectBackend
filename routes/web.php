<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;




Route::get('/',[HomeController::class,'HomeIndex'])->middleware('loginCheck');
Route::get('/visitor',[VisitorController::class,'VisitorIndex'])->middleware('loginCheck');

//service Management Route

Route::get('/service',[ServiceController::class,'ServiceIndex'])->middleware('loginCheck');
Route::get('/getServiceData',[ServiceController::class,'getServiceData'])->middleware('loginCheck');
Route::post('/serviceDelete',[ServiceController::class,'ServiceDelete'])->middleware('loginCheck');
Route::post('/serviceDetails',[ServiceController::class,'getServiceDetails'])->middleware('loginCheck');
Route::post('/serviceUpdate',[ServiceController::class,'ServiceUpdate'])->middleware('loginCheck');
Route::post('/serviceAdd',[ServiceController::class,'ServiceAdd'])->middleware('loginCheck');

//Courses Section

Route::get('/courses',[CoursesController::class,'CoursesIndex'])->middleware('loginCheck');
Route::get('/getCoursesData',[CoursesController::class,'getCoursesData'])->middleware('loginCheck');
Route::post('/courseDelete',[CoursesController::class,'getCourseDelete'])->middleware('loginCheck');
Route::post('/CoursesAdd',[CoursesController::class,'CoursesAdd'])->middleware('loginCheck');
Route::post('/courseDetails',[CoursesController::class,'getCourseDetails'])->middleware('loginCheck');
Route::post('/Details',[CoursesController::class,'Details'])->middleware('loginCheck');
Route::post('/courseUpdate',[CoursesController::class,'CourseUpdate'])->middleware('loginCheck');


// Projects Section

Route::get('/projects',[ProjectsController::class,'ProjectsIndex'])->middleware('loginCheck');
Route::get('/getProjectData',[ProjectsController::class,'getProjectsData'])->middleware('loginCheck');
Route::post('/getProjectDelete',[ProjectsController::class,'getProjectDelete'])->middleware('loginCheck');
Route::post('/getProjectDetails',[ProjectsController::class,'getProjectDetails'])->middleware('loginCheck');
Route::post('/getUpdateDetails',[ProjectsController::class,'getUpdateDetails'])->middleware('loginCheck');
Route::post('/ProjectAdd',[ProjectsController::class,'ProjectAdd'])->middleware('loginCheck');


// Contact Section

Route::get('/contact',[ContactController::class,'ContactIndex'])->middleware('loginCheck');
Route::get('/getContactData',[ContactController::class,'ContactData'])->middleware('loginCheck');
Route::post('/ContactDelete',[ContactController::class,'DeleteContact'])->middleware('loginCheck');

// Review Section

Route::get('/review',[ReviewController::class,'ReviewIndex'])->middleware('loginCheck');
Route::get('/reviewData',[ReviewController::class,'ReviewData'])->middleware('loginCheck');
Route::post('/reviewDelete',[ReviewController::class,'ReviewDelete'])->middleware('loginCheck');
Route::post('/reviewAdd',[ReviewController::class,'ReviewAdd'])->middleware('loginCheck');
Route::post('/reviewDetails',[ReviewController::class,'ReviewDetails'])->middleware('loginCheck');
Route::post('/reviewUpdate',[ReviewController::class,'ReviewUpdate'])->middleware('loginCheck');


// Login Section

Route::get('/login',[LoginController::class,'LoginIndex']);
Route::post('/onLogin',[LoginController::class,'onLogin']);
Route::get('/logout',[LoginController::class,'onLogout']);


// Admin Photo Gallery

Route::get('/photo',[PhotoController::class,'PhotoIndex'])->middleware('loginCheck');
Route::post('/photoUpload',[PhotoController::class,'PhotoUpload'])->middleware('loginCheck');
Route::get('/photoJson',[PhotoController::class,'PhotoJson'])->middleware('loginCheck');
Route::get('/photoJsonByID/{id}',[PhotoController::class,'PhotoJsonByID'])->middleware('loginCheck');
Route::post('/PhotoDelete',[PhotoController::class,'PhotoDelete'])->middleware('loginCheck');

//File Download

Route::get('/download/{folder}/{name}',[DownloadController::class,'onDownload']);
