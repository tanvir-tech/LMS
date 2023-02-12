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
                    <a class="nav-link" href="/latest">Latest</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/authors">Authors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/publishers">Publishers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/categories">Categories</a>
                </li>

                @if (Auth::guard('web')->check() && Auth::user()->hasRole('admin'))
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/dashboard">ApproveList</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/issueList">IssueList</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/createBook">Add Book</a>
                    </li>
                @endif

            </ul>
            <form class="form-inline my-2 my-lg-0" action="/search" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>


            <div class="p-2">
                @if (Auth::guard('web')->check())
                {{-- <a class="nav-link" href="/admin/dashboard">Dashboard</a> --}}

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <div class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();this.closest('form').submit(); " role="button">
                            <i class="fas fa-sign-out-alt"></i>
                            {{ __('Log Out') }}
                        </a>
                    </div>
                </form>
            @else
                <a class="nav-link" href="/login">Login</a>
            @endif
            </div>
            

        </div>
    </nav>









    {{-- admin = {{Auth::guard('admin')->check()}} --}}
</header>
