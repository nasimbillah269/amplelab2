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
  .catalog-page{ padding:40px 0 60px; }
  .catalog-page .section-heading{ text-align:center; margin-bottom:36px; }
  .catalog-page .section-heading h1{ font-weight:700; font-size:1.7rem; color:var(--al-text); }
  .catalog-page .section-heading p{ color:var(--al-muted); margin-top:6px; }

  .catalog-card{
    background:#fff;
    border:1px solid var(--al-border);
    border-left:4px solid var(--al-green);
    border-radius:10px;
    padding:14px;
    height:100%;
    display:flex;
    flex-direction:column;
    gap:12px;
    transition:.2s;
  }
  .catalog-card:hover{ box-shadow:0 10px 24px rgba(13,61,51,.12); transform:translateY(-3px); }

  .catalog-thumb{
    background:var(--al-bg-soft, #f5f6f1);
    border:1px solid var(--al-border);
    border-radius:8px;
    height:300px;
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden;
  }
  .catalog-thumb img{ max-width:100%; max-height:100%; object-fit:contain; }

  .catalog-name{
    font-weight:600;
    color:var(--al-text);
    text-align:center;
    font-size:.98rem;
    line-height:1.35;
  }

  .catalog-download{
    margin-top:auto;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    width:100%;
    padding:10px 14px;
    background:var(--al-green, #1f7a4d);
    color:#fff;
    border:1px solid var(--al-green-hover, #17603b);
    border-radius:6px;
    font-size:.9rem;
    font-weight:500;
    text-decoration:none;
    transition:.2s;
  }
  .catalog-download:hover{ background:var(--al-green-hover, #17603b); color:#fff; }
</style>
@endpush

@section('contents')

<!-- ===================== Breadcrumb ===================== -->
<div class="breadcrumb-strip">
  <div class="container">
    <a href="{{ route('index') }}">Home</a><span class="sep">&gt;</span><span class="text-muted">{{ $page->name }}</span>
  </div>
</div>

@php
  $catalogs = $clients->filter(fn ($c) => $c->bannerFile);
@endphp

<section class="catalog-page">
  <div class="container">

    <div class="section-heading">
      <h1>{{ $page->name }}</h1>
      <p>{{ $page->short_description ?: 'Download our product catalogs and brochures.' }}</p>
    </div>

    @if($catalogs->count())
    <div class="row g-4">
      @foreach($catalogs as $client)
      @php
        $file = $client->bannerFile;
        $ext  = pathinfo($file->file_url, PATHINFO_EXTENSION) ?: 'pdf';
      @endphp
      <div class="col-6 col-md-4 col-lg-3">
        <div class="catalog-card">
          <div class="catalog-thumb">
            <img src="{{ assetUrl($file->image()) }}" alt="{{ $client->name }}" loading="lazy">
          </div>
          <div class="catalog-name">{{ $client->name }}</div>
          <a href="{{ assetUrl($file->file_url) }}" class="catalog-download"
             target="_blank" rel="noopener"
             download="{{ Str::slug($client->name) ?: 'catalog' }}.{{ $ext }}">
            <i class="fa fa-download"></i> Download
          </a>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <p class="text-center text-muted py-5">No catalog available right now.</p>
    @endif

  </div>
</section>

@endsection

@push('js')
@endpush
