<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Registration;




use Illuminate\Support\Facades\DB;


class UpdateController extends Controller
{

    //protected $productss;
    protected $result;

 
    public function index()
    {
        return view('register.update');
    }
 




    


    public function search(Request $request)
    {
     $searchQuery = $request->input('query');
     $results = Registration::where('id','like','%' . $searchQuery . '%')->get();
     return view('register.search',['results'=>$results]);

    }

    
      public function delete($id)
      {
        $result = Registration::find($id);
        
        if($result)
        {
            $result->delete();
        }
        //return redirect()->route('register.update');
        return redirect()->back();

    }


    public function update($id){

        $result = Registration::find($id);
        

    }

}
