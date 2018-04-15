<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;


class SystemAccount extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'system_account';
    protected $fillable = [
        'login_name', 'password','group','auth'
    ];
    public $timestamps = true;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
