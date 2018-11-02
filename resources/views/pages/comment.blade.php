
{{-- 

{!! Form::open(['action' => 'CommentsController@store', 'method' => 'POST']) !!}
    <div class="form-group">
    	{{Form::label('body', 'Comments')}}
    	{{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Write a comment..'])}}
    </div>
    {{ Form::hidden('video_id', $video->id, ['id' => 'video_id']) }}
    {{ Form::hidden('parent_comment_id', '0', ['id' => 'parent_comment_id']) }}
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
{!! Form::close() !!}





 <form method="POST" id="comment_form" action="/comments">
 	<div class="form-group">
 		<textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5">
 		</textarea>
 	</div>
 	<div class="form-group">
 		<input type="hidden" name="video_id" id="video_id" value="$video->id" />
 		<input type="hidden" name="parent_comment_id" id="parent_comment_id" value="0" />
 		<input type="submit" name="submit" id="submit" class="btn btn-default" value="Submit" />
 		<input type="hidden" name="update" id="update" class="btn btn-default" value="Update" />
 	</div>
 </form> --}}



 <form method="POST" id="comment_form">
 	<input type="hidden" name="_token" value="{{ csrf_token() }}">
 	<div class="form-group md-form amber-textarea active-amber-textarea">
 	    <i class="fas fa-pencil-alt prefix"></i>
 	    {{-- <textarea name="comment_content" id="comment_content form22" class="md-textarea form-control" rows="5"></textarea> --}}
 	{{-- </div>
 	<div class="form-group shadow-textarea"> --}}
 		@guest
 			{{-- <textarea name="comment_content" id="comment_content" class="form-control z-depth-1" placeholder="You need to log in to comment.." rows="5" data-validation="required" disabled>
 			</textarea> --}}
 			<textarea name="comment_content" id="comment_content" class="md-textarea form-control" rows="5" placeholder="You need to log in to comment.."  disabled></textarea>
 		@else
 			{{-- <textarea name="comment_content" id="comment_content" class="form-control z-depth-1" placeholder="Enter Comment" rows="5" data-validation="required">
 			</textarea> --}}
 			<textarea name="comment_content" id="comment_content" class="md-textarea form-control" rows="5"></textarea>
 		@endguest
 	    <label for="comment_content">Enter Comment</label>
 		
 	</div>
 	<div class="form-group">
 		<input type="hidden" name="video_id" id="video_id" value={{$video->id}} />
 		<input type="hidden" name="comment_id" id="comment_id" value="0" />

 		@guest
 			<input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" disabled/>
 		@else
 			<input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit"/>
 		@endguest

 		{{-- <input type="hidden" name="update" id="update" class="" value="Update" /> --}}
 	</div>
 </form>

 <div id="display_comment"></div>