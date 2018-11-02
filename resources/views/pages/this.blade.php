
@if(count($comments) > 0)
	@foreach($comments as $comment)

	<div class="comment mb-4 row" id="div_{{$comment->comment_id}}">
		<div class="comment-avatar col-md-1 col-sm-2 col-2 text-center pr-0">
			<a href=""><img style="width:50px; height:50px" class="mx-auto rounded-circle img-fluid" src="{{$comment->user->avatar_original}}">
			</a>
		</div>

		
			@if($video->upload_by == $comment->comment_by)
				<div class="comment-content col-md-11 col-sm-10 col-10 p-2" style="background-color: antiquewhite; letter-spacing: 1">
			@else
				<div class="comment-content col-md-11 col-sm-10 col-10 p-2" style="background-color: dimgray; color: white; letter-spacing: 1">
			@endif
		

			<div class="btn-group float-right mt-2">
			    <a class="dd" data-toggle="dropdown" style="font-size: 22px; padding: 5px 17px; border-radius: 50%"><i class="fas fa-ellipsis-v"></i></a>
			    <div class="dropdown-menu">
			        @auth
			        	@if($comment->user->id == Auth::user()->id)
			        		<a class="dropdown-item edit" id="{{$comment->comment_id}}">Edit</a>
			        		<a class="dropdown-item delete" id="{{$comment->comment_id}}">Delete</a>
			        		<div class="dropdown-divider"></div>
			        	@endif
			        @endauth
			        	<a class="dropdown-item report-comment" name="{{$video->id}}" id="{{$comment->comment_id}}">Report</a>
			        
			    </div>
			</div>

			{{-- @auth
				@if($comment->user->id == Auth::user()->id)
				<div class="btn-group float-right mt-2 editndelete">
					<button class="float-right btn btn-light btn-md delete" id="{{$comment->comment_id}}"></i>Delete</button>
					<button class="float-right btn btn-light btn-md edit" id="{{$comment->comment_id}}">Edit</button>
				</div>
				@endif
			@endauth --}}

			<h6 class="comment-meta">{{$comment->comment_by}}&emsp;<small>{{time_elapsed_string($comment->created_at)}}</small>

			<div class="comment-body pt-4">

				
				@if($video->upload_by == $comment->comment_by)
					<p class="text" style="color: black">
				@else
					<p class="text" style="color: white">
				@endif
					<span>&#8220;</span>{{$comment->comment}}<span>&#8221;</span>
				    <br>
				</p>	
				

			    
			</div>
			<div class="comment-likedis">
				{{-- <span class="like" id="up1"><i class="far fa-thumbs-up"></i></span>	
				<span class="like" id="up2"><i class="fas fa-thumbs-up"></i></span>
				<span class="mr-3"></span>	
				<span class="dislike" id="down1"><i class="far fa-thumbs-down"></i></span>	
				<span class="dislike" id="down2"><i class="fas fa-thumbs-down"></i></span>
				<span class="mr-3"></span>	 --}}
				<button type="button" class="btn btn-light reply" id="{{$comment->comment_id}}">Reply<i class="fas fa-reply"></i></button>
				{{-- @auth
					<div class="reportcmt">
						<button type="button" class="btn btn-flat waves-effect report" id="{{$comment->comment_id}}">Report</button>
					</div>
				@endauth --}}
			</div>
		</div>
	</div>

	@if(count($replys) > 0)
		@foreach($replys as $reply)
			@if($reply->parent_comment_id == $comment->comment_id)

			<div class="comment-reply offset-md-1 offset-sm-2 offset-1" id="div_{{$reply->comment_id}}">		
				<div class="comment mb-4 row ">
					<div class="comment-avatar col-md-1 col-sm-2 col-2 text-center pr-0">
						<a href=""><img style="width:50px; height:50px" class="mx-auto rounded-circle img-fluid" src="{{$reply->user->avatar_original}}">
						</a>
					</div>
					
					
						@if($video->upload_by == $reply->comment_by)
							<div class="comment-content col-md-11 col-sm-10 col-10 p-2" style="background-color: antiquewhite; letter-spacing: 1">
						@else
							<div class="comment-content col-md-11 col-sm-10 col-10 p-2" style="background-color: lightgray; letter-spacing: 1">
						@endif
					

						<div class="btn-group float-right mt-2">
						    <a class="dd" data-toggle="dropdown" style="font-size: 22px; padding: 5px 17px; border-radius: 50%"><i class="fas fa-ellipsis-v"></i></a>
						    <div class="dropdown-menu">
						        @auth
						        	@if($reply->user->id == Auth::user()->id)
						        		<a class="dropdown-item edit" id="{{$reply->comment_id}}">Edit</a>
						        		<a class="dropdown-item delete" id="{{$reply->comment_id}}">Delete</a>
						        		<div class="dropdown-divider"></div>
						        	@endif
						        @endauth
						        	<a class="dropdown-item report-comment" name="{{$video->id}}" id="{{$reply->comment_id}}">Report</a>
						        
						    </div>
						</div>

						{{-- @auth
							@if($reply->user->id == Auth::user()->id)
							<div class="btn-group float-right mt-2 editndelete" >
								<button class="float-right btn btn-light btn-md delete" id="{{$reply->comment_id}}"></i>Delete</button>
								<button class="float-right btn btn-light btn-md edit" id="{{$reply->comment_id}}">Edit</button>
							</div>
							@endif
						@endauth --}}

						<h6 class="comment-meta">{{$reply->comment_by}}&emsp;<small>{{time_elapsed_string($reply->created_at)}}</small>
							
						</h6>
						<div class="comment-body pt-4">
							
								{{-- @if($video->upload_by == $reply->comment_by) --}}
									<p class="text" style="color: black">
								{{-- @else --}}
									{{-- <p class="text"> --}}
								{{-- @endif --}}
									<span>&#8220;</span>{{$reply->comment}}<span>&#8221;</span>
								    <br>
								</p>
							

						</div>
						{{-- <div>	
							<button type="button" class="btn btn-light reply" id="$reply->comment_id">Reply</button>
						</div> --}}
						{{-- @auth
							<div class="reportcmt">
								<button type="button" class="btn btn-flat waves-effect report" id="{{$comment->comment_id}}">Report</button>
							</div>
						@endauth --}}
					</div>
				</div>
			</div>
			@endif
		@endforeach
	@endif

	@endforeach
@endif