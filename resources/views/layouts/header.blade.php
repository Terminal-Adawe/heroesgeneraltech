<amp-sidebar id="sidebar" class="cid-sRqhGqfkwa" layout="nodisplay" side="right">
        <div class="builder-sidebar" id="builder-sidebar">
            <button on="tap:sidebar.close" class="close-sidebar">
                <span></span>
                <span></span>
            </button>
        
            
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
            	<li class="nav-item">
                    <a class="nav-link link text-black display-4" href="/">
                        Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link text-black display-4" href="{{ route('services') }}">
                        Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link text-black display-4" href="{{ route('about') }}">
                        About Us</a>
                </li></ul>
 	@guest
    	@if (Route::has('login'))
            <div class="navbar-buttons mbr-section-btn align-center"><a class="btn btn-sm btn-black display-4" href="{{ route('login') }}">
                  Login
                </a></div>
        @endif
@else
	<div class="navbar-buttons mbr-section-btn align-center">	
		<ul class="navbar-nav nav-dropdown" data-app-modern-menu="true"><li class="nav-item dropdown">
                    <a class="nav-link link text-black dropdown-toggle display-4" data-toggle="dropdown-submenu" aria-expanded="false">
                        {{ Auth::user()->name }}</a>
                    <div class="dropdown-menu">
                        <a class="text-black dropdown-item display-4" href="{{ url('/') }}">Profile</a>
                        <a class="text-black dropdown-item display-4" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Logout</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            	@csrf
    		</form>
                    </div>
                </li>
        </ul>
    </div>
@endguest
      </div>
    </amp-sidebar>


 <section class="menu horizontal-menu cid-sRqhGqfkwa" id="menu2-6">

    
    

    <nav class="navbar navbar-dropdown navbar-expand-lg">
       <div class="menu-container container-fluid"> 
      <div class="navbar-brand">
          <span class="navbar-logo">
              <amp-img src="{{ asset('images/logo.png') }}" layout="responsive" width="40.638297872340424" height="40" alt="Mobirise" class="mobirise-loader">
                  <div placeholder="" class="placeholder">
                                <div class="mobirise-spinner">
                                    <em></em>
                                    <em></em>
                                    <em></em>
                                </div></div>
                  
              </amp-img>
          </span>
          <!-- <p class="brand-name mbr-fonts-style mbr-bold display-4"><a href="/" class="text-primary">Heroes</a> -->
      <!-- </p> -->
  </div>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
            	<li class="nav-item">
                    <a class="nav-link link text-black display-4" href="/">
                        Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link text-black display-4" href="{{ route('services') }}">
                        Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link text-black display-4" href="{{ route('about') }}">
                        About Us</a>
                </li></ul>
@guest
    	@if (Route::has('login'))
            <div class="navbar-buttons mbr-section-btn align-center"><a class="btn btn-sm btn-black display-4" href="{{ route('login') }}">
                  Login
                </a>
            </div>
      @endif
@else
	<div class="navbar-buttons mbr-section-btn align-center">
		<ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
            	<li class="nav-item dropdown">
                   	<a class="nav-link link text-black dropdown-toggle display-4" data-toggle="dropdown-submenu" aria-expanded="false">
                        {{ Auth::user()->name }}</a>
                    <div class="dropdown-menu">
                        <a class="text-black dropdown-item display-4" href="https://mobiri.se">New Item</a>
                        <a class="text-black dropdown-item display-4" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Logout</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
           		@csrf
    		</form>
                    </div>
                </li>
    	</ul>
    </div>
@endguest
        </div>

        <button on="tap:sidebar.toggle" class="ampstart-btn hamburger">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </button>
</div>
    </nav>

  <!-- AMP plug -->
    

</section>