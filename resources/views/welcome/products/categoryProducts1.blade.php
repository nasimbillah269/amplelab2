@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle($category->seo_title?:$category->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle($category->seo_title?:$category->name)}}" />
<meta name="description" property="og:description" content="{!!$category->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$category->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{assetUrl($category->image())}}" />
<meta name="url" property="og:url" content="{{route('productCategory',$category->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('productCategory',$category->slug?:'no-title')}}">
@endsection @push('css')

<style>

</style>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "{{ $category->name }}",
  "url": "{{ url()->current() }}",
  "mainEntity": {
    "@type": "ItemList",
    "itemListElement": [
      @foreach($products as $index => $product)
      {
        "@type": "ListItem",
        "position": {{ $index + 1 }},
        "url": "{{route('productView',$product->slug?:Str::slug($product->name))}}"
      }@if(!$loop->last),@endif
      @endforeach
    ]
  }
}
</script>


@endpush 

@section('contents')

   <section class="section-b-space pt-0"> 
      <div class="heading-banner">
        <div class="custom-container container">
          <div class="row align-items-center">
            <div class="col-sm-6">
              <h4>{{$category->name}}</h4>
            </div>
            <div class="col-sm-6">
              <ul class="breadcrumb float-end">
                <li class="breadcrumb-item"> <a href="{{route('index')}}">Home </a></li>
                <li class="breadcrumb-item active"> <a href="javascript:void(0)">{{$category->name}} </a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <section class="section-b-space pt-0"> 
      <div class="custom-container container">
          
        <div class="row"> 
        
        
       
          <div class="col-3"> 
           
            <div class="custom-accordion theme-scrollbar left-box">
              <div class="left-accordion"> 
                <h5>Back </h5><i class="back-button fa-solid fa-xmark"></i>
              </div>
              <div class="accordion proSideBar" id="accordionPanelsStayOpenExample">
                  <input type="hidden" value="" class="inputShortBy"  name="short_by">
                @if($maxPrice > 0)
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour"><span>Filter</span></button>
                  </h2>
                  <div class="accordion-collapse collapse show" id="panelsStayOpen-collapseFour">
                    <div class="accordion-body">
                      <div class="range-slider">
                        <input class="range-slider-input filterAction" type="range" min="{{$minPrice}}" name="min_price" max="{{$maxPrice}}" step="100" value="{{$minPrice}}">
                        <input class="range-slider-input filterAction" type="range" min="{{$minPrice}}" name="max_price" max="{{$maxPrice}}" step="100" value="{{$maxPrice}}">
                        <div class="range-slider-display"></div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                
                @if($categories->count() > 0)
                <div class="accordion-item"> 
                  <h2 class="accordion-header">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"><span>Categories</span></button>
                  </h2>
                  <div class="accordion-collapse collapse show" id="panelsStayOpen-collapseTwo">
                    <div class="accordion-body">
                      <ul class="catagories-side theme-scrollbar">
                        @foreach($categories as $ctg)
                        <li> 
                          <input class="custom-checkbox filterAction" id="category{{$ctg->id}}" type="checkbox" value="{{$ctg->id}}"  name="ctgs[]" {{$category->id==$ctg->id?'checked':''}}>
                          <label for="category{{$ctg->id}}">{{$ctg->name}}</label>
                        </li>
                            @foreach($ctg->subctgs()->latest()->where('status','active')->get() as $sctg)
                            <li> 
                              <input class="custom-checkbox filterAction" id="category{{$sctg->id}}" type="checkbox" value="{{$sctg->id}}" style="margin-left: 15px;" name="ctgs[]" {{$category->id==$sctg->id?'checked':''}}>
                              <label for="category{{$sctg->id}}">{{$sctg->name}}</label>
                            </li>
                                @foreach($sctg->subctgs()->latest()->where('status','active')->get() as $ssctg)
                                    <li> 
                                      <input class="custom-checkbox filterAction" id="category{{$ssctg->id}}" type="checkbox" value="{{$ssctg->id}}" style="margin-left: 15px;" name="ctgs[]" {{$category->id==$ssctg->id?'checked':''}}>
                                      <label for="category{{$ssctg->id}}">{{$ssctg->name}}</label>
                                    </li>
                                @endforeach
                            
                            @endforeach
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
                @endif
                
                @foreach($attributes as $attri)
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne"><span>Color</span></button>
                  </h2>
                  <div class="accordion-collapse collapse show" id="panelsStayOpen-collapseOne">
                    <div class="accordion-body">
                      <div class="color-box">
                        <ul class="color-variant">
                          <li class="bg-color-purple">sdfs</li>
                          <li class="bg-color-blue"></li>
                          <li class="bg-color-red"></li>
                          <li class="bg-color-yellow"></li>
                          <li class="bg-color-coffee"></li>
                          <li class="bg-color-chocolate"></li>
                          <li class="bg-color-brown"></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
                

                <div class="accordion-item">
                  <h2 class="accordion-header tags-header">
                    <button class="accordion-button"><span>Shipping & Delivery</span><span></span></button>
                  </h2>
                  <div class="accordion-collapse collapse show" id="panelsStayOpen-collapseSeven">
                    <div class="accordion-body">
                      <ul class="widget-card"> 
                        <li><i class="iconsax" data-icon="truck-fast"></i>
                          <div> 
                            <h6>Free Shipping</h6>
                            <p>Free shipping for all US order</p>
                          </div>
                        </li>
                        <li><i class="iconsax" data-icon="headphones"></i>
                          <div> 
                            <h6>Support 24/7</h6>
                            <p>Free shipping for all US order</p>
                          </div>
                        </li>
                        <li><i class="iconsax" data-icon="exchange"></i>
                          <div> 
                            <h6>30 Days Return</h6>
                            <p>Free shipping for all US order</p>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="mt-3" style="text-align: center;width: 100%;">
                    <a href="{{route('productCategory',$category->slug?:'no-title')}}" class="btn btn-danger">Reset All</a>
                 </div>
                
              </div>
            </div>
          </div>
          
           
          
          <div class="col-xl-9">

            <div class="sticky">
              <div class="top-filter-menu">
                <div> <a class="filter-button btn"> 
                    <h6> <i class="iconsax" data-icon="filter"></i>Filter Menu </h6></a>
                  <div class="category-dropdown">
                    <label for="cars">Sort By :</label>
                    <select class="form-select shortBy filterAction" id="cars">
                      <option value="latest">Latest Product</option>
                      <option value="best_selling">Best selling</option>
                      <option value="featured">Featured</option>
                      <option value="high_to_low">High - Low Price</option>
                      <option value="low_to_high">Low - High Price</option>
                    </select>
                  </div>
                </div>
                <div>
                   
                </div>
              </div>
              <div class="product-tab-content ratio1_3 ajaxProductList">
                  
                
                @include(welcomeTheme().'products.includes.productsAll')
                
              </div>
              
            </div>
          
          
            </div>
          
        </div>
      </div>
    </section>








@endsection 
@push('js')

<script>

$(function () {

  var $parent = $(".range-slider");
  if (!$parent.length) return;

  var $range = $parent.find("input[type=range]");
  var $display = $parent.find(".range-slider-display");

  function updateValues() {
    var min = parseInt($range.eq(0).val());
    var max = parseInt($range.eq(1).val());

    if (min > max) {
      var temp = min;
      min = max;
      max = temp;
    }

    $range.eq(0).val(min);
    $range.eq(1).val(max);

    // $display.text("$" + min.toLocaleString() + " - $" + max.toLocaleString());
  }

  $range.on("input", updateValues);

  updateValues(); // initialize on load
  
   
  $('.shortBy').change(function(){
      var shortBy = $(this).val();
      $('.inputShortBy').val(shortBy);
  });

});

// (function() {

//   var parent = document.querySelector(".range-slider");
//   if(!parent) return;

//   var
//     rangeS = parent.querySelectorAll("input[type=range]"),
//     numberS = parent.querySelectorAll("input[type=number]");

//   rangeS.forEach(function(el) {
//     el.oninput = function() {
//       var slide1 = parseFloat(rangeS[0].value),
//         	slide2 = parseFloat(rangeS[1].value);

//       if (slide1 > slide2) {
// 		[slide1, slide2] = [slide2, slide1];
//       }
//       numberS[0].value = slide1;
//       numberS[1].value = slide2;
//     }
//   });


//   numberS.forEach(function(el) {
//     el.oninput = function() {
// 			var number1 = parseFloat(numberS[0].value),
// 					number2 = parseFloat(numberS[1].value);
			
//       if (number1 > number2) {
//         var tmp = number1;
//         numberS[0].value = number2;
//         numberS[1].value = tmp;
//       }

//       rangeS[0].value = number1;
//       rangeS[1].value = number2;
      

//     }
//   });
  
  

// })();


    $(document).ready(function(){
        

    
    //     $('.min-range, .max-range').on('change', function() {
    //         filterAction();
    //     });
       
    //   $(document).on('change','.priceFilter',function(){
    //         filterAction();
    //   });
       
       $(document).on('change','.filterAction',function(){
           filterAction();
           
       });
       
       function filterAction(){
           var url="{{route('productCategoryFilter')}}";
           var formData = $('.proSideBar').find('select, input').serialize();
           $.ajax({
                url:url,
                dataType: 'json',
                cache: false,
                data:formData,
                success : function(data){

                $('.ajaxProductList').empty().append(data.viewData);
                
                setTimeout(function() {
                }, 200);

                },error: function () {
                    alert('error');
                }
            });
       }
       
       
       
       
    });


</script>

@endpush