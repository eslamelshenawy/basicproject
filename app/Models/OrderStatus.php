<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
      protected $table = 'order_status';

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'order_id','captain_id', 'status_order_captain', 'is_sent_agent',
  ];

  
}
