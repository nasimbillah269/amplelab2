
                
                 {{--<a href="{{ route('productView',$product->slug?:Str::slug($product->name)) }}" class="prod-card-anchor">
              <article class="prod-card">
                <div class="prod-media-wrapper">
                  <span class="prod-badge-pill">New</span>
                  <img src="{{ assetUrl($product->image()) }}" alt="Nuvesta LEGEND WOMEN Front View" class="prod-image prod-image-primary" loading="lazy">
                  <img src="{{ assetUrl($product->banner()) }}" alt="Nuvesta LEGEND WOMEN Back View" class="prod-image prod-image-secondary" loading="lazy">
                  <div class="prod-brand-watermark">
                    <i class="fa-solid fa-shirt"></i>
                  </div>
                </div>
                <div class="prod-content-body">
                      
                  <div class="prod-title-group">
                  
                      
                    <h2 class="prod-title">{{ $product->name }}</h2>
                  </div>
                  @if($product->sku_code)
                            <p class="prod-code"><span>{{$product->sku_code}}</span></p>
                        @endif

                  <div class="prod-specs-info">{{$product->productVariationAttributeList()->where('parent_id','68')->count()}} color(s) &middot; {{$product->productVariationAttributeList()->where('parent_id','73')->count()}} size(s)</div>
                </div>
              </article>
            </a>--}}
            
            
            <div class="product-card">
          <a href="{{ route('productView',$product->slug?:Str::slug($product->name)) }}" class="thumb">
            <span class="badge-status badge-ready">READY STOCK</span>
            <img src="{{ assetUrl($product->image()) }}" alt="Computer Workstation">
          </a>
          <div class="body">
            <a href="{{ route('productView',$product->slug?:Str::slug($product->name)) }}" class="title">{{ $product->name }}</a>
          </div>
          <div class="link-row">
            <a href="#">Specification</a>
            <a href="#">Catalog</a>
          </div>
          <button class="price-btn">Request Price <i class="fa-solid fa-file-lines"></i></button>
        </div>