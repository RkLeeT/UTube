

@extends('layouts.app')



@section('content')



    {{-- <h2>YouTube</h2>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> --}}


    <pre id="demo_1">
        utube<ins><span id="pow-txt"> ---[BAAANNGGG!]</span></ins>
        <span id="tagline">Which is a Video Sharing Platform, <ins>SAD</ins>  :|<br>        allowing users to upload and share their videos <br>        out here  :D</span><del></del><del id="pow-trigger"></del> \\
        </pre>



    <div class="line"></div>

    @if(count($videos) > 0)
	    <div class="row" id="load-data">
	    	@foreach($videos as $video)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
	    		<div class="card card-home bg-light mx-1 mb-4 d-inline-block card-cascade wider reverse" style="width: inherit;">
                    <a href="/view/{{$video->id}}">
                        <video style="object-fit: fill; width: 100%;">
                            <source src="/storage/videos/{{$video->upload}}" type="video/mp4">Sorry, your browser doesn't support the video element.
                        </video>
                    </a>
	    		    
	    		    <div class="card-body card-body-cascade p-2">
                        <a href="/view/{{$video->id}}">
                            <h5 class="card-title m-0">{{$video->title}}</h5>
                        </a>
                        
                        <p class="text-muted m-1" style="line-height: 20px"> 
                            <cite class="text-info">-{{$video->upload_by}}</cite><br>
                            <code>-{{time_elapsed_string($video->created_at)}}</code><br>
                        </p>
                        <a href="#" data-toggle="modal" data-target="#myModal-{{$video->id}}" class="btn btn-default btn-sm">View</a> 
                    
                        <div class="modal fade" id="myModal-{{$video->id}}" tabindex="-1">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel-{{$video->id}}">
                                            {{$video->id}}. {{$video->upload}}
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <video width="100%" controls >
                                            <source src="/storage/videos/{{$video->upload}}" type="video/mp4">
                                                Sorry, your browser doesn't support the video element.
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
            </div>
	    	@endforeach
            
	    </div>

        <div id="remove-row" class="d-block text-center w-100">
            <button id="btn-more" data-id="{{ $video->id }}" class="btn btn-dark" > Load More </button>
        </div>

    @endif

@endsection