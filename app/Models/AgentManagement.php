<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentManagement extends Model
{
    protected $table = "agent_management";
    protected $fillable = [
        'central_agent', 'divisional_agent', 'district_agent', 'thana_agent', 'status'];


    function centralAgent(){
    	return $this->hasOne('App\User', 'id', 'central_agent');
    }
    function divisionalAgent(){
    	return $this->hasOne('App\User', 'id', 'divisional_agent');
    }
    function districtAgent(){
    	return $this->hasOne('App\User', 'id', 'district_agent');
    }
    function thanaAgent(){
    	return $this->hasOne('App\User', 'id', 'thana_agent');
    }
    
}
