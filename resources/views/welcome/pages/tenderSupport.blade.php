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
    background:linear-gradient(135deg,#0d6efd,#003b88);
    color:#fff;
    padding:90px 0;
}

.hero h1{
    font-size:52px;
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
}

.section-title p{
    color:#777;
}

.card-box{
    background:#fff;
    border-radius:15px;
    padding:35px 25px;
    height:100%;
    transition:.3s;
    border:1px solid #e5e5e5;
}

.card-box:hover{
    transform:translateY(-8px);
    box-shadow:0 20px 40px rgba(0,0,0,.08);
}

.icon-box{
    width:75px;
    height:75px;
    background: #0967652b;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:20px;
}

.icon-box i{
    color: #096765;
    font-size:30px;
}

.card-box h4{
    font-size:22px;
    margin-bottom:15px;
}

.card-box p{
    color:#666;
}

.timeline{
    position:relative;
}

.timeline::before{
    content:"";
    position:absolute;
    left:25px;
    top:0;
    bottom:0;
    width:3px;
    background: #030d1c;
}

.step{
    position:relative;
    padding-left:60px;
    margin-bottom:35px;
}

.step span{
    position:absolute;
    left:8px;
    top:0;
    width:35px;
    height:35px;
    background: #096765;
    color:#fff;
    border-radius:50%;
    text-align:center;
    line-height:35px;
    font-weight:bold;
}

.cta{
    background: #096765;
    color:#fff;
    border-radius:20px;
    padding:60px;
}

.cta .btn{
    padding:12px 30px;
    font-weight:600;
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
            <h2>Our Tender Support Services</h2>

            <p>Professional support throughout every stage of the tender process.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card-box">
                    <div class="icon-box">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    <h4>Tender Documentation</h4>
                    <p>Preparation and review of complete tender documents according to project requirements.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card-box">
                    <div class="icon-box">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <h4>Technical Compliance</h4>
                    <p>Ensure specifications and technical requirements fully comply with tender conditions.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card-box">
                    <div class="icon-box">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <h4>Quotation Support</h4>
                    <p>Preparation of competitive quotations, BOQ, pricing, and commercial documents.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card-box">
                    <div class="icon-box">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h4>Bid Submission</h4>
                    <p>Complete guidance for online and offline tender submission procedures.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card-box">
                    <div class="icon-box">
                        <i class="fas fa-boxes-stacked"></i>
                    </div>
                    <h4>Equipment Supply</h4>
                    <p>Supply premium laboratory equipment from internationally recognized manufacturers.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card-box">
                    <div class="icon-box">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h4>Installation</h4>
                    <p>Professional installation, testing, and commissioning by certified engineers.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card-box">
                    <div class="icon-box">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h4>User Training</h4>
                    <p>Comprehensive training for laboratory operators and technical personnel.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card-box">
                    <div class="icon-box">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4>After-Sales Support</h4>
                    <p>Warranty, maintenance, calibration, and technical assistance after project completion.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Timeline -->

<section class="py-5 bg-white">
    <div class="container">
        <div class="section-title">
            <h2>Tender Process</h2>

            <p>How we support your project from start to finish.</p>
        </div>


        
        <div class="row">
            <div class="col-md-5">
                    <div class="timeline">
                        <div class="step">
                            <span>1</span>
                            <h5>Requirement Analysis</h5>
                            <p>Understand tender specifications and project objectives.</p>
                        </div>
            
                        <div class="step">
                            <span>2</span>
                            <h5>Document Preparation</h5>
                            <p>Prepare technical, financial, and compliance documents.</p>
                        </div>
            
                        <div class="step">
                            <span>3</span>
                            <h5>Bid Submission</h5>
                            <p>Submit complete tender documents within the deadline.</p>
                        </div>
            
                        <div class="step">
                            <span>4</span>
                            <h5>Supply & Installation</h5>
                            <p>Deliver equipment and complete installation successfully.</p>
                        </div>
            
                        <div class="step">
                            <span>5</span>
                            <h5>Training & Support</h5>
                            <p>Provide operator training and long-term maintenance support.</p>
                        </div>
                    </div>
            </div>
            <div class="col-md-7">
                <section class="py-5">
                    <div class="container">
                        <div class="cta text-center">
                            <h2>Need Professional Tender Assistance?</h2>
                
                            <p class="mt-3 mb-4">
                                Our experienced team is ready to help you prepare, submit, and successfully execute laboratory equipment
                                tenders.
                            </p>
                
                            <a href="#" class="btn btn-light">
                                <i class="fas fa-paper-plane me-2"></i>
                                Contact
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        
    </div>
</section>

<!-- CTA -->









@endsection @push('js') @endpush