<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Comment extends Model
{
    protected $table = 'comments';
    public $primaryKey = 'comment_id';
    public $timestamps = true;

    use SyncsWithFirebase;

    public function user(){
    	return $this->belongsTo('App\User', 'comment_by', 'email');
    }

    public function onvideo(){
    	return $this->belongsTo('App\Upload', 'video_id', 'id');
    }

    public function replys(){
        return $this->hasMany('App\Comment', 'comment_id', 'parent_comment_id');
    }

    public function reports(){
        return $this->hasMany('App\Report', 'report_on_video_id', 'comment_id');
    }
}
