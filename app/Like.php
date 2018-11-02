<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Like extends Model
{
    protected $table = 'likes';
    public $primaryKey = 'id';
    public $timestamps = true;

    use SyncsWithFirebase;

    public function user(){
    	return $this->belongsTo('App\User', 'like_by', 'email');
    }

    public function ofvideo(){
    	return $this->belongsToMany('App\Upload', 'like_on_video_id', 'id');
    }
}
