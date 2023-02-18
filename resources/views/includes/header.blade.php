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
                <li class="nav-item">
                    <a class="nav-link" href="/userrequest">Book_Request</a>
                </li>

                @if (Auth::guard('web')->check() && Auth::user()->hasRole('admin'))
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/approvelist">ApproveList</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/issuelist">IssueList</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/createBook">Add_Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/createCat">Creat_Category</a>
                    </li>
                @endif

            </ul>
            <form class="form-inline my-2 my-lg-0" action="/search" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                    name="query">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>


            {{-- <div class="p-2">
                @if (Auth::guard('web')->check())

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
            </div> --}}



            <div class="dropdown d-inline-block ">
                @if (Auth::guard('web')->check())
                    {{-- logged in  --}}
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}">
                    </button>

                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="/user/profile"><i
                                class="bx bx-user font-size-16 align-middle me-1"></i>
                            <span key="t-profile">Profile</span></a>

                        <a class="dropdown-item" href="/user/fine">
                            <span key="t-profile">Fine</span></a>

                        <a class="dropdown-item" href="/user/requests">
                            <span key="t-profile">Requests</span></a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </a>
                    </div>
                @else
                    {{-- logged out  --}}
                    <a class="nav-link p-2" href="/login">Login</a>
                @endif
            </div>





        </div>
    </nav>









    {{-- admin = {{Auth::guard('admin')->check()}} --}}
</header>
