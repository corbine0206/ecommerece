@if(auth()->user()->role === 'user')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.profile.edit') }}">Edit Profile</a>
    </li>
@endif
