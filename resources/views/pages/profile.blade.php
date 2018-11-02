@extends('layouts.app')

@section('content')

<div class="container-fluid h-100 p-0 px-xl-n" style="height: 100%;">
    <div style="background-color: white;">

        <div class="row align-items-center pr-5 mx-0 mb-5 pt-5 pb-5" style="height: auto; width: auto; background:linear-gradient(to right, #114357, #f29492); color: white">

            <div class="col-md-3" align="center">
                <img src="{{ $user->avatar_original }}" style="width: 13rem; height: 13rem; border-radius: 50%">
            </div>

            <div class="col-md-9" align="center">
                <table class="table table-hover table-bordered">
                    <tbody style="color: white;">
                        <tr>
                            <td>ID</td>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>Google ID</td>
                            <td>{{ $user->google_id }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    </tbody>
                </table>
               
            </div>
        </div>



        <div class="belowContent px-5">

            <nav>
                <div class="nav nav-tabs" id="nav-tab">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-video">My Videos</a>
                    <a class="nav-item nav-link" id="nav-like-tab" data-toggle="tab" href="#nav-like">Liked Videos</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-upload">Upload</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-myReport">Your Reports</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-oReport">Other Reports</a>
                </div>
            </nav>

            <div class="tab-content mt-4" id="nav-tabContent">

                <div class="tab-pane fade show active" id="nav-video" style="">

                  <h3>Total Videos: {{ $videos->total() }}</h3>

                  @if(count($videos) > 0)
                      <div class="row">
                          @foreach($videos as $video)
                          <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                          <div class="card bg-light mb-4 d-inline-block" style="width:auto;">
                              <div class="area">
                                  <a href="/view/{{$video->id}}">
                                      <div class="mask">Watch</div>
                                  </a>
                                  <video style="object-fit: fill; width: 100%">
                                      <source src="/storage/videos/{{$video->upload}}" type="video/mp4">
                                          Sorry, your browser doesn't support the video element.
                                  </video>
                              </div> 
                                  
                              <div class="card-body p-2">
                                  <a href="/view/{{$video->id}}"></a>
                                  <h5 class="card-title m-0">{{$video->title}}</h5>
                                  {{-- <cite class="text-info">-{{$video->upload_by}}</cite><br>
                                  <code>-{{$video->created_at}}</code><br> --}}
                                  <p class="text-muted m-1" style="line-height: 20px"> 
                                      <cite class="text-info">-{{$video->upload_by}}</cite><br>
                                      <code>-{{time_elapsed_string($video->created_at)}}</code><br>
                                  </p>
                                  <a href="#" data-toggle="modal" data-target="#myModal-{{$video->id}}" class="btn btn-sm btn-default">View</a> 
                                  <a href="/video/{{$video->id}}/delete" onclick="return confirm('Are u sure!')" class="btn btn-sm btn-danger float-right" role="button">Delete</a>
                              
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
                    @endif
                    {{ $videos->links() }}
                    

                </div>


                <div class="tab-pane fade" id="nav-upload">
                    
                    <div class="mb-5 py-5">

                    {!! Form::open(['route' => 'video.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        
                        {!! Form::label('upload', 'Upload only Videos', ['class' => 'form-control']) !!}
                        {!! Form::file('video') !!}
                        {!! Form::submit('Upload', ['class' => 'btn btn-dark btn-md']); !!}

                    {!! Form::close() !!}

                    </div>

                </div>


                <div class="tab-pane fade" id="nav-myReport">
                                        
                    <div class="pb-5">
                      {!! $output1 !!}
                    </div>
                    

                </div>


                <div class="tab-pane fade" id="nav-oReport">
                    
                    <div class="pb-5">
                      {!! $output2 !!}
                    </div>

                </div>


                <div class="tab-pane fade" id="nav-like">
                  
                  {{-- @if(count($favs) > 0)
                          @foreach($favs as $fav)
                          <p>{{$fav->id}}</p>
                          @endforeach  
                  @endif --}}

                  <h3>Liked Videos: {{ $favs->count() }}</h3>

                  @if(count($favs) > 0)
                      <div class="row">
                          @foreach($favs as $fav)
                          <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                          <div class="card bg-light  mb-4 d-inline-block" style="width:auto;">
                              <div class="area">
                                  <a href="/view/{{$fav->id}}">
                                      <div class="mask">Watch</div>
                                  </a>
                                  <video style="object-fit: fill; width: 100%">
                                      <source src="/storage/videos/{{$fav->upload}}" type="video/mp4">
                                          Sorry, your browser doesn't support the video element.
                                  </video>
                              </div> 
                                  
                              <div class="card-body p-2">
                                  <a href="/view/{{$fav->id}}"></a>
                                  <h5 class="card-title m-0">{{$fav->title}}</h5>
                                  {{-- <cite class="text-info">-{{$video->upload_by}}</cite><br>
                                  <code>-{{$video->created_at}}</code><br> --}}
                                  <p class="text-muted m-1" style="line-height: 20px"> 
                                      <cite class="text-info">-{{$fav->upload_by}}</cite><br>
                                      <code>-{{time_elapsed_string($fav->created_at)}}</code><br>
                                  </p>
                                  <a href="#" data-toggle="modal" data-target="#myModal-{{$fav->id}}" class="btn btn-sm btn-default">View</a> 
                                  
                              
                                  <div class="modal fade" id="myModal-{{$fav->id}}" tabindex="-1">
                                      <div class="modal-dialog modal-lg" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title" id="myModalLabel-{{$fav->id}}">
                                                      {{$fav->id}}. {{$fav->upload}}
                                                  </h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              </div>
                                              <div class="modal-body">
                                                  <video width="100%" controls >
                                                      <source src="/storage/videos/{{$fav->upload}}" type="video/mp4">
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
                    @endif


                </div>

            </div>
           
            
            

            

        </div>

        

    </div>
</div>




@endsection