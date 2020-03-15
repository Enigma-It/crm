<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentCommision extends Model
{
   protected $table = "agent_commision";
    protected $fillable = [
        'agent_id','agent_type','commision','status'
    ];
}
