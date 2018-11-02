
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/css/mdb.min.css" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" /> --}}

    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"></script>



</head>
<body>

    <div id="overlay">
        <div class="spinner"></div> 
    </div>

    <div id="app">

        @include('inc.navbar')

        <div class="wrapper">
            <!-- Sidebar  -->
            @include('inc.sidebar')

            <!-- Page Content  -->
            <div id="content" class="" style="background-color: #f2f2f2;">

                @include('inc.messages')
                @yield('content')

            </div>

        </div>
        <div class="overlay"></div>
    </div>
    
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}
    
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    {{-- Bootstrap core JavaScript --}}
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/js/mdb.min.js"></script>

    
    <script src="{{ asset('js/t.min.js') }}" defer></script>

    <script type="text/javascript">
        $(document).ready(function () {


            var overlay = document.getElementById("overlay");

            window.addEventListener('load', function(){
                overlay.style.display = 'none';
            })

            

            $('#demo_1').t({
                 beep:true,
                 caret:'<span style="color:hotpink;">•</span>',
                 typing:function(elm,chr){

                   if(chr.match(/\-trigger/))
                     $('#pow-txt').show().delay(5000).fadeOut(0);
                  
                 }
                });


            $('#up2').hide();

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                // $('#sidebar').addClass('active');
                $('.overlay').toggleClass('active');
                // $('.card-home').toggleClass('mr-4 ml-3');
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('.area').hover(function(){
                $('.mask').removeClass('d-none');
                $('.mask').addClass('d-block');
            });

            var loggedIn = {{ auth()->check() ? 'true' : 'false' }};

            $(document).on('click', '.like', function () {
                event.preventDefault();

                if (loggedIn)
                {
                    $(this).css('display', 'none');
                    $('.dislike').css('display', 'block');
                    var $id = $(this).attr("id");

                    $.ajax({
                        url:$id+"/likes",
                        method: "POST",
                        data: {
                            update: 'like' 
                        },
                        success:function(response)
                        {
                            // if(data.error != '')
                            // {
                                // alert("success");
                            // }
                            $(".like-count").load(location.href+" .like-count");
                        },
                        error: function(e) {
                            console.log(e.message);
                        }
                    })

                }
                else {
                    alert("You need to Log in");
                }
        

            });

            $(document).on('click', '.dislike', function () {
                event.preventDefault();

                $(this).css('display', 'none');
                $('.like').css('display', 'block');
                var $id = $(this).attr("id");

                $.ajax({
                    url:$id+"/unlikes",
                    method: "POST",
                    data: {
                        update: 'unlike' 
                    },
                    success:function(response)
                    {
                        // if(data.error != '')
                        // {
                            // alert("success");
                        // }
                        $(".like-count").load(location.href+" .like-count");
                    },
                    error: function(e) {
                        console.log(e.message);
                    }
                })

            });



            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });




            $('#comment_form').on('submit', function(event){
                event.preventDefault();

                if ($('#comment_content').val() == 0) {
                    $('#comment_content').focus();
                    return;
                }

                var form_data = $(this).serialize();

                // var comment_content = $(".comment_content").val();
                // var video_id = $("input[name=video_id]").val();
                // var parent_comment_id = $("input[name=parent_comment_id]").val();

                $.ajax({
                    url:"{{ url('/save') }}",
                    method:"POST",
                    data:form_data,
                    // data:{comment_content:comment_content, video_id:video_id, parent_comment_id:parent_comment_id},
                    dataType:"JSON",
                    success:function(data)
                    {
                        alert(data.success);

                        $('#comment_form')[0].reset();
                        $('#comment_id').val('0');

                        load_comment();
                    }
                    // error: function(response){
                    //     alert('Error'+response);
                    // }
                })
            });

            load_comment();

            function load_comment()
            {
                var $id = $("input[name=video_id]").val();
                $.ajax({
                    url:$id+"/load",
                    method:"POST",
                    data:$id,
                    success:function(data)
                    {
                        $('#display_comment').html(data);
                    }
                })
            }


            $(document).on('click', '.reply', function(){

                if (!loggedIn){
                    alert("You need to Log in");
                }

                var comment_id = $(this).attr("id");
                $('#comment_id').val(comment_id);
                $('#comment_content').val("");
                $('#comment_content').focus();
                $('#submit').show();
                $('#update').prop('type', 'hidden');
            });


            var edit_id;
            var edit_comment;
            var name;
            var comment;

            $(document).on('click', '.edit', function(){

                edit_id = $(this).attr("id");
                edit_comment = $(this).parent();

                name = $(this).parents('.comment-content').find('.name').text();
                comment = $.trim($(this).parents('.comment-content').find('.text').text());

                $('#comment_content').focus();
                $('#comment_content').val(comment);
                $('#submit').prop('name', 'update');
                $('#submit').prop('value', 'Update');
                $('#submit').prop('id', 'update');
                // alert(comment);
                // console.log(comment);

            });
            

            $(document).on('click', '#update', function(event){
                event.preventDefault();
                newcomment = $('#comment_content').val();
                // alert(edit_id);
                // console.log(edit_id);
                $.ajax({
                    url:"{{ url('/editupdate') }}",
                    method: "POST",
                    data: {
                        update: 'true', 
                        id: edit_id, 
                        comment: newcomment
                    },
                    success:function(data)
                    {
                        alert("Comment Updated");
                        if(data.error != '')
                        {
                            $('#comment_form')[0].reset();
                            $('#comment_message').html(data.error);

                            // $edit_comment.replaceWith(response);
                            load_comment();
                        }
                        $('#update').prop('value', 'Submit');
                        $('#update').prop('name', 'submit');
                        $('#submit').prop('id', 'submit');
                    },
                    error: function(e) {
                        console.log(e.message);
                    }
                })
            }); 



            $(document).on('click', '.delete', function(event){
                event.preventDefault();

                var r = confirm("Are u sure!");
                    if (r == true) {
                        var id = $(this).attr("id");
                        var $btn = $(this);

                        $.ajax({
                            url:"{{ url('/delete') }}",
                            method:"POST",
                            data: {
                                delete: 1,
                                id: id,
                            },
                            success:function(data)
                            {
                                alert("Comment Deleted");
                                // $btn.parents('.comment').remove();
                                load_comment();
                            }
                        })
                    } 
                
            });


            $(document).on('click', '.report-video', function(event){
                event.preventDefault();
                var r = confirm("Are u sure!");
                if (r == true) {
                    if (loggedIn)
                    {
                        var $id = $(this).attr("id");
                        
                        $.ajax({
                            url:$id+"/reportvideo",
                            method:"POST",
                            dataType: "json",
                            data: {
                                id: $id,
                            },
                            success:function(data)
                            {
                                alert(data); 
                            }
                        })
                    }
                    else{
                        alert("You need to log in to report");
                    }
                }
            });



            $(document).on('click', '.report-comment', function(event){
                event.preventDefault();
                var r = confirm("Are u sure!");
                if (r == true) {
                    if (loggedIn)
                    {
                        var $id = $(this).attr("id");
                        var $v_id = $(this).attr("name");
                        
                        $.ajax({
                            url:$id+"/reportcomment",
                            method:"POST",
                            dataType: "json",
                            data: {
                                id: $id,
                                v_id: $v_id,
                            },
                            success:function(data)
                            {
                                alert(data);
                            }
                        })
                    }
                    else{
                        alert("You need to log in to report");
                    }
                }
            });







            var menu;

            $('.comment-content').mouseover(function(){
                $(this).css('display', 'block');
            });

            $('.comment-content').mouseout(function(){
                $(this).css('display', 'hidden');
            });

            $(document).on('click', '.dd', function(event){
                menu = $(this);
                menu.css('display', 'block');
            });

            $('body').click(function(evt){    
                var isVisible = $('.dd:visible');
                if(menu && !$(evt.target).is('.dd'))
                {
                    // alert($('.dd:visible'));
                    menu.css('display', '');
                    // menu.css('display', 'hidden');
                    // isVisible.css('display', 'hidden');
                    // $('.dd').css('display', 'hidden');
                    // $('.comment-content a:visible').css('display', 'hidden');
                    // menu.hide();

                }
            });

            
            
            $(document).on('click','#btn-more',function(){
                   var id = $(this).data('id');
                   $("#btn-more").html("Loading....");
                   $.ajax({
                       url : '{{ url("home") }}',
                       method : "POST",
                       data : {id:id, _token:"{{csrf_token()}}"},
                       dataType : "text",
                       success : function (data)
                       {
                          if(data != '') 
                          {
                              $('#remove-row').remove();
                              $('#load-data').append(data);
                          }
                          else
                          {
                              $('#btn-more').html("Finished Loading");
                          }
                       }
                   });
               }); 



            




        });
    </script>

</body>
</html>
