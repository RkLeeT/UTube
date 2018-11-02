@extends('layouts.app')

@section('content')

<div class="container-fluid">
	
	<div class="row view-video d-block">
		
		<div class="main col-12 col-xl-8 pl-0 pb-4 float-left">
			
			<video width="100%" height="auto" controls style="object-fit: fill">
			    <source src="/storage/videos/{{$video->upload}}" type="video/mp4">
			</video>

			<div class="detail">
				<div class="clearfix pt-1">
					<h4 class="float-left mt-4">{{$video->title}}</h4>
					<div class="float-right">
						<div class="float-left pr-5 pt-3" style="font-size: 2rem">
							<span class="likedis">
								<a class="waves-effect" style="padding: 7px 15px; border-radius: 50%;">
									@auth
										@if($liketable)
											<i class="far fa-heart like" id="{{$video->id}}" style="display: none"></i>
											<i class="fas fa-heart dislike" id="{{$video->id}}" style="display: block"></i>
										@else
											<i class="far fa-heart like" id="{{$video->id}}" style="display: block"></i>
											<i class="fas fa-heart dislike" id="{{$video->id}}" style="display: none"></i>
										@endif
										
									@else
										<i class="far fa-heart like" id="{{$video->id}}" style="display: block"></i>
										<i class="fas fa-heart dislike" id="{{$video->id}}" style="display: none"></i>
									@endauth
								</a>
								<p class="float-right d-inline-block like-count">{{$video->likes}}</p>
							</span>
							{{-- <span class="dislike">
								<i class="far fa-thumbs-down"></i>
								<p class="d-inline-block dislike-count">2</p>
							</span> --}}
						</div>
						
						<div class="btn-group mt-3">
						    <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">Action</button>
						    <div class="dropdown-menu">
						    	@auth
						    		@if($user->email == Auth::user()->email)
							        	<a href="/view/{{$video->id}}/delete" onclick="return confirm('Are u sure!')" class="dropdown-item">Delete</a>
							        	<div class="dropdown-divider"></div>
						    		@endif
						    	@endauth
						        <a class="dropdown-item report-video" id="{{$video->id}}">Report</a>
						    </div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-2 col-sm-2 col-lg-1">
						<img src="{{$user->avatar_original}}" style="width: 5rem;height: 5rem;border-radius: 50%">
					</div>
					<div class="col-10 col-sm-10 col-lg-11 mt-3 ">
						<h5>{{$video->upload_by}}</h5>
						<p>Published on {{time_elapsed_string($video->created_at)}}</p>
					</div>
				</div>
				<hr>
			</div>

		</div>

		<div class="others col-12 col-xl-4 float-right">
			
			@if(count($others)>0)
				<div class="row">
				@foreach($others as $other)
					<div class="col-6 col-md-3 col-xl-6 mb-2 ">
						<a href="/view/{{$other->id}}">
							<video style="object-fit: fill;">
						    	<source src="/storage/videos/{{$other->upload}}" type="video/mp4">
							</video>
						</a>
					</div>
					
					<div class="col-6 col-md-9 col-xl-6 pl-xl-0 pl-0">
						<a href="/view/{{$other->id}}">
							<h6 class="title m-0" style="font-size: 15px">{{$other->title}}</h6>
						</a>	
						<p class="m-0" style="font-size: 15px">{{$other->user->name}}</p>
						<p class="m-0" style="font-size: 15px">{{time_elapsed_string($other->created_at)}}</p>
					</div>			


				@endforeach
				</div>
			@endif	

		</div>
		<div class="col-12 col-xl-8 pl-0 float-left">
			<br>
			<h5>Comment Section</h5>
			@include('pages.comment')

			

		</div>

	</div>

	{{-- <div class="row">
		<div class="col-8 pl-0"> --}}

			

		{{-- </div>
	</div> --}}

</div>



@endsection