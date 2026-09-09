@php
  /* Dynamic footer – data from Admin ▸ General Settings + Admin ▸ Menus
     Menu locations used: "Footer Three", "Footer Two", "Footer Five" */
  $g        = general();
  $waNumber = preg_replace('/\D+/', '', (string) $g->mobile);
  $isLink   = fn ($v) => filled($v) && trim($v) !== '#';

  $footerMenus = collect(['Footer Three', 'Footer Two', 'Footer Five'])
      ->map(fn ($loc) => menu($loc))
      ->filter()
      ->map(function ($m) {
          $m->items = $m->subMenus->filter(fn ($i) => trim((string) $i->menuName()) !== '');
          return $m;
      })
      ->filter(fn ($m) => $m->items->count());
@endphp

<!-- ===== Footer ===== -->
<footer>
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6 col-lg-3 foot-about">
        <a class="navbar-brand d-inline-block mb-3" href="{{ route('index') }}">
          <img src="{{ assetUrl($g->footerLogo()) }}" alt="{{ $g->title }}" style="max-height:48px; width:auto;">
        </a>
        <p>{{ $g->copyright_text ?: 'Ample Lab is a trusted supplier of laboratory equipment for educational institutions, industries and research organizations.' }}</p>
        <div class="foot-social mt-3">
          <a href="{{ $g->facebook_link ?: '#' }}" @if($isLink($g->facebook_link)) target="_blank" rel="noopener" @endif><i class="fa-brands fa-facebook-f"></i></a>
          <a href="{{ $g->linkedin_link ?: '#' }}" @if($isLink($g->linkedin_link)) target="_blank" rel="noopener" @endif><i class="fa-brands fa-linkedin-in"></i></a>
          <a href="{{ $g->youtube_link ?: '#' }}" @if($isLink($g->youtube_link)) target="_blank" rel="noopener" @endif><i class="fa-brands fa-youtube"></i></a>
          <a href="{{ $g->instagram_link ?: '#' }}" @if($isLink($g->instagram_link)) target="_blank" rel="noopener" @endif><i class="fa-brands fa-instagram"></i></a>
          @if($g->mobile)<a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i></a>@endif
        </div>
      </div>

      @foreach($footerMenus as $fm)
      <div class="col-6 col-md-3 col-lg">
        <h6>{{ $fm->name }}</h6>
        @foreach($fm->items as $item)
        <a href="{{ assetUrl($item->menuLink()) }}">{{ $item->menuName() }}</a>
        @endforeach
      </div>
      @endforeach

      <div class="col-6 col-md-6 col-lg-3">
        <h6>Contact Us</h6>
        @if($g->address_one)
        <div class="contact-row"><i class="fa-solid fa-location-dot"></i><span>{{ $g->address_one }}</span></div>
        @endif
        @if($g->mobile)
        <div class="contact-row"><i class="fa-solid fa-phone"></i><span>{{ $g->mobile }}</span></div>
        @endif
        @if($g->email)
        <div class="contact-row"><i class="fa-solid fa-envelope"></i><span>{{ $g->email }}</span></div>
        @endif
        @if($g->website)
        <div class="contact-row"><i class="fa-solid fa-globe"></i><span>{{ preg_replace('#^https?://#', '', $g->website) }}</span></div>
        @endif
      </div>
    </div>

    <div class="foot-bottom">
      &copy; {{ date('Y') }} {{ $g->title ?: 'Ample Lab' }}. All Rights Reserved.
    </div>
  </div>
</footer>
