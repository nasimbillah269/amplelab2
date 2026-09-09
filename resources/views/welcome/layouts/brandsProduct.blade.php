
<div class="allBrand">
    <div class="container">

        <div class="brandContainer">
            
            <div class="brandContainer2">
              <div class="sectionHeader">
             <div>
                 <h4>Shop</h4>
                    <h1 class="flash-title" style="margin: 0;"> by Brands</h1>
             </div>
             <div class="viewLink">
                 @if($bPg =pageTemplate('All Brands'))
                <a href="{{route('pageView',$bPg->slug?:'no-title')}}">View All</a>
                @endif
             </div>
        </div>
           <div class="col-md-12">
                <hr />
            </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="brandTab">
                    <nav>
                        <div class="nav nav-tabs brandSlick" id="nav-tab" role="tablist">
                            @foreach($brands as $i=>$brd)
                            <a class="nav-link slick-box"  href="{{route('productBrand',$brd->slug?:'no-title')}}" >
                                <img src="{{assetUrl($brd->image())}}" alt="{{$brd->name}}" />
                            </a>
                            @endforeach
                        </div>
                    </nav>
                </div>
            </div>
     
            {{--
            <div class="col-md-12">
                <div class="tab-content" id="nav-tabContent">
                    @foreach($brands as $bb=>$brand)
                    <div class="tab-pane fade" id="nav-brand_{{$brand->id}}" role="tabpanel" aria-labelledby="nav-brand_{{$brand->id}}-tab">
                        <div class="row">
                            @foreach($brand->brandProducts()->latest()->where('status','active')->limit(8)->get() as $product)
                            <div class="col-md-3 col-6">
                                @include(welcomeTheme().'.products.includes.productCard')
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            --}}
        </div>
    </div>
    </div>
        </div>
</div>
