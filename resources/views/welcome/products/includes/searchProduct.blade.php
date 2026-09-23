<div class="SearchResult">
    @forelse($products as $product)
    <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}" class="SearchResult-item">
        <img src="{{assetUrl($product->image())}}" alt="{{$product->name}}">
        <span class="SearchResult-name">{{Str::limit($product->name,60)}}</span>
        <span class="SearchResult-price">{{priceFullFormat($product->final_price)}}</span>
    </a>
    @empty
    <div class="SearchResult-empty">No product found</div>
    @endforelse
</div>