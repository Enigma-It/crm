<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    protected $table = "thanas";
    protected $fillable = ['name','district_id'];
    public function district()
    {
        return $this->belongsTo('district_id');
    }
}
