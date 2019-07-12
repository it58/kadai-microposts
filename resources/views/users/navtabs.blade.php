<ul class="nav nav-tabs nav-justified mb-3">
    <li class="nav-item"><a href="{{ route('users.show',['id' =>$user->id]) }}" class="nav-link {{ Request::is('users/'.$user->id) ? 'active' : '' }}">TimeLine <span class="badge bagde-secondary">{{ $count_microposts }}</span></a></li>
    <li class="nav-item"><a href="{{ route('users.followings',['id' =>$user->id]) }}" class="nav-link {{ Request::is('users/*/followings') ? 'active' : '' }}">followings <span class="badge bagde-secondary">{{ $count_followings }}</span></a></li>
    <li class="nav-item"><a href="{{ route('users.followers',['id' =>$user->id]) }}" class="nav-link {{ Request::is('users/*/followers') ? 'active' : '' }}">followers <span class="badge bagde-secondary">{{ $count_followers }}</span></a></li>
</ul>