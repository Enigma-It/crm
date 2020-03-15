<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FranchiseOrg extends Model
{
    protected $table = "franchise_org";

    protected $fillable = ['id','franchise_id','org_name','org_address','speciality','bed','daily_indoor_patient','daily_outdoor_patient','icu','nicu','ct_scan','mri','usg','category','employee','status'];

    public function franchiseData()
    {
        return $this->belongsTo('franchise_id');
    }
}
