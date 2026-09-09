@if($products->count() > 0)

<div class="row g-3 g-xl-4">
  @foreach($products as $index => $product)
  <div class="col-6 col-md-4 col-lg-3">
    @include(welcomeTheme().'products.includes.productCard')
  </div>
  @endforeach
</div>


<div class="paginationPart">
    {{$products->links('pagination')}}
</div>

@else


<div>
    <p style="text-align: center;font-size: 24px;color: gray;margin-top: 100px;">No Product found</p>
</div>



@endif