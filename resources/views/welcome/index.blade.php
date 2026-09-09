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

</style>
@endpush 
@section('contents')


   <!--Slider Part Include Start-->
   @include(general()->theme.'.layouts.slider')




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

        <div class="text-center mt-5">
            <a href="{{ route('pageView', 'all-categories') }}" class="btn-al-primary">
                View All Categories
                <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>
        </div>

    </div>
</section>
@endif




<!-- ===== Featured Products ===== -->



{{--<section class="bg-soft">
  <div class="container">
    <div class="section-heading">
      <h2>Featured Products</h2>
      <div class="heading-divider"></div>
    </div>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
      <div class="filter-tabs">
        <button class="btn active-filter">All Products</button>
        <button class="btn"><i class="fa-solid fa-circle-check text-success me-1"></i>Ready Stock</button>
        <button class="btn"><i class="fa-solid fa-cart-shopping me-1"></i>Pre Order</button>
      </div>
      <div class="d-flex align-items-center gap-2">
        <div class="search-box">
          <input type="text" placeholder="Search products...">
          <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <button class="arrow-btn"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="arrow-btn"><i class="fa-solid fa-chevron-right"></i></button>
      </div>
    </div>

    <div class="row g-3">
        
     @foreach($featuresProducts as $product)
     <div class="col-6 col-md-4 col-lg-2">
        @include(welcomeTheme().'products.includes.productCard')
    </div>
    @endforeach
    </div>

</div>
</section>--}}

<!-- ===== Featured Products ===== -->
<section class="bg-soft">
    <div class="container">

        <div class="section-heading">
            <h2>Featured Products</h2>
            <div class="heading-divider"></div>
        </div>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <!-- Filter Tabs -->
            <div class="filter-tabs">

                <button type="button"
                        class="btn active-filter product-filter"
                        data-filter="all">
                    All Products
                </button>

                <button type="button"
                        class="btn product-filter"
                        data-filter="ready">
                    <i class="fa-solid fa-circle-check text-success me-1"></i>
                    Ready Stock
                </button>

                <button type="button"
                        class="btn product-filter"
                        data-filter="preorder">
                    <i class="fa-solid fa-cart-shopping me-1"></i>
                    Pre Order
                </button>

            </div>


            <!-- Search + Arrows -->
            <div class="d-flex align-items-center gap-2">

                <div class="search-box">
                    <input type="text"
                           id="productSearch"
                           placeholder="Search products...">

                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>

                <!-- Previous -->
                <button type="button"
                        class="arrow-btn product-prev">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <!-- Next -->
                <button type="button"
                        class="arrow-btn product-next">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>

            </div>

        </div>


        <!-- Products -->
        <div class="row g-3" id="featuredProducts">

            @foreach($featuresProducts as $product)

                @php
                    $stockType = $product->stock_status ?? 'ready';
                @endphp

                <div class="col-6 col-md-4 col-lg-2 product-item"
                     data-stock="{{ strtolower($stockType) }}"
                     data-name="{{ strtolower($product->title ?? $product->name ?? '') }}">

                    @include(welcomeTheme().'products.includes.productCard')

                </div>

            @endforeach

        </div>

        <div id="noProductsFound"
             class="text-center py-5"
             style="display:none;">
            <h5 class="text-muted">No products found.</h5>
        </div>

    </div>
</section>



<!-- ===== Info strip ===== -->
<section class="info-strip py-4">
  <div class="container">
    <div class="row g-4">
      <div class="col-6 col-lg-2">
        <div class="info-item">
          <div class="ic"><i class="fa-solid fa-box"></i></div>
          <div>
            <span class="ttl">Ready Stock</span>
            <span class="sub">Products available for immediate delivery</span>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-2">
        <div class="info-item">
          <div class="ic"><i class="fa-solid fa-cart-shopping"></i></div>
          <div>
            <span class="ttl">Pre Order</span>
            <span class="sub">Order now, we deliver on time</span>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-2">
        <div class="info-item">
          <div class="ic"><i class="fa-solid fa-circle-check"></i></div>
          <div>
            <span class="ttl">Quality Assured</span>
            <span class="sub">100% quality products from trusted brands</span>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-2">
        <div class="info-item">
          <div class="ic"><i class="fa-solid fa-tags"></i></div>
          <div>
            <span class="ttl">Competitive Price</span>
            <span class="sub">Best value for money for every institution</span>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-2">
        <div class="info-item">
          <div class="ic"><i class="fa-solid fa-people-carry-box"></i></div>
          <div>
            <span class="ttl">Installation &amp; Training</span>
            <span class="sub">Professional installation &amp; training support</span>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-2">
        <div class="info-item">
          <div class="ic"><i class="fa-solid fa-headset"></i></div>
          <div>
            <span class="ttl">After Sales Support</span>
            <span class="sub">Reliable after sales service &amp; support</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== Brands ===== -->

@if($brands->count())
<section>

  <div class="container text-center">
    <h2 class="fw-bold mb-1" style="font-size:1.6rem;">We Work With International Brands</h2>
    <p class="text-muted mb-4">Delivering trusted quality through global partnerships</p>
    <div class="row g-3 justify-content-center">
      @foreach($brands as $brand)
      <div class="col-6 col-md-2">
        <a href="{{ route('productBrand', $brand->slug ?: 'no-title') }}" class="brand-box text-decoration-none" style="font-family:Georgia,serif;">
          @if($brand->imageFile)
          <img src="{{ assetUrl($brand->image()) }}" alt="{{ $brand->name }}" style="max-height:64px; max-width:100%; object-fit:contain;">
          @else
          {{ $brand->name }}
          @endif
        </a>
      </div>
      @endforeach
    </div>
    <a href="{{ route('pageView', 'all-brands') }}" class="btn-al-primary d-inline-block mt-4">View All Brands</a>
  </div>

</section>
@endif



<!-- ===== Stats ===== -->
<div class="stats-bar">
  <div class="container">
    <div class="row g-4">
      <div class="col-6 col-lg-3">
        <div class="stat-item" style="background-color: unset;">
          <i class="fa-solid fa-building"></i>
          <div><div class="num">500+</div><div class="lbl">Projects Completed</div></div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="stat-item" style="background-color: unset;">
          <i class="fa-solid fa-users"></i>
          <div><div class="num">1000+</div><div class="lbl">Happy Customers</div></div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="stat-item" style="background-color: unset;">
          <i class="fa-solid fa-cubes"></i>
          <div><div class="num">2000+</div><div class="lbl">Products</div></div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="stat-item" style="background-color: unset;">
          <i class="fa-solid fa-award"></i>
          <div><div class="num">10+</div><div class="lbl">Years of Experience</div></div>
        </div>
      </div>
    </div>
  </div>
</div>




@endsection 
@push('js') 


<script>
    $(document).ready(function () {

    /*
    |--------------------------------------------------------------------------
    | Initialize Slick Slider
    |--------------------------------------------------------------------------
    */

    $('#featuredProducts').slick({

        slidesToShow: 6,
        slidesToScroll: 1,

        infinite: false,

        arrows: false,

        dots: false,

        speed: 500,

        responsive: [

            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 5
                }
            },

            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4
                }
            },

            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            },

            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2
                }
            }

        ]

    });


    /*
    |--------------------------------------------------------------------------
    | Custom Previous Arrow
    |--------------------------------------------------------------------------
    */

    $('.product-prev').on('click', function () {

        $('#featuredProducts').slick('slickPrev');

    });


    /*
    |--------------------------------------------------------------------------
    | Custom Next Arrow
    |--------------------------------------------------------------------------
    */

    $('.product-next').on('click', function () {

        $('#featuredProducts').slick('slickNext');

    });


    /*
    |--------------------------------------------------------------------------
    | Disable / Enable Custom Arrows
    |--------------------------------------------------------------------------
    */

    $('#featuredProducts').on(
        'afterChange',
        function (event, slick, currentSlide) {

            updateArrowState(slick, currentSlide);

        }
    );


    function updateArrowState(slick, currentSlide) {

        let totalSlides = slick.slideCount;
        let slidesToShow = slick.options.slidesToShow;

        if (currentSlide <= 0) {

            $('.product-prev').addClass('slick-disabled');

        } else {

            $('.product-prev').removeClass('slick-disabled');

        }


        if (currentSlide + slidesToShow >= totalSlides) {

            $('.product-next').addClass('slick-disabled');

        } else {

            $('.product-next').removeClass('slick-disabled');

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Initial Arrow State
    |--------------------------------------------------------------------------
    */

    let slickInstance = $('#featuredProducts').slick('getSlick');

    updateArrowState(
        slickInstance,
        slickInstance.currentSlide
    );


    /*
    |--------------------------------------------------------------------------
    | Product Filter
    |--------------------------------------------------------------------------
    */

    $('.product-filter').on('click', function () {

        $('.product-filter').removeClass('active-filter');

        $(this).addClass('active-filter');

        let filter = $(this).data('filter');

        $('#featuredProducts').slick('slickUnfilter');


        if (filter === 'ready') {

            $('#featuredProducts').slick(
                'slickFilter',
                '.product-item[data-stock="ready"], .product-item[data-stock="ready_stock"], .product-item[data-stock="in_stock"]'
            );

        }


        if (filter === 'preorder') {

            $('#featuredProducts').slick(
                'slickFilter',
                '.product-item[data-stock="preorder"], .product-item[data-stock="pre_order"]'
            );

        }


        $('#featuredProducts').slick('slickGoTo', 0);

        setTimeout(function () {

            let slickInstance = $('#featuredProducts').slick('getSlick');

            updateArrowState(
                slickInstance,
                slickInstance.currentSlide
            );

        }, 100);

    });


    /*
    |--------------------------------------------------------------------------
    | Product Search
    |--------------------------------------------------------------------------
    */

    $('#productSearch').on('keyup', function () {

        let searchText = $(this).val().toLowerCase().trim();

        $('#featuredProducts').slick('slickUnfilter');


        if (searchText !== '') {

            $('#featuredProducts').slick(
                'slickFilter',
                function () {

                    let name = $(this)
                        .attr('data-name')
                        .toLowerCase();

                    return name.indexOf(searchText) !== -1;

                }
            );

        }


        $('#featuredProducts').slick('slickGoTo', 0);

        setTimeout(function () {

            let slickInstance = $('#featuredProducts').slick('getSlick');

            updateArrowState(
                slickInstance,
                slickInstance.currentSlide
            );

        }, 100);

    });

});
</script>



<script>
    $(document).ready(function () {

    $('#video-play-btn').on('click', function () {

        $('.banner-image').fadeOut(300, function () {

            $('.bg-video').fadeIn(300);

            let video = $('.bg-video').get(0);

            video.play();

        });

        $(this).fadeOut();
    });

});
</script>


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