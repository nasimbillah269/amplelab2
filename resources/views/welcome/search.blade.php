@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Search')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{general()->meta_title}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{assetUrl(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('search')}}" />
<link rel="canonical" href="{{route('search')}}">
@endsection @push('css')
<style>
.search-hero{
    padding:34px 0 30px;
    background:linear-gradient(135deg, var(--al-dark,#0d3d33), var(--al-dark-2,#0f4a3d));
}
.search-hero .breadcrumb{
    align-items:center;
    margin:0 0 14px;
}
.search-hero .breadcrumb-item,
.search-hero .breadcrumb-item a{
    color:rgba(255,255,255,.62);
    font-size:.85rem;
    transition:color .2s ease;
}
.search-hero .breadcrumb-item a:hover{
    color:var(--al-orange,#f0a63a);
}
.search-hero .breadcrumb-item.active{
    color:#fff;
}
.search-hero .breadcrumb-item + .breadcrumb-item::before{
    color:rgba(255,255,255,.35);
}
.search-hero-title{
    color:#fff;
    font-family:'Poppins', sans-serif;
    font-weight:700;
    font-size:1.7rem;
    line-height:1.3;
    margin:0 0 6px;
}
.search-hero-title span{
    color:var(--al-orange,#f0a63a);
}
.search-hero-meta{
    color:rgba(255,255,255,.72);
    font-size:.92rem;
    margin:0;
}

.categoryMainDiv{
    padding:36px 0 56px;
}
.productRow{
    row-gap:24px;
}

.no-result{
    text-align:center;
    color:var(--al-muted,#6c7a76);
    padding:70px 20px;
}
.no-result i{
    display:block;
    font-size:2.4rem;
    color:var(--al-border,#e5e9e7);
    margin-bottom:16px;
}
.no-result span{
    display:block;
    font-size:1.05rem;
    font-weight:500;
}
</style>
@endpush

@section('contents')

<div class="search-hero">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search Results</li>
            </ol>
        </nav>
        <h1 class="search-hero-title">Search results for <span>&ldquo;{{request()->search}}&rdquo;</span></h1>
        <p class="search-hero-meta">{{$products->total()}} {{Str::plural('product',$products->total())}} found</p>
    </div>
</div>

<div class="categoryMainDiv">
    <div class="container">
        <div class="productsLists">
            <div class="row productRow">
                @foreach($products as $product)
                <div class="col-md-3 col-6">
                    @include(welcomeTheme().'.products.includes.productCard')
                </div>
                @endforeach
            </div>
            @if($products->count()==0)
            <div class="no-result">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span>No product found for &ldquo;{{request()->search}}&rdquo;</span>
            </div>
            @endif
        </div>

        <div class="paginationPart">
            {{$products->links('pagination')}}
        </div>
    </div>
</div>

@endsection
@push('js') @endpush