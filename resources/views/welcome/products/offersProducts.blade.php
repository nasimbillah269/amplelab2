@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$page->seo_title?:websiteTitle($page->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$page->seo_title?:general()->meta_title}}" />
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

 <section class="section-b-space pt-0"> 
      <div class="heading-banner">
        <div class="custom-container container">
          <div class="row align-items-center">
            <div class="col-sm-6">
              <h4>{{$page->name}}</h4>
            </div>
            <div class="col-sm-6">
              <ul class="breadcrumb float-end">
                <li class="breadcrumb-item"> <a href="{{route('index')}}">Home </a></li>
                <li class="breadcrumb-item active"> <a href="javascript:void(0)">{{$page->name}} </a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
</section>


<section class="section-b-space pt-0"> 
      <div class="custom-container container">
        <div class="product-tab-content ratio1_3">
              <div class="row-cols-lg-4 row-cols-md-3 row-cols-2 grid-section view-option row g-3 g-xl-4">
                  
                @foreach($products as $product)
                
                 @include(welcomeTheme().'.products.includes.productCard')
                 
                @endforeach
           
              </div>
            </div>
      </div>
</section>


@endsection 
@push('js') 

@endpush