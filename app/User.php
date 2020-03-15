<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use NotificationChannels\WebPush\HasPushSubscriptions;
class User extends Authenticatable
{
    use Notifiable;
    use HasPushSubscriptions;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type','phone_number','present_address','permanent_address','image','user_pluck'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userTypeObj()
    {
        return $this->hasOne('App\Models\UserType', 'id', 'user_type');
    }
    public function franchiseAsUserData()
    {
        return $this->hasOne('App\Models\Franchise', 'id', 'user_pluck');
    }
    public function franchiseOrgAsUserData()
    {
        return $this->hasOne('App\Models\FranchiseOrg', 'id', 'user_pluck');
    }
    public function getUserFranchiseOrg()
    {
        return $this->hasOne('App\Models\FranchiseOrg', 'id', 'user_pluck');
    }
}
