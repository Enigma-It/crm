<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    protected $table = "franchises";

    protected $fillable = ['name','mobile','dob','division_id','district_id','thana_id','email','address','organization_type','sex','agent_id','status','trade_license','business_card'];

    public function organizationData()
    {
        return $this->hasOne('App\Models\FranchiseOrg');
    }
    public function divisionName()
    {
        return $this->hasOne('App\Models\Division','id','division_id');
    }
    public function districtName()
    {
        return $this->hasOne('App\Models\District','id','district_id');
    }
    public function thanaName()
    {
        return $this->hasOne('App\Models\Thana','id','thana_id');
    }
    public function agentName()
    {
        return $this->hasOne('App\User','id','agent_id');
    }
    

}
