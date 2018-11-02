<nav class="navbar navbar-expand-sm navbar-light fixed-top p-3">
    {{-- <div class="container-fluid"> --}}

        <button type="button" id="sidebarCollapse" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-align-left"></i>
            <!-- <span>Toggle Sidebar</span> -->
        </button>

        <a class="navbar-brand" href="/home">
            <img width="110px" height="25px" src="http://localhost.utube.com/img/youtube/youtube2.png" > 
        </a>

        {{-- <button class="btn btn-dark d-inline-block d-sm-none ml-auto" data-toggle="collapse" data-target="#navbarSupportedContent">
            <i class="fas fa-align-justify"></i>
        </button> --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
          </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{-- <form class="mr-auto mb-auto col-xs-12 col-md-8 d-inline-flex">
                <div class="input-group ">
                    <input type="text" class="form-control border border-right-0" placeholder="Search..." >
                    <span class="input-group-append">
                        <button class="btn btn-outline-secondary border border-left-0" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form> --}}

            <form class="form-inline my-2 my-lg-0 ml-auto">
                <input class="form-control " type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-black btn-md my-2 my-sm-0 ml-3 d-inline-block" type="submit">Search</button>
              </form>
            
            
            <ul class="navbar-nav ml-auto">
                
                @guest
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li> --}}
                            <a href="http://localhost.utube.com/login/google" class="btn btn-light btn-block">
                                SIGN IN
                            </a>
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>   
                        @endguest

                    </ul>
                </div>
            {{-- </div> --}}
        </nav>