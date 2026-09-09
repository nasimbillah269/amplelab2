@isset($wlCount)
    @if($wlCount > 0 && $products->count() > 0)
    <div class="row-cols-xl-4 row-cols-md-3 row-cols-2 grid-section view-option row gy-4 g-xl-4">
    
    @foreach($products as $product)
        @include(welcomeTheme().'.products.includes.productCard')
    @endforeach
    
   </div>
   
   {{$products->links('pagination')}}

        
    @else

    <div class="emptyWishList" style="text-align:center;">
          <p>No Wishlist Product</p>
    </div>
    @endif

@endisset