<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Comment;
use App\Upload;
use App\User;
use App\Report;

class CommentsController extends Controller
{

    private $id = 0;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

        // $this->validate($request, [
        //     'comment_content' => 'required'
        // ]);


        // $input = Input::all();
        // $input = Input::only('parent_comment_id','video_id','comment_content'); 

        $this->id = $_POST['video_id'];

        $comment = new Comment;
        $comment->parent_comment_id = $_POST['comment_id'];
        $comment->video_id = $_POST['video_id'];
        $comment->comment = $_POST['comment_content'];
        $comment->comment_by = Auth::user()->email;
        $comment->save();

        // $comment = new Comment;
        // $comment->parent_comment_id = $request->parent_comment_id;
        // $comment->video_id = $request->parent_comment_id;
        // $comment->comment = $request->parent_comment_id;
        // $comment->comment_by = Auth::user()->email;
        // $comment->save();

        

        return response()->json(['success'=>'Data is successfully added']);

        // return back();
    }



    public function load($video_id)
    {
        // $comments = Comment::where('video_id', 1)->where('parent_comment_id', '0');
        // $comments = Comment::all();
        $comments = Comment::where('video_id', '=', $video_id)->where('parent_comment_id', '=', 0)->get();
        $replys = Comment::where('parent_comment_id', '!=', 0)->get();
        $video = Upload::findOrFail($video_id);
        return view('pages.this', ['comments' => $comments, 'replys' => $replys, 'video' => $video]);
    }

    public function editupdate()
    {
        $id = $_POST["id"];
        $newcomment = $_POST["comment"];

        $comment = Comment::findOrFail($id);
        $comment->comment = $newcomment;
        $comment->save();

        return response()->json(['success'=>'Successfully Updated']);
    }

    public function reportcomment($id)
    {
        $id = $_POST["id"];
        $video_id = $_POST["v_id"];

        $comment = Comment::findOrFail($id);
        

        $user = User::find(Auth::user()->id);
        $user_reports = $user->myReports()->where('report_on_comment_id', $id)->get();
        // $user_reports = Report::all()->where('report_on_comment_id', $id)->where('report_by', $user->email)->first();
        if (count($user_reports)) {
            return json_encode('Comment has been ALREADY Reported');
        }
        else {
            $comment->increment('report_count');
            $report = new Report;
            $report->report_on_video_id = $video_id;
            $report->report_on_comment_id = $id;
            $report->report_by = $user->email;
            $report->report_on = $comment->comment_by;
            $report->comment = $comment->comment;
            $report->save();

            return json_encode('Comment has been Reported');
        }

    }

    public function delete()
    {
        $id = $_POST["id"];

        $comment = Comment::findOrFail($id);
        Comment::where('parent_comment_id', '=', $id)->delete();
        $comment->delete();

        return response()->json(['success'=>'Successfully Deleted']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }





}
