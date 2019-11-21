<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class VerifyController extends Controller
{
    
    // function view verify
    public function getVerify()
    {
        return view('verify');
    }


        // function  postVerify
    public function postVerify(Request $request)
    {
        if($user=User::where('code',$request->code)->first()){

            $user->active=1;
            $user->code=Null;
            $user->save();
            return redirect()->route('login')->with('message', 'Your code is active');
        }else{
            return redirect()->back()->with('message', 'verify code is not correct , Please try again .');

        }
        
    }

}
