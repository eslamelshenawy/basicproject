<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    
       /**
      * Get 
      *
      * @param  array  $data
      * @return  view Login
      */
      protected function Loginpage()
      {
           return view('dashboard.pages.login');
      }

       /**
      * Get 
      *
      * @param  array  $data
      * @return  function   login
      */   
      
      public function Login(Request $request)
     {

       
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);
        
            $remember_me = $request->has('remember_me') ? true : false; 

            if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me))
            {
                $user = auth()->user();
                return redirect('admin');

            }else{
                return redirect()->back()->with('error', 'your Email and password are wrong.');

            }
        
        } catch (Exception $e) {

        }
        finally {


        }
}


}
