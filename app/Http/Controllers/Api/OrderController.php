<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\SendCode;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Auth;
use Validator;
use Redirect;
use App\Http\Helpers\Helper;
use Illuminate\Support\Facades\Hash;

class OrderController extends ApiController
{

    public function CreatOrder(Request $request){
        $user = Auth::user();
        try {
            if ($user->type == 3){

                $inputs = $request->all();
                $validator = Validator::make($request->all(), [
                    'info.end_lat' => 'required|numeric',
                    'info.end_lang' => 'required|numeric',
                    'info.address' => 'required|string|max:255',
                    'info.state_id' => 'required|numeric',
                    'info.city_id' => 'required|numeric',
                    'info.agentaddress_id' => 'required|numeric',

                    'items.*.name' => 'required|string|max:255',
                    'items.*.qty' => 'required|numeric',
                    'items.*.amount' => 'required|numeric',
                ]);
                if ($validator->fails()) {
                    $statusCode = 200;
                    $response["status"] = -2;
                    $response['message'] = Helper::ArrayToString($validator->errors()->all());
                    return response()->json($response, $statusCode);
                }



                $order= new Order();
                $order->agent_id = $user->id;
                $order->end_lat = $inputs['info']['end_lat'];
                $order->end_lang = $inputs['info']['end_lang'];
                $order->address = $inputs['info']['address'];
                $order->state_id = $inputs['info']['state_id'];
                $order->city_id = $inputs['info']['city_id'];
                $order->agentaddress_id = $inputs['info']['agentaddress_id'];
                $order->save();

                foreach ($inputs['items'] as $item){

                    $orderDetails = new OrderDetails();
                    $orderDetails->name =$item['name'];
                    $orderDetails->qty =$item['qty'];
                    $orderDetails->amount =$item['amount'];
                    $orderDetails->order_id =$order->id;
                    $orderDetails->save();

                }





                $response = [];
                $statusCode = 200;
                $response['status'] = 1;
                $response['message'] = "order created";
                $response['data'] = $order;

            }


        } catch (\Exception $e) {
            logger($e);
            $statusCode = 200;
            $response['status'] = -3;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }
    }




    /**
      * Get orders to Captain with Location .
      *eslam Elshenawy
      * @param  array  $data
      * @return  function   orders
      */
    public function orders(Request $request){
        try{

             $captain= Auth()->user();
             if($captain->status == "active" && $captain->active == 1 ){
                if($captain->type == 4){

                    // check captain working with  branch 
                    $agent_captain = $this->checkcaptain($captain->id);
                    
                     // get ALl Orders 
                   $data= $this->object($agent_captain);

            }else{

                $statusCode = 200;
                $response['status'] = -1;
                $response['message'] = "not Avaliable";
                return response()->json($response, $statusCode);

            }

            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "Order Details";
            $response['data'] = $data;


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
      * Captain Accept order if he Avaliabule.
      *eslam Elshenawy
      * @param  array  $data
      * @return  function   CaptainAcceptOrder
      */
    public function CaptainAcceptOrder(Request $request){

        try{


            $validator = Validator::make($request->all(), [
                'order_id'=>'required',
                'captain_id'=>'required',
                ]);

                if ($validator->fails()) {
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());

            } else {

                $status_order = OrderStatus::where('order_id',$request->order_id)->first();
                $status_order->order_id=$request->order_id;
                $status_order->captain_id=$request->captain_id;
                $status_order->status_order_captain="accept";
                $status_order->save();

                $statusCode = 200;
                $response['status'] = 1;
                $response['message'] = "Success Accept";
                $response['data'] = $status_order->select('order_id','captain_id','status_order_captain','is_sent_agent')->first();

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
      * Captain Receive order if he Avaliabule.
      *eslam Elshenawy
      * @param  array  $data
      * @return  function   CaptainReceivedOrder
      */
      public function CaptainReceivedOrder(Request $request){

        try{

            $validator = Validator::make($request->all(), [
                'order_id'=>'required',
                'captain_id'=>'required',
                ]);

                if ($validator->fails()) {
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());

            } else {

                
                $status_order = OrderStatus::where('order_id',$request->order_id)->first();
                $status_order->order_id=$request->order_id;
                $status_order->captain_id=$request->captain_id;
                $status_order->status_order_captain="received";
                $status_order->save();

                $statusCode = 200;
                $response['status'] = 1;
                $response['message'] = "Success received";
                $response['data'] = $status_order->select('order_id','captain_id','status_order_captain','is_sent_agent')->where('order_id',$request->order_id)->first();

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


}
