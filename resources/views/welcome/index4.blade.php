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
    .prod-price del {
    color: #000;
    margin-left: 14px;
}
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
    @media (max-width: 768px) {
       .prod-price del {
            color: #000;
             margin-left: 0px; 
            display: block;
        }
    }
</style>
@endpush 
@section('contents')


   <!--Slider Part Include Start-->
   @include(general()->theme.'.layouts.slider')



<div class="custom-container ">
    
    <div class="title-section">
    <div class="title-line"></div>
    <div class="title">POPULAR CATEGORY</div>
</div>
    

  <!--<div class="homeCtg">-->
  <!--    <div class="row" style="margin:0 -5px;">-->
  <!--          @foreach($category as $hCtg)-->
  <!--          <div class="col-md-3 col-6" style="padding:5px;">-->
  <!--              <a href="{{route('productCategory',$hCtg->slug?:'no-title')}}" class="deatVtgGrid">-->
  <!--                  <img src="{{assetUrl($hCtg->image())}}" alt="{{$hCtg->name}}" />-->
  <!--                  <p>{{$hCtg->name}}</p>-->
  <!--              </a>-->
  <!--          </div>-->
  <!--          @endforeach-->
  <!--          </div>-->
  <!--</div>-->
  
  
  <div class="homeCtg">

    <!-- Skeleton -->
    <div class="row skeleton-category" style="margin:0 -5px;">
        @for($i=0; $i<8; $i++)
        <div class="col-md-3 col-6" style="padding:5px;">
            <div class="cat-skeleton">
                <div class="sk-img"></div>
                <div class="sk-line"></div>
            </div>
        </div>
        @endfor
    </div>

    <!-- REAL CATEGORY -->
    <div class="row real-category d-none" style="margin:0 -5px;">
        @foreach($category as $hCtg)
        <div class="col-md-3 col-6" style="padding:5px;">
            <a href="{{ route('productCategory',$hCtg->slug?:'no-title') }}" class="deatVtgGrid">
                <img src="{{ assetUrl($hCtg->image()) }}" alt="{{ $hCtg->name }}" loading="lazy" />
                <p>{{ $hCtg->name }}</p>
            </a>
        </div>
        @endforeach
    </div>

</div>
    


  <!-- CHAIR SECTION -->
   @foreach($category as $hCtg)
  <div class="homePageProductLayout">
      
 
 <div class="container">
     <div class="title-section">
    <div class="title-line"></div>
    <div class="title">{{$hCtg->name}}</div>
</div>
 </div>
  
  
   @php
        $products = App\Models\Post::whereHas('ctgProducts',function($q) use($hCtg){
            $q->where('reff_id',$hCtg->id);
          })
                    ->latest()
                    ->limit(4)
                    ->get();
    @endphp



  
  
  
  <!--<div class="row g-3 mb-4">-->
  <!--     @foreach($products as $product)-->
  <!--  <div class="col-6 col-md-3">-->
  <!--    <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}" class="prod-card card">-->
  <!--      <div class="img-box">-->
  <!--        <img src="{{assetUrl($product->image())}}" alt="Chair"/>-->
  <!--      </div>-->
  <!--      <div class="card-body">-->
  <!--        <div class="prod-name">{{$product->name}}</div>-->
  <!--        <div class="prod-price">{{priceFullFormat($product->offerPrice())}}/-</div>-->
  <!--      </div>-->
  <!--    </a>-->
  <!--  </div>-->
  <!--    @endforeach-->
  <!--</div>-->
  
  
<div class="row g-3 mb-4 product-wrapper">

    <!-- Skeleton -->
    <div class="col-12 skeleton-container">
        <div class="row g-3">
            @for($i=0; $i<4; $i++)
            <div class="col-6 col-md-3">
                <div class="card skeleton-card">
                    <div class="skeleton-img"></div>
                    <div class="skeleton-line"></div>
                    <div class="skeleton-line short"></div>
                </div>
            </div>
            @endfor
        </div>
    </div>

    <!-- Real Products -->
    <div class="col-12 real-products d-none">
        <div class="row g-3">
            @foreach($products as $product)
            <div class="col-6 col-md-3">
                <a href="{{ route('productView',$product->slug?:Str::slug($product->name)) }}" class="prod-card card">
                    <div class="img-box">
                        <img src="{{ assetUrl($product->image()) }}" loading="lazy">
                    </div>
                    <div class="card-body">
                        <div class="prod-name">{{ $product->name }}</div>
                        <div class="prod-price">
                            {{ priceFullFormat($product->offerPrice()) }}/-
                            
                             @if($product->regularPrice() > $product->offerPrice())
                        <del>{{priceFullFormat($product->regularPrice())}}/-</del>
                        @endif 
                        
                         <span>({{$product->discountPercent()}}%)</span>
                            </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

</div>
  
  
  
  
  
  
  

 </div>
   @endforeach

</div><!-- /container -->


    <section class="section-t-space mb-5">
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




















@endsection 
@push('js') 


<script>
    (function ($) {

    $.fn.lazyObserver = function (callback) {

        let observer = new IntersectionObserver(function (entries, obs) {

            entries.forEach(entry => {

                if (entry.isIntersecting) {

                    let el = $(entry.target);
                    callback.call(entry.target, el);

                    obs.unobserve(entry.target);
                }

            });

        }, {
            threshold: 0.2
        });

        return this.each(function () {
            observer.observe(this);
        });

    };

})(jQuery);
</script>

<script>
  $(".homeCtg").lazyObserver(function (wrapper) {

    wrapper.find(".skeleton-category").fadeOut(200);
    wrapper.find(".real-category")
        .removeClass("d-none")
        .hide()
        .fadeIn(300);

});
</script>



<script>
(function ($) {

    $.fn.lazyObserver = function (callback) {

        let observer = new IntersectionObserver((entries, obs) => {

            entries.forEach(entry => {

                if (entry.isIntersecting) {

                    callback.call(entry.target, entry);

                    // STOP observing properly
                    obs.unobserve(entry.target);
                }

            });

        }, {
            threshold: 0.2
        });

        return this.each(function () {
            observer.observe(this);
        });

    };

})(jQuery);


</script>


<script>
    $(".product-wrapper").lazyObserver(function () {

    let wrapper = $(this);

    wrapper.find(".skeleton-container").fadeOut(200);
    wrapper.find(".real-products").removeClass("d-none").hide().fadeIn(300);

});
</script>

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