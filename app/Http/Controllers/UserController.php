<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Donationcamps;

use App\Models\Registration;

use App\Models\Bloodcapacity;

use App\Models\Donarinformation;


use App\Models\Homeuer;
use Illuminate\Support\Facades\Hash;

//use Illuminate\Support\Facades\Auth; // Import the Auth facade


use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Hash;





class UserController extends Controller
{
    public function index()
    
    {

        $count = Registration::count();
        $centers = Donationcamps::count();
        $donor = Donarinformation::count();



        

      
       



    




       // $response['tasks'] = $this->received->all();
        $response['count'] = $count;
        $response['centers'] = $centers;
        $response['donor'] = $donor;
       // $response['aPositivePercentage'] = $aPositivePercentage;
       // $response['aPositivePercentage'] = $aPositivePercentage;

       

       // $response['tasks']=$this->received->all();


       
        return view('home.home2',$response);


    }







    

    public function details(){


        return view('home.homedonordetails');




        
    }



  public function registration(){

    return view('home.homedonordetails');
 
  }












    public function registrationuser(Request $request){

   
      

      $data['donorid'] = $request->donorid;
      $data['password'] = Hash::make($request->password);

      $homeuser = Homeuer::create($data);

      if(!$homeuser){

        return redirect(route('login'))->with("error","registration  fails Try Again");
      }

     return redirect(route('homedonordetails.login'))->with("error","registration  fails Try Again");    




    
    }



    public function login(){

        return view('home.loginuser');



    }

    public function loginuser(Request $request)
    {
        $donorid = $request->input('donorid');
        $password = $request->input('password');
    
        // Fetch user from the database based on donorid
        $user = DB::table('homeuers')->where('donorid', $donorid)->first();
    
        // Check if the user exists and the password matches
        if ($user && Hash::check($password, $user->password)) {
            return view('home.donorDetails'); // Load the dashboard.blade.php file
        }
    
        return redirect(route('homedonordetails.login'))->with("error", "Login fails");
    }
    


}


