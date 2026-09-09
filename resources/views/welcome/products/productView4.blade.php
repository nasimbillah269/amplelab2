@extends(welcomeTheme().'layouts.app')

@section('title')
<title>{{websiteTitle($product->seo_title?:$product->name)}}</title>
@endsection

@section('SEO')
<meta name="title" property="og:title" content="{{$product->seo_title?:websiteTitle($product->name)}}" />
<meta name="description" property="og:description" content="{{$product->seo_description?:$product->short_description}}" />
<meta name="keywords" content="{{$product->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{assetUrl($product->image())}}" />
<meta name="url" property="og:url" content="{{route('productView',$product->slug?:'no-title')}}" />
<link class="canonical" href="{{route('productView',$product->slug?:'no-title')}}">
@endsection

@push('css')
<style>
.paragraphs ul li {
    display: block;
    margin-bottom: 20px;
}

/* =============================================
   MANAGEMENT PRODUCT DETAIL MAIN
   ============================================= */
.mgmt-detail-section {
    padding: 40px 0 60px;
    background-color: var(--mgmt-bg);
}

/* =============================================
   PRODUCT IMAGE (Left Column)
   ============================================= */
.mgmt-detail-img-wrap {
    position: relative;
    width: 100%;
    background-color: transparent;
    border-radius: 0;
    overflow: hidden;
    padding-right: 20px;
}

.mgmt-detail-img {
    width: 100%;
    height: auto;
    object-fit: contain;
    display: block;
}

/* =============================================
   PRODUCT INFO (Right Column)
   ============================================= */
.mgmt-detail-info {
    display: flex;
    flex-direction: column;
    gap: 12px;
    padding-top: 10px;
}

.mgmt-detail-title {
    font-family: var(--mgmt-font);
    font-size: 28px;
    font-weight: 700;
    color: var(--mgmt-heading);
    margin: 0 0 4px 0;
    line-height: 1.2;
}

.mgmt-detail-desc {
    font-family: var(--mgmt-font);
    font-size: 15px;
    font-weight: 400;
    color: var(--mgmt-text-light);
    line-height: 1.6;
    margin: 0 0 16px 0;
}

.mgmt-detail-readmore {
    font-family: var(--mgmt-font);
    font-size: 14px;
    font-weight: 400;
    color: var(--mgmt-accent);
    text-decoration: underline;
    text-underline-offset: 4px;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    transition: color 0.25s ease;
    display: block;
    margin-top: 4px;
}

.mgmt-detail-readmore:hover {
    color: #6a4914;
}

.mgmt-detail-color-label {
    font-family: var(--mgmt-font);
    font-size: 14px;
    font-weight: 700;
    color: var(--mgmt-heading);
    margin: 4px 0 0 0;
    text-transform: uppercase;
}

.mgmt-detail-color-label span {
    font-weight: 700;
    color: var(--mgmt-heading);
}

.mgmt-detail-color-swatch-wrap {
    display: flex;
    gap: 10px;
    margin: 0 0 16px 0;
}

.mgmt-detail-swatch {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: 2px solid #dddddd;
    cursor: pointer;
    transition: border-color 0.25s ease;
    padding: 3px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: none;
}

.mgmt-detail-swatch:hover {
    border-color: #aaaaaa;
}

.mgmt-detail-swatch-active {
    border-color: var(--mgmt-accent);
}

.mgmt-detail-swatch-inner {
    width: 22px;
    height: 22px;
    border-radius: 50%;
    display: block;
}

.mgmt-detail-price {
    font-family: var(--mgmt-font);
    font-size: 22px;
    font-weight: 400;
    color: var(--mgmt-heading);
    margin: 0 0 12px 0;
}

.mgmt-detail-cart-row {
    display: flex;
    align-items: center;
    gap: 16px;
    margin: 0 0 12px 0;
    flex-wrap: wrap;
}

.mgmt-detail-qty-control {
    display: flex;
    align-items: center;
    border: 1px solid #cccccc;
    border-radius: 0;
    height: 48px;
}

.mgmt-detail-qty-btn {
    width: 40px;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--mgmt-bg);
    border: none;
    color: var(--mgmt-heading);
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.25s ease;
}

.mgmt-detail-qty-btn:hover {
    background-color: #f5f5f5;
}

.mgmt-detail-qty-input {
    width: 40px;
    height: 100%;
    text-align: center;
    font-family: var(--mgmt-font);
    font-size: 15px;
    font-weight: 500;
    color: var(--mgmt-heading);
    border: none;
    background-color: var(--mgmt-bg);
    outline: none;
    -moz-appearance: textfield;
}

.mgmt-detail-qty-input::-webkit-outer-spin-button,
.mgmt-detail-qty-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.mgmt-detail-btn-cart {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 48px;
    padding: 0 36px;
    font-family: var(--mgmt-font);
    font-size: 15px;
    font-weight: 600;
    color: var(--mgmt-bg);
    background-color: var(--mgmt-accent);
    border: none;
    border-radius: 0;
    cursor: pointer;
    transition: background-color 0.25s ease;
}

.mgmt-detail-btn-cart:hover {
    background-color: #6a4914;
}

.mgmt-detail-btn-buy {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    max-width: 320px;
    height: 48px;
    font-family: var(--mgmt-font);
    font-size: 14px;
    font-weight: 700;
    color: #ffffff !important;
    background-color: #232323 !important;
    border: none;
    border-radius: 0;
    cursor: pointer;
    transition: background-color 0.25s ease;
    margin-bottom: 20px;
}

.mgmt-detail-btn-buy:hover {
    background-color: #000000;
}

.mgmt-detail-meta-wrap {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.mgmt-detail-meta-line {
    font-family: var(--mgmt-font);
    font-size: 14px;
    font-weight: 400;
    color: var(--mgmt-heading);
    margin: 0;
}

.mgmt-detail-meta-line strong {
    font-weight: 600;
}

.mgmt-detail-meta-link {
    color: var(--mgmt-heading);
    text-decoration: none;
    font-weight: 400;
    transition: color 0.25s ease;
}

.mgmt-detail-meta-link:hover {
    color: var(--mgmt-accent);
}

.mgmt-detail-share-wrap {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 10px;
}

.mgmt-detail-share-btn {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background-color: #eeeeee;
    color: var(--mgmt-heading);
    font-size: 15px;
    text-decoration: none;
    transition: background-color 0.25s ease, color 0.25s ease;
    border: none;
    cursor: pointer;
}

.mgmt-detail-share-btn:hover {
    background-color: #dddddd;
    color: var(--mgmt-heading);
    text-decoration: none;
}

/* =============================================
   ACCORDION SECTION
   ============================================= */
.mgmt-accordion-section {
    padding: 0 0 60px 0;
    background-color: var(--mgmt-bg);
}

.mgmt-accordion-item {
    border: none;
    border-radius: 0 !important;
    background-color: var(--mgmt-bg);
    margin-bottom: 16px;
}

.mgmt-accordion-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 16px 20px;
    font-family: var(--mgmt-font);
    font-size: 14px;
    font-weight: 700;
    color: var(--mgmt-heading);
    background-color: var(--mgmt-bg-light);
    border: none;
    cursor: pointer;
    text-align: left;
    transition: background-color 0.25s ease;
}

.mgmt-accordion-btn:hover {
    background-color: #ebebeb;
}

.mgmt-accordion-btn:focus {
    outline: none;
    box-shadow: none;
}

.mgmt-accordion-icon {
    font-size: 14px;
    color: var(--mgmt-heading);
    flex-shrink: 0;
}

.mgmt-accordion-body {
    padding: 24px 20px;
    background-color: var(--mgmt-bg);
    border: 1px solid var(--mgmt-border);
    border-top: none;
}

.mgmt-accordion-body-title {
    font-family: var(--mgmt-font);
    font-size: 15px;
    font-weight: 700;
    color: var(--mgmt-heading);
    margin: 0 0 16px 0;
}

.mgmt-accordion-body p {
    font-family: var(--mgmt-font);
    font-size: 14px;
    font-weight: 400;
    color: var(--mgmt-text-light);
    line-height: 1.6;
    margin: 0 0 16px 0;
}

.mgmt-accordion-body p:last-child {
    margin-bottom: 0;
}

.mgmt-accordion-dim-label {
    font-family: var(--mgmt-font);
    font-size: 14px;
    font-weight: 700;
    color: var(--mgmt-heading);
    margin: 20px 0 12px 0;
}

.mgmt-accordion-dim-list {
    list-style: disc;
    margin: 0;
    padding: 0 0 0 20px;
}

.mgmt-accordion-dim-list li {
    font-family: var(--mgmt-font);
    font-size: 14px;
    font-weight: 400;
    color: var(--mgmt-text-light);
    line-height: 1.8;
    margin-bottom: 8px;
}
.mgmt-accordion-dim-list li:last-child {
    margin-bottom: 0;
}

/* =============================================
   "YOU MAY ALSO LIKE" SECTION
   ============================================= */
.mgmt-related-section {
    padding: 40px 0 60px;
    background-color: var(--mgmt-bg);
}

.mgmt-related-heading {
    font-family: var(--mgmt-font);
    font-size: 22px;
    font-weight: 700;
    color: var(--mgmt-heading);
    text-align: center;
    margin: 0 0 32px 0;
}

.mgmt-related-card {
    display: block;
    text-decoration: none;
    background-color: var(--mgmt-bg);
    overflow: hidden;
    transition: transform 0.3s ease;
}

.mgmt-related-card:hover {
    text-decoration: none;
}

.mgmt-related-card-img-wrap {
    width: 100%;
    overflow: hidden;
    background-color: transparent;
    border-radius: 0;
}

.mgmt-related-card-img {
    width: 100%;
    height: 320px;
    object-fit: cover;
    display: block;
    transition: opacity 0.3s ease;
}

.mgmt-related-card:hover .mgmt-related-card-img {
    opacity: 0.9;
}

.mgmt-related-card-body {
    padding: 16px 0 0 0;
}

.mgmt-related-card-title {
    font-family: var(--mgmt-font);
    font-size: 14px;
    font-weight: 600;
    color: var(--mgmt-accent);
    margin: 0 0 8px 0;
    line-height: 1.3;
}

.mgmt-related-card-price {
    font-family: var(--mgmt-font);
    font-size: 14px;
    font-weight: 600;
    color: var(--mgmt-heading);
    margin: 0 0 6px 0;
}

.mgmt-related-card-color {
    font-family: var(--mgmt-font);
    font-size: 13px;
    font-weight: 400;
    color: var(--mgmt-accent);
}

/* =============================================
   PRODUCT ZOOM & GALLERY THUMBNAILS
   ============================================= */
.mgmt-detail-img-zoom-wrap {
    position: relative;
    cursor: crosshair;
    border: 1px solid var(--mgmt-border, #eeeeee);
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
}

.mgmt-detail-img-zoom-wrap img {
    width: 100%;
    height: auto;
    object-fit: contain;
    display: block;
    pointer-events: none;
}

/* Zoom Lens */
.mgmt-zoom-lens {
    display: none;
    position: absolute;
    top: 0;
    left: 0;
    width: 120px;
    height: 120px;
    border: 2px solid var(--mgmt-accent, #6a4914);
    background-color: rgba(255,255,255,0.3);
    pointer-events: none;
    z-index: 5;
}

/* Zoom Result (zoomed view) */
.mgmt-zoom-result {
    display: none;
    position: absolute;
    top: 0;
    width: 600px;
    height: 800px;
    border: 1px solid #ddd;
    background-repeat: no-repeat;
    background-size: 200%;
    background-color: #fff;
    z-index: 10;
    box-shadow: 0 4px 16px rgba(0,0,0,0.12);
}

@media (max-width: 1199.98px) {
    .mgmt-zoom-result {
        width: 300px;
        height: 300px;
    }
}

@media (max-width: 767.98px) {
    .mgmt-zoom-result {
        display: none !important;
    }
    .mgmt-zoom-lens {
        display: none !important;
    }
}

.mgmt-thumbnails-wrap {
    display: flex;
    gap: 10px;
    margin-top: 15px;
    overflow-x: auto;
    padding-bottom: 5px;
    scrollbar-width: thin;
    scrollbar-color: var(--mgmt-accent) #f0f0f0;
}

.mgmt-thumbnails-wrap::-webkit-scrollbar {
    height: 4px;
}

.mgmt-thumbnails-wrap::-webkit-scrollbar-track {
    background: #f0f0f0;
}

.mgmt-thumbnails-wrap::-webkit-scrollbar-thumb {
    background-color: var(--mgmt-accent);
    border-radius: 2px;
}

.mgmt-thumbnail-item {
    width: 80px;
    height: 80px;
    flex-shrink: 0;
    border: 2px solid transparent;
    cursor: pointer;
    transition: all 0.25s ease;
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

.mgmt-thumbnail-item img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.mgmt-thumbnail-item:hover,
.mgmt-thumbnail-item.active {
    border-color: var(--mgmt-accent, #6a4914);
}







.color-picker {
    font-family: Arial, sans-serif;
        margin-bottom: 10px;
}

.colors {
    display: flex;
    gap: 12px;
    margin-top: 10px;
}

.color {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    cursor: pointer;
    border: 2px solid #ddd;
    transition: all 0.3s ease;
}

.color.active {
    box-shadow: 0 0 0 3px #d6c08d;
}

.orange {
    background: #f68b00;
}

.black {
    background: #000;
}

.gray {
    background: #9b9b9b;
}

.red {
    background: #ff1f1f;
}




.color-picker h4 {
    font-size: 20px;
    margin: 0;
    color: #000;
}

.color-picker h4 span {
    font-size: 20px;
    color: #000;
}



ul.colorList{
    display:inline-block;
    margin-top:0;
    padding: 0;
}

ul.colorList li{
    background-color: unset;
    color:unset;
    float: left;
    padding:0;
    padding-right: 10px;
}

.attributeItem .colorItem {
    height: 25px;
    width: 25px;
    border-radius: 100%;
    cursor:pointer;
    margin-bottom: 5px;
    
}

.attributeItem .colorItem.active {
    box-shadow: 0px 1px 8px 2px #444;
    transition: 0.4s;
    border: 2px solid #dbcccc;
}

.attributeItem .textItem {
    /*height: 25px;*/
    min-width: 25px;
    border-radius: 5px;
    background: #f1f1f1;
    text-align: center;
    padding: 8px 20px;
    text-transform: uppercase;
    cursor: pointer;
    border: 1px solid #e9dce2;
    margin-bottom: 5px;
    line-height: 18px;
}

.attributeItem .textItem.active {
    border-color: #0ba350;
}

.attributeItem .imageItem {
    margin-bottom: 5px;
}

.attributeItem .imageItem img {
    width: 25px;
    height: 25px;
    border-radius: 5px;
    border: 1px solid #dfdede;
    padding: 1px;
}

.attributeItem .imageItem.active img {
    border-color: #0ba350;
}

.attributeValue {
    width: 1px;
    position: absolute;
    z-index: -9;
}





.colorList .colorItem {
  position: relative;
}

.colorList .colorItem::after {
  content: attr(data-vari); /* Use the data-name attribute as tooltip text */
  position: absolute;
  top: -30px; /* Position above the label */
  left: 50%;
  transform: translateX(-50%);
  background-color: black;
  color: white;
  padding: 5px 10px;
  font-size: 12px;
  border-radius: 4px;
  white-space: nowrap;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.3s ease-in-out;
}

.colorList .colorItem:hover::after {
  opacity: 1;
  visibility: visible;
}









@media (max-width: 991.98px) {
    .mgmt-thumbnails-wrap {
        justify-content: center;
    }
}

/* =============================================
   RESPONSIVE
   ============================================= */
@media (max-width: 991.98px) {
    .mgmt-detail-section {
        padding: 30px 0 40px;
    }
    .mgmt-detail-img-wrap {
        padding-right: 0;
        margin-bottom: 24px;
    }
    .mgmt-detail-title {
        font-size: 24px;
    }
    .mgmt-related-card-img {
        height: 240px;
    }
}

@media (max-width: 767.98px) {
    .mgmt-detail-section {
        padding: 20px 0 30px;
    }
    .mgmt-detail-title {
        font-size: 22px;
    }
    .mgmt-detail-price {
        font-size: 20px;
    }
    .mgmt-detail-btn-buy {
        max-width: 100%;
    }
    .mgmt-detail-cart-row {
        flex-direction: column;
        align-items: stretch;
    }
    .mgmt-detail-qty-control {
        justify-content: center;
    }
    .mgmt-detail-btn-cart {
        width: 100%;
    }
    .mgmt-related-card-img {
        height: 200px;
    }
}

@media (max-width: 480px) {
    .mgmt-detail-title {
        font-size: 20px;
    }
    .mgmt-detail-price {
        font-size: 18px;
    }
    .mgmt-related-card-img {
        height: 160px;
    }
}
</style>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "{{ route('index') }}"
    }
    @foreach($product->productCategories as $index => $ctg),
    {
      "@type": "ListItem",
      "position": {{ $index + 2 }},
      "name": "{{ $ctg->name }}",
      "item": "{{ route('productCategory', $ctg->slug ?: 'no-title') }}"
    }
    @endforeach,
    {
      "@type": "ListItem",
      "position": {{ $product->productCategories->count() + 2 }},
      "name": "{{ $product->name }}",
      "item": "{{ url()->current() }}"
    }
  ]
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ $product->name }}",
  "image": "{{ assetUrl($product->image()) }}",
  "description": @json(strip_tags($product->seo_contents ?: $product->description)),
  "brand": {
    "@type": "Brand",
    "name": "{{ $product->brand->name ?? 'Unknown' }}"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{ url()->current() }}",
    "priceCurrency": "BDT",
    "price": "{{ $product->offerPrice() }}",
    "availability": "https://schema.org/InStock",
    "itemCondition": "https://schema.org/NewCondition"
  }
}
</script>
@endpush

@section('contents')

<main class="mgmt-detail-section" id="mgmtDetailSection">
    <div class="container">
        <div class="row g-4 g-lg-5 align-items-start">

            <div class="col-12 col-lg-6">
                <div class="mgmt-detail-img-wrap largeImage">
                    <div class="mgmt-detail-img-zoom-wrap">
                        <img src="{{assetUrl($product->image())}}" alt="{{$product->name}}" class="mgmt-detail-img" id="mgmtMainImage">
                        <div class="mgmt-zoom-lens"></div>
                        <div class="mgmt-zoom-result"></div>
                    </div>

                    <div class="mgmt-thumbnails-wrap">
                        <div class="mgmt-thumbnail-item active" data-src="{{assetUrl($product->image())}}">
                            <img src="{{assetUrl($product->image())}}" alt="{{$product->name}}">
                        </div>
                        @if(isset($product->galleryFiles) && $product->galleryFiles->count() > 0)
                            @foreach($product->galleryFiles as $gallery)
                                <div class="mgmt-thumbnail-item" data-src="{{assetUrl($gallery->image())}}">
                                    <img src="{{assetUrl($gallery->image())}}" alt="Gallery Image">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="mgmt-detail-info">

                    <h1 class="mgmt-detail-title">{{$product->name}}</h1>

                    <div class="mgmt-detail-desc">
                        {!! $product->short_description !!}
                    </div>
                    
                <!--    <div class="color-picker">-->
                <!--    <h4>COLOR: <span id="selectedColor">RED</span></h4>-->
                
                <!--    <div class="colors">-->
                <!--        <span class="color orange" data-color="ORANGE"></span>-->
                <!--        <span class="color black" data-color="BLACK"></span>-->
                <!--        <span class="color gray" data-color="GRAY"></span>-->
                <!--        <span class="color red active" data-color="RED"></span>-->
                <!--    </div>-->
                <!--</div>-->

                    <form class="addToCartForm" action="{{route('addToCart',$product->id)}}" method="post">
                        @csrf

                        @if($product->productAttibutesVariationGroup()->count() > 0)
                            <div class="smalOtherBox my-3">
                                @include(welcomeTheme().'products.includes.productVariation')
                            </div>
                        @endif

                        <p class="mgmt-detail-price productPriceAppend">
                            {{priceFullFormat($product->offerPrice())}}/-
                            @if($product->regularPrice() > $product->offerPrice())
                                <del style="font-size: 0.6em; color: #777; margin-left: 10px;">{{priceFullFormat($product->regularPrice())}}/-</del>
                            @endif
                        </p>

                        <div class="productStock mb-3">
                            @if($product->quantity > 0)
                                <b>Stock Available</b>
                            @else
                                <b style="color:red;">Stock Out</b>
                            @endif
                        </div>

                        <div class="mgmt-detail-cart-row">
                            <div class="mgmt-detail-qty-control quantityValue">
                                <button type="button" class="mgmt-detail-qty-btn decrement-quantity" data-direction="-1" aria-label="Decrease quantity">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" name="quantity" class="mgmt-detail-qty-input productQtyValue" id="qty" value="1" min="1" data-max="{{$product->quantity}}" readonly>
                                <button type="button" class="mgmt-detail-qty-btn increment-quantity" data-direction="1" aria-label="Increase quantity">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                               <button type="button" class="mgmt-detail-btn-cart addToCart addToSinBtn" data-product-id="{{ $product->id }}" data-url="{{route('addToCart',$product->id)}}">
                                Add to cart
                            </button>
                        </div>

                        <button type="submit" name="orderNow" value="order" class="mgmt-detail-btn-buy buyNow buyNowSinBtn" data-product-id="{{ $product->id }}">
                            BUY IT NOW
                        </button>
                    </form>

                    <div class="succeMessage my-2"></div>

                    <div class="mgmt-detail-meta-wrap">
                        @if($product->sku_code)
                            <p class="mgmt-detail-meta-line">SKU: <span>{{$product->sku_code}}</span></p>
                        @endif
                        <p class="mgmt-detail-meta-line">Available: <span>{{$product->quantity}} Qty</span></p>
                        <p class="mgmt-detail-meta-line">Categories:
                            @foreach($product->productCategories as $ctg)
                                <a href="{{ route('productCategory', $ctg->slug ?: 'no-title') }}" class="mgmt-detail-meta-link">{{ $ctg->name }}</a>{{ !$loop->last ? ',' : '' }}
                            @endforeach
                        </p>
                    </div>

                    <div class="mgmt-detail-share-wrap d-flex align-items-center gap-3 mt-3">
                        <a href="javascript:void(0)" class="wishlistCompareUpdate btn btn-sm btn-light" data-url="{{route('wishlistCompareUpdate',[$product->id,'wishlist'])}}">
                            <i class="fa-{{$product->isWl()?'regular':'solid'}} fa-heart"></i> Wishlist
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('productView', $product->slug ?: 'no-title')) }}" class="mgmt-detail-share-btn" aria-label="Share on Facebook" title="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/" class="mgmt-detail-share-btn" aria-label="Visit Instagram" title="Share on Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('productView', $product->slug ?: 'no-title')) }}&text={{ urlencode($product->name) }}" class="mgmt-detail-share-btn" aria-label="Share on X" title="Share on X"><i class="fab fa-x-twitter"></i></a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($product->name . ' - ' . route('productView', $product->slug ?: 'no-title')) }}" class="mgmt-detail-share-btn" aria-label="Share on WhatsApp" title="Share on WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<section class="mgmt-accordion-section" id="mgmtAccordionSection">
    <div class="container">

        <div class="mgmt-accordion-item mgmt-accordion-open" id="mgmtAccDesc">
            <button type="button" class="mgmt-accordion-btn" aria-expanded="true" aria-controls="mgmtAccDescBody">
                Description
                <i class="fas fa-minus mgmt-accordion-icon"></i>
            </button>
            <div class="mgmt-accordion-body" id="mgmtAccDescBody">
                <div class="paragraphs">
                    {!! $product->description !!}
                </div>
            </div>
        </div>

        <div class="mgmt-accordion-item" id="mgmtAccInfo">
            <button type="button" class="mgmt-accordion-btn" aria-expanded="false" aria-controls="mgmtAccInfoBody">
                Specification
                <i class="fas fa-plus mgmt-accordion-icon"></i>
            </button>
            <div class="mgmt-accordion-body" id="mgmtAccInfoBody" hidden>
                @if($product->extraAttribute->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped specification-table">
                            <tbody>
                                @foreach($product->extraAttribute as $extraAttri)
                                <tr>
                                    <th>{!!$extraAttri->name!!}</th>
                                    <td>{!!$extraAttri->content!!}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <span>No Specification Available</span>
                @endif
            </div>
        </div>

    </div>
</section>

<section class="mgmt-related-section" id="mgmtRelatedProducts">
    <div class="container">
        <h2 class="mgmt-related-heading">You may also like</h2>
        <div class="row g-3 g-md-4">
            @foreach($relatedProducts as $relatedProd)
                <div class="col-6 col-md-3">
                    <a href="{{ route('productView', $relatedProd->slug ?: 'no-title') }}" class="mgmt-related-card">
                        <div class="mgmt-related-card-img-wrap">
                            <img src="{{assetUrl($relatedProd->image())}}" alt="{{$relatedProd->name}}" class="mgmt-related-card-img">
                        </div>
                        <div class="mgmt-related-card-body">
                            <h4 class="mgmt-related-card-title">{{$relatedProd->name}}</h4>
                            <p class="mgmt-related-card-price">{{priceFullFormat($relatedProd->offerPrice())}}/-</p>
                            <span class="mgmt-related-card-color">{{ $relatedProd->quantity > 0 ? 'In Stock' : 'Out of Stock' }}</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('js')



<script>
$(document).ready(function () {

    $('.color').on('click', function () {

        $('.color').removeClass('active');

        $(this).addClass('active');

        let colorName = $(this).data('color');

        $('#selectedColor').text(colorName);
    });

});
</script>









<script>
$(document).ready(function(){

    $(document).on('click', '.mgmt-thumbnail-item', function() {
        $('.mgmt-thumbnail-item').removeClass('active');
        $(this).addClass('active');
        var src = $(this).data('src');
        if (src) {
            $('#mgmtMainImage').attr('src', src);
        }
    });

    // Box lens zoom + scroll to change zoom level
    var zoomWrap = $('.mgmt-detail-img-zoom-wrap');
    var zoomLens = $('.mgmt-zoom-lens');
    var zoomResult = $('.mgmt-zoom-result');
    var zoomLevel = 2;
    var minZoom = 2;
    var maxZoom = 6;
    var zoomStep = 0.5;

    zoomWrap.on('mouseenter', function() {
        var src = $(this).find('img').attr('src');
        zoomLens.show();
        zoomResult.show();
        zoomResult.css('background-image', 'url(' + src + ')');
    });

    zoomWrap.on('mousemove', function(e) {
        var $this = $(this);
        var rect = this.getBoundingClientRect();

        var lensW = zoomLens.width() / 2;
        var lensH = zoomLens.height() / 2;

        var x = e.clientX - rect.left - lensW;
        var y = e.clientY - rect.top - lensH;

        x = Math.max(0, Math.min(x, rect.width - zoomLens.width()));
        y = Math.max(0, Math.min(y, rect.height - zoomLens.height()));

        zoomLens.css({ left: x + 'px', top: y + 'px' });

        var px = x / rect.width;
        var py = y / rect.height;

        zoomResult.css({
            backgroundPosition: (px * 100) + '% ' + (py * 100) + '%'
        });
    });

    zoomWrap.on('wheel', function(e) {
        e.preventDefault();
        var delta = e.deltaY || (e.originalEvent && e.originalEvent.deltaY) || 0;
        if (delta < 0) {
            zoomLevel = Math.min(maxZoom, zoomLevel + zoomStep);
        } else {
            zoomLevel = Math.max(minZoom, zoomLevel - zoomStep);
        }
        zoomResult.css('background-size', (zoomLevel * 100) + '%');
    });

    zoomWrap.on('mouseleave', function() {
        zoomLens.hide();
        zoomResult.hide();
    });

    $(".quantityValue .increment-quantity").click(function(){
        var input = $("#qty");
        var max = parseInt(input.attr("data-max")) || 20;
        var value = parseInt(input.val());
        if (value < max) { input.val(value + 1); }
    });

    $(".quantityValue .decrement-quantity").click(function(){
        var input = $("#qty");
        var min = parseInt(input.attr("min")) || 1;
        var value = parseInt(input.val());
        if (value > min) { input.val(value - 1); }
    });

    $(document).on("click", ".addToCart", function () {
    var url = $(this).data("url");
    var quantity = $("#qty").val();

    var option = [];

    $('.attributeValue:checked').each(function () {
        option.push($(this).data('vlueid'));
        // or .val() depending on your HTML
    });

    $.ajax({
        url: url,
        type: "GET",
        data: {
            quantity: quantity,
            option: option
        },
        success: function (data) {

            if (!data.success) {
                alert(data.message);
                return;
            }

            if ($('#offcanvasRight').length) {
                new bootstrap.Offcanvas($('#offcanvasRight')[0]).show();
            }

            $(".shopping-details").html(data.cartViews);
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});


$(document).on('click', '.attributeItem li label', function () {

    let $label = $(this);
    let $input = $label.find('.attributeValue');

    // check radio
    $input.prop('checked', true);

    // remove active only in same group (same attribute)
    let groupName = $input.attr('name');

    $('.attributeItem li label').each(function () {
        if ($(this).find('.attributeValue').attr('name') === groupName) {
            $(this).removeClass('active');
        }
    });

    $label.addClass('active');

    // 🔥 GET SELECTED COLOR / NAME
    let selectedName = $label.data('vari'); // THIS IS IMPORTANT

    // show selected name
    $label.closest('.row')
        .find('.selected-value')
        .text(selectedName);

    // 🔥 CHANGE MAIN IMAGE IF EXISTS
    let image = $label.data('image');
    if (image) {
        $('.largeImage img, #mgmtMainImage').attr('src', image);
    }

    // 🔥 COLOR FIX (BACKGROUND BOX ALWAYS SHOW)
    if ($label.hasClass('colorItem')) {
        $label.css('background-color', $label.css('background-color'));
    }

});




  $('.attributeItem li label').click(function() {
           
            var dataName = $(this).data('name');
            $('.attributeItem li label[data-name="'+dataName+'"]').removeClass('active');
            
            $(this).addClass('active');
            
            var image = $(this).data('image');
            if (image) {
                //alert('Image URL: ' + image);
                $('.largeImage img').attr('src', image);
            }
            
            
            setTimeout(function() {
                var selectedIds = [];
                $('.attributeItem li .attributeValue:checked').each(function() {
                    selectedIds.push($(this).data('vlueid'));
                });
                
                var datas = @json($datas);
                
                var filteredProducts = filterProductsBySelectedAttributes(datas, selectedIds);
                
                if(filteredProducts.length > 0) {
                    var priceText = '';
                    var stutas =true;
                    var qtyVari =0;
                    filteredProducts.forEach(function(product) {
                        priceText += product.price;
                        stutas =product.stock_status?true:false;
                        qtyVari =product.quantity;
                    });
                    
                    if(stutas){
                        
                        $('.buyNowSinBtn, .addToSinBtn').prop('disabled', false);
                        $('.buyNowSinBtn').empty().append('Buy Now');
                        if($('.productQtyValue').val()==0){
                            $('.productQtyValue').val(1);
                            $('.productQtyValue').prop('disabled', false);
                        }
                        
                        $('.productQtyValue').attr('data-max',qtyVari);
                        $('.productPriceAppend').empty().append(priceText);
                        $('.productStock').empty().append('<b>Stock Available</b>');
                    
                    }else{
                        $('.buyNowSinBtn').empty().append('Pre Order');
                        $('.buyNowSinBtn').prop('disabled', false);
                        $('.addToSinBtn').prop('disabled', true);
                        $('.productQtyValue').val(1);
                        $('.productPriceAppend').empty().append(priceText);
                        $('.productQtyValue').prop('disabled', false);
                        $('.productStock').empty().append('<b style="color:red;">Stock Out</b>');
                    }
                    
                } else {
                    $('.buyNowSinBtn, .addToSinBtn').prop('disabled', true);
                    $('.buyNowSinBtn').empty().append('Buy Now');
                    $('.productQtyValue').val(0);
                    $('.productQtyValue').prop('disabled', true);
                    $('.productStock').empty().append('<b style="color:red;">Stock Out</b>');
                }
                
                $('.succeMessage').empty()
                console.log(filteredProducts);
                console.log(selectedIds);
                getPrice();
            }, 10);
            
        });



    $(document).on('click', '.mgmt-accordion-btn', function(){
        var item = $(this).closest('.mgmt-accordion-item');
        var body = item.find('.mgmt-accordion-body');
        var icon = $(this).find('.mgmt-accordion-icon');
        var isOpen = item.hasClass('mgmt-accordion-open');
        item.toggleClass('mgmt-accordion-open', !isOpen);
        body.attr('hidden', isOpen ? 'hidden' : null);
        icon.removeClass('fa-minus fa-plus').addClass(isOpen ? 'fa-plus' : 'fa-minus');
        $(this).attr('aria-expanded', !isOpen);
    });

});
</script>





@endpush
