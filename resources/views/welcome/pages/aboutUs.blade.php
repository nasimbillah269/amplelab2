@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$page->seo_title?:websiteTitle($page->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$page->seo_title?:websiteTitle($page->name)}}" />
<meta name="description" property="og:description" content="{!!$page->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$page->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{assetUrl($page->image())}}" />
<meta name="url" property="og:url" content="{{route('pageView',$page->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('pageView',$page->slug?:'no-title')}}">
@endsection
@push('css')
<style>

</style>
@endpush 

@section('contents')



<!-- ===================== Breadcrumb ===================== -->
<div class="breadcrumb-strip">
  <div class="container">
    <a href="{{route('index')}}">Home</a><span class="sep">&gt;</span><span class="text-muted">{{$page->name}}</span>
  </div>
</div>



<!-- ===================== About Hero ===================== -->
<section class="page-hero">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <div class="eyebrow">About Us</div>
        <h1 class="mt-2">Empowering Practical Education Through Quality Lab Solutions</h1>
        <div class="hero-underline"></div>
        <p class="mt-4 mb-4">
          Ample Lab is a trusted supplier of laboratory equipment and training solutions for
          educational institutions, technical training centers, universities, research
          organizations and industries across Bangladesh. We provide complete laboratory
          solutions to support skill development, innovation and engineering excellence.
        </p>
        <a href="#" class="btn-alab">Learn More About Us <i class="fa-solid fa-arrow-right"></i></a>
      </div>
      <div class="col-lg-6">
        <div class="about-media">
          <img src="{{assetUrl(assetLink().'/images/ample/about-page.webp')}}" alt="Laboratory equipment">
          <div class="badge-float">
            <div class="icon-box"><i class="fa-solid fa-building-columns"></i></div>
            <div class="fw-bold" style="font-size:14.5px;">Trusted Lab Solutions</div>
            <div class="text-muted" style="font-size:13px;">Since 2015</div>
            <div class="line"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Feature Strip -->
    <div class="feature-strip">
      <div class="row gy-4">
        <div class="col-6 col-md-4 col-lg-2">
          <div class="feature-item">
            <div class="icon-circle"><i class="fa-solid fa-award"></i></div>
            <h6>Quality Products</h6>
            <p>We supply high quality products from trusted international brands.</p>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
          <div class="feature-item">
            <div class="icon-circle"><i class="fa-solid fa-gear"></i></div>
            <h6>Complete Solutions</h6>
            <p>From product selection to installation – we provide complete lab solutions.</p>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
          <div class="feature-item">
            <div class="icon-circle"><i class="fa-solid fa-headset"></i></div>
            <h6>Technical Support</h6>
            <p>Our expert team provides professional technical support and training.</p>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
          <div class="feature-item">
            <div class="icon-circle"><i class="fa-solid fa-file-circle-check"></i></div>
            <h6>Tender Support</h6>
            <p>We assist in tender documentation and technical compliance requirements.</p>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
          <div class="feature-item">
            <div class="icon-circle"><i class="fa-solid fa-screwdriver-wrench"></i></div>
            <h6>Installation &amp; Training</h6>
            <p>We ensure proper installation and provide training for effective usage.</p>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
          <div class="feature-item">
            <div class="icon-circle"><i class="fa-solid fa-shield-halved"></i></div>
            <h6>After Sales Service</h6>
            <p>Reliable after sales service for long term customer satisfaction.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== Mission & Vision ===================== -->
<section class="section-pad bg-light">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <div class="mv-image">
          <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=1200&auto=format&fit=crop" alt="Engineering planning">
        </div>
      </div>
      <div class="col-lg-6">
        <h2 class="mb-1">Our Mission &amp; Vision</h2>
        <div class="hero-underline mb-4"></div>

        <div class="mv-item">
          <div class="icon-circle"><i class="fa-solid fa-bullseye"></i></div>
          <div>
            <h5>Our Mission</h5>
            <p>To support technical education, research and industrial development in
              Bangladesh by providing high-quality laboratory equipment, professional
              support and dependable after-sales service.</p>
          </div>
        </div>

        <div class="mv-item mb-0">
          <div class="icon-circle"><i class="fa-solid fa-eye"></i></div>
          <div>
            <h5>Our Vision</h5>
            <p>To become one of the leading laboratory equipment solution providers in
              Bangladesh, recognized for quality products, technical expertise, customer
              satisfaction and long-term partnerships.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== Brands ===== -->
<section>
  <div class="container text-center">
    <h2 class="fw-bold mb-1" style="font-size:1.6rem;">We Work With International Brands</h2>
    <p class="text-muted mb-4">Delivering trusted quality through global partnerships</p>
    <div class="row g-3 justify-content-center">
      <div class="col-6 col-md-2"><div class="brand-box text-danger" style="font-family:Georgia,serif;">SEW<br><small class="text-muted fw-normal" style="font-size:.65rem;">EURODRIVE</small></div></div>
      <div class="col-6 col-md-2"><div class="brand-box" style="background:#0f7a3d; color:#fff;">K&amp;H</div></div>
      <div class="col-6 col-md-2"><div class="brand-box"><i class="fa-solid fa-square me-1"></i>LUTRON</div></div>
      <div class="col-6 col-md-2"><div class="brand-box text-danger" style="font-family:Georgia,serif;">WLKATA</div></div>
      <div class="col-6 col-md-2"><div class="brand-box"><i class="fa-solid fa-handshake me-2"></i>And Many More...</div></div>
    </div>
    <a href="#" class="btn-al-primary d-inline-block mt-4">View All Brands</a>
  </div>
</section>

<!-- ===== Stats ===== -->
<div class="stats-bar">
  <div class="container">
    <div class="row g-4">
      <div class="col-6 col-lg-3">
        <div class="stat-item">
          <i class="fa-solid fa-building"></i>
          <div><div class="num">500+</div><div class="lbl">Projects Completed</div></div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="stat-item">
          <i class="fa-solid fa-users"></i>
          <div><div class="num">1000+</div><div class="lbl">Happy Customers</div></div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="stat-item">
          <i class="fa-solid fa-cubes"></i>
          <div><div class="num">2000+</div><div class="lbl">Products</div></div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="stat-item">
          <i class="fa-solid fa-award"></i>
          <div><div class="num">10+</div><div class="lbl">Years of Experience</div></div>
        </div>
      </div>
    </div>
  </div>
</div>





@endsection 
@push('js') 
@endpush


