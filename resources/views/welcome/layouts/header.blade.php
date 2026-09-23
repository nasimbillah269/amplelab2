<!-- ===== Top Bar ===== -->
<div class="topbar d-none d-md-block">
  <div class="container d-flex justify-content-between align-items-center flex-wrap">
    <div class="d-flex align-items-center flex-wrap">
      <span><i class="fa-solid fa-location-dot me-1"></i> {{general()->address_one}}</span>
      <span class="divider">|</span>
      <a href="tel:+8801712345678"><i class="fa-solid fa-phone me-1"></i> {{general()->mobile}}</a>
      <span class="divider">|</span>
      <a href="mailto:info@amplelab.com"><i class="fa-solid fa-envelope me-1"></i> {{general()->email}}</a>
      <span class="divider">|</span>
      <span><i class="fa-regular fa-clock me-1"></i> {{general()->address_two}}</span>
    </div>
    <div class="social-icons">
       @if(general()->facebook_link)<a href="{{general()->facebook_link}}" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a>@endif
       @if(general()->linkedin_link)<a href="{{general()->linkedin_link}}" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in"></i></a>@endif
       @if(general()->youtube_link)<a href="{{general()->youtube_link}}" target="_blank" rel="noopener"><i class="fa-brands fa-youtube"></i></a>@endif
       @if(general()->instagram_link)<a href="{{general()->instagram_link}}" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a>@endif
    </div>
  </div>
</div>


<!-- ===== Navbar ===== -->
<nav class="navbar navbar-expand-lg navbar-al sticky-top">
  <div class="container">
    <a class="navbar-brand" href="{{route('index')}}">
         <img src="{{assetUrl(general()->logo())}}" alt="{{general()->title}}">
    </a>

    <div class="al-mobile-search d-lg-none">
      <div class="al-search-box">
        <form action="{{ route('search') }}" method="GET" class="al-search-form" autocomplete="off">
          <input
            type="text"
            name="search"
            class="al-search-input"
            placeholder="Search products..."
            value="{{ request()->search }}"
          >
          <button type="submit" class="al-search-btn" aria-label="Search">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </form>
        <div class="al-search-results"></div>
      </div>
    </div>

    <button class="navbar-toggler" type="button" id="navToggler" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

<div class="collapse navbar-collapse" id="mainNav">
    <div class="al-nav-head">
      <img src="{{ assetUrl(general()->logo()) }}" alt="{{ general()->title }}" class="al-nav-logo">
      <button type="button" class="al-nav-close" aria-label="Close menu">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>
    @if($headerMenu = menu('Header Menus'))
    <ul class="navbar-nav ms-lg-3 my-3 my-lg-0">
        @foreach($headerMenu->subMenus as $menu) @if($menu->subMenus->count())
        <!-- Dropdown Menu -->
        <li class="nav-item dropdown">
            <a href="{{ assetUrl($menu->menuLink()) }}" class="nav-link dropdown-toggle"> {{ $menu->menuName() }} </a>
            <ul class="dropdown-menu">
                @foreach($menu->subMenus as $subMenu)
                <li class="{{ $subMenu->subMenus->count() ? 'dropdown-submenu' : '' }}">
                    <a href="{{  assetUrl($subMenu->menuLink()) }}" class="dropdown-item">
                        {{ $subMenu->menuName() }}
                        @if($subMenu->subMenus->count())<i class="fa-solid fa-chevron-right submenu-caret"></i>@endif
                    </a>
                    @if($subMenu->subMenus->count())
                    <ul class="dropdown-menu dropdown-submenu-menu">
                        @foreach($subMenu->subMenus as $subSubMenu)
                        <li><a href="{{ assetUrl($subSubMenu->menuLink()) }}" class="dropdown-item"> {{ $subSubMenu->menuName() }} </a></li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </li>
        @else
        <!-- Normal Menu -->
        <li class="nav-item">
            <a
                href="{{ assetUrl($menu->menuLink()) }}"
                class="nav-link"
            >
                {{ $menu->menuName() }}
            </a>
        </li>
        @endif @endforeach
    </ul>
    @endif
    <div class="al-nav-right ms-lg-auto">
      <div class="al-search-box d-none d-lg-block">
        <form action="{{ route('search') }}" method="GET" class="al-search-form" autocomplete="off">
          <input
            type="text"
            name="search"
            class="al-search-input"
            placeholder="Search products..."
            value="{{ request()->search }}"
          >
          <button type="submit" class="al-search-btn" aria-label="Search">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </form>
        <div class="al-search-results"></div>
      </div>
      <a href="{{ route('pageView', 'request-quotation') }}" class="btn-al-primary"> Request a Quotation </a>
    </div>
</div>

<div class="al-nav-backdrop"></div>

  </div>
</nav>

<style>
  /* ---- Right side: search + CTA ---- */
  .al-nav-right{
    display:flex;
    align-items:center;
    gap:16px;
  }
  .al-search-box{
    position:relative;
    width:220px;
  }
  .al-search-form{
    display:flex;
    align-items:center;
    background:var(--al-bg-soft, #f6f8f7);
    border:1px solid var(--al-border, #e5e9e7);
    border-radius:8px;
    overflow:hidden;
  }
  .al-search-input{
    flex:1 1 0%;
    min-width:0;
    border:0;
    outline:0;
    background:transparent;
    padding:.55rem .8rem;
    font-size:.85rem;
    color:var(--al-text, #1f2d2a);
  }
  .al-search-btn{
    flex:0 0 auto;
    border:0;
    background:transparent;
    color:var(--al-muted, #6c7a76);
    width:38px; height:38px;
    display:flex; align-items:center; justify-content:center;
    cursor:pointer;
    transition:color .2s ease;
  }
  .al-search-btn:hover{ color:var(--al-green, #0f7a5c); }
  .al-search-results{
    position:absolute;
    top:calc(100% + 8px);
    left:0; right:0;
    background:#fff;
    border:1px solid var(--al-border, #e5e9e7);
    border-radius:8px;
    box-shadow:0 14px 30px rgba(0,0,0,.12);
    max-height:70vh;
    overflow-y:auto;
    z-index:1030;
    display:none;
  }
  .al-search-results.is-open{ display:block; }
  .al-search-results .SearchResult-item{
    display:flex;
    align-items:center;
    gap:10px;
    padding:.6rem .8rem;
    border-bottom:1px solid var(--al-border, #e5e9e7);
    color:var(--al-text, #1f2d2a);
  }
  .al-search-results .SearchResult-item:last-child{ border-bottom:0; }
  .al-search-results .SearchResult-item:hover{ background:var(--al-bg-soft, #f6f8f7); }
  .al-search-results .SearchResult-item img{
    width:40px; height:40px;
    object-fit:contain;
    flex-shrink:0;
    border-radius:4px;
    background:var(--al-bg-soft, #f6f8f7);
  }
  .al-search-results .SearchResult-name{
    flex:1 1 auto;
    min-width:0;
    font-size:.85rem;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
  }
  .al-search-results .SearchResult-price{
    flex-shrink:0;
    font-size:.85rem;
    font-weight:600;
    color:var(--al-green, #0f7a5c);
  }
  .al-search-results .SearchResult-empty,
  .al-search-results .SearchResult-loading{
    padding:.9rem .8rem;
    font-size:.85rem;
    color:var(--al-muted, #6c7a76);
    text-align:center;
  }

  .al-nav-backdrop{
    position:fixed; inset:0;
    background:rgba(6,26,21,.5);
    opacity:0; visibility:hidden;
    transition:opacity .3s ease, visibility .3s ease;
    z-index:1040;
  }
  .al-nav-backdrop.is-open{ opacity:1; visibility:visible; }
  .al-nav-head{ display:none; }

  @media (min-width: 992px){
    .al-nav-backdrop,
    .al-nav-head{ display:none !important; }

    /* ---- Give the navbar room so items never wrap on laptop widths ---- */
    .navbar-al .container{
      max-width:1320px;
    }
    .navbar-al #mainNav.navbar-collapse{
      flex-wrap:nowrap;
    }
    .navbar-al .navbar-nav{
      flex-wrap:nowrap;
    }
    .navbar-al .navbar-nav .nav-link{
      white-space:nowrap;
    }
    .al-nav-right{
      flex-shrink:0;
    }

    /* ---- Tighter spacing only in the narrow lg range (992-1199px) ---- */
    @media (max-width: 1199.98px){
      .navbar-al .navbar-nav .nav-link{
        padding:10px 10px !important;
        font-size:.86rem !important;
      }
      .navbar-al .navbar-nav{
        margin-left:.5rem !important;
      }
      .al-nav-right{
        gap:10px;
      }
      .al-search-box{
        width:150px;
      }
    }

    /* ---- Desktop hover dropdown ---- */
    .navbar-al .navbar-nav .nav-item.dropdown{ position:relative; }
    .navbar-al .navbar-nav .nav-item.dropdown > .dropdown-menu{
      display:block;
      position:absolute;
      top:100%; left:0;
      min-width:220px;
      background:#fff;
      border:1px solid var(--al-border, #e5e9e7);
      border-radius:8px;
      box-shadow:0 14px 30px rgba(0,0,0,.12);
      padding:8px 0;
      margin:0;
      overflow:visible;
      animation:none;
      opacity:0;
      visibility:hidden;
      transform:translateY(8px);
      transition:opacity .2s ease, transform .2s ease, visibility .2s ease;
      z-index:1000;
    }
    .navbar-al .navbar-nav .nav-item.dropdown:hover > .dropdown-menu,
    .navbar-al .navbar-nav .nav-item.dropdown:focus-within > .dropdown-menu{
      opacity:1;
      visibility:visible;
      transform:translateY(0);
    }
    .navbar-al .navbar-nav .nav-item.dropdown .dropdown-item{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:10px;
      padding:.55rem 1.1rem;
      font-size:.88rem;
      font-weight:500;
      color:var(--al-text, #1f2d2a);
      text-transform:none;
      white-space:nowrap;
    }
    .navbar-al .navbar-nav .nav-item.dropdown .dropdown-item:hover{
      background:var(--al-bg-soft, #f6f8f7);
      color:var(--al-green, #0f7a5c);
      padding-left:1.1rem;
    }
    .navbar-al .navbar-nav .submenu-caret{
      font-size:.65rem;
      opacity:.55;
      flex-shrink:0;
    }

    /* ---- Desktop hover flyout (sub-submenu) ---- */
    .navbar-al .navbar-nav .dropdown-submenu{ position:relative; }
    .navbar-al .navbar-nav .dropdown-submenu > .dropdown-submenu-menu{
      display:block;
      position:absolute;
      top:0; left:100%;
      min-width:200px;
      background:#fff;
      border:1px solid var(--al-border, #e5e9e7);
      border-radius:8px;
      box-shadow:0 14px 30px rgba(0,0,0,.12);
      padding:8px 0;
      margin:0 0 0 4px;
      overflow:visible;
      animation:none;
      opacity:0;
      visibility:hidden;
      transform:translateX(8px);
      transition:opacity .2s ease, transform .2s ease, visibility .2s ease;
      z-index:1001;
    }
    .navbar-al .navbar-nav .dropdown-submenu:hover > .dropdown-submenu-menu,
    .navbar-al .navbar-nav .dropdown-submenu:focus-within > .dropdown-submenu-menu{
      opacity:1;
      visibility:visible;
      transform:translateX(0);
    }
  }

  @media (max-width: 991.98px){
    /* ---- Drawer shell ---- */
    .navbar-al #mainNav.navbar-collapse{
      display:flex !important;
      flex-direction:column;
      align-items:stretch;
      position:fixed; top:0; right:0;
      width:min(86vw, 340px);
      height:100vh; height:100dvh;
      background:#fff;
      box-shadow:-12px 0 40px rgba(0,0,0,.20);
      transform:translateX(100%);
      transition:transform .35s cubic-bezier(.4,0,.2,1);
      z-index:1050;
      overflow-y:auto;
      padding:0 0 24px;
    }
    .navbar-al #mainNav.navbar-collapse.is-open{ transform:translateX(0); }

    /* ---- Drawer header ---- */
    #mainNav .al-nav-head{
      display:flex; align-items:center; justify-content:space-between;
      padding:16px 18px;
      border-bottom:1px solid rgba(0,0,0,.08);
      position:sticky; top:0; background:#fff; z-index:2;
    }
    #mainNav .al-nav-logo{ height:34px; width:auto; }
    #mainNav .al-nav-close{
      width:38px; height:38px;
      display:flex; align-items:center; justify-content:center;
      border:0; border-radius:8px;
      background:var(--al-bg-soft, #eef2ee);
      color:var(--al-text, #1c2b2a);
      font-size:18px;
    }
    #mainNav .al-nav-close:active{ background:#e2e8e2; }

    /* ---- Menu list ---- */
    #mainNav .navbar-nav{
      margin:0 !important;
      width:100% !important;
      padding:8px 0;
      align-items:stretch !important;
      text-align:left !important;
    }
    #mainNav .navbar-nav .nav-item{
      width:100%;
      border-bottom:1px solid rgba(0,0,0,.06);
    }
    #mainNav .navbar-nav .nav-link{
      display:flex !important;
      align-items:center;
      justify-content:flex-start;
      gap:10px;
      width:100%;
      padding:.9rem 20px !important;
      margin:0 !important;
      font-size:.98rem;
      font-weight:500;
      color:var(--al-text, #1c2b2a);
      text-align:left !important;
    }
    #mainNav .navbar-nav .nav-link:hover,
    #mainNav .navbar-nav .nav-link:focus{ color:var(--al-green, #1f7a4d); background:rgba(31,122,77,.05); }
    #mainNav .navbar-nav .nav-item.active > .nav-link{ color:var(--al-green, #1f7a4d); }

    /* ---- Dropdown: caret pinned to the right, acts as toggler ---- */
    #mainNav .navbar-nav .nav-item.dropdown > .dropdown-toggle::after{
      content:"";
      display:inline-block;
      margin-left:auto !important;
      width:.55rem; height:.55rem;
      border:0;
      border-right:2px solid currentColor;
      border-bottom:2px solid currentColor;
      transform:rotate(45deg);
      transition:transform .25s ease;
      flex-shrink:0;
    }
    #mainNav .navbar-nav .nav-item.dropdown.is-expanded > .dropdown-toggle::after{
      transform:rotate(-135deg);
    }
    #mainNav .dropdown-menu{
      display:block;
      position:static; float:none;
      border:0; box-shadow:none; margin:0;
      padding:0 0 0 0;
      background:var(--al-bg-soft, #f5f7f5);
      max-height:0; overflow:hidden;
      transition:max-height .3s ease;
    }
    #mainNav .nav-item.dropdown.is-expanded > .dropdown-menu{ max-height:600px; }
    #mainNav .dropdown-menu .dropdown-item{
      padding:.7rem 20px .7rem 34px;
      font-size:.9rem;
      color:var(--al-ink-soft, #55645f);
      text-transform:none;
      white-space:normal;
      border-top:1px solid rgba(0,0,0,.05);
      position:relative;
    }
    #mainNav .dropdown-menu .dropdown-item::before{
      content:"";
      position:absolute; left:22px; top:50%;
      width:5px; height:5px; margin-top:-2px;
      border-radius:50%;
      background:var(--al-green, #1f7a4d);
    }
    #mainNav .dropdown-menu .dropdown-item:hover{ color:var(--al-green, #1f7a4d); background:rgba(31,122,77,.06); }

    /* ---- Sub-submenu (3rd level) accordion ---- */
    #mainNav .dropdown-submenu > .dropdown-item{
      display:flex !important;
      align-items:center;
      justify-content:space-between;
      gap:10px;
    }
    #mainNav .dropdown-submenu .submenu-caret{
      font-size:.7rem;
      opacity:.55;
      transition:transform .25s ease;
      flex-shrink:0;
    }
    #mainNav .dropdown-submenu.is-expanded > .dropdown-item .submenu-caret{
      transform:rotate(90deg);
    }
    #mainNav .dropdown-submenu-menu{
      max-height:0; overflow:hidden;
      background:rgba(0,0,0,.03);
      transition:max-height .3s ease;
    }
    #mainNav .dropdown-submenu.is-expanded > .dropdown-submenu-menu{ max-height:600px; }
    #mainNav .dropdown-submenu-menu .dropdown-item{ padding-left:50px; }

    /* ---- CTA button ---- */
    #mainNav .btn-al-primary{
      display:block;
      text-align:center;
      margin:20px 20px 0;
      padding:.8rem 1rem;
    }

    /* ---- Right side (search + CTA) in drawer ---- */
    #mainNav .al-nav-right{
      flex-direction:column;
      align-items:stretch;
      gap:0;
      padding:0 20px;
    }
    #mainNav .al-nav-right .btn-al-primary{ margin:16px 0 0; }

    /* ---- Compact search bar between logo and hamburger ---- */
    .navbar-al .navbar-brand img{ max-height:38px; width:auto; }
    .al-mobile-search{
      flex:1 1 0%;
      min-width:0;
      margin:0 10px;
    }
    .al-mobile-search .al-search-box{ width:100%; }
    .al-mobile-search .al-search-input{ font-size:.8rem; padding:.5rem .6rem; }
    .al-mobile-search .al-search-btn{ width:34px; height:34px; }
    .al-mobile-search .al-search-results{
      left:-10px;
      right:-10px;
    }
  }
</style>

<script>
  (function () {
    var toggler  = document.getElementById('navToggler');
    var nav      = document.getElementById('mainNav');
    if (!toggler || !nav) return;
    var backdrop = document.querySelector('.al-nav-backdrop');
    var closeBtn = nav.querySelector('.al-nav-close');

    function isMobile () { return window.innerWidth < 992; }

    function openNav () {
      nav.classList.add('is-open');
      if (backdrop) backdrop.classList.add('is-open');
      document.body.style.overflow = 'hidden';
      toggler.setAttribute('aria-expanded', 'true');
    }
    function closeNav () {
      nav.classList.remove('is-open');
      if (backdrop) backdrop.classList.remove('is-open');
      document.body.style.overflow = '';
      toggler.setAttribute('aria-expanded', 'false');
    }

    toggler.addEventListener('click', function () {
      nav.classList.contains('is-open') ? closeNav() : openNav();
    });
    if (backdrop) backdrop.addEventListener('click', closeNav);
    if (closeBtn) closeBtn.addEventListener('click', closeNav);
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeNav();
    });

    /* Accordion for sub-menus (mobile only) */
    nav.querySelectorAll('.nav-item.dropdown > .dropdown-toggle').forEach(function (link) {
      link.addEventListener('click', function (e) {
        if (!isMobile()) return;
        e.preventDefault();
        var item = link.parentElement;
        var wasOpen = item.classList.contains('is-expanded');
        nav.querySelectorAll('.nav-item.dropdown.is-expanded').forEach(function (el) {
          el.classList.remove('is-expanded');
        });
        if (!wasOpen) item.classList.add('is-expanded');
      });
    });

    /* Accordion for sub-submenus (mobile only) */
    nav.querySelectorAll('.dropdown-submenu > .dropdown-item').forEach(function (link) {
      link.addEventListener('click', function (e) {
        if (!isMobile()) return;
        e.preventDefault();
        e.stopPropagation();
        var item = link.parentElement;
        var wasOpen = item.classList.contains('is-expanded');
        item.parentElement.querySelectorAll(':scope > .dropdown-submenu.is-expanded').forEach(function (el) {
          el.classList.remove('is-expanded');
        });
        if (!wasOpen) item.classList.add('is-expanded');
      });
    });

    /* Close drawer when a real link is tapped */
    nav.addEventListener('click', function (e) {
      if (e.target.closest('a.dropdown-item, a.nav-link:not(.dropdown-toggle), a.btn-al-primary, .SearchResult-item')) closeNav();
    });

    window.addEventListener('resize', function () {
      if (!isMobile()) {
        closeNav();
        nav.querySelectorAll('.nav-item.dropdown.is-expanded, .dropdown-submenu.is-expanded').forEach(function (el) {
          el.classList.remove('is-expanded');
        });
      }
    });
  })();
</script>

<script>
  (function () {
    var boxes = document.querySelectorAll('.al-search-box');
    if (!boxes.length) return;

    boxes.forEach(function (box) {
      var input   = box.querySelector('.al-search-input');
      var results = box.querySelector('.al-search-results');
      if (!input || !results) return;

      var timer      = null;
      var controller = null;

      function openResults () { results.classList.add('is-open'); }
      function closeResults () { results.classList.remove('is-open'); }

      function runSearch (term) {
        if (controller) controller.abort();
        controller = new AbortController();

        results.innerHTML = '<div class="SearchResult-loading">Searching...</div>';
        openResults();

        fetch('{{ route('headerSearch') }}?search=' + encodeURIComponent(term), {
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
          signal: controller.signal
        })
          .then(function (res) { return res.json(); })
          .then(function (data) {
            results.innerHTML = data.html;
            openResults();
          })
          .catch(function (err) {
            if (err.name !== 'AbortError') closeResults();
          });
      }

      input.addEventListener('input', function () {
        var term = input.value.trim();
        clearTimeout(timer);

        if (term.length < 2) {
          closeResults();
          results.innerHTML = '';
          return;
        }

        timer = setTimeout(function () { runSearch(term); }, 300);
      });

      input.addEventListener('focus', function () {
        if (results.innerHTML.trim() !== '' && input.value.trim().length >= 2) openResults();
      });

      document.addEventListener('click', function (e) {
        if (!box.contains(e.target)) closeResults();
      });

      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeResults();
      });
    });
  })();
</script>
