<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Doctor;


class HomeController extends Controller
{
    public function redirect()
    {

        if(Auth::id())
        {
            if(Auth::user()->usertype=='0')
            {
                $doctor = doctor::all();

                return view('user.home',compact('doctor'));
            }

            else
            {
               return view('admin.home'); 
            }

        }

        else
        {
            return redirect()->back();
        }
    }






// home page

public function index()
{
   
    if(Auth::id())
    { 
    return redirect('home');
    }

     // showing doctors from database to homepage
      
     else
   {
    $doctor = doctor::all();


    return view('user.home',compact('doctor'));
   }
}
}
