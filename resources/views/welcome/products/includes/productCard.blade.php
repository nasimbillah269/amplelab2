
                
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
            @php
              $rawStock = $product->stock_status;
              $stockBadge = match(true) {
                is_null($rawStock) => ['label' => 'READY STOCK', 'class' => 'badge-ready'],
                (int) $rawStock === 2 => ['label' => 'PRE ORDER', 'class' => 'badge-pre'],
                (int) $rawStock === 0 => ['label' => 'OUT OF STOCK', 'class' => 'badge-out'],
                default => ['label' => 'READY STOCK', 'class' => 'badge-ready'],
              };
            @endphp
            <span class="badge-status {{ $stockBadge['class'] }}">{{ $stockBadge['label'] }}</span>
            <img src="{{ assetUrl($product->image()) }}" alt="Computer Workstation">
          </a>
          <div class="body">
            <a href="{{ route('productView',$product->slug?:Str::slug($product->name)) }}" class="title">{{ $product->name }}</a>
          </div>
          <div class="link-row">
            <a href="#">Specification</a>
            <a href="#">Catalog</a>
          </div>
          @if($product->offerPrice() > 0)
            <div class="price-btn price-value">
              {{ priceFullFormat($product->offerPrice()) }}/-
              @if($product->regularPrice() > $product->offerPrice())
                <del class="price-strike">{{ priceFullFormat($product->regularPrice()) }}/-</del>
              @endif
            </div>
          @else
            @php $waNumber = preg_replace('/\D+/', '', (string) optional(general())->mobile); @endphp
            <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode('I am interested in '.$product->name) }}" target="_blank" rel="noopener" class="price-btn">Request Price <i class="fa-brands fa-whatsapp"></i></a>
          @endif
        </div>