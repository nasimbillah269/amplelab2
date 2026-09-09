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

<!--Slider Part Include Start-->
@include(general()->theme.'.layouts.slider')



@if($featuredText)
<div class="punchLine">
    <div class="container">
        <div class="row" style="margin:0 -5px">
            <div class="col-md-2 col-6" style="padding:5px">
                <div class="punchBox">
                    <div class="punchBoxItem">
                        <div class="">
                            <!--<div class="ecoInfoIcon"><i class="fa fa-apple" aria-hidden="true"></i></div>-->
                            <div class="ecoInfoIcon"><img src="{{assetUrl('public/welcome/images/apple-icon.png')}}" alt="icon-image"/></div>
                        </div>
                        <div class="">
                            <h5>Apple Reseller </h5>
                           
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-6" style="padding:5px">
                <div class="punchBox">
                    <div class="punchBoxItem">
                        <div class="">
                            <!--<div class="ecoInfoIcon"> <i class="fa-solid fa-award"></i></div>-->
                             <div class="ecoInfoIcon"><img src="{{assetUrl('public/welcome/images/Layer_2.png')}}" alt="icon-image"/></div>
                        </div>
                        <div class="">
                            <h5>100% Genuine Products </h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-6" style="padding:5px">
                <div class="punchBox">
                    <div class="punchBoxItem">
                        <div class="">
                             <!--<div class="ecoInfoIcon"> <i class="fa-solid fa-truck-fast"></i>  </div>-->
                               <div class="ecoInfoIcon"><img src="{{assetUrl('public/welcome/images/head].png')}}" alt="icon-image"/></div>
                        </div>
                        <div class="">
                            <h5>Fast Delivery</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-6" style="padding:5px">
                <div class="punchBox">
                    <div class="punchBoxItem">
                        <div class="">
                            
                              <!--<div class="ecoInfoIcon"> <i class="fa-solid fa-headset"></i> </div>-->
                               <div class="ecoInfoIcon"><img src="{{assetUrl('public/welcome/images/Layer_3.png')}}" alt="icon-image"/></div>
                        </div>
                        <div class="">
                            <h5>24/7 Customer Service</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6" style="padding:5px">
                <div class="punchBox">
                    <div class="punchBoxItem">
                        <div class="punchBoxItem">
                            <!--<div class="ecoInfoIcon"> <i class="fa-solid fa-percent"></i></div>-->
                                 <div class="ecoInfoIcon"><img src="{{assetUrl('public/welcome/images/Layer_4.png')}}" alt="icon-image"/></div>
                        </div>
                        <div class="">
                            <h5>Flexible EMI Policy</h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endif


<div class="flasOffer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="sectionHeader">
                   
                     <div>
                          <div class="header-badge">Supper Offer</div>
                            <h1 class="flash-title">Flash Sale</h1>
                     </div>
                     <div>
                         
                     </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            @foreach($bannerGroupOne as $i=>$data)
            <div class="col-md-4">
                <a href="{{$data->image_link}}" class="flasOfferBox" target="_blank" >
                     <img src="{{assetUrl($data->image())}}"  alt="{{$data->name}}" />   
                </a>
            </div>
            @endforeach

        </div>
        
    </div>
</div>




<div class="featuredCtgs">
    <div class="container">
      
         <div class="sectionHeader">
             <div>
                  <div class="header-badge" style="border-left: 4px solid #0BA350;">Categories</div>
                    <h1 class="flash-title">Browsing Top Categories</h1>
             </div>
             <div class="viewLink">
                 <!--<a href="#">View All</a>-->
             </div>
        </div>
        <div class="">
            <div class="row" style="margin:0 -5px;">
            @foreach($category as $hCtg)
            <div class="col-md-2 col-6" style="padding:5px;">
                <a href="{{route('productCategory',$hCtg->slug?:'no-title')}}" class="deatVtgGrid">
                    <img src="{{assetUrl($hCtg->image())}}" alt="{{$hCtg->name}}" />
                     <img class="hoverImg" src="{{assetUrl($hCtg->hoverImage())}}" alt="{{$hCtg->name}}" />   
                    <p>{{$hCtg->name}}</p>
                </a>
            </div>
            @endforeach
            </div>
        </div>
    </div>
</div>



@include(general()->theme.'.layouts.featuredProductTab')

{{--@foreach($largeBannerOne as $data)
<div class="smartPart">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="smartPartImg">
                    <img src="{{assetUrl($data->image())}}" alt="{{$data->name}}" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="smartContent">
                    <span>{!!$data->sub_title!!}</span>
                    <h1>
                        {!!$data->name!!}
                    </h1>
                    <p>
                    {!!$data->description!!}
                    </p>
                    @if($data->image_link)
                    <a href="{{$data->image_link}}">Shop Now</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach--}}




@if($bannerGroupTwo->count() > 0)
<div class="twoPartBanner">
    <div class="container">
        <div class="row">
            @foreach($bannerGroupTwo as $i=>$data)
            <div class="col-md-6">
                {{--<div class="rightOfferBox {{$i % 2 === 0?'':'blackBox'}}">
                    <h1>{!!$data->name!!}</h1>
                    <p>
                       {!!$data->sub_title!!}
                    </p>
                    @if($data->image_link)
                    <a href="{{$data->image_link}}">Shop Now <i class="fa fa-long-arrow-right"></i></a>
                    @endif
                    <div class="newleftArImg">
                        <img src="{{assetUrl($data->image())}}" alt="{{$data->name}}" /><img src="{{assetUrl($data->image())}}" alt="{{$data->name}}" /><img src="{{assetUrl($data->image())}}" alt="{{$data->name}}" />
                    </div>
                </div>--}}
                <div class="rightOfferBox {{$i % 2 === 0?'':'blackBox'}}">
                    <a href="{{$data->image_link}}" target="_blank">
                        <img src="{{assetUrl($data->image())}}" alt="{{$data->name}}" />
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@foreach($categoryGroupOne as $data)
<div class="allProd" style="background: white;">
    <div class="container">
        <div class="row">
            
            
              <div class="sectionHeader">
                 <div>
                        <h1 class="flash-title">{!!$data->name!!}</h1>
                 </div>
                 <div class="viewLink">
                      @if($ctg =$data->category)
                    <a href="{{route('productCategory',$ctg->slug?:'no-title')}}" style="border: 1px solid #000; padding: 5px 25px; border-radius: 20px;" >View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    @endif
                    
                 </div>
            </div>
           
            <div class="col-md-12">
                <div class="row productRow">
                    @foreach($data->products() as $product)
                    <div class="col-md-3 col-6">
                        @include(welcomeTheme().'.products.includes.productCard')
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach


@foreach($largeBannerTwo as $data)
<div class="bannerMiddlw">
    <div class="container-fluid">
        <a href="{{$data->image_link?:'javascript:void(0)'}}"  target="_blank" >
            <img src="{{assetUrl($data->image())}}" alt="{{$data->name}}" />
        </a>
    </div>
</div>
@endforeach

@foreach($categoryGroupTwo as $data)
<div class="allProd" style="background: white;">
    <div class="container">
        <div class="row">
               <div class="sectionHeader">
                     <div>
                        <h1 class="flash-title">{!!$data->name!!}</h1>
                     </div>
                     <div class="viewLink">
                          @if($ctg =$data->category)
                        <a href="{{route('productCategory',$ctg->slug?:'no-title')}}" style="border: 1px solid #000; padding: 5px 25px; border-radius: 20px;" >View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        @endif
                        
                     </div>
                </div>
            <div class="col-md-12">
                <hr />
            </div>
            <div class="col-md-12">
                <div class="row productRow">
                    @foreach($data->products() as $product)
                    <div class="col-md-3 col-6">
                        @include(welcomeTheme().'.products.includes.productCard')
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach


@if($bannerGroupThree->count() > 0)
<div class="twoPartBanner">
    <div class="container">
        <div class="row">
            @foreach($bannerGroupThree as $i=>$data)
            <div class="col-md-6">
                <div class="rightOfferBox {{$i % 2 === 0?'':'blackBox'}}">
                    <a href="{{$data->image_link}}" target="_blank" >
                        <img src="{{assetUrl($data->image())}}" alt="{{$data->name}}" />
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif




@if($data =$timeOfferBanner)
@php
    $expiryDate = Carbon\Carbon::parse($data->created_at)->addDays($data->data_limit);
@endphp

@if($expiryDate->isFuture())
 <!-- Hero Section -->
<section class="hero-section" id="offers">
    <div class="dHeroBg" style="background-image: url('{{assetUrl('public/welcome/images/Group 136.png')}}'); background-repeat: no-repeat; background-position: center;background-size: cover;">
        <div class="dHeroBgOverlyContent">
            <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 hero-content">
                <h1 class="deal-title">
                    {!!$data->name!!}
                </h1>
                <p class="hero-subtitle">
                    {!!$data->description!!}
                </p>
                <div class="countdown-timer mainOfferq" data-date="{{$expiryDate->format('d/m/Y')}}"  >
                    <div class="timer-block">
                        <span class="timer-value" id="days"></span>
                        <span class="timer-label">Day</span>
                    </div>
                    <span class="timer-separator">-</span>
                    <div class="timer-block">
                        <span class="timer-value" id="hours"></span>
                        <span class="timer-label">Hrs</span>
                    </div>
                    <span class="timer-separator">-</span>
                    <div class="timer-block">
                        <span class="timer-value" id="minutes"></span>
                        <span class="timer-label">Min</span>
                    </div>
                    <span class="timer-separator">-</span>
                    <div class="timer-block">
                        <span class="timer-value" id="seconds"></span>
                        <span class="timer-label">Sec</span>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="row">
                <div class="col-md-5">
                    <div class="dicountHeroGrid">
                       <div class="offerHead">
                            <small>Supper Offer</small>
                            <h5>{!!$data->sub_title!!}</h5>
                       </div>
                         <img src="{{assetUrl($data->image())}}"  alt="Bytebliss" />   
                        @if($data->image_link)
                        <a href="{{$data->image_link}}" target="_blank" >Browse Products</a>
                        @endif
                    </div>
                </div>
                <div class="col-md-7">
                        
                        {{--
                        @foreach($data->products()->take(2) as $product)
                        <div class="disHeroCard">
                            <div class="row">
                                <div class="col-4">
                                    <div class="dicHeroGridLeft">
                                        <span>-20%</span>
                                         <img src="{{assetUrl($product->image())}}" alt="{{$product->name}}" />   
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="dicHeroGridRight">
                                        <p>{{$product->name}}</p>
                                        <span>{{priceFullFormat($product->offerPrice())}}/-</span>
                                        <a  style="display: inline-block;width: unset;padding: 5px 15px;"
                                        @if($product->variation_status)
                                            href="{{route('productView',$product->slug?:Str::slug($product->name))}}"
                                            @else
                                            href="javascript:void(0)"
                                            @endif
                                            data-id="{{$product->id}}" data-url="{{route('addToCart',$product->id)}}" 
                                            class="addCart {{$product->variation_status?'':'ajaxaddToCart'}}"
                                        >Add To Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        --}}
                        
                        <div class="disHeroCard p-0">
                            <a href="{{$data->image_link2?:'javascript:void(0)'}}" target="_blank">
                                <img src="{{assetUrl($data->banner())}}"  alt="Supper Offer" style="max-width: 100%;border-radius: 10px;" >
                            </a>
                        </div>
                        
                        <div class="disHeroCard p-0">
                            <a href="{{$data->image_link3?:'javascript:void(0)'}}" target="_blank">
                                <img src="{{assetUrl($data->banner2())}}" alt="Supper Offer" style="max-width: 100%;border-radius: 10px;" >
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
    
</section>

@endif
@endif



@if($brands->count() > 0)


@include(general()->theme.'.layouts.brandsProduct')


@endif


@if($bannerGroupFour->count() > 0)
<div class="homeLastOfferLayout">
    <div class="container">
        <div class="row">
            @foreach($bannerGroupFour as $i=>$data)
            <div class="col-md-{{$i % 2 === 0?'4':'8'}}">
                <a href="{{$data->image_link}}" class="homeLastOfferGrid" target="_blank" >
                     <img src="{{assetUrl($data->image())}}" alt="{{$data->name}}" />   
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@if($page->description)
<div class="homeSeoContent">
    <div class="container">
        <div class="homeTextBox pageContents">
            {!!$page->description!!}
        </div>
    </div>
</div>
@endif

@if($hasOffer=App\Models\PostExtra::where('type',6)->where('status','active')->first())

<div class="modal fade" id="OfferModal" style="z-index: 99999;">
  <div class="modal-dialog modal-dialog-centered modal-lg modalReSize">
    <div class="modal-content">
      <div class="modal-body" style="padding:0;">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute;right: -10px;top: -10px;border: 1px solid #ffffff;background-color: #bcb6b6;"></button>
        <a href="{{$hasOffer->sub_title?:'javascript:void(0)'}}"  >
            <img src="{{assetUrl($hasOffer->image())}}" alt="{{$hasOffer->name}}" style="width:100%;">
        </a>
      </div>
    </div>
  </div>
</div>
@endif

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