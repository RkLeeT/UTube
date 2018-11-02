<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Thumbnail;


use App\User;
use App\Upload;
use App\Like;
use App\Report;

class PagesController extends Controller
{
    public function home()
    {
    	$videos = Upload::all()->take(8);
    	return view('pages.homepage')->with('videos', $videos);
    }

    public function homeAjax(Request $request)
    {
        $id = $request->id;
        $videos = Upload::all()->where('id','>',$id)->take(4);
        $output = "";
        if(!$videos->isEmpty())
        {
            foreach($videos as $video)
            {
                $output .= '<div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card card-home bg-light mx-1 mb-4 d-inline-block card-cascade wider reverse" style="width: inherit;">
                    <a href="/view/'.$video->id.'">
                        <video style="object-fit: fill; width: 100%;">
                            <source src="/storage/videos/'.$video->upload.'" type="video/mp4">
                        </video>
                    </a>
                    
                    <div class="card-body card-body-cascade p-2">
                        <a href="/view/'.$video->id.'">
                            <h5 class="card-title m-0">'.$video->title.'</h5>
                        </a>
                        
                        <p class="text-muted m-1" style="line-height: 20px"> 
                            <cite class="text-info">-'.$video->upload_by.'</cite><br>
                            <code>-'.time_elapsed_string($video->created_at).'</code><br>
                        </p>
                        <a href="#" data-toggle="modal" data-target="#myModal-'.$video->id.'" class="btn btn-default btn-sm">View</a> 
                    
                        <div class="modal fade" id="myModal-'.$video->id.'" tabindex="-1">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel-'.$video->id.'">
                                            '.$video->id.'. '.$video->upload.'
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <video width="100%" controls >
                                            <source src="/storage/videos/'.$video->upload.'" type="video/mp4">
                                        </video>
                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>';
            }
            
            $output .= '<div class="w-100"></div><div id="remove-row" class="d-block text-center w-100">
                            <button id="btn-more" data-id="'.$video->id.'" class="btn btn-dark" > Load More </button>
                        </div>';
            
            echo $output;
        }
    }

    public function profile()
    {
        $user = User::find(Auth::user()->id);
        $videos = $user->uploads()->paginate(3);
        

        $likes = DB::table('likes')->join('users', 'likes.like_by', '=', 'users.email')->select('likes.like_on_video_id');           
                      
        $favs = DB::table('uploads')
        ->joinSub($likes, 'likes', function ($join) {
            $join->on('uploads.id', '=', 'likes.like_on_video_id');
        })->get();





        $myreports = $user->myreports;
        
        $video = "";
        $comment = "";
        $output1 = "";
        $output2 = "";

        if(!$myreports->isEmpty())
        {
            foreach($myreports as $myreport)
            {
                if($myreport->video)
                {
                    // dd($myreport->ofVideo);
                    $video = $myreport->ofVideo;
                        $output1 .= '<h5>You reported this video at '.$myreport->created_at.'</h5>
                        <div class="row p-3 ml-4 mb-5" style="border: 1px solid black; background-color: #f2f2f2;">
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                            <a href="/view/'.$video->id.'">
                                <video style="object-fit: fill; width: 100%;">
                                    <source src="/storage/videos/'.$video->upload.'" type="video/mp4">
                                </video>
                            </a>
                        </div>
                        <div>    
                            <div class="col-12 col-md-6 col-lg-8 col-xl-8 p-2">
                                <a href="/view/'.$video->id.'">
                                    <h5 class="card-title m-0">'.$video->title.'</h5>
                                </a>
                                
                                <p class="text-muted m-1" style="line-height: 20px"> 
                                    <cite class="text-info">'.$video->upload_by.'</cite><br>
                                    <code>'.time_elapsed_string($video->created_at).'</code><br>
                                </p>
                                <a href="#" data-toggle="modal" data-target="#myModal-'.$video->id.'" class="btn btn-default btn-sm">View</a> 
                            
                                <div class="modal fade" id="myModal-'.$video->id.'" tabindex="-1">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel-'.$video->id.'">
                                                    '.$video->id.'. '.$video->upload.'
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <video width="100%" controls >
                                                    <source src="/storage/videos/'.$video->upload.'" type="video/mp4">
                                                </video>
                                            </div>
                                            <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>';
                }
                else 
                {
                    $comment = $myreport->ofComment;
                    $output1 .= '<h5>You reported this comment at '.$myreport->created_at.'</h5>
                        <div class="comment mb-4 ml-4 row" style="border: 1px solid black">
                            <div class="comment-avatar col-md-1 col-sm-2 col-2 text-center pr-0">
                                <a href=""><img style="width:70px; height:70px" class="mx-auto rounded-circle img-fluid" src="'.$comment->user->avatar_original.'">
                                </a>
                            </div>
                      
                                <div class="comment-content col-md-11 col-sm-10 col-10 p-2" style="background-color: #f2f2f2; letter-spacing: 1">
                            <a href="http://localhost.utube.com/view/'.$myreport->report_on_video_id.'#div_'.$comment->comment_id.'">
                                    <h6 class="comment-meta">'.$comment->comment_by.'&emsp;<small>'.time_elapsed_string($comment->created_at).'</small>
                                    <div class="comment-body pt-4">
                                        <p class="text" style="color: black">
                                            <span>&#8220;</span>'.$comment->comment.'<span>&#8221;</span>
                                            <br>
                                        </p>    
                                    </div>
                            </a>
                                </div>
                        </div>';

                }
                
            }
        }



        $oreports = $user->oreports;



        if(!$oreports->isEmpty())
        {
            foreach($oreports as $oreport)
            {
                if($oreport->video)
                {
                    // dd($oreport->ofVideo);
                    $video = $oreport->ofVideo;
                        $output2 .= '<h5><span style="font-style:italic; font-weight:bold">'.$oreport->report_by.'</span> reported your video at '.$oreport->created_at.'</h5>
                        <div class="row p-3 ml-4 mb-5" style="border: 1px solid black; background-color: #f2f2f2;">
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                            <a href="/view/'.$video->id.'">
                                <video style="object-fit: fill; width: 100%;">
                                    <source src="/storage/videos/'.$video->upload.'" type="video/mp4">
                                </video>
                            </a>
                        </div>
                        <div>    
                            <div class="col-12 col-md-6 col-lg-8 col-xl-8 p-2">
                                <a href="/view/'.$video->id.'">
                                    <h5 class="card-title m-0">'.$video->title.'</h5>
                                </a>
                                
                                <p class="text-muted m-1" style="line-height: 20px"> 
                                    <cite class="text-info">'.$video->upload_by.'</cite><br>
                                    <code>'.time_elapsed_string($video->created_at).'</code><br>
                                </p>
                                <a href="#" data-toggle="modal" data-target="#myModal-'.$video->id.'" class="btn btn-default btn-sm">View</a> 
                            
                                <div class="modal fade" id="myModal-'.$video->id.'" tabindex="-1">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel-'.$video->id.'">
                                                    '.$video->id.'. '.$video->upload.'
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <video width="100%" controls >
                                                    <source src="/storage/videos/'.$video->upload.'" type="video/mp4">
                                                </video>
                                            </div>
                                            <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>';
                }
                else 
                {
                    $comment = $oreport->ofComment;
                    $output2 .= '<h5><span style="font-style:italic; font-weight:bold">'.$oreport->report_by.'</span> reported your comment at '.$oreport->created_at.'</h5>
                        <div class="comment mb-4 ml-4 row" style="border: 1px solid black">
                            <div class="comment-avatar col-md-1 col-sm-2 col-2 text-center pr-0">
                                <a href=""><img style="width:70px; height:70px" class="mx-auto rounded-circle img-fluid" src="'.$comment->user->avatar_original.'">
                                </a>
                            </div>
                      
                                <div class="comment-content col-md-11 col-sm-10 col-10 p-2" style="background-color: #f2f2f2; letter-spacing: 1">
                            <a href="http://localhost.utube.com/view/'.$myreport->report_on_video_id.'#div_'.$comment->comment_id.'">
                                    <h6 class="comment-meta">'.$comment->comment_by.'&emsp;<small>'.time_elapsed_string($comment->created_at).'</small>
                                    <div class="comment-body pt-4">
                                        <p class="text" style="color: black">
                                            <span>&#8220;</span>'.$comment->comment.'<span>&#8221;</span>
                                            <br>
                                        </p>    
                                    </div>
                            </a>
                                </div>
                        </div>';

                }
                
            }
        }

        

        return view('pages.profile')->with('user', $user)->with('videos', $videos)->with('favs', $favs)->with('myreports', $myreports)->with('oreports', $oreports)->with('output1', $output1)->with('output2', $output2);
    }

    public function profile_video()
    {
    	$videos = Upload::orderBy('created_at', 'desc')->paginate(10);
    	return view('pages.profile')->with('videos', '$videos');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
        	'video' => 'required|mimes:mp4,mov,ogg,qt,webm',
        ]);

        if($request->hasFile('video'))
        {
        	$filenameWithExt = $request->file('video')->getClientOriginalName();
        	$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        	$extension = $request->file('video')->getClientOriginalExtension();
        	$filenameToStore = $filename.'_'.time().'.'.$extension;
        	$path = $request->file('video')->storeAs('public/videos', $filenameToStore);
        }

        $upload = new Upload;
        $upload->title = $filename;
        $upload->upload = $filenameToStore;
        $upload->upload_by = Auth::user()->email;
        $upload->save();

        return redirect('/profile')->with('success', 'Video Uploaded');
    }

    public function delete($id)
    {
        $video = Upload::findOrFail($id);
        Storage::delete($video->upload);
        $video->comments()->delete();
        $video->delete();
        // unlink(storage_path('public/videos/'.$video->upload));
        return redirect('/profile')->with('success', 'Video Deleted');
    }

    public function deleteview($id)
    {
        $video = Upload::findOrFail($id);
        Storage::delete($video->upload);
        $video->comments()->delete();
        $video->delete();
        // unlink(storage_path('public/videos/'.$video->upload));
        return redirect('/home');
    }

    public function reportvideo($id)
    {
        $video = Upload::findOrFail($id);

        $user = User::find(Auth::user()->id);
        $user_reports = $user->myReports()->where('report_on_video_id', $id)->get();
        // $user_reports = Report::all()->where('report_on_video_id', $id)->where('report_by', $user->email)->first();
        if (count($user_reports)) {
            return json_encode('Video has been ALREADY Reported');
        }
        else {
            $video->increment('report_count');
            $report = new Report;
            $report->report_on_video_id = $id;
            $report->report_by = $user->email;
            $report->report_on = $video->upload_by;
            $report->video = $video->title;
            $report->save();

            return json_encode('Video has been Reported');
        }
    }

    


    public function view($id)
    {
        $video = Upload::findOrFail($id);
        $user = $video->user;
        // $user = User::find($video->upload_by);
        $others = Upload::inRandomOrder()->whereNotIn('id', [$id])->limit(9)->get();
        
        // $others = DB::table('uploads')
        //         ->where('id', '<>', $id)
        //         ->inRandomOrder()
        //         ->get();
        if(Auth::check()) {
            $liketable = User::find(Auth::id())->likes()->where('like_on_video_id', $id)->first();
            return view('pages.view')->with('video',$video)->with('user',$user)->with('others', $others)->with('liketable',$liketable);
        }
        return view('pages.view')->with('video',$video)->with('user',$user)->with('others', $others);
    }


    public function favsystem($video_id)
    {
        $video = Upload::findOrFail($video_id);
        $video->increment('likes');

        $like_by = Auth::user()->email;

        $liketable = new Like;
        $liketable->like_on_video_id = $video_id;
        $liketable->like_by = $like_by;
        $liketable->save();

        return response()->json(['success'=>'Successfully liked the video']);
    }

    public function unfavsystem($video_id)
    {
        $video = Upload::findOrFail($video_id);
        $video->decrement('likes');

        // $like = $video->likes()->where('like_by', '=', Auth::user()->email)->get();
        // $like->delete();
        $like = Like::where('like_on_video_id', $video_id)->where('like_by', Auth::user()->email)->delete();
 
        return response()->json(['success'=>'Successfully Unliked the video']);
    }


}
