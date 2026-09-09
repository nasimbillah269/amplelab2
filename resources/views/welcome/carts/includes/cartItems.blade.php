@if(isset($carts) && $carts->count() > 0)
@include(welcomeTheme().'.alerts')
<div class="row g-4">
           <div class="col-xxl-9 col-xl-8">
             <div class="cart-table">
               <div class="table-title"> 
                 <h5>Cart <span id="cartTitle">({{$carts->count()}}) </span></h5>
               </div>
               <div class="table-responsive theme-scrollbar"> 
                 <table class="table" id="cart-table">
                   <thead>
                     <tr> 
                       <th>Product  </th>
                       <th>Price  </th>
                       <th>Quantity </th>
                       <th>Total </th>
                       <th></th>
                     </tr>
                   </thead>
                   <tbody> 
                    @foreach($carts as $cart)
                     <tr> 
                       <td> 
                         <div class="cart-box">  
                            <a href="{{route('productView',$cart->product->slug?:'no-title')}}">  <img src="{{assetUrl($cart->image())}}" alt="{{$cart->product->name}}"  /></a>
                            <div>
                               <a href="{{route('productView',$cart->product->slug?:'no-title')}}"> 
                                <h5>{{$cart->product->name}}</h5>
                               </a>
                                @if($cart->itemAttributes())
    							<span style="font-size: 14px;">
                                    @foreach($cart->itemAttributes() as $attributeName => $value)
                                        <b>{{ $attributeName }}</b>: {{ $value }}
                                        @if(!$loop->last)
                                            , 
                                        @endif
                                    @endforeach
                                </span>
    							@endif
                             
                            </div>
                         </div>
                       </td>
                       <td>
                           {{priceFullFormat($cart->product->offerPrice())}}/-
                    @if($cart->product->regularPrice() > $cart->product->offerPrice())
                        <del>{{priceFullFormat($cart->product->regularPrice())}}/-</del>
                        
                        <span class="offer-btn">{{$cart->product->discountPercent()}}% off </span>
                        
                        @endif
                      </td>
                       <td>
                         <div class="quantity">
                           <button class="minus cartUpdate" data-url="{{ route('changeToCart', [$cart, 'decrement']) }}" type="button"><i class="fa-solid fa-minus"></i></button>
                           <input type="number" value="{{$cart->quantity}}" min="1" max="20" />
                           <button class="plus cartUpdate" data-url="{{ route('changeToCart', [$cart, 'increment']) }}" type="button"><i class="fa-solid fa-plus"></i></button>
                         </div>
                       </td>
                       <td>{{priceFullFormat($cart->subtotal())}}</td>
                       <td>
                           <a class="deleteButton cartUpdate" data-url="{{ route('changeToCart', [$cart, 'delete']) }}" style="color: #F44336;cursor: pointer;" href="javascript:void(0)"><i class="fa fa-trash" ></i></a>
                        </td>
                     </tr>
                    
                    @endforeach
    
                   </tbody>
                 </table>
               </div>
               <div class="no-data" id="data-show"><img src="{{assetUrl('public/welcome/assets/images/cart/1.gif')}}" alt="" />
                 <h4>You have nothing in  shopping cart! </h4>
                 <p>Today is a great  to purchase the things  have been holding onto!   <span>Carry on Buying </span></p>
               </div>
             </div>
           </div>
           <div class="col-xxl-3 col-xl-4">
             <div class="cart-items">      
               <!--<div class="cart-progress">-->
               <!--  <div class="progress">-->
               <!--    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 43%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><span>  <i class="iconsax" data-icon="truck-fast"></i></span></div>-->
               <!--  </div>-->
               <!--  <p>Almost there, add   <span>$267.00  </span>more to get  <span>FREE Shipping !!  </span></p>-->
               <!--</div>-->
               <div class="cart-body"> 
                 <h6>Price Details </h6>
                 <ul> 
                   <li> 
                     <p>Sub total  </p><span>{{priceFullFormat($cartTotalPrice)}}</span>
                   </li>
                   <li> 
                     <p>Coupon Discount  </p><span>{{priceFullFormat($couponDisc)}}</span>
                   </li>
                 </ul>
               </div>
               <div class="cart-bottom"> 
                    <h6>Grand Total  <span>{{priceFullFormat($grandTotal)}}</span></h6>
               </div>
               <div class="coupon-box"> 
                 <h6>Coupon </h6>
                    <form action="{{route('couponApply')}}" method="post">
    					@csrf
                         <ul> 
                            <li>
                                <span> 
                                    <input type="text" value="{{old('coupon_code')}}" name="coupon_code" placeholder="Apply Coupon" /><i class="iconsax me-1" data-icon="tag-2"></i>
                                </span>
                                <button class="btn" type="submit">Apply</button>
                            </li>
                         </ul>
                    </form>
               </div><a class="btn btn_black w-100 rounded sm" href="{{route('checkout')}}">Check Out </a>
             </div>
           </div>
         </div>


@else
<div class="cart_empty">
	<i class="linearicons-cart"></i>
	<h4>Continue Shopping</h4>
	<a href="{{route('index')}}" class="btn btn-success rounded-0 view-cart">Shopping</a>
</div>
@endif
