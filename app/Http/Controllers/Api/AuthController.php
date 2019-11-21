<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\SendCode;
use App\User;
use Validator;
use Redirect;
use App\Http\Helpers\Helper;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    
   /**
      * Get a validator for an incoming registration request.
      *
      * @param  array  $data
      * @return  function   login
      */   
      
      public function login(Request $request)
     {

        try {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];
     
            if (auth()->attempt($credentials)) {
                $token = auth()->user()->createToken('TutsForWeb')->accessToken;
                $user =auth()->user();
                $user['token']=$token ;
                $statusCode = 200;
                $response['status'] = 1;
                $response['message'] = "Success Login";
                $response['data'] = $user;
                
                return response()->json($response, $statusCode);   
            } 

        } catch (Exception $e) {
            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        }
        finally {
            return response()->json($response, $statusCode);
        }

          

       

     }


     /**
      * Get a validator for an incoming registration request.
      *
      * @param  array  $data
      * @return \Illuminate\Contracts\Validation\Validator
      */
      protected function validateLogin(array $data)
      {
             $validator = Validator::make($data, [
                 'email' => ['required'],
                 'password' => ['required', 'string', 'min:8'],
             ]);

             return $validator;
           
      }
      //  .........................................................................................



         /**
      * Get a validator for an incoming registration request.
      *
      * @param  array  $data
      * @return  function   register
      */
        protected function register(Request $request)
        {
            
         try{
            $this->validator($request->all());
            if ($this->validator($request->all())->fails()) {
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($this->validator($request->all())->errors()->all());

            } else {
                $user = $this->create($request->all()) ;
                $statusCode = 200;
                $response['status'] = 1;
                $response['message'] = "Success register";
                $response['data'] = $user;
                
                return response()->json($response, $statusCode);       

            }

         }catch(Exception $e){

            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);

         }finally {
            return response()->json($response, $statusCode);
        }
 
        }
 
 
 
     /**
      * Get a validator for an incoming registration request.
      *
      * @param  array  $data
      * @return \Illuminate\Contracts\Validation\Validator
      */
     protected function validator(array $data)
     {
            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'phone'=>'required|min:9|max:10',
                'latitude'=>'required',
                'longitude'=>'required',
                'type'=>'required',
                ]);
            return $validator;
          
     }
 
     /**
      * Create a new user instance after a valid registration.
      *
      * @param  array  $data
      * @return \App\User
      */
     protected function create(array $data)
     {

        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'address' => $data['address'],
            'day' => $data['day'],
            'hours' => $data['hours'],
            'type_id' => $data['type'],
 
         ]);

        // create  Token passport
         $token = $user->createToken('Token')->accessToken;
        
        if($user){
         $user->code = SendCode::sendcode($user->phone);
         $user->save();
         $user['token']=$token ;
        }
        return $user;

     }
     
 
 }
