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

/* Product Title */
.mgmt-detail-title {
    font-family: var(--mgmt-font);
    font-size: 28px;
    font-weight: 700;
    color: var(--mgmt-heading);
    margin: 0 0 4px 0;
    line-height: 1.2;
}

/* Short Description */
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

/* Color Label */
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

/* Color Swatch */
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

/* Price */
.mgmt-detail-price {
    font-family: var(--mgmt-font);
    font-size: 22px;
    font-weight: 400;
    color: var(--mgmt-heading);
    margin: 0 0 12px 0;
}

/* Quantity & Add to Cart Row */
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

/* Add to Cart Button */
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

/* Buy It Now Button */
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

/* SKU, Categories, Tags */
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

/* Social Share Icons */
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
   ACCORDION SECTION (Description, Additional)
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

/* Accordion Body */
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

/* Dimensions List */
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

/* Related Product Card */
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
   RESPONSIVE - TABLET (max 991px)
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

/* =============================================
   RESPONSIVE - MOBILE (max 767px)
   ============================================= */
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

/* =============================================
   RESPONSIVE - SMALL MOBILE (max 480px)
   ============================================= */
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

/* =============================================
   PRODUCT ZOOM & GALLERY THUMBNAILS
   ============================================= */
.mgmt-detail-img-zoom-wrap {
    position: relative;
    overflow: hidden;
    cursor: zoom-in;
    border: 1px solid var(--mgmt-border, #eeeeee);
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
}

.mgmt-detail-img-zoom-wrap img {
    transition: transform 0.2s ease-out;
    width: 100%;
    height: auto;
    object-fit: contain;
    transform-origin: center center;
    pointer-events: none;
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

@media (max-width: 991.98px) {
    .mgmt-thumbnails-wrap {
        justify-content: center;
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
                    </div>
                    
                    <div class="mgmt-thumbnails-wrap">
                        <!-- Main product image thumbnail -->
                        <div class="mgmt-thumbnail-item active">
                            <img src="{{assetUrl($product->image())}}" alt="Thumbnail 1">
                        </div>
                        <div class="mgmt-thumbnail-item">
                            <img src="{{assetUrl('img/ALMIRAH/12.jfif')}}" alt="Thumbnail 2">
                        </div>
                        <div class="mgmt-thumbnail-item">
                            <img src="{{assetUrl('img/ALMIRAH/13.jfif')}}" alt="Thumbnail 3">
                        </div>
                        <div class="mgmt-thumbnail-item">
                            <img src="{{assetUrl('img/ALMIRAH/14.jfif')}}" alt="Thumbnail 4">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mgmt-detail-info">

                    <h1 class="mgmt-detail-title">{{$product->name}}</h1>

                    <div class="mgmt-detail-desc">
                        {!! $product->short_description !!}
                    </div>
                    

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
$(document).ready(function(){

    // Fixed Quantity logic mapping cleanly onto new DOM selectors 
    $(".quantityValue .increment-quantity").click(function(){
        let input = $("#qty");
        let max = parseInt(input.attr("data-max")) || 20;
        let value = parseInt(input.val());

        if(value < max){
            input.val(value + 1);
        }
    });

    $(".quantityValue .decrement-quantity").click(function(){
        let input = $("#qty");
        let min = parseInt(input.attr("min")) || 1;
        let value = parseInt(input.val());

        if(value > min){
            input.val(value - 1);
        }
    });

    // Add To Cart Ajax Handler
    $(document).on("click", ".addToCart", function() {
        let product_id = $(this).data("product-id");
        let url = $(this).data("url");
        let quantity = $("#qty").val();

        $.ajax({
            url: url,
            type: "GET",
            data: {quantity: quantity},
            success: function(data){
                if($('#offcanvasRight').length) {
                    new bootstrap.Offcanvas($('#offcanvasRight')[0]).show();
                }
                $(".shopping-details").empty().append(data.cartViews);
            },
            error: function(xhr){
                console.log(xhr.responseText);
            }
        });
    });

    // Attribute Selector Processing
    $('.attributeItem li label').click(function() {
        var dataName = $(this).data('name');
        $('.attributeItem li label[data-name="'+dataName+'"]').removeClass('active');
        $(this).addClass('active');
        
        var image = $(this).data('image');
        if (image) {
            $('#mgmtMainImage').attr('src', image);
        }
        
        setTimeout(function() {
            var selectedIds = [];
            $('.attributeItem li .attributeValue:checked').each(function() {
                selectedIds.push($(this).data('vlueid'));
            });
            
            var datas = @json($datas ?? []);
            if(!datas.length) return;
            
            var filteredProducts = datas.filter(function(product) {
                return selectedIds.every(function(selectedId) {
                    return product.items.some(function(item) {
                        return item.attribute_item_id == selectedId;
                    });
                });
            });
            
            if(filteredProducts.length > 0) {
                var priceText = '';
                var status = true;
                var qtyVari = 0;
                
                filteredProducts.forEach(function(product) {
                    priceText = "Tk " + parseFloat(product.price).toLocaleString('en-US', {minimumFractionDigits: 2});
                    status = product.stock_status ? true : false;
                    qtyVari = product.quantity;
                });
                
                if(status){
                    $('.buyNowSinBtn, .addToSinBtn').prop('disabled', false);
                    $('.buyNowSinBtn').empty().append('BUY IT NOW');
                    if($('.productQtyValue').val() == 0){
                        $('.productQtyValue').val(1).prop('disabled', false);
                    }
                    $('.productQtyValue').attr('data-max', qtyVari);
                    $('.productPriceAppend').empty().append(priceText);
                    $('.productStock').empty().append('<b>Stock Available</b>');
                } else {
                    $('.buyNowSinBtn').empty().append('Pre Order').prop('disabled', false);
                    $('.addToSinBtn').prop('disabled', true);
                    $('.productQtyValue').val(1).prop('disabled', false);
                    $('.productPriceAppend').empty().append(priceText);
                    $('.productStock').empty().append('<b style="color:red;">Stock Out</b>');
                }
            } else {
                $('.buyNowSinBtn, .addToSinBtn').prop('disabled', true);
                $('.productQtyValue').val(0).prop('disabled', true);
                $('.productStock').empty().append('<b style="color:red;">Stock Out</b>');
            }
        }, 10);
    });

    // Accordion Toggle Behavior Logic for Static Accordion Section
    $('.mgmt-accordion-btn').click(function(){
        let item = $(this).closest('.mgmt-accordion-item');
        let body = item.find('.mgmt-accordion-body');
        let icon = $(this).find('.mgmt-accordion-icon');
        
        if(item.hasClass('mgmt-accordion-open')) {
            item.removeClass('mgmt-accordion-open');
            body.attr('hidden', true);
            icon.removeClass('fa-minus').addClass('fa-plus');
            $(this).attr('aria-expanded', 'false');
        } else {
            item.addClass('mgmt-accordion-open');
            body.removeAttr('hidden');
            icon.removeClass('fa-plus').addClass('fa-minus');
            $(this).attr('aria-expanded', 'true');
        }
    });


});
</script>
@endpush