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
.no-result {
    text-align: center;
    color: gray;
    font-size: 24px;
    margin: 30px 0;
}

.singleProHead {
    padding: 12px 0;
    background: #7f1978;
}

ol.breadcrumb {
    margin: 0;
}


.breadcrumb-item a {
    color: #fff;
}


.breadcrumb-item.active {
    color: #fff;
}
.breadcrumb-item + .breadcrumb-item::before {
    color: #fff;
}


</style>
@endpush 

@section('contents')

<div class="singleProHead">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search: {{request()->search}}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="categoryMainDiv">
    <div class="container">
        <div class="productsLists">
            <h2><b>Search:</b> {{request()->search}}</h2>
            <div class="row productRow">
                @foreach($products as $product)
                <div class="col-md-3 col-6">
                    @include(welcomeTheme().'.products.includes.productCard')
                </div>
                @endforeach
            </div>
            @if($products->count()==0)
            <div class="no-result">
                <span>No Product found</span>
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