
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
<style></style>
@endpush @section('contents')

{{--<div class="breadcrumb-area" @if($page->
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
</div>--}}

<!-- ===================== Breadcrumb ===================== -->
<div class="breadcrumb-strip">
  <div class="container">
    <a href="{{route('index')}}">Home</a><span class="sep">&gt;</span><span class="text-muted">{{$page->name}}</span>
  </div>
</div>




@if($homeCategories->count() > 0)
<section id="categories" class="py-5">
    <div class="container">

        <div class="section-heading text-center mb-5">
            <h2>Explore Our Product Categories</h2>
            <div class="heading-divider"></div>
        </div>

        <div class="row g-4">
            @foreach($homeCategories as $category)
            
              <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('productCategory', $category->slug) }}" class="cat-card">
                      <div class="cat-icon"> <img src="{{ assetUrl($category->banner()) }}" alt="{{ $category->name }}"></div>
                      <div class="cat-title">{{ $category->name }}</div>
                      <img src="{{ assetUrl($category->image()) }}" alt="{{ $category->name }}">
                    </a>
                </div>
            
            
               
            @endforeach
        </div>


    </div>
</section>
@endif


@endsection @push('js') @endpush