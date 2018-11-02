<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function byUser(){
    	return $this->belongsTo('App\User', 'report_by', 'email');
    }

    public function onUser(){
    	return $this->belongsTo('App\User', 'report_on', 'email');
    }

    public function ofVideo(){
    	return $this->belongsTo('App\Upload', 'report_on_video_id', 'id');
    }

    public function ofComment(){
    	return $this->belongsTo('App\Comment', 'report_on_comment_id', 'comment_id');
    }
}
