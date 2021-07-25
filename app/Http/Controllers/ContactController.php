<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactModel;

class ContactController extends Controller
{
    function ContactIndex(){
        return view('Contact');
    }

    function ContactData(Request $request)
    {
        $result = json_encode(ContactModel::all());

        return $result;
    }


    function DeleteContact(Request $request)
    {
        $id = $request->input('id');

        $result = ContactModel::where('id','=',$id)->delete();

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
