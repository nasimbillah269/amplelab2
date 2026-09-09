@extends(welcomeTheme().'layouts.app')

@section('title')
<title>{{ $page->seo_title ?: websiteTitle($page->name) }}</title>
@endsection

@section('SEO')
<meta name="title" property="og:title" content="{{ $page->seo_title ?: websiteTitle($page->name) }}" />
<meta name="description" property="og:description" content="{!! $page->seo_description ?: general()->meta_description !!}" />
<meta name="keywords" content="{{ $page->seo_keyword ?: general()->meta_keyword }}" />
<meta name="image" property="og:image" content="{{ assetUrl($page->image()) }}" />
<meta name="url" property="og:url" content="{{ route('pageView', $page->slug ?: 'no-title') }}" />
<link rel="canonical" href="{{ route('pageView', $page->slug ?: 'no-title') }}">
@endsection

@push('css')
<style>
  .rq-section{ padding:40px 0 60px; }
  .rq-card{
    display:grid;
    grid-template-columns:1fr 1.3fr;
    background:#fff;
    border:1px solid var(--al-border);
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 12px 30px rgba(13,61,51,.06);
  }
  /* left panel */
  .rq-aside{
    background:var(--al-dark, #0d3d33);
    color:#e6efe9;
    padding:36px 30px;
  }
  .rq-aside .eyebrow{
    font-size:.72rem; letter-spacing:.14em; text-transform:uppercase;
    color:var(--al-orange, #e08a3c); font-weight:700;
  }
  .rq-aside h2{ color:#fff; font-size:1.5rem; font-weight:700; margin:10px 0 14px; line-height:1.25; }
  .rq-aside p{ font-size:.9rem; color:#c3d6ce; line-height:1.7; }
  .rq-aside .rq-contact{ margin-top:26px; display:flex; flex-direction:column; gap:14px; }
  .rq-aside .rq-contact a,
  .rq-aside .rq-contact span{
    display:flex; align-items:center; gap:12px;
    color:#e6efe9; text-decoration:none; font-size:.9rem;
  }
  .rq-aside .rq-contact i{
    width:34px; height:34px; border-radius:50%;
    background:rgba(255,255,255,.1);
    display:flex; align-items:center; justify-content:center;
    flex-shrink:0; color:#fff;
  }
  /* form side */
  .rq-form{ padding:36px 34px; }
  .rq-form h3{ font-size:1.3rem; font-weight:700; color:var(--al-text); margin-bottom:6px; }
  .rq-form .rq-sub{ color:var(--al-muted); font-size:.9rem; margin-bottom:22px; }
  .rq-form .form-label{ font-size:.82rem; font-weight:600; color:var(--al-text); margin-bottom:5px; }
  .rq-form .form-label .req{ color:#d9534f; }
  .rq-form .form-control,
  .rq-form .form-select{
    border:1px solid var(--al-border);
    border-radius:8px;
    padding:.6rem .8rem;
    font-size:.9rem;
  }
  .rq-form .form-control:focus,
  .rq-form .form-select:focus{
    border-color:var(--al-green, #1f7a4d);
    box-shadow:0 0 0 3px rgba(31,122,77,.12);
  }
  .rq-submit{
    background:var(--al-dark, #0d3d33);
    color:#fff;
    border:none;
    border-radius:8px;
    padding:.75rem 1.6rem;
    font-weight:600;
    font-size:.92rem;
    display:inline-flex;
    align-items:center;
    gap:8px;
    transition:.2s;
  }
  .rq-submit:hover{ background:var(--al-green-hover, #17603b); }

  @media (max-width: 860px){
    .rq-card{ grid-template-columns:1fr; }
    .rq-aside{ padding:28px 22px; }
    .rq-form{ padding:26px 20px; }
  }
</style>
@endpush

@section('contents')

<!-- ===================== Breadcrumb ===================== -->
<div class="breadcrumb-strip">
  <div class="container">
    <a href="{{ route('index') }}">Home</a><span class="sep">&gt;</span><span class="text-muted">{{ $page->name }}</span>
  </div>
</div>

@php $g = general(); @endphp

<section class="rq-section">
  <div class="container">
    <div class="rq-card">

      <!-- Left info panel -->
      <aside class="rq-aside">
        <div class="eyebrow">Get a Price</div>
        <h2>{{ $page->name }}</h2>
        <p>{{ $page->short_description ?: 'Tell us what you need — product, model, and quantity — and our team will send you a detailed quotation with pricing, availability and delivery timeline.' }}</p>

        <div class="rq-contact">
          @if($g->mobile)
          <a href="tel:{{ preg_replace('/[^\d+]/', '', $g->mobile) }}"><i class="fa-solid fa-phone"></i> {{ $g->mobile }}</a>
          @endif
          @if($g->email)
          <a href="mailto:{{ $g->email }}"><i class="fa-solid fa-envelope"></i> {{ $g->email }}</a>
          @endif
          @if($g->address_one)
          <span><i class="fa-solid fa-location-dot"></i> {{ $g->address_one }}</span>
          @endif
        </div>
      </aside>

      <!-- Form -->
      <div class="rq-form">
        <h3>Request a Quotation</h3>
        <p class="rq-sub">Fill in the form below and we’ll get back to you shortly.</p>

        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> {{ Session::get('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <form action="{{ route('contactMail') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Full Name <span class="req">*</span></label>
              <input type="text" name="name" class="form-control" placeholder="Your name" value="{{ old('name') }}" required>
              @error('name')<p class="text-danger small mb-0">{{ $message }}</p>@enderror
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Company / Organization</label>
              <input type="text" name="company" class="form-control" placeholder="Company name" value="{{ old('company') }}">
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Email <span class="req">*</span></label>
              <input type="email" name="email" class="form-control" placeholder="you@example.com" value="{{ old('email') }}" required>
              @error('email')<p class="text-danger small mb-0">{{ $message }}</p>@enderror
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Phone / WhatsApp</label>
              <input type="text" name="mobile" class="form-control" placeholder="+880 1XXX XXXXXX" value="{{ old('mobile') }}">
            </div>

            <div class="col-md-8 mb-3">
              <label class="form-label">Product / Item Name</label>
              <input type="text" name="subject" class="form-control" placeholder="e.g. Binocular Biological Microscope" value="{{ old('subject') }}">
            </div>

            <div class="col-md-4 mb-3">
              <label class="form-label">Quantity</label>
              <input type="text" name="quantity" class="form-control" placeholder="e.g. 10 pcs" value="{{ old('quantity') }}">
            </div>

            <div class="col-12 mb-4">
              <label class="form-label">Requirement Details</label>
              <textarea name="message" rows="4" class="form-control" placeholder="Specifications, models, brands, delivery location, deadline…">{{ old('message') }}</textarea>
              @error('message')<p class="text-danger small mb-0">{{ $message }}</p>@enderror
            </div>

            <div class="col-12">
              <button type="submit" class="rq-submit">Submit Request <i class="fa-solid fa-arrow-right"></i></button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</section>

@endsection

@push('js')
@endpush
