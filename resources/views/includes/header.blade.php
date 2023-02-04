<header id="page-topbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/home">LMS</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                
                <li class="nav-item">
                    <a class="nav-link" href="#">Latest</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/authors">Authors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/publishers">Publishers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Subjects</a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>

            <div class="p-3">
                <a class="nav-link" href="/login">Login</a>
            </div>

            
        </div>
    </nav>





    {{-- @if (Auth::guard('admin')->check())
                    <a href="/admin/dashboard" class="logo logo-light">
                    @else
                        <a href="dashboard" class="logo logo-light">
                @endif --}}



    {{-- admin = {{Auth::guard('admin')->check()}} --}}
</header>
