<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Microposts</a>

        <button type="button" class="navbar-toggler" data-toggle=
        "collapse" data-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item">{!! link_to_route('users.index', 'Users',[], ['class' =>'nav-link']) !!} </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        {{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <!--Auth::id()とAuth::user()->idは同じ動き-->
                            <li class="dropdown-item">{!! link_to_route('users.show', 'My Profile',['id' => Auth::id()]) !!}</li>
                            <li class="dropdown-item">{!! link_to_route('users.favorites', 'Favorites',['id' => Auth::id()]) !!}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('logout.get', 'Logout') !!}</li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">{!! link_to_route('signup.get', 'Signup', [], ['class' =>'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('login', 'Login', [], ['class' =>'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>