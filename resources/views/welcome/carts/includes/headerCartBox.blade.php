{{--
<a class="nav-link cart_trigger" href="#" data-bs-toggle="dropdown">
    <i class="linearicons-cart"></i>
    <span class="cart_count">{{$cartsCount}}</span>
</a>
<div class="cart_box dropdown-menu dropdown-menu-right">
    @if($carts->count() > 0)
        <ul class="cart_list">
            @foreach($carts as $cart)
            <li>
                <a href="javascript:void(0)" class="item_remove cartUpdate" data-url="{{ route('changeToCart', [$cart, 'delete']) }}" ><i class="ion-close"></i></a>
                <a href="{{route('productView',$cart->product->slug?:'no-title')}}"><img src="{{assetUrl($cart->product->image())}}" alt="{{$cart->product->name}}">{{$cart->product->name}}</a>
                <span class="cart_quantity"> {{ $cart->quantity }} x {{priceFullFormat($cart->itemprice())}}</span>
            </li>
            @endforeach
        </ul>
        <div class="cart_footer">
            <p class="cart_total"><strong>Subtotal:</strong>{{priceFullFormat($cartTotalPrice)}}</p>
            <p class="cart_buttons"><a href="{{route('carts')}}" class="btn btn-fill-line rounded-0 view-cart">View Cart</a><a href="{{route('checkout')}}" class="btn btn-fill-out rounded-0 checkout">Checkout</a></p>
        </div>
    @else
    <div class="cart_empty">
        <i class="linearicons-cart"></i>
        <h4>Empty Cart</h4>
        <a href="{{route('index')}}" class="btn btn-fill-line rounded-0 view-cart">Shopping</a>
    </div>
    @endif 
</div>
--}}

<style>
  #offcanvasRight.shopping-details{ width:380px; max-width:92vw; }
  #offcanvasRight .offcanvas-header{
    padding:18px 20px; border-bottom:1px solid #eef0f4; align-items:center;
  }
  #offcanvasRight .offcanvas-title{ font-size:1.1rem; font-weight:700; color:#2c3345; margin:0; }

  #offcanvasRight .offcanvas-body{ padding:6px 16px; }
  #offcanvasRight .offcanvas-cart{ list-style:none; margin:0; padding:0; }
  #offcanvasRight .offcanvas-cart > li{
    display:flex; align-items:center; gap:12px;
    padding:14px 2px;
    border-bottom:1px solid #f0f2f5;
  }
  #offcanvasRight .offcanvas-cart > li:last-child{ border-bottom:0; }
  #offcanvasRight .offcanvas-cart > li > a{ flex-shrink:0; line-height:0; }
  #offcanvasRight .offcanvas-cart > li img{
    width:64px; height:64px; object-fit:cover;
    border:1px solid #eef0f4; border-radius:10px; background:#fff;
  }
  #offcanvasRight .offcanvas-cart > li > div{ flex:1; min-width:0; }
  #offcanvasRight .offcanvas-cart > li h6{
    font-size:.85rem; font-weight:600; color:#2c3345; line-height:1.35;
    display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
    margin:0 0 4px !important;
  }
  #offcanvasRight .offcanvas-cart > li p{
    margin:0; font-size:.82rem; color:#8a93a5;
  }
  #offcanvasRight .offcanvas-cart > li p b{ color:#1f7a4d; font-weight:600; }
  #offcanvasRight .offcanvas-cart > li .fa-trash{
    color:#ef6079 !important; font-size:13px;
    padding:9px; border-radius:8px; flex-shrink:0; transition:.15s;
  }
  #offcanvasRight .offcanvas-cart > li .fa-trash:hover{ background:#fdeef1; }

  #offcanvasRight .offcanvas-cart > li:only-child:has(.cart-empty-mini){ display:block; border:0; padding:0; }
  #offcanvasRight .cart-empty-mini{
    width:100%; text-align:center; padding:48px 20px; color:#8a93a5;
  }
  #offcanvasRight .cart-empty-mini i{ font-size:34px; color:#c9d0da; display:block; margin-bottom:12px; }
  #offcanvasRight .cart-empty-mini span{ font-size:.9rem; }

  #offcanvasRight .offcanvas-footer{
    padding:16px 20px 20px; border-top:1px solid #eef0f4; background:#fafbfc;
  }
  #offcanvasRight .price-box{
    display:flex; justify-content:space-between; align-items:center; margin:0 0 14px;
  }
  #offcanvasRight .price-box h6{ margin:0; font-weight:700; color:#2c3345; font-size:.95rem; }
  #offcanvasRight .price-box p{ margin:0; font-weight:700; color:#1f7a4d; font-size:1.1rem; }
  #offcanvasRight .cart-button{ display:flex; gap:10px; }
  #offcanvasRight .cart-button .btn{
    flex:1; border-radius:10px !important; padding:.72rem .5rem; font-weight:600; font-size:.85rem;
    display:flex; align-items:center; justify-content:center; transition:.2s;
  }
  #offcanvasRight .cart-button .btn_outline{
    background:#fff; border:1px solid #d7dce3; color:#2c3345;
  }
  #offcanvasRight .cart-button .btn_outline:hover{ border-color:#1f7a4d; color:#1f7a4d; }
  #offcanvasRight .cart-button .btn_black{
    background:#0d3d33; border:1px solid #0d3d33; color:#fff;
  }
  #offcanvasRight .cart-button .btn_black:hover{ background:#0a2e27; border-color:#0a2e27; }
</style>

<div class="offcanvas-header">
 <h4 class="offcanvas-title" id="offcanvasRightLabel">Shopping Cart</h4>
 <button class="btn-close" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body theme-scrollbar">
    <ul class="offcanvas-cart">
    @if(@isset($carts) && $carts->count() > 0)
    @foreach($carts as $cart)
       <li>
        <a href="{{route('productView',$cart->product->slug?:'no-title')}}">
            <img src="{{assetUrl($cart->product->image())}}" alt="{{$cart->product->name}}" />
        </a>
        <div>
           <h6 class="mb-0">{{$cart->product->name}}</h6>
           <p>{{ $cart->quantity }} &times; <b>{{priceFullFormat($cart->itemprice())}}</b></p>
         </div>
         <i class="fa fa-trash cartUpdate" style="cursor: pointer;" data-url="{{ route('changeToCart', [$cart->id, 'delete']) }}" ></i>
       </li>
       @endforeach
    @else
    <li>
        <div class="cart-empty-mini">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Your cart is empty</span>
        </div>
    </li>
    @endif
     </ul>
</div>
<div class="offcanvas-footer">
 <div class="price-box">
   <h6>Total</h6>
   <p>@isset($cartTotalPrice){{priceFullFormat($cartTotalPrice)}}@endisset</p>
 </div>
 <div class="cart-button"><a class="btn btn_outline" href="{{route('carts')}}">View Cart</a><a class="btn btn_black" href="{{route('checkout')}}">Checkout</a></div>
</div>