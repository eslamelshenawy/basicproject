<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BranchCaptain;
use App\Models\Order;

class ApiController extends Controller
{
    

     /**
     * Favorite has many Users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
   public function  checkcaptain($id){

        $branchs = BranchCaptain::where('captain_id',$id)->with('branch_details')->get();

        $agent_all =[];
        foreach($branchs as $branch){

            $agent_all[$branch->branch_details->agent_id]=$branch->branch_details->agent_id;
        }

        return $agent_all;

    }


    
     /**
     * Favorite has many Users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
     public function  object($array_agent){
        
        $place_sent =[];
        $agent_sender =[];
        $order_sender =[];
        $orders_object =[];
        $Allorders =[];
        $index =1;
        foreach($array_agent as $agent_id){
    
                // $orders = Order::where('agent_id',$agent_id)->with('deliveryAddress','orderDetails','agent_user')->get();


                $orders = Order::where('agent_id',$agent_id)->whereHas('status_order', function($q){
                    $q->where('status_order_captain', '=', "pending");
                })->with('branchAddress','orderDetails','agent_user')->get();                


            foreach($orders as $key=> $order){

                $place_sent['address'] = strval($order->address);
                $place_sent['latitude'] = strval($order->end_lat);
                $place_sent['longitude'] = strval($order->end_lang);
                $place_sent['state_id'] = intval($order->state_id);
                $place_sent['city_id'] = intval($order->city_id);
    
                $orders_object['place_sent']=$place_sent;
    
                if($order->branchAddress != null){
                    
                    $agent_sender['name agent'] = strval($order->branchAddress->name);
                    $agent_sender['phone'] = strval($order->branchAddress->phone);
                    $agent_sender['latitude'] = strval($order->branchAddress->latitude);
                    $agent_sender['longitude'] = strval($order->branchAddress->longitude);
                    $agent_sender['address'] = strval($order->branchAddress->address);
                    $agent_sender['state_id'] = intval($order->branchAddress->state_id);
                    $agent_sender['city_id'] = intval($order->branchAddress->city_id);

                    $orders_object['agent_sender']=$agent_sender;


                }else{

                    $agent_sender['name agent'] = strval($order->agent_user->firstname .$order->agent_user->lastname);
                    $agent_sender['phone'] = strval($order->agent_user->phone);
                    $agent_sender['latitude'] = strval($order->agent_user->latitude);
                    $agent_sender['longitude'] = strval($order->agent_user->longitude);
                    $agent_sender['address'] = strval($order->agent_user->address);
                    $agent_sender['state_id'] = intval($order->agent_user->state_id);
                    $agent_sender['city_id'] = intval($order->agent_user->city_id);

                    $orders_object['agent_sender']=$agent_sender;

                }

                $order_sender['orderID'] = strval('100'.$order->id.'#');
                
                $orders_object['order_sender']=$order_sender;

                $Allorders[$index] =$orders_object;
                $index++;
            }

         }

         return($Allorders);




    }



}
