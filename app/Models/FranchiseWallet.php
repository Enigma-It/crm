<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FranchiseWallet extends Model
{
    protected $table ='franchise_wallet';
    protected $fillable = ['total_wallet', 'franchise_id'];
}
