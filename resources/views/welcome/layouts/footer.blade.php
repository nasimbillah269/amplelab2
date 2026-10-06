@php
  /* Dynamic footer – data from Admin ▸ General Settings + Admin ▸ Menus
     Menu locations used: "Footer Three" (Quick Links), "Footer Five" (bottom links) */
  $g        = general();
  $waNumber = preg_replace('/\D+/', '', (string) $g->mobile);
  $isLink   = fn ($v) => filled($v) && trim($v) !== '#';

  $menuItems = function ($loc) {
      $m = menu($loc);
      if (!$m) return [null, collect()];
      return [$m, $m->subMenus->filter(fn ($i) => trim((string) $i->menuName()) !== '')];
  };
  [$quickMenu, $quickLinks]   = $menuItems('Footer Three');
  [$bottomMenu, $bottomLinks] = $menuItems('Footer Five');

  $linkIcon = function ($name) {
      $n = strtolower($name);
      return match (true) {
          str_contains($n, 'home')                                => 'fa-house',
          str_contains($n, 'product')                             => 'fa-cube',
          str_contains($n, 'project')                             => 'fa-folder-open',
          str_contains($n, 'contact')                             => 'fa-envelope',
          str_contains($n, 'about')                               => 'fa-circle-info',
          str_contains($n, 'blog') || str_contains($n, 'news')    => 'fa-newspaper',
          str_contains($n, 'catalog')                             => 'fa-book-open',
          default                                                 => 'fa-circle-dot',
      };
  };

  $productsItem = $quickLinks->first(fn ($i) => str_contains(strtolower($i->menuName()), 'product'));
  $productsPage = pageTemplate('Latest Products');
  $productsUrl  = $productsItem ? assetUrl($productsItem->menuLink())
                : ($productsPage ? route('pageView', $productsPage->slug) : route('index'));

  $stats = [
      ['icon' => 'fa-building', 'num' => '500+',  'lbl' => 'Projects'],
      ['icon' => 'fa-users',    'num' => '1000+', 'lbl' => 'Clients'],
      ['icon' => 'fa-cube',     'num' => '2000+', 'lbl' => 'Products'],
      ['icon' => 'fa-award',    'num' => '10+',   'lbl' => 'Years'],
  ];
@endphp

<!-- ===== Footer ===== -->
<footer class="al-footer">
  <div class="al-footer-map" aria-hidden="true"></div>

  <div class="container position-relative">
    <!-- Stats -->
    <div class="al-stats">
      @foreach($stats as $s)
      <div class="al-stat">
        <span class="al-stat-icon"><i class="fa-solid {{ $s['icon'] }}"></i></span>
        <div>
          <div class="al-stat-num">{{ $s['num'] }}</div>
          <div class="al-stat-lbl">{{ $s['lbl'] }}</div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="al-footer-main">
      <!-- Brand -->
      <div class="al-col">
        <a href="{{ route('index') }}" class="al-brand">
          <img src="{{ assetUrl($g->footerLogo()) }}" alt="{{ $g->title }}">
          <span>
            <span class="al-brand-title">{{ $g->title ?: 'Ample Lab' }}</span>
            <span class="al-brand-tag">Lab Solutions for a Smarter Tomorrow</span>
          </span>
        </a>
        <p class="al-about">{{ $g->copyright_text ?: 'Trusted supplier of laboratory equipment for education, industry and research.' }}</p>
        <a href="{{ $productsUrl }}" class="al-btn-outline">View Products <i class="fa-solid fa-arrow-right"></i></a>
      </div>

      <!-- Quick Links -->
      @if($quickLinks->count())
      <div class="al-col al-col-line">
        <h5 class="al-title">{{ $quickMenu->name }}</h5>
        <ul class="al-links">
          @foreach($quickLinks as $item)
          <li>
            <a href="{{ assetUrl($item->menuLink()) }}">
              <i class="fa-solid {{ $linkIcon($item->menuName()) }}"></i>
              <span>{{ $item->menuName() }}</span>
              <i class="fa-solid fa-chevron-right al-chev"></i>
            </a>
          </li>
          @endforeach
        </ul>
      </div>
      @endif

      <!-- Get in Touch -->
      <div class="al-col al-col-line">
        <h5 class="al-title">Get in Touch</h5>
        @if($g->mobile)
        <a href="tel:{{ preg_replace('/[^\d+]/', '', $g->mobile) }}" class="al-contact">
          <span class="al-contact-icon"><i class="fa-solid fa-phone"></i></span><span>{{ $g->mobile }}</span>
        </a>
        @endif
        @if($g->email)
        <a href="mailto:{{ $g->email }}" class="al-contact">
          <span class="al-contact-icon"><i class="fa-solid fa-envelope"></i></span><span>{{ $g->email }}</span>
        </a>
        @endif
        @if($g->address_one)
        <div class="al-contact">
          <span class="al-contact-icon"><i class="fa-solid fa-location-dot"></i></span><span>{{ $g->address_one }}</span>
        </div>
        @endif
      </div>

      <!-- Follow Us -->
      <div class="al-col al-col-line al-follow">
        <h5 class="al-title">Follow Us</h5>
        <div class="al-social">
          <a href="{{ $g->facebook_link ?: '#' }}" @if($isLink($g->facebook_link)) target="_blank" rel="noopener" @endif aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="{{ $g->linkedin_link ?: '#' }}" @if($isLink($g->linkedin_link)) target="_blank" rel="noopener" @endif aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
          <a href="{{ $g->youtube_link ?: '#' }}" @if($isLink($g->youtube_link)) target="_blank" rel="noopener" @endif aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
          <a href="{{ $g->instagram_link ?: '#' }}" @if($isLink($g->instagram_link)) target="_blank" rel="noopener" @endif aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
          @if($g->mobile)<a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>@endif
        </div>
      </div>
    </div>
  </div>

  <svg class="al-wave" viewBox="0 0 1600 110" preserveAspectRatio="none" aria-hidden="true">
    <defs>
      <linearGradient id="alWvBase" x1="0" y1="0" x2="0" y2="1">
        <stop offset="0" stop-color="#0c7559" stop-opacity=".45"/>
        <stop offset="1" stop-color="#11916d" stop-opacity=".8"/>
      </linearGradient>
      <linearGradient id="alWvLeft" x1="0" y1="0" x2="1" y2="0">
        <stop offset="0" stop-color="#1bb48a" stop-opacity=".75"/>
        <stop offset=".45" stop-color="#139874" stop-opacity=".35"/>
        <stop offset="1" stop-color="#0f8061" stop-opacity="0"/>
      </linearGradient>
      <linearGradient id="alWvRight" x1="0" y1="0" x2="1" y2="0">
        <stop offset="0" stop-color="#11916d" stop-opacity="0"/>
        <stop offset=".5" stop-color="#14a07a" stop-opacity=".45"/>
        <stop offset="1" stop-color="#22c99a" stop-opacity=".9"/>
      </linearGradient>
      <linearGradient id="alWvRibbon" x1="0" y1="0" x2="1" y2="0">
        <stop offset="0" stop-color="#1fbf92" stop-opacity="0"/>
        <stop offset=".7" stop-color="#2ad3a2" stop-opacity=".35"/>
        <stop offset="1" stop-color="#2ad3a2" stop-opacity=".2"/>
      </linearGradient>
      <linearGradient id="alWvFloor" x1="0" y1="0" x2="0" y2="1">
        <stop offset="0" stop-color="#14a37c" stop-opacity="0"/>
        <stop offset="1" stop-color="#17b086" stop-opacity=".45"/>
      </linearGradient>
      <linearGradient id="alWvLine" x1="0" y1="0" x2="1" y2="0">
        <stop offset="0" stop-color="#a8f7da" stop-opacity=".1"/>
        <stop offset=".3" stop-color="#a8f7da" stop-opacity=".5"/>
        <stop offset=".6" stop-color="#a8f7da" stop-opacity=".15"/>
        <stop offset="1" stop-color="#a8f7da" stop-opacity=".6"/>
      </linearGradient>
      <filter id="alWvGlow" x="-5%" y="-50%" width="110%" height="200%"><feGaussianBlur stdDeviation="3"/></filter>
    </defs>
    <!-- teal body under the hump -->
    <path d="M0,78 C130,62 300,22 490,20 C700,18 860,66 1060,80 C1260,94 1420,66 1600,34 L1600,110 L0,110 Z" fill="url(#alWvBase)"/>
    <!-- left sheet sweeping down from the top-left edge -->
    <path d="M0,0 C170,26 380,68 620,90 C720,99 800,105 880,110 L0,110 Z" fill="url(#alWvLeft)"/>
    <!-- right sheet rising to the right edge -->
    <path d="M680,110 C940,100 1190,72 1390,36 C1470,22 1540,10 1600,6 L1600,110 Z" fill="url(#alWvRight)"/>
    <!-- right ribbon crest -->
    <path d="M960,110 C1150,84 1300,22 1460,14 C1530,11 1570,14 1600,18 L1600,110 Z" fill="url(#alWvRibbon)"/>
    <!-- bright floor -->
    <rect x="0" y="60" width="1600" height="50" fill="url(#alWvFloor)"/>
    <!-- glowing edges -->
    <g fill="none" stroke="url(#alWvLine)" stroke-width="4" filter="url(#alWvGlow)" opacity=".6">
      <path d="M0,78 C130,62 300,22 490,20 C700,18 860,66 1060,80 C1260,94 1420,66 1600,34"/>
      <path d="M960,110 C1150,84 1300,22 1460,14 C1530,11 1570,14 1600,18"/>
    </g>
    <g fill="none" stroke="url(#alWvLine)" stroke-width="1.2">
      <path d="M0,78 C130,62 300,22 490,20 C700,18 860,66 1060,80 C1260,94 1420,66 1600,34"/>
      <path d="M960,110 C1150,84 1300,22 1460,14 C1530,11 1570,14 1600,18"/>
      <path d="M0,0 C170,26 380,68 620,90 C720,99 800,105 880,110" stroke-opacity=".5"/>
    </g>
  </svg>

  <div class="al-footer-bottom">
    <div class="container d-flex flex-wrap align-items-center justify-content-between gap-3">
      <div class="al-copy">&copy; {{ date('Y') }} {{ $g->title ?: 'Ample Lab' }}. All Rights Reserved.</div>
      <div class="al-bottom-right">
        @if($bottomLinks->count())
        <nav class="al-bottom-links">
          @foreach($bottomLinks as $item)
          <a href="{{ assetUrl($item->menuLink()) }}">{{ $item->menuName() }}</a>
          @endforeach
        </nav>
        @endif
        <button type="button" id="scrollTop" class="al-top" aria-label="Back to top"><i class="fa-solid fa-chevron-up"></i></button>
      </div>
    </div>
  </div>
</footer>
