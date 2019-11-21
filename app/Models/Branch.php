<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    
    protected $fillable = [
        'name', 'email','phone','latitude','longitude','address','agent_id',
    ];

}
