<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bloodrequest;
use App\Models\Hospital;

use App\Mail\BloodRequestEmail;
use Illuminate\Support\Facades\Mail;


// App\Models\Bloodrequest;
use App\Models\Donarinformation;
use App\Models\Registration;
//use App\Mail\BloodRequestEmail;
// Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;




class HospitalController extends Controller
{
 

    protected $task;
    protected $reg;


    public function __construct(){
  
      //$this->task=new Bloodrequest();
      $this->reg=new Hospital();

     
  
  
  
    }  


    public function index(){


        return view('hospital.index');
    }


    public function donor()
    {

        return view('hospital.sendemail');
    }





    public function store(Request $request)
    {




     // Store the blood request
     $bloodRequest = Bloodrequest::create($request->all());

     $donors = Donarinformation::where('bloodGroup', $request->input('bloodtype'))->get();
 
     // Log the number of recipients to receive the email
     Log::info("Number of recipients: " . count($donors));
 
     // Send emails to matching donors
     foreach ($donors as $donor) {
         $recipient = Registration::find($donor->donorid);
 
         // Check if recipient (donor) exists
         if ($recipient) {
             // Validate the email address before sending the email
             if (filter_var($recipient->email, FILTER_VALIDATE_EMAIL)) {
                 // Email address is valid, send the email
                 Mail::to($recipient->email)->send(new BloodRequestEmail($bloodRequest, $donor));
                 Log::info("Email sent successfully to: " . $recipient->email);
             } else {
                 // Log an error for invalid email address
                 Log::error("Invalid email address: " . $recipient->email);
             }
         } else {
             // Handle the case when recipient (donor) is not found
             // For example, you can log an error or skip sending the email
             Log::error("Recipient not found for donor ID: " . $donor->donorid);
         }
     }
 
     return redirect()->back()->with('success', 'Blood request submitted successfully!');
 }






    public function emailsend()
    {


    }





    public function registration(){


         return view('hospital.hospitalRegistration');

    }
   


    
    public function registrationstore(Request $request){

        $hospital = new Hospital([
            'name' => $request->name,
            'location' => $request->location,
            'distric' => $request->distric,
            'email' => $request->email,
            'telephon' => $request->telephon,
        ]);
    
          $hospital->save();
    
    

          //$this->task->create($request->all());
          return redirect()->back();
  
  
        
  
  
      }


}

