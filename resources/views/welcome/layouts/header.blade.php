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
    <ul class="navbar-nav mx-auto my-3 my-lg-0">
        @foreach($headerMenu->subMenus as $menu) @if($menu->subMenus->count())
        <!-- Dropdown Menu -->
        <li class="nav-item dropdown">
            <a href="{{ assetUrl($menu->menuLink()) }}" class="nav-link dropdown-toggle"> {{ $menu->menuName() }} </a>
            <ul class="dropdown-menu">
                @foreach($menu->subMenus as $subMenu)
                <li><a href="{{  assetUrl($subMenu->menuLink()) }}" class="dropdown-item"> {{ $subMenu->menuName() }} </a></li>
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
    @endif <a href="{{ route('pageView', 'request-quotation') }}" class="btn-al-primary"> Request a Quotation </a>
</div>

<div class="al-nav-backdrop"></div>

  </div>
</nav>

<style>
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

    /* ---- CTA button ---- */
    #mainNav .btn-al-primary{
      display:block;
      text-align:center;
      margin:20px 20px 0;
      padding:.8rem 1rem;
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

    /* Close drawer when a real link is tapped */
    nav.addEventListener('click', function (e) {
      if (e.target.closest('a.dropdown-item, a.nav-link:not(.dropdown-toggle), a.btn-al-primary')) closeNav();
    });

    window.addEventListener('resize', function () {
      if (!isMobile()) {
        closeNav();
        nav.querySelectorAll('.nav-item.dropdown.is-expanded').forEach(function (el) {
          el.classList.remove('is-expanded');
        });
      }
    });
  })();
</script>
