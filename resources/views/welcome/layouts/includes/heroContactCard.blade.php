@php
  $g         = general();
  $waNumber  = preg_replace('/\D+/', '', (string) $g->mobile);
  $telNumber = preg_replace('/[^\d+]/', '', (string) $g->mobile);
@endphp
<div class="contact-float-card">

  @if($g->mobile)
  <a class="item" href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener">
    <div class="icon-circle"><i class="fa-brands fa-whatsapp"></i></div>
    <div>
      <span class="label">WhatsApp</span>
      <span class="sub">Chat Now</span>
    </div>
  </a>

  <a class="item" href="tel:{{ $telNumber }}">
    <div class="icon-circle"><i class="fa-solid fa-phone"></i></div>
    <div>
      <span class="label">Call Now</span>
      <span class="sub">{{ $g->mobile }}</span>
    </div>
  </a>
  @endif

  @if($g->email)
  <a class="item" href="mailto:{{ $g->email }}">
    <div class="icon-circle"><i class="fa-solid fa-envelope"></i></div>
    <div>
      <span class="label">Email Us</span>
      <span class="sub">{{ $g->email }}</span>
    </div>
  </a>
  @endif

  <a class="item" href="{{ route('pageView', 'catalogs') }}">
    <div class="icon-circle"><i class="fa-solid fa-download"></i></div>
    <div>
      <span class="label">Download Catalog</span>
      <span class="sub">View Catalogs</span>
    </div>
  </a>

</div>
