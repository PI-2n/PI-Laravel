<div class="header_image">
  <a href="/">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" />
  </a>
</div>

<div class="header_searchBar">
  <form class="search-form" action="/search" method="get" role="search">
    <input id="q" class="search-input" name="q" type="search" placeholder="Buscar..." required />
    <button class="search-btn" type="submit">
      <img src="{{ asset('images/icons/lupa.png') }}" alt="Buscar" />
    </button>
  </form>
</div>

<div class="header_btn-container">
  <div class="platform-btn-container">
    <a href="#"><img src="{{ asset('images/icons/steam.png') }}" alt="Steam" class="platform-btn" /></a>
    <a href="#"><img src="{{ asset('images/icons/ps.png') }}" alt="PlayStation" class="platform-btn" /></a>
    <a href="#"><img src="{{ asset('images/icons/xbox.png') }}" alt="Xbox" class="platform-btn" /></a>
    <a href="#"><img src="{{ asset('images/icons/switch.png') }}" alt="Nintendo Switch" class="platform-btn" /></a>
    <a href="#"><img src="{{ asset('images/icons/pc.png') }}" alt="PC Software" class="platform-btn" /></a>
  </div>
  <div class="separator"></div>
  <div class="user-btn-container">
    @auth
      <a href="{{ route('profile.edit') }}">
        <img src="{{ asset('images/icons/user.png') }}" alt="Usuario"
          class="user-btn {{ request()->routeIs('profile.*') ? 'is-active' : '' }}" />
      </a>
    @else
      <a href="{{ route('login') }}">
        <img src="{{ asset('images/icons/user.png') }}" alt="Usuario"
          class="user-btn {{ request()->routeIs('login', 'register') ? 'is-active' : '' }}" />
      </a>
    @endauth
    <a href="{{ route('cart.index') }}"><img src="{{ asset('images/icons/carrito.png') }}" alt="Carrito"
        class="user-btn" /></a>
  </div>
</div>

<div class="platform-btn-mobile">
  <a href="#"><img src="{{ asset('images/icons/steam.png') }}" alt="Steam" class="platform-btn" /></a>
  <a href="#"><img src="{{ asset('images/icons/ps.png') }}" alt="PlayStation" class="platform-btn" /></a>
  <a href="#"><img src="{{ asset('images/icons/xbox.png') }}" alt="Xbox" class="platform-btn" /></a>
  <a href="#"><img src="{{ asset('images/icons/switch.png') }}" alt="Nintendo Switch" class="platform-btn" /></a>
  <a href="#"><img src="{{ asset('images/icons/pc.png') }}" alt="PC Software" class="platform-btn" /></a>
</div>