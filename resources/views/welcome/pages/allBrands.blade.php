@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$page->seo_title?:websiteTitle($page->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$page->seo_title?:websiteTitle($page->name)}}" />
<meta name="description" property="og:description" content="{!!$page->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$page->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{assetUrl($page->image())}}" />
<meta name="url" property="og:url" content="{{route('pageView',$page->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('pageView',$page->slug?:'no-title')}}" />
@endsection @push('css')
<style>
  .brands-page{ padding:40px 0 60px; }
  .brands-page .section-heading{ margin-bottom:32px; }
  .brands-page .section-heading h2{ font-weight:700; font-size:1.6rem; }
  .brands-page .section-heading p{ color:var(--al-muted); }
  .brand-box{
    border:1px solid var(--al-border);
    border-radius:10px;
    height:110px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#fff;
    padding:14px;
    font-weight:700;
    color:var(--al-text);
    text-align:center;
    text-decoration:none;
    transition:.2s;
  }
  .brand-box img{ max-height:70px; max-width:100%; object-fit:contain; }
  .brand-box:hover{ box-shadow:0 10px 22px rgba(13,61,51,.1); transform:translateY(-3px); border-color:var(--al-green); }
</style>
@endpush @section('contents')

<!-- ===================== Breadcrumb ===================== -->
<div class="breadcrumb-strip">
  <div class="container">
    <a href="{{route('index')}}">Home</a><span class="sep">&gt;</span><span class="text-muted">{{$page->name}}</span>
  </div>
</div>

<section class="brands-page">
  <div class="container">

    <div class="section-heading text-center">
      <h2>{{$page->name}}</h2>
      <p>{{$page->short_description?:'Delivering trusted quality through global partnerships'}}</p>
    </div>

    @if($brands->count())
    <div class="row g-3">
      @foreach($brands as $brand)
      <div class="col-6 col-md-3 col-lg-2">
        <a href="{{route('productBrand',$brand->slug?:'no-title')}}" class="brand-box">
          @if($brand->imageFile)
          <img src="{{assetUrl($brand->image())}}" alt="{{$brand->name}}">
          @else
          <span>{{$brand->name}}</span>
          @endif
        </a>
      </div>
      @endforeach
    </div>

    <div class="paginationPart mt-4">
      {{$brands->links('pagination')}}
    </div>
    @else
    <p class="text-center text-muted py-5">No brand found.</p>
    @endif

  </div>
</section>

@endsection @push('js') @endpush
