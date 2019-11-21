<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Order extends Model
{
   
    protected $table = 'orders';

    public function branchAddress()
    {
        return $this->belongsTo(Branch::class, 'agent_id', 'agent_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    }

    
    protected $fillable = [
         'city_id','state_id','agentaddress_id','end_lang','end_lat','agent_id',
    ];

    public function agent_user()
    {
        return $this->hasOne(User::class, 'id', 'agent_id');
    }
    public function status_order()
    {
        return $this->hasOne(OrderStatus::class, 'order_id','id');
    }


}
