@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle()}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{general()->meta_title}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keyword" property="og:keyword" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{assetUrl(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('index')}}" />
<link rel="canonical" href="{{route('index')}}" />
@endsection 
@push('css') 


<style>
    
    @media (min-width: 992px) {
        .modalReSize{
            max-width:600px;
        }
    }
    
    @media (min-width: 1400px) {
        .modalReSize{
            max-width:800px;
        }
    }
</style>
@endpush 
@section('contents')


    <section class="pt-0 home-section-3">
       <div class="container-fluid">
         <div class="row align-items-center">
           <div class="col-2 d-none d-xl-block">
             <ul> 
              @foreach($category as $hCtg)
               <li>  <a href="{{route('productCategory',$hCtg->slug?:'no-title')}}">{{$hCtg->name}} </a></li>
             @endforeach    
                
             </ul>
           </div>
           <div class="col pe-0">  
             <!--Slider Part Include Start-->
                @include(general()->theme.'.layouts.slider')
           </div>
         </div>
       </div>
     </section>


    <section class="section-t-space">
       <div class="custom-container container service">
         <ul>
           <li>
             <div class="service-block"><img src="{{assetUrl('public/welcome/assets/images/svg-icon/1.svg')}}" alt="" />
               <div>    
                 <h6>Free Shipping Worldwide </h6>
                 <p>Apply to all orders  $800 </p>
               </div>
             </div>
           </li>
           <li>
             <div class="service-block"><img src="{{assetUrl('public/welcome/assets/images/svg-icon/2.svg')}}" alt="" />
               <div>    
                 <h6>Return & Exchanges </h6>
                 <p>Complete warranty </p>
               </div>
             </div>
           </li>
           <li>
             <div class="service-block"><img src="{{assetUrl('public/welcome/assets/images/svg-icon/3.svg')}}" alt="" />
               <div>    
                 <h6>Technical Support </h6>
                 <p>Service support 24/7 </p>
               </div>
             </div>
           </li>
           <li>
             <div class="service-block border-0"><img src="{{assetUrl('public/welcome/assets/images/svg-icon/4.svg')}}" alt="" />
               <div>    
                 <h6>Daily Gift Vouchers </h6>
                 <p>Shopping now is more  </p>
               </div>
             </div>
           </li>
         </ul>
       </div>
     </section>
     
     <section class="section-t-space">
       <div class="custom-container container">
         <div class="row"> 
         
           <div class="col-xxl-5 col-lg-8 offer-box-1">
               
             <div class="row gy-4 ratio_45">
                @foreach($bannerGroupOne as $i=>$data)
               <div class="col-12">
                 <div class="collection-banner {{$i==0?'p-left':'p-right'}}"><img class="bg-img" src="{{assetUrl($data->image())}}" alt="{{$data->name}}" />
                   <div class="contain-banner"> 
                     <div> 
                        @if($data->sub_title)
                        <h4>{{$data->sub_title}}</h4>
                        @endif
                        @if($data->name)
                        <h3>{{$data->name}}</h3>
                        @endif
                        @if($data->image_link)
                        <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="{{$data->image_link}}">Shop Collection
                           <svg>
                             <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#arrow')}}"></use>
                           </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="{{$data->image_link}}">Shop Collection
                           <svg>
                             <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#arrow')}}"></use>
                           </svg></a>
                        </div>
                        @endif
                        
                     </div>
                   </div>
                 </div>
               </div>
               @endforeach
               
             </div>
           </div>
           <div class="col-xxl-3 col-4 d-none d-lg-block"> 
            @foreach($specialOffers as $i=>$data)
             <div class="special-offer-slider"> 
               <h4>{{$data->name}}</h4>
               
               <div class="swiper special-offer-slide">
                 
                   
                 <div class="swiper-wrapper trending-products">
                    @foreach($data->products() as $product)
                   <div class="swiper-slide product-box-3">
  
                        <div class="img-wrapper">
                           <div class="label-block">
                               <span class="lable-1">NEW </span>
                                <a class="label-2 wishlist-icon wishlistCompareUpdate" data-url="{{route('wishlistCompareUpdate',[$product->id,'wishlist'])}}" href="javascript:void(0)" tabindex="0">
                                    <i class="fa-{{$product->isWl()?'solid':'regular'}} fa-heart"></i>
                                </a>
                            </div>
                           <div class="product-image ratio_apos">
                                <a class="pro-first" href="{{route('productView',$product->slug?:Str::slug($product->name))}}">
                                   <img class="bg-img" src="{{assetUrl($product->image())}}" alt="product" />
                                </a>
                                <a class="pro-sec" href="{{route('productView',$product->slug?:Str::slug($product->name))}}">
                                    <img class="bg-img" src="{{assetUrl($product->image())}}" alt="product" />
                                </a>
                            </div>
                            <!--<div class="cart-info-icon">-->
                            <!--    <a href="#" data-bs-toggle="modal" data-bs-target="#addtocart" tabindex="0"><i class="iconsax" data-icon="basket-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to card">  </i></a>-->
                            <!--    <a href="compare.html" tabindex="0"><i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a>-->
                            <!--    <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0"><i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i></a>-->
                            <!--</div>-->
                        </div>
                        <div class="product-detail">
                            <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}"> 
                             <h6>{{$product->name}}</h6></a>
                            <p>{{priceFullFormat($product->offerPrice())}}/-
                                @if($product->regularPrice() > $product->offerPrice())
                                <del>{{priceFullFormat($product->regularPrice())}}/-</del>
                                @endif
                            </p>
                        </div>
                   </div>
                   @endforeach
                 </div>
                 <div class="swiper-button-prev"></div>
                 <div class="swiper-button-next"></div>
               </div>
             </div>
             @endforeach
           </div>
           <div class="col-4 d-none d-xxl-block"> 
            
            @foreach($largeBannerOne as $i=>$data)
                <div class="offer-banner-3 ratio1_3">  
                    <a href="{{$data->image_link?:'javascript:void(0)'}}">  
                        <img class="bg-img" src="{{assetUrl($data->image())}}" alt="{{$data->name}}" />
                        <div>
                            <img src="{{assetUrl('public/welcome/assets/images/banner/2.png')}}" alt="" />
                            <h6>SALE UP TO 70% </h6>
                        </div>
                    </a>
                </div>
            @endforeach
           </div>
         </div>
       </div>
     </section>
     
     
     <section class="section-t-space">
    <div class="custom-container container">
        <div class="row special-products align-items-center">
            <div class="col-md-4 col-12">
                <div class="title-1">
                    <p>Trendy collection <span></span></p>
                    <h3>Special Products</h3>
                </div>
            </div>
            <div class="col-md-8 col-12">
                <div class="theme-tab-3">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a
                                class="nav-link active"
                                data-bs-toggle="tab"
                                data-bs-target="#new-product"
                                role="tab"
                                aria-controls="new-product"
                                aria-selected="true"
                            >
                                <h6>New Products</h6></a
                            >
                        </li>
                        <li class="nav-item" role="presentation">
                            <a
                                class="nav-link"
                                data-bs-toggle="tab"
                                data-bs-target="#featured-product"
                                role="tab"
                                aria-controls="featured-product"
                                aria-selected="false"
                            >
                                <h6>Featured Products</h6></a
                            >
                        </li>
                        <li class="nav-item" role="presentation">
                            <a
                                class="nav-link"
                                data-bs-toggle="tab"
                                data-bs-target="#best-seller"
                                role="tab"
                                aria-controls="best-seller"
                                aria-selected="false"
                            >
                                <h6>Best Sale</h6></a
                            >
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="new-product" role="tabpanel" tabindex="0">
                        <div class="row ratio1_3 gy-4 gx-3 gx-sm-4">
                             @foreach($latestProducts as $product)
                             
                            <div class="col-lg-3 col-md-4 col-6">
                                 @include(welcomeTheme().'.products.includes.productCard')
                                
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="featured-product" role="tabpanel" tabindex="0">
                        <div class="row ratio1_3 gy-4">
                             @foreach($featuresProducts as $product)
                            <div class="col-lg-3 col-md-4 col-6">
                                @include(welcomeTheme().'.products.includes.productCard')
                            </div>
                            @endforeach
                           
                        </div>
                    </div>
                    <div class="tab-pane fade" id="best-seller" role="tabpanel" tabindex="0">
                        <div class="row ratio1_3 gy-4">
                        @foreach($bestProducts as $product)
                            <div class="col-lg-3 col-md-4 col-6">
                                @include(welcomeTheme().'.products.includes.productCard')
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

     
     
<section class="section-t-space">
        <div class="custom-container container">
            <div class="style-banner">
                <div class="row gy-4 align-items-end">
                    @foreach($largeBannerTwo as $i=>$data)
                        @if($i==0)
                        <div class="col-sm-6 col-12 ratio_square-4">
                            <a href="{{$data->image_link?:'javascript:void(0)'}}">
                                <img class="bg-img" src="{{assetUrl($data->image())}}" alt="{{$data->name}}"/>
                            </a>
                        </div>
                        @else
                        <div class="col-sm-6 col-12 ratio3_2">
                            <div class="style-content">
                                <!--<h6>Wear Your Style</h6>-->
                                @if($data->sub_title)
                                    <h2>{{$data->sub_title}}</h2>
                                @endif
                                @if($data->name)
                                    <h4>{{$data->name}}</h4>
                                @endif
                                @if($data->image_link)
                                <div class="link-hover-anim underline">
                                    <a
                                        class="btn btn_underline link-strong link-strong-unhovered"
                                        href="{{$data->image_link}}"
                                        >Shop Collection
                                        <svg>
                                            <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#arrow')}}"></use></svg></a
                                    >
                                    <a
                                        class="btn btn_underline link-strong link-strong-hovered"
                                        href="{{$data->image_link}}"
                                        >Shop Collection
                                        <svg>
                                            <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#arrow')}}"></use></svg
                                    ></a>
                                </div>
                                @endif
                            </div>
                            <a href="{{$data->image_link?:'javascript:void(0)'}}">
                                <img class="bg-img" src="{{assetUrl($data->image())}}" alt="" />
                            </a>
                        </div>
                        @endif
                    @endforeach
                    
                    
                </div>
            </div>
        </div>
    </section>

     
    
    @foreach($flashSales as $i=>$data)
    <section class="section-t-space">
       <div class="custom-container container flash-box">
         <div class="row gy-3"> 
           <div class="col-12">
             <div class="d-sm-flex d-block justify-content-between align-items-center">
               <div class="title-1">
                 <p>Brand collection </p>
                 <h3>Flash Sale Product </h3>
               </div>
               <div class="link-hover-anim underline">
                    @if($ctg =$data->category)
                  <a class="btn btn_underline link-strong link-strong-unhovered" href="{{route('productCategory',$ctg->slug?:'no-title')}}">See All Product
                   <svg>
                     <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#arrow')}}"></use>
                   </svg>
                  </a>
                  <a class="btn btn_underline link-strong link-strong-hovered" href="{{route('productCategory',$ctg->slug?:'no-title')}}">See All Product
                   <svg>
                     <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#arrow')}}"></use>
                   </svg>
                   </a>
                   @endif
                </div>
             </div>
           </div>
           <div class="col-xxl-3 col-lg-6 col-12 order-xxl-1 order-2"> 
            
            @php
                $chunks = $data->products()->chunk(2);
                $chunk1 = $chunks->get(0);
                $chunk2 = $chunks->get(1);
            @endphp
           
           
             <div class="row gy-4"> 
                @foreach($chunk1 ?? [] as $product)
               <div class="col-lg-12 col-md-6 col-12"> 
                 <div class="flash-content">
                    <img class="img-fluid" style="max-width: 150px;" src="{{assetUrl($product->image())}}" alt="{{$product->name}}" />
                    <div> 
                     <ul> 
                       <li>
                         <svg>
                           <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#star')}}"></use>
                         </svg>
                       </li>
                       <li>
                         <svg>
                           <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#star')}}"></use>
                         </svg>
                       </li>
                       <li>
                         <svg>
                           <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#star')}}"></use>
                         </svg>
                       </li>
                       <li>
                         <svg>
                           <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#star')}}"></use>
                         </svg>
                       </li>
                       <li>
                         <svg>
                           <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#star')}}"></use>
                         </svg>
                       </li>
                       <li>4.3 </li>
                     </ul>
                     <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}">
                       <h6>{{$product->name}}</h6>
                      </a>
                     <h6>{{priceFullFormat($product->offerPrice())}}</h6>
                   </div>
                 </div>
               </div>
               @endforeach
               
               
               <!--<div class="col-lg-12 col-md-6 col-12"> -->
               <!--  <div class="flash-content"><img class="img-fluid" src="{{assetUrl('public/welcome/assets/images/banner/7.jpg')}}" alt="" />-->
               <!--    <div> -->
               <!--      <ul> -->
               <!--        <li>-->
               <!--          <svg>-->
               <!--            <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#star')}}"></use>-->
               <!--          </svg>-->
               <!--        </li>-->
               <!--        <li>-->
               <!--          <svg>-->
               <!--            <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#star')}}"></use>-->
               <!--          </svg>-->
               <!--        </li>-->
               <!--        <li>-->
               <!--          <svg>-->
               <!--            <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#star')}}"></use>-->
               <!--          </svg>-->
               <!--        </li>-->
               <!--        <li>-->
               <!--          <svg>-->
               <!--            <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#star')}}"></use>-->
               <!--          </svg>-->
               <!--        </li>-->
               <!--        <li>-->
               <!--          <svg>-->
               <!--            <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#star')}}"></use>-->
               <!--          </svg>-->
               <!--        </li>-->
               <!--        <li>4.3 </li>-->
               <!--      </ul><a href="product.html">-->
               <!--        <h6>Greciilooks Women's Stylish Top  </h6></a>-->
               <!--      <h6>$100.00-->
               <!--        <del>$140.00 </del>-->
               <!--      </h6>-->
               <!--    </div>-->
               <!--    <div class="flash-lable">  <span>-20% </span></div>-->
               <!--  </div>-->
               <!--</div>-->
               
             </div>
           </div>
           <div class="col-xxl-6 col-lg-6 col-12 order-xxl-2 order-1">
             <div class="flash-images ratio50_2">
                <a href="{{$data->image_link?:'javascript:void(0)'}}">
                    <img class="bg-img" src="{{assetUrl($data->image())}}" alt="{{$data->name}}" />
                </a>
               <div class="banner-2"> 
                 @if($data->sub_title)
                 <h3>{{$data->sub_title}}</h3>
                 @endif
                 
                 @if($data->name)
                 <h5>{{$data->name}}</h5>
                 @endif
                 <div class="countdown">
                   <ul class="clockdiv8">
                     <li> 
                       <div class="timer">
                         <div class="days"></div>
                       </div><span class="title">Days </span>
                     </li>
                     <li class="dot">  <span>  </span><span></span></li>
                     <li> 
                       <div class="timer">
                         <div class="hours"></div>
                       </div><span class="title">Hours </span>
                     </li>
                     <li class="dot">  <span>  </span><span></span></li>
                     <li> 
                       <div class="timer">
                         <div class="minutes"></div>
                       </div><span class="title">Min </span>
                     </li>
                     <li class="dot">  <span>  </span><span></span></li>
                     <li> 
                       <div class="timer">
                         <div class="seconds"></div>
                       </div><span class="title">Sec </span>
                     </li>
                   </ul>
                 </div>
                 @if($data->image_link)
                 <div class="link-hover-anim underline">
                     <a class="btn btn_underline link-strong link-strong-unhovered" href="{{$data->image_link}}">Shop Collection
                     <svg>
                       <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                     </svg>
                     </a>
                     <a class="btn btn_underline link-strong link-strong-hovered" href="{{$data->image_link}}">Shop Collection
                     <svg>
                       <use href="../assets/svg/icon-sprite.svg#arrow"></use>
                     </svg>
                     </a>
                </div>
                @endif
                
               </div>
             </div>
           </div>
           <div class="col-xxl-3 col-12 order-xxl-3 order-3">
             <div class="row gy-4">
                @foreach($chunk2 ?? [] as $product)
                <div class="col-xxl-12 col-md-6 col-12"> 
                 <div class="flash-content">
                     <img class="img-fluid" style="max-width: 150px;" src="{{assetUrl($product->image())}}" alt="{{$product->name}}" />
                   <div> 
                     <ul> 
                       <li>
                         <svg>
                           <use href="../assets/svg/icon-sprite.svg#star"></use>
                         </svg>
                       </li>
                       <li>
                         <svg>
                           <use href="../assets/svg/icon-sprite.svg#star"></use>
                         </svg>
                       </li>
                       <li>
                         <svg>
                           <use href="../assets/svg/icon-sprite.svg#star"></use>
                         </svg>
                       </li>
                       <li>
                         <svg>
                           <use href="../assets/svg/icon-sprite.svg#star"></use>
                         </svg>
                       </li>
                       <li>
                         <svg>
                           <use href="../assets/svg/icon-sprite.svg#star"></use>
                         </svg>
                       </li>
                       <li>4.3 </li>
                     </ul>
                     <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}">
                       <h6>{{$product->name}}</h6>
                      </a>
                     <h6>{{priceFullFormat($product->offerPrice())}}</h6>
                   </div>
                   <div class="flash-lable">  <span>-30% </span></div>
                 </div>
               </div>
                @endforeach
               
             </div>
           </div>
         </div>
       </div>
     </section>
    @endforeach
    
     <section class="section-t-space">
       <div class="container-fluid">
         <div class="row align-items-center">
           <div class="col-sm-3 col-6">
             <div class="brand-logo-txt">
               <div>    
                 <h3>Top Brands  </h3>
                 <h4>Up to 40% off </h4>
                 <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="index.html">Shop Now
                     <svg>
                       <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#arrow')}}"></use>
                     </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="#">Shop Now
                     <svg>
                       <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#arrow')}}"></use>
                     </svg></a></div>
               </div>
             </div>
           </div>
           <div class="col-sm-9 col-6 p-0">
               @if($brands->count() > 0)
             <div class="swiper slide-2">
               <div class="swiper-wrapper">
                 @foreach($brands as $i=>$brd)
                 <div class="swiper-slide logo-block"><a href="#">  <img src="{{assetUrl($brd->image())}}" alt="{{$brd->name}}" /></a></div>
                @endforeach
             </div>
           </div>
           @endif
         </div>
       </div>
     </section>
     
     
     {{--<section class="section-t-space ratio3_3">
       <div class="container-fluid subscribe-banner">
         <div class="row align-items-center">
           <div class="col-xl-8 col-md-7 col-12 px-0">  <a href="index.html"><img class="bg-img" src="{{assetUrl('public/welcome/assets/images/banner/banner-6.png')}}" alt="" /></a></div>
           <div class="col-xl-4 col-5">
             <div class="subscribe-content">
               <h6>GET 20% OFF </h6>
               <h4>Subscribe to Our Newsletter! </h4>
               <p>Join the insider list - youâ€™ll be the first  know about new arrivals,  - only discounts and  $15 off your first . </p>
               <input type="text" name="text" placeholder="Your email address..." />
               <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="index.html">Subscribe Now
                   <svg>
                     <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#arrow')}}"></use>
                   </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="index.html">Subscribe Now
                   <svg>
                     <use href="{{assetUrl('public/welcome/assets/svg/icon-sprite.svg#arrow')}}"></use>
                   </svg></a></div>
             </div>
           </div>
         </div>
       </div>
     </section>--}}
     
     
     <section class="section-b-space pt-0 mt-4"> 
       <div class="custom-container container blog-page">
           <h3 class="mt-2 mb-3">Blogs</h3>
         <div class="row blog-no-sidebar">
           <div class="col-12 ratio50_2">
             <div class="row gy-4 sticky">
                @foreach($latestPosts as $post)
                
               <div class="col-lg-4 col-md-6">
                    @include(welcomeTheme().'blogs.includes.blogGrid')
               </div>
               @endforeach

             </div>
           </div>
         </div>
       </div>
     </section>



















@endsection 
@push('js') 

<script type="text/javascript">
    $(document).ready(function () {
        
        
        
        // $('.hero-sectionClick').on('click', function(e){
        //     e.preventDefault(); // prevent default behavior
    
        //     // scroll target
        //     var target = $('#hero-section'); // your section class
        //     if(target.length){
        //         // calculate offset top minus 140px
        //         var scrollTo = target.offset().top - 240;
    
        //         // smooth scroll
        //         $('html, body').animate({
        //             scrollTop: scrollTo
        //         }, 100); // 800ms animation
        //     }
        // });
        

        if ($('#OfferModal').length > 0) {
    
            let today = new Date().toISOString().split('T')[0]; // YYYY-MM-DD
            let lastShownDate = localStorage.getItem('offerModalShownDate');
    
            if (lastShownDate !== today) {
    
                setTimeout(function () {
                    $('#OfferModal').modal('show');
                    localStorage.setItem('offerModalShownDate', today);
                }, 1000);
    
            }
        }
        
        
        const second = 1000,
              minute = second * 60,
              hour = minute * 60,
              day = hour * 24;

        // Get the date from the data attribute (d/m/Y format from Carbon)
        let birthday = $('.mainOfferq').data('date');

        // Split the date (d/m/Y) into day, month, year
        let dateParts = birthday.split('/');
        let dayOfMonth = dateParts[0];
        let month = dateParts[1] - 1; // Month is 0-based in JavaScript (0 = January)
        let year = dateParts[2];

        // Create a JavaScript Date object in MM/DD/YYYY format
        let formattedBirthday = new Date(year, month, dayOfMonth).getTime();

        // Get today's date in MM/DD/YYYY format
        let today = new Date(),
            dd = String(today.getDate()).padStart(2, '0'),
            mm = String(today.getMonth() + 1).padStart(2, '0'),
            yyyy = today.getFullYear();

        today = mm + '/' + dd + '/' + yyyy;

        // If today's date is greater than the birthday, set the birthday to the next year
        if (today > birthday) {
            formattedBirthday = new Date(yyyy + 1, month, dayOfMonth).getTime();
        }

        // Countdown target date
        const countDown = formattedBirthday;

        // Update the countdown every second
        const x = setInterval(function () {
            const now = new Date().getTime(),
                  distance = countDown - now;

            $('#days').text(Math.floor(distance / day));
            $('#hours').text(Math.floor((distance % day) / hour));
            $('#minutes').text(Math.floor((distance % hour) / minute));
            $('#seconds').text(Math.floor((distance % minute) / second));

            // If the countdown reaches 0, display the message and hide countdown
            if (distance < 0) {
                $('#headline').text("Today is the Day!");
                $('#countdown').hide();
                $('#content').show();
                clearInterval(x);
            }
        }, 1000);
    });
</script>

@endpush