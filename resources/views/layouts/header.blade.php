<header class="u-align-center-xs u-clearfix u-header u-sticky u-sticky-a2b8" id="sec-9fa7"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <a href="/" class="u-image u-logo u-image-1" data-image-width="80" data-image-height="40">
          <img src="{{ asset('images/logo.png') }}" class="u-logo-image u-logo-image-1">
        </a>
        <form action="#" method="get" class="u-border-1 u-border-grey-15 u-search u-search-right u-search-1">
          <button class="u-search-button" type="submit">
            <span class="u-search-icon u-spacing-10 u-text-grey-40">
              <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 56.966 56.966" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-b04b"></use></svg>
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="svg-b04b" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" class="u-svg-content"><path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
            </span>
          </button>
          <input class="u-search-input" type="search" name="search" value="" placeholder="Search">
        </form>
        <nav class="u-align-left u-menu u-menu-dropdown u-nav-spacing-25 u-offcanvas u-menu-1">
          <div class="menu-collapse">
            <a class="u-button-style u-custom-text-active-color u-custom-text-color u-nav-link" href="#" style="padding: 4px 0px; font-size: calc(1em + 8px);">
              <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 302 302" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-7b92"></use></svg>
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="svg-7b92" x="0px" y="0px" viewBox="0 0 302 302" style="enable-background:new 0 0 302 302;" xml:space="preserve" class="u-svg-content"><g><rect y="36" width="302" height="30"></rect><rect y="236" width="302" height="30"></rect><rect y="136" width="302" height="30"></rect>
</g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
            </a>
          </div>
          <div class="u-custom-menu u-nav-container">
            <ul class="u-nav u-unstyled u-nav-1"><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-4-light-3 u-text-grey-25 u-text-hover-palette-2-base" href="Home.html" style="padding: 10px 20px;">Home</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-4-light-3 u-text-grey-25 u-text-hover-palette-2-base" href="{{ route('about') }}" style="padding: 10px 20px;">About</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-4-light-3 u-text-grey-25 u-text-hover-palette-2-base" href="{{ route('contact') }}" style="padding: 10px 20px;">Contact</a>
</li>
@guest
    @if (Route::has('login'))
		<li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-4-light-3 u-text-grey-25 u-text-hover-palette-2-base" href="{{ route('login') }}" style="padding: 10px 20px;">Login</a>
		</li>
	@endif
@else
		<li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-4-light-3 u-text-grey-25 u-text-hover-palette-2-base" href="customer.html" style="padding: 10px 20px;">{{ Auth::user()->name }}</a><div class="u-nav-popup"><ul class="u-h-spacing-20 u-nav u-unstyled u-v-spacing-10 u-nav-2"><li class="u-nav-item"><a class="u-button-style u-nav-link u-white">Profile</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-white" href="{{ route('logout') }}"
        onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
    </form>
</li></ul>
</div>
</li>
@endguest
</ul>
          </div>
          <div class="u-custom-menu u-nav-container-collapse">
            <div class="u-align-center u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
              <div class="u-inner-container-layout u-sidenav-overflow">
                <div class="u-menu-close"></div>
                <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-3"><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Home.html" style="padding: 10px 20px;">Home</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="{{ route('about') }}" style="padding: 10px 20px;">About</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="{{ route('contact') }}" style="padding: 10px 20px;">Contact</a>
</li>
@guest
    @if (Route::has('login'))
<li class="u-nav-item"><a class="u-button-style u-nav-link" style="padding: 10px 20px;" href="{{ route('login') }}">Login</a>
</li>
	@endif
@else
<li class="u-nav-item"><a class="u-button-style u-nav-link" href="customer.html" style="padding: 10px 20px;">{{ Auth::user()->name }}</a><div class="u-nav-popup"><ul class="u-h-spacing-20 u-nav u-unstyled u-v-spacing-10 u-nav-4"><li class="u-nav-item"><a class="u-button-style u-nav-link">Profile</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
    </form>
</li></ul>
</div>
</li>
@endguest

</ul>
              </div>
            </div>
            <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
          </div>
        </nav>
      </div><style class="u-sticky-style" data-style-id="a2b8">.u-sticky-fixed.u-sticky-a2b8, .u-body.u-sticky-fixed .u-sticky-a2b8 {
box-shadow: -2px 2px 8px 0 rgba(128,128,128,1) !important
}.u-sticky-fixed.u-sticky-a2b8:before, .u-body.u-sticky-fixed .u-sticky-a2b8:before {
borders: top right bottom left !important
}</style></header>