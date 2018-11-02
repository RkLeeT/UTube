<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function user(){
    	return $this->belongsTo('App\User', 'report_by', 'email');
    }

    public function ofvideo(){
    	return $this->belongsToMany('App\Upload', 'report_on_video_id', 'video_id');
    }

    public function ofcomment(){
    	return $this->belongsToMany('App\Comment', 'report_on_comment_id', 'comment_id');
    }
}







<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('report_on_video_id')->default('0');
            $table->string('report_on_comment_id')->default('0');
            $table->string('video')->default('0');
            $table->string('comment')->default('0');
            $table->string('report_by');
            $table->string('report_on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
