<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Upload extends Model
{
    protected $table = 'uploads';
    public $primaryKey = 'id';
    public $timestamps = true;

    use SyncsWithFirebase;
    
    public function user(){
    	return $this->belongsTo('App\User', 'upload_by', 'email');
    }

    public function comments(){
        return $this->hasMany('App\Comment', 'video_id', 'id');
    }

    public function likes(){
        return $this->hasMany('App\Like', 'like_on_video_id', 'id');
    }

    public function reports(){
        return $this->hasMany('App\Report', 'report_on_video_id', 'id');
    }
}
