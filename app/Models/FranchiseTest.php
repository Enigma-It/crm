<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FranchiseTest extends Model
{
    protected $table = "franchise_test";

    protected $fillable = ['franchise_id','test_id','fr_price','pb_price','status'];
}
