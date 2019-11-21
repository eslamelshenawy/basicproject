<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchCaptain extends Model
{
    
    protected $table = 'branch_captains';

    public function branch_details()
    {
    	return $this->belongsTo(Branch::class,"branch_id","id");
    }

    protected $fillable = [
        'captain_id', 'branch_id',
    ];

}
