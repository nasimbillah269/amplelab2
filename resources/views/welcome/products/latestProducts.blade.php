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

{{--<div class="singleProHead">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$page->name}}</li>
            </ol>
        </nav>
    </div>
</div>--}}


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
  <div class="container">

    @if($products->count())
    <div class="row g-3 g-xl-4">
      @foreach($products as $product)
      <div class="col-6 col-md-4 col-lg-3">
        @include(welcomeTheme().'products.includes.productCard')
      </div>
      @endforeach
    </div>

    @if($products instanceof \Illuminate\Contracts\Pagination\Paginator)
    <div class="paginationPart mt-4">
      {{ $products->links('pagination') }}
    </div>
    @endif
    @else
    <p class="text-center text-muted py-5">No product found.</p>
    @endif

  </div>
</section>





@endsection @push('js') @endpush