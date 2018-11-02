<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mpociot\Firebase\SyncsWithFirebase;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;
    use SyncsWithFirebase;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function uploads(){
        return $this->hasMany('App\Upload', 'upload_by', 'email');
    }

    public function comments(){
        return $this->hasMany('App\Comment', 'comment_by', 'email');
    }

    public function likes(){
        return $this->hasMany('App\Like', 'like_by', 'email');
    }

    public function myReports(){
        return $this->hasMany('App\Report', 'report_by', 'email');
    }

    public function oReports(){
        return $this->hasMany('App\Report', 'report_on', 'email');
    }
}
