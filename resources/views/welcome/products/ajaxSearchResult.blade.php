
@if($products->count() > 0)
    <div class="row gy-4 ratio_square-2 preemptive-search"> 
        
        @foreach($products as $product)
            <div class="col-xl-3 col-sm-4 col-6"> 
              @include(welcomeTheme().'products.includes.productCard')
            </div>
            
            @endforeach
    </div>
@else
<li><a href="javascript:void(0)">No Result Found</a></li>
@endif