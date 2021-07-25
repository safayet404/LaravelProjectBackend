<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    function onDownload($folder,$name){
       return Storage::download($folder."/".$name);
    }
}
