<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'settings';
    protected $fillable = ['company_name','address','contact','logo','dis_agent_com','central_agent_com','division_agent_com','report_delivery_time_limit','currency_id','currency_space','currency_position','digit_separator'];
}
