<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/"><img src="{{ asset('images/logo.png') }}" style="width: 28px; height: 25px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            @if (Auth::check() &&Auth::user()->username == "admin")
                <a class="nav-link link" href="/admin">
                Home</a>
            @else
                <a class="nav-link link" href="/">
                    Home</a>
             @endif
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('services') }}">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('about') }}">About Us</a>
        </li>
        @if (Auth::check() && Auth::user()->username == "admin")
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin') }}">Manage</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/manage-staff') }}">Manage your staff</a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{ route('customer') }}">Your Services</a>
        </li>
        @endif
      </ul>
      <div class="d-flex">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        </li>

        @guest
        @if (Route::has('login'))
            <li class="nav-item dropdown"><a class="btn btn-sm btn-black display-4" href="{{ route('login') }}">
                  Login
                </a></li>
        @endif
        @else
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ url('/customer') }}">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </li>
          </ul>
        </li>
        @endguest
        </ul>
      </div>
    </div>
  </div>
</nav>
    