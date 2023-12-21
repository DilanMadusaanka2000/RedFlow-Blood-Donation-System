<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Donationcamps;

use App\Models\Registration;

use App\Models\Bloodcapacity;

use App\Models\Donarinformation;

use App\Models\Homeuer;
use Illuminate\Support\Facades\Hash;




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

        return redirect(route('registrations'))->with("error","registration  fails Try Again");
      }

     return redirect(route('home.homedonordetails'))->with("error","registration  fails Try Again");    

    // user updated
    }
    

}


