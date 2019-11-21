<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentAddresslist extends Model
{
    //
    protected $table = 'agent_addresslists';

    protected $fillable = [
        'firstname', 'agent_id','lastname','email','phone','latitude','longitude','address','state_id','city_id',
    ];


}
