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
    
    
    
     .hero{
            background:linear-gradient(135deg,#0d6efd,#0b4db7);
            color:#fff;
            padding:90px 0;
        }

        .hero h1{
            font-size:48px;
            font-weight:700;
        }

        .hero p{
            max-width:750px;
            margin:auto;
            opacity:.9;
        }

        .section-title{
            text-align:center;
            margin-bottom:50px;
        }

        .section-title h2{
            font-weight:700;
            color:#1b1b1b;
        }

        .section-title p{
            color:#666;
        }

        .service-card{
            background:#fff;
            border-radius:15px;
            padding:35px 25px;
            transition:.35s;
            border:1px solid #eee;
            height:100%;
        }

        .service-card:hover{
            transform:translateY(-8px);
            box-shadow:0 20px 40px rgba(0,0,0,.08);
        }

        .service-icon{
            width:75px;
            height:75px;
            background:#08676624;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            margin-bottom:20px;
        }

        .service-icon i{
            font-size:30px;
            color: #096765;
        }

        .service-card h4{
            font-size:22px;
            font-weight:600;
            margin-bottom:15px;
        }

        .service-card p{
            color:#666;
            margin-bottom:20px;
        }

        .btn-service{
            color:#0d6efd;
            text-decoration:none;
            font-weight:600;
        }

        .btn-service:hover{
            color:#084298;
        }
    
    .breadcrumb-area {
    background: #096765 !important;
    padding: 44px 0;
}
    
</style>
@endpush @section('contents')

<div class="breadcrumb-area" @if($page->
    bannerFile) style="background-image:url({{assetUrl($page->banner())}});background-repeat: no-repeat; background-size: cover;padding: 50px 0;" @endif >
    <div class="container">
        <div class="title">
            <h1>{{$page->name}}</h1>
            <ul>
                <li><a href="{{route('index')}}">Home</a></li>
                <li>{{$page->name}}</li>
            </ul>
        </div>
    </div>
</div>

<!-- ===================== Breadcrumb ===================== -->
{{--<div class="breadcrumb-strip">
  <div class="container">
    <a href="{{route('index')}}">Home</a><span class="sep">&gt;</span><span class="text-muted">{{$page->name}}</span>
  </div>
</div>--}}



<!-- Services -->
<section class="py-5">
    <div class="container">

        <div class="section-title">
            <h2>Our Service Support</h2>
            <p>
                Comprehensive after-sales solutions for educational,
                research, and industrial laboratories.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h4>Installation</h4>
                    <p>Professional installation and commissioning of laboratory equipment.</p>
                   
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-screwdriver-wrench"></i>
                    </div>
                    <h4>Maintenance</h4>
                    <p>Scheduled preventive maintenance to maximize equipment life.</p>

                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-wrench"></i>
                    </div>
                    <h4>Repair Service</h4>
                    <p>Fast troubleshooting and repair by experienced service engineers.</p>

                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-ruler-combined"></i>
                    </div>
                    <h4>Calibration</h4>
                    <p>Accurate calibration services for reliable laboratory results.</p>

                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h4>Training</h4>
                    <p>Hands-on operator training for safe and efficient equipment use.</p>

                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4>Technical Support</h4>
                    <p>Quick technical assistance through remote and onsite support.</p>

                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h4>Warranty Support</h4>
                    <p>Reliable warranty coverage with dedicated after-sales service.</p>

                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h4>Spare Parts</h4>
                    <p>Original spare parts for long-lasting equipment performance.</p>

                </div>
            </div>

        </div>

    </div>
</section>





@endsection @push('js') @endpush