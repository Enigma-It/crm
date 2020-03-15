<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletHistory extends Model
{
    protected $table ='wallet_history';
    protected $fillable = ['franchise_id', 'deposit_amount','deposit_type','date','deposit_purpose','status'];

   public function FranchiseName(){
   	return $this->hasOne('App\Models\Franchise','id','franchise_id');
   }
}
