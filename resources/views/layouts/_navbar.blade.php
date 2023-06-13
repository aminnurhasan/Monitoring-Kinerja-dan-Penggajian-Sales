<nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <p> 
                    <i class="fas fa-user"></i>
                    {{ Auth::user()->name }}
                    <i class="fas fa-caret-down"></i>
                </p>
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                {{-- <a href="#" class="dropdown-item"> --}}
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <div class="row">
                            <p style="color: black" class="ml-2">
                                Logout
                                <i style="color: red" class="fas fa-power-off ml-2"></i>
                            </p>
                        </div>
                    </a>
    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                {{-- </a> --}}
            </div>
        </li>
    </ul>
</nav>
