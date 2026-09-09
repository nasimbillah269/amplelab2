@extends(welcomeTheme().'layouts.app')
@section('title')
<title>{{websiteTitle('My WishList')}}</title>
@endsection
@section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('My WishList')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keyword" property="og:keyword" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{assetUrl(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('myWishlist')}}" />
<link rel="canonical" href="{{route('myWishlist')}}">
@endsection 
@push('css')

<style>
    .section.wishlistPage {
        background-color: #f9f9f9;
        padding: 40px 0;
    }
    
    .table-responsive.wishlist_table {
        background-color: #fff;
        padding: 20px;
        box-shadow: 0px 0px 10px #ccc;
    }
</style>
@endpush 

@section('contents')

{{--<div class="singleProHead">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Wishlist</li>
            </ol>
        </nav>
    </div>
</div>--}}
<!-- START SECTION SHOP -->
{{--<div class="section wishlistPage">
	<div class="container viewItemsLists">
        @include(welcomeTheme().'.carts.includes.wishlistItems')
    </div>
</div>--}}



  <section class="section-b-space pt-0"> 
       <div class="heading-banner">
         <div class="custom-container container">
           <div class="row align-items-center">
             <div class="col-sm-6">
               <h4>Wishlist </h4>
             </div>
             <div class="col-sm-6">
               <ul class="breadcrumb float-end">
                 <li class="breadcrumb-item">  <a href="index.html">Home  </a></li>
                 <li class="breadcrumb-item active">  <a href="#">Wishlist </a></li>
               </ul>
             </div>
           </div>
         </div>
       </div>
     </section>


<section class="section-b-space pt-0"> 
       <div class="custom-container container wishlist-box"> 
         <div class="product-tab-content ratio1_3 viewItemsLists">
            @include(welcomeTheme().'.carts.includes.wishlistItems')
         </div>
       </div>
     </section>






<!-- END SECTION SHOP -->

@endsection @push('js') @endpush