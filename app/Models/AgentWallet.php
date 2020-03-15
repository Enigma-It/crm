<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentWallet extends Model
{
    protected $table = "agent_wallet";
    protected $fillable = [
        'agent_id', 'commission', 'wallet'];


    function agentInfo(){
    	return $this->hasOne('App\User','id','agent_id');
    }
}
