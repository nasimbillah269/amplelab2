
@for($i=0;$i < $product->productRating();$i++)
<i class="fa-solid fa-star"></i>
@endfor

@for($i=0;$i < 5-$product->productRating();$i++)
<i class="fa-regular fa-star"></i>
@endfor

