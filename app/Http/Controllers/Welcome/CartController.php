<?php

namespace App\Http\Controllers\Welcome;

use Mail;
use Auth;
use Cookie;
use Hash;
use Validator;
use Session;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Cart;
use App\Models\General;
use App\Models\Country;
use App\Models\Order;
use App\Models\User;
use App\Models\Post;
use App\Models\PostExtra;
use App\Models\Transaction;
use App\Models\WishList;
use App\Models\Attribute;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Library\SslCommerz\SslCommerzNotification;

class CartController extends Controller
{
    
    public function __construct(){
        $this->middleware('cart');
    }
    
    public function addToCart(Request $r,$id)
    {
        
    	
    	$product = Post::where('type',2)->find($id);
    	$qty = $r->quantity ?: 1;    
		$cookie = $r->cookie('carts');
        if($cookie && $product)
    	{
		
    	$color = Attribute::where('id', $r->color)->first();
    	$size = Attribute::where('id', $r->size)->first();
    	
    	$ct = $r->color;
    	$st = $r->size;
    	
    	$options=$r->option;

    	if($product->productAttibutesVariationGroup()->count() > 0 && $options==null){
    	    if($r->ajax())
	        {
                return Response()->json([
		            'success' => false,
		            'message' => 'Please select product variation item.',
		          ]);  
		          
	        }else{

	            return redirect()->route('productView',$product->slug?:'no-title')->with('error', 'Please select product variation item.');
	        }
    	}

    	$warranty =$r->warranty;
    	
    // 	if($product->warranty_note || $product->warranty_note2){
    // 	    if($warranty==null){
    // 	        if($r->ajax())
    // 	        {
    //                 return Response()->json([
    // 		            'success' => false,
    // 		            'message' => 'Please select product warranty option.',
    // 		          ]);  
    		          
    // 	        }else{
    	            
    // 	            return redirect()->route('')->with('error', 'Please select product warranty option.');
    // 	        }
    // 	    }   
    // 	}
    	
    	
    // 	if($ct and $st)
    // 	{
    // 	    $sku = ProductSku::where('product_id', $product->id)->where('color_id', $ct)->where('size_id', $st)->first();
    // 	}
    // 	elseif($ct and !$st)
    // 	{
    // 	    $sku = ProductSku::where('product_id', $product->id)->where('color_id', $ct)->where('size_id', null)->first();
    // 	}
    // 	elseif(!$ct and $st)
    // 	{
    // 	    $sku = ProductSku::where('product_id', $product->id)->where('color_id', null)->where('size_id', $st)->first();
    // 	}
    // 	else
    // 	{
    // 	}
    	    $sku = null;

    		//$oldCart = Cart::where('cookie', $cookie)->where('product_id', $product->id)->where('color', $ct)->where('size', $st)->first();
			
			$cart = Cart::where('cookie', $cookie)->where('product_id', $product->id);
            if (!empty($options)) {
                $cart = $cart->whereJsonContains('sku_id', $options);
            }
            $cart = $cart->first();
            
            if(!$cart){
                $cart = new Cart;
                $cart->product_id = $product->id;
                $cart->cookie = $cookie;
                if (!empty($options)) {
                $cart->sku_id = json_encode($options);
                }
                $cart->save();
            }
    
            $totalQty =$cart->quantity+$qty;
            $cart->addedby_id = Auth::id();
            $cart->user_id = Auth::id();
            
            if($warranty){
            $cart->warranty_note = $warranty=='warranty_note2'?$product->warranty_note2:$product->warranty_note;
            $cart->warranty_charge = $warranty=='warranty_note2'?$product->warranty_charge2:$product->warranty_charge;
            }
            
            $cart->quantity =$totalQty;  //$totalQty < $product->productMinQty() ? $product->productMinQty() : ($totalQty > $product->productMaxQty()  ? $product->productMaxQty()  : $totalQty);
            $cart->save();
			
    // 		if($oldCart){
    		    
    //             $oldCart->trans_date = date("Y-m-d");
    //             $oldCart->user_id = Auth::id();
    //             $oldCart->quantity += $qty;
    //             $oldCart->save();
                
    // 		}else{
				
    // 			$cart = new Cart;
    //             $cart->addedby_id = Auth::id();
    //             $cart->trans_date = date("Y-m-d");
    //             $cart->user_id = Auth::id();
    //             $cart->product_id = $product->id;
    //             $cart->color = $r->has('color') ? $ct : null;
    //             $cart->size = $r->has('size') ? $st : null;
                
    //             $cart->sku_id = $sku ? $sku->id : null;
    //             if($product->emi_status==true && $r->statusEmi==true){
    //             $cart->emi = 1;
    //             }else{
    //             $cart->emi = 0;
    //             }
    //             //$cart->quantity = $qty >= $product->min_order_quantity ? $qty : $product->min_order_quantity;
    //             $cart->quantity = $qty;
    //             $cart->cookie = $cookie;
    //             $cart->save();
                
    // 		}
            
            $couponDisc = 0;
            $cartTotalPrice = 0;
            $grandTotal = 0;
	    	$couponDisc = 0;
	    	$cartsCount = 0;
	    	$shippingCharge = 0;
	    	$carts =null;
            
            $myCarts = myCart($cookie);      
            if(count($myCarts['carts']))
            {   
                $carts =$myCarts['carts'];
    	    	$couponDisc = $myCarts['couponDisc'];
    	    	$cartTotalPrice = $myCarts['cartTotalPrice'];
                $cartsCount =$myCarts['cartsCount'];
    	    	$grandTotal = $myCarts['grandTotal'];
    	    	$shippingCharge = $myCarts['shippingCharge'];
            }

	    	$cartItems =view(welcomeTheme().'carts.includes.headerCartBox',compact('carts','couponDisc','cartTotalPrice','grandTotal','shippingCharge'))->render();

		    if($r->ajax())
	        {	

		        return Response()->json([
		            'success' => true,
		            'cartViews' => $cartItems,
		            'cartCount' => $cartsCount,
		            'cartTotal' => priceFullFormat($cartTotalPrice),
		          ]);
	    	}else{
	    	     if($r->orderNow)
                {
                	return redirect()->route('checkout');
                }
                else
                {
                	return back()->with('success', 'Product successfully added to cart');
                }
	    	}
        }else{
            
           if($r->ajax())
	        {
            
                return Response()->json([
		            'success' => false,
		          ]);  
		          
	        }else{
	            if($r->orderNow)
                {
                	return redirect()->route('checkout');
                }
                else
                {
                	return back()->with('success', 'Product successfully added to cart');
                }
	        }
        }

        

        // return back();
    }


    public function changeToCart(Request $r,$id,$type){

    	if($r->ajax())
        {

        	$cart =Cart::find($id);

	    	$cookie = $r->cookie('carts');

	    	if($cookie && $cart)
	    	{
	    	    $s=true;
	    		if($type == 'increment')
		    	{
		    		

		    		$qty = $cart->quantity + 1;

		    		$cart->update(['quantity'=> $qty]);

		    		// $maxLimit = $cart->product->max_order_quantity ?: $cart->product->quantity;
		    		// if($qty <= $maxLimit){

		    		// 	$cart->update(['quantity'=> $qty]);
		    		// 	$s = true; 

		    		// }else{
		    		// 	$s = false;
		    		// }



		    	}elseif($type == 'decrement'){
		    		
		    		if($cart->quantity > 1){
		    		    $qty = $cart->quantity - 1;
                        $cart->update(['quantity'=> $qty]);
		    		}
                    
		    		// $minLimit = $cart->product->min_order_quantity ?: 1;

		    		// if($qty >= 1 && $qty >= $minLimit)
		    		// {
		    		// 	$cart->update(['quantity'=> $qty]);
		    		// 	$s = true;
		    		// }else{
		    		// 	$s = false;
		    		// }


		    	}elseif($type == 'quantity'){
		    	    
		    	    $qty =$r->qty?:1;
		    	    $cart->update(['quantity'=> $qty]);
		    	      
		    	 //   $maxLimit = $cart->product->max_order_quantity ?: $cart->product->quantity;
		    	 //   $minLimit = $cart->product->min_order_quantity ?: 1;
		    		// if($qty <= $maxLimit && $qty >= $minLimit && $qty >= 1){

		    		// 	$cart->update(['quantity'=> $qty]);
		    		// 	$s = true; 

		    		// }else{
		    		// 	$s = false;
		    		// }
		    	    
		    	}elseif($type == 'delete'){
		    		$cart->delete();
		    	}

		    	$couponDisc = 0;
                $cartTotalPrice = 0;
                $grandTotal = 0;
		    	$couponDisc = 0;
		    	$cartsCount = 0;
		    	$shippingCharge = 0;
		    	$carts =null;
                
                $myCarts = myCart($cookie);      
                if(count($myCarts['carts']))
                {   
                    $carts =$myCarts['carts'];
        	    	$couponDisc = $myCarts['couponDisc'];
        	    	$cartTotalPrice = $myCarts['cartTotalPrice'];
                    $cartsCount =$myCarts['cartsCount'];
        	    	$grandTotal = $myCarts['grandTotal'];
        	    	$shippingCharge = $myCarts['shippingCharge'];
                }

		    	$cartItems =view(welcomeTheme().'carts.includes.cartItems',compact('carts','couponDisc','cartTotalPrice','grandTotal','shippingCharge'))->render();
                $cartViews =view(welcomeTheme().'carts.includes.headerCartBox',compact('carts','couponDisc','cartTotalPrice','grandTotal','shippingCharge'))->render();
		    	return Response()->json([
			            'success' => $s,
			            'cartItems' => $cartItems,
			            'cartViews' => $cartViews,
			            'cartCount' => $cartsCount,
		                'cartTotal' => priceFullFormat($cartTotalPrice),
			          ]);


		    }else{

		    	return Response()->json([
			            'success' => false,
			          ]);

		    }

        }

    }

    public function couponApply(Request $r){

    	$check = $r->validate([
            'coupon_code' => 'required|max:100'
        ]);

    	$coupon = Attribute::where('name', $r->coupon_code)
            ->where('status','active')
            ->whereDate('start_date', '<=', date('Y-m-d'))
            ->whereDate('end_date', '>=', date('Y-m-d'))
            ->first();
            
        if(!$coupon){
            $r->session()->forget(['my_coupon_id']);
            return back()->with('info', 'Sorry, your coupon is invalid. Please, try again with another coupon code');
        }
        $cartTotalPrice =0;
        $cookie = $r->cookie('carts');
        if($cookie){
            $carts = Cart::where('cookie', $cookie)->get();
            foreach($carts as $cart){
                $cartTotalPrice +=$cart->subtotal();
            }
        }
        
        if($coupon->min_shopping > 0 && $coupon->max_shopping > 0){
            if($cartTotalPrice >= $coupon->min_shopping && $cartTotalPrice <= $coupon->max_shopping){}else{
                $r->session()->forget(['my_coupon_id']);
                return back()->with('info', 'Sorry, you can not use coupon reason shopping Amount limit. Please, Minimum shopping '.priceFullFormat($coupon->min_shopping));
            }
        }elseif($coupon->min_shopping > 0){
            if($cartTotalPrice >= $coupon->min_shopping){}else{
                $r->session()->forget(['my_coupon_id']);
                return back()->with('info', 'Sorry, you can not use coupon reason shopping Amount limit. Please, Minimum shopping '.priceFullFormat($coupon->min_shopping));
            }
        }elseif($coupon->max_shopping > 0){
            if($cartTotalPrice <= $coupon->max_shopping){}else{
                $r->session()->forget(['my_coupon_id']);
                return back()->with('info', 'Sorry, you can not use coupon reason shopping Amount limit. Please, Maximum shopping '.priceFullFormat($coupon->max_shopping));
            }
        }
        
        $r->session()->put(['my_coupon_id'=>$coupon->id]);
        return back()->with('success', 'Your coupon code is valid and successfully added');

    }


    public function carts(Request $r){
        
        // $myCarts = myCart($r->cookie('carts'));        
        
        // foreach($myCarts['carts'] as $cart) {
        //     return $cart->image();
        //     $selectedIds = json_decode($cart->sku_id, true);
        //     $proDatas = $cart->product->productVariationAttributeItems()->get(['id', 'src_id', 'reguler_price', 'discount', 'final_price', 'quantity', 'stock_status']);
        //         $datas = [];
        //         foreach ($proDatas as $data) {
        //             $attributeItemIds = $data->attributeVatiationItems()->get(['attribute_item_id']);
        //             $datas[] = [
        //                 'price' => $data->offerPrice(),
        //                 'stock_status' => $data->stock_status,
        //                 'items' => $attributeItemIds
        //             ];
        //         }

        //     $filteredDatas = array_filter($datas, function($product) use ($selectedIds) {
        //         return collect($selectedIds)->every(function($selectedId, $attributeId) use ($product) {
        //             return collect($product['items'])->contains(function($item) use ($selectedId) {
        //                 return $item['attribute_item_id'] == $selectedId;
        //             });
        //         });
        //     });

        //     $firstProduct = array_shift($filteredDatas);
        //     return $firstProduct;

        // }
        
        // return $myCarts;
                

    	return view(welcomeTheme().'carts.cart');
    }
    
    

    public function checkout(Request $r){
    	$user =Auth::user();
        $myCarts = myCart($r->cookie('carts'));         
        if(count($myCarts['carts']) ==0)
        {
            return redirect()->route('carts')->with('info', 'Sorry, Your Cart Is empty.');
        }
        
       

        if($r->isMethod('post')){
            

            
            $check = $r->validate([
                'name' => 'required|max:100',
                'email' => 'nullable|max:100',
                'mobile' => 'required|max:20',
                'district' => 'nullable|numeric',
                'city' => 'nullable|numeric',
                'address' => 'required|max:500',
                'payment_option' => 'required',
            ]);
           
            $order =new Order();
            $order->user_id=Auth::check()?$user->id:null;
            $order->name=$r->name;
            $order->mobile=$r->mobile;
            $order->email=$r->email;
            $order->district=$r->district;
            $order->city=$r->city;
            $order->address=$r->address;
            $order->postal_code=$r->postal_code;
            $order->note=$r->note;
            $order->order_status='pending';
            $order->pending_at=Carbon::now();
            $order->pending_by=Auth::check()?$user->id:null;
            $order->save();
            $order->invoice=$order->created_at->format('Ymd').$order->id;
            $order->save();
            



            foreach($myCarts['carts'] as $cart){
                // return $cart;
                $item = new OrderItem;
                $item->order_id = $order->id;
                $item->user_id = Auth::check()?$user->id:null;
                $item->invoice = $order->invoice;
                $item->product_id = $cart->product_id;
                $item->product_name = $cart->product?$cart->product->name:null;
                $item->quantity = $cart->quantity;
                // if($product =$cart->product){
                //     if($product->variation_status){
                        
                //     }else{
                //         if($product->quantity > $item->quantity){
                //             $product->quantity-=$item->quantity;
                //             $product->sell_count+=1;
                //             $product->save();
                //         }
                //     }
                // }
                $item->price = $cart->itemprice(); 
                if (!empty($cart->itemAttributes())) {
                $item->sku_value = json_encode($cart->itemAttributes());
                }
                $item->sku_id = $cart->sku_id;
                
                if($cart->itemStock()==0){
                    $item->pre_order=1;
                }
                
                $item->color = $cart->color; 
                $item->size = $cart->size; 
                $item->warranty_note = $cart->warranty_note; 
                $item->warranty_charge = $cart->warranty_charge?:0; 
                $item->total_price = $cart->subtotal();
                $item->final_price = $cart->subtotal()-$item->total_deal_discount;
                $item->pending_at = Carbon::now();
                $item->pending_by = Auth::check()?$user->id:null;
                $item->addedby_id = Auth::check()?$user->id:null;
                $item->status=$order->order_status;
                $item->order_status=$order->order_status;
                $item->save();

                $cart->delete();
            }
            
            if($order->district==73){
            $shippingCharge=general()->inside_dhaka_shipping_charge?:0;
            }else{
            $shippingCharge=general()->outside_dhaka_shipping_charge?:0;
            }
       
            $shippingCharge=0;


            
            
            $order->coupon_discount=$myCarts['couponDisc'];
            $order->shipping_charge =$shippingCharge;
            $order->total_price=$order->items->sum('final_price');
            $order->tax=0;
            if($r->payment_option=='Online Payment'){
            $order->getway_charge=$order->total_price*2.56/100;
            }else{
            $order->getway_charge=0;
            }
            
            $order->grand_total =$order->total_price + $order->shipping_charge + $order->getway_charge + $order->tax - $order->coupon_discount;
            $order->paid_amount=0;
            $order->payment_method=$r->payment_option;
            $order->due_amount=$order->grand_total;
            $order->save();
            
            if($r->payment_option=='Online Payment' || $r->payment_option=='EMI Online Payment'){
                $cityName=null;
                $stateName=null;
                
                $city =Country::find($r->city);
                if($city){
                    $cityName =$city->name;
                }
                
                $state =Country::find($r->district);
                if($state){
                    $stateName =$state->name;
                }
                
                    $emi_status = 0;
                if($r->payment_option=='EMI Online Payment' && $order->grand_total >= 5000){
                    $emi_status = 1;
                }
                
                $datas =[
                    'name'=>$r->name,
                    'email'=>$r->email,
                    'mobile'=>$r->mobile,
                    'address'=>$r->address,
                    'cityName'=>$cityName,
                    'stateName'=>$stateName,
                    'postCode'=>null,
                    'country'=>'Bangladesh',
                    'transection'=>$order->invoice,
                    'currency'=>'BDT',
                    'grand_total'=>$order->grand_total,
                    'emi_option'    => $emi_status,
                    'emi_allow_only'    => $emi_status,
                ];
                
                
                return $this->sslCommercePay($datas);
            }
            
            //**********Send Mail***************//

            if(general()->mail_status && $order->email){
                //Mail Data
                $datas =array('order'=>$order);
                $template ='mails.InvoiceMail';
                $toEmail =$order->email;
                $toName =$order->name;
                $subject ='Order Successfully Completed in '.general()->title;
            
                sendMail($toEmail,$toName,$subject,$datas,$template);
            }
           
            if(general()->mail_status && general()->mail_from_address){
                //Mail Data
                $datas =array('order'=>$order);
                $template ='mails.InvoiceMail';
                $toEmail =general()->mail_from_address;
                $toName =general()->mail_from_name;
                $subject ='Order Successfully Completed in '.general()->title;
            
                sendMail($toEmail,$toName,$subject,$datas,$template);
            }
            //**********Send Mail***************//
            if(Auth::check()){
                return redirect()->route('customer.orderDetails',$order->invoice)->with('success', 'Order successfully submitted');
            }else{
              return redirect()->route('invoiceView',$order->invoice)->with('success', 'Order successfully submitted');  
            }

        }
        
        
	    if($r->ajax() && $r->areaId){

	        
	          $areaId =PostExtra::where('type',3)->where('parent_id','<>',null)->where('src_id',$r->areaId)->first();
    	      if($areaId){
                 $day =$areaId->parentId?$areaId->parentId->shipping_charge:0;
    	         
    	         
    	         if ($now->gte($today) && $day <= 1) {
                    //change After Time
                    $afterDay=2;
                }else{
                   $afterDay=1+$day; 
                }
    	         
    	      }else{
    	        if ($now->gte($today)) {
                    //change After Time
                    $afterDay=2;
                }else{
                   $afterDay=1; 
                }
    	          
    	      }
	        
	        
	        $view  =View(welcomeTheme().'carts.includes.shippinigAddress',compact('afterDay'))->render();
	        return Response()->json([
              'success' => true,
              'view' => $view,
              'afterDay' => $afterDay,
              'areaId' => $areaId?:'',
              'parent' => $areaId?$areaId->parentId:'',
            ]);
	    }
	    

    	return view(welcomeTheme().'carts.checkout',compact('user'));
    }
    
    public function sslCommercePay($datas){
        
        $post_data = array();
        $post_data['total_amount'] = $datas['grand_total']; # You cant not pay less than 10
        $post_data['currency'] = $datas['currency'];
        $post_data['tran_id'] = $datas['transection']; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $datas['name'];
        $post_data['cus_email'] = $datas['email'];
        $post_data['cus_add1'] = $datas['address'];
        $post_data['cus_city'] = $datas['cityName'];
        $post_data['cus_state'] = $datas['stateName'];
        $post_data['cus_postcode'] =$datas['postCode'];
        $post_data['cus_country'] = $datas['country'];
        $post_data['cus_phone'] = $datas['mobile'];
        $post_data['cus_fax'] = "";
        
         # EMI INFORMATION
        if($datas['emi_option']){
            $post_data['emi_option'] = $datas['emi_option'];
            // $post_data['emi_allow_only'] = $datas['emi_allow_only'];
        }

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
        
        return abort(404);
    }
    
    public function sslPayment(Request $request,$action){
        

        if($action=='again-pay'){
            $order =Order::find($request->order_id);
            if($order){
                
                $datas =[
                    'name'=>$order->name,
                    'email'=>$order->email,
                    'mobile'=>$order->mobile,
                    'district'=>$order->district,
                    'city'=>$order->city,
                    'address'=>$order->address,
                    'cityName'=>$order->cityN?$order->cityN->name:null,
                    'stateName'=>$order->districtN?$order->districtN->name:null,
                    'postCode'=>null,
                    'country'=>'Bangladesh',
                    'payment_option'=>'Online Payment',
                    'note'=>null,
                    'status'=>$order->order_status,
                    'transection'=>$order->invoice,
                    'currency'=>'BDT',
                    'grand_total'=>$order->grand_total,
                ];
                
                return $this->sslCommercePay($datas);
                
            }else{
                return abort(404);
            }
        }
        
        if($action=='success'){
            
            $tran_id = $request->input('tran_id');
            $amount = $request->input('amount');
            $currency = $request->input('currency');
    
            $sslc = new SslCommerzNotification();
            
            $order = Order::latest()->where('invoice', $tran_id)->first();
            if($order){
                $user =$order->user;
                    if($user && !Auth::check()){
                        Auth::login($user);
                    }
                if ($order->order_status == 'pending') {
                    $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);
                    if ($validation) {
                        $order->order_status='confirmed';
                        $order->paid_amount=$order->grand_total;
                        $order->due_amount=0;
                        $order->payment_status='paid';
                        $order->save();
                        
                        $transection =new Transaction();
                        $transection->billing_name=$order->name;
                        $transection->billing_email=$order->email;
                        $transection->billing_mobile=$order->mobile;
                        $transection->billing_address=$order->fullAddress();
                        $transection->transection_id=$tran_id;
                        $transection->payment_method=$order->payment_method;
                        $transection->currency='BDT';
                        $transection->status='Success';
                        $transection->type=0;
                        $transection->save();
                    }
                }
            
            //**********Send Mail***************//

            if(general()->mail_status && $order->email){
                //Mail Data
                $datas =array('order'=>$order);
                $template ='mails.InvoiceMail';
                $toEmail =$order->email;
                $toName =$order->name;
                $subject ='Order Successfully Completed in '.general()->title;
            
                sendMail($toEmail,$toName,$subject,$datas,$template);
            }
           
            if(general()->mail_status && general()->mail_from_address){
                //Mail Data
                $datas =array('order'=>$order);
                $template ='mails.InvoiceMail';
                $toEmail =general()->mail_from_address;
                $toName =general()->mail_from_name;
                $subject ='Order Successfully Completed in '.general()->title;
            
                sendMail($toEmail,$toName,$subject,$datas,$template);
            }
            if(general()->mail_status){
                //Mail Data
                $datas =array('order'=>$order);
                $template ='mails.InvoiceMail';
                $toEmail ='info@bytebliss.com.bd';
                $toName =general()->mail_from_name;
                $subject ='Order Successfully Completed in '.general()->title;
            
                sendMail($toEmail,$toName,$subject,$datas,$template);
            }
            if(general()->mail_status){
                //Mail Data
                $datas =array('order'=>$order);
                $template ='mails.InvoiceMail';
                $toEmail ='safiul.alam@bytebliss.com.bd';
                $toName =general()->mail_from_name;
                $subject ='Order Successfully Completed in '.general()->title;
            
                sendMail($toEmail,$toName,$subject,$datas,$template);
            }
            //**********Send Mail***************//
            
            
            $status='success';
            $message= 'Your order is successfully Completed';
            Session::flash($status,$message);
            
            return redirect()->route('invoiceView',$order->invoice);
            
            }else {
                $status='error';
                $message= 'Order Invalid Transaction';   
            }

            Session::flash($status,$message);
            return redirect()->route('checkout');
            
            
        }
        
        if($action=='fail'){
            $tran_id = $request->input('tran_id');
            if($tran_id){
                $order = Order::latest()->where('invoice', $tran_id)->first();
                if($order){
                    $user =$order->user;
                    if($user && !Auth::check()){
                        Auth::login($user);
                    }
                    if ($order->order_status != 'pending') {
                        $status='success';
                        $message= 'Transaction is successfully Completed';
                    }
                    $status='error';
                    $message= 'Transaction is Cancel';
                    
                    Session::flash($status,$message);
                    return redirect()->route('invoiceView',$order->invoice);
                    
                }else{
                    
                    $status='error';
                    $message= 'Order Invalid Transaction';    
                }

            }else{
                $status='error';
                $message= 'Order information Invalid Data';
            }

            Session::flash($status,$message);
            return redirect()->route('checkout');
            
        }
        
        if($action=='cancel'){
            
            $tran_id = $request->input('tran_id');
            if($tran_id){
                $order = Order::latest()->where('invoice', $tran_id)->first();
                if($order){
                    $user =$order->user;
                    if($user && !Auth::check()){
                        Auth::login($user);
                    }
                    
                    if ($order->order_status != 'pending') {
                        $status='success';
                        $message= 'Transaction is successfully Completed';
                    }
                    $status='error';
                    $message= 'Transaction is Cancel';
                    
                    Session::flash($status,$message);
                    return redirect()->route('invoiceView',$order->invoice);
                    
                }else{
                    
                    $status='error';
                    $message= 'Order Invalid Transaction';    
                }

            }else{
                $status='error';
                $message= 'Order information Invalid Data';
            }

            Session::flash($status,$message);
            return redirect()->route('checkout');
        }
        
        if($action=='ipn'){
            if ($request->input('tran_id'))
            {
                $tran_id = $request->input('tran_id');
                
                $order = Order::latest()->where('invoice', $tran_id)->first();
                if($order){
                    if($order->order_status == 'pending') {
                        $sslc = new SslCommerzNotification();
                        $validation = $sslc->orderValidate($request->all(), $tran_id, $order->grand_total, 'BDT');
                        if ($validation == TRUE) {
                            $order->order_status='confirmed';
                            $order->paid_amount=$order->grand_total;
                            $order->due_amount=0;
                            $order->payment_status='paid';
                            $order->save();
                            
                            $transection =new Transaction();
                            $transection->billing_name=$order->name;
                            $transection->billing_email=$order->email;
                            $transection->billing_mobile=$order->mobile;
                            $transection->billing_address=$order->fullAddress();
                            $transection->transection_id=$tran_id;
                            $transection->payment_method=$order->payment_method;
                            $transection->currency='BDT';
                            $transection->status='Success';
                            $transection->type=0;
                            $transection->save();

                        }
                    }
                    
                }else {
                    $status='error';
                    $message= 'Order Invalid Transaction';
                    Session::flash($status,$message);
                    return redirect()->route('checkout');
                }
            } else {
                $status='error';
                $message= 'Order information Invalid Data';
                Session::flash($status,$message);
                return redirect()->route('checkout');
            }
            
        }
        
        
        return abort(404);
        
    }
    
    public function invoiceView($invoice){
        
        $order = Order::where('order_type','customer_order')->where('invoice',$invoice)->first();
        if(!$order){
            return abort(404);
        }
       return view(welcomeTheme().'carts.cartInvoice',compact('order'));
    }
    

    public function orderPayment($id){

        $order =Order::find($id);

        if(!$order){
            Session::flash('error','This Order Invoic Are Not Found');
            return redirect()->route('customer.myOrders');
        }
        $active='';
        $general =General::first();

        if($general->online_payment){
            $active ='handcash_payment';
        }elseif($general->wallet_payment){
            $active ='wallet_payment';
        }else{
            $active ='online_payment';
        }
        
        //Mail Send / SMS Send
        
        //**********Send Mail***************//
        
        if($general->mail_status && $order->email){

            Mail::to($order->email)->send(new orderInvoiceMail($order));
            
        }
        
        //**********Send Mail***************//
        
         //**********Send SMS ***************//
            if($general->sms_status){
        
                //Send SMS User
                if($general->order_place_sms_customer && $order->mobile){
                    
                    $m =$order->mobile;
                    
                    $to =bdMobile($m);
                    
                    if(strlen($to) != 13)
                    {
                        return true;
                    }
                    $msg = urlencode("Your order #{$order->invoice} is Successfully Place in {$general->title}. Total Invoice Cost is {$general->currency} {$order->grand_total}."); //150 characters allowed here
        
                    $url = smsUrl($to,$msg);
                
                    $client = new Client();
                    
                    try {
                            $r = $client->request('GET', $url);
                        } catch (\GuzzleHttp\Exception\ConnectException $e) {
                        } catch (\GuzzleHttp\Exception\ClientException $e) {
                        }
                    
                    
                }
                
                //Send SMS Vendor User
                if($general->order_place_sms_vendor){
                    
                    foreach($order->items as $item){
                        
                        if($item->seller){
                            
                            if($item->seller->user){
                                
                                if($item->seller->user->mobile){
                                    
                                    $m =$item->seller->user->mobile;
                    
                                    $to =bdMobile($m);
                                    
                                    if(strlen($to) != 13)
                                    {
                                        return true;
                                    }
                                    $msg = urlencode("Your Product New order #{$order->invoice} is Successfully Place in {$general->title}. Total Cost is {$general->currency} {$item->seller_paid}."); //150 characters allowed here
                        
                                    $url = smsUrl($to,$msg);
                                
                                    $client = new Client();
                                    
                                    try {
                                            $r = $client->request('GET', $url);
                                        } catch (\GuzzleHttp\Exception\ConnectException $e) {
                                        } catch (\GuzzleHttp\Exception\ClientException $e) {
                                        }
                                    
                                }
                                
                                
                            }
                            
                        }
                        
                    }
                    
                }
                
                //Send SMS Admin
                if($general->order_place_sms_admin && $general->admin_numbers){
                    
                    $to =$general->admin_numbers;

                    $msg = urlencode("New Order in {$general->title}. Invoice: {$order->invoice}, Total Cost: {$order->grand_total}."); //150 characters allowed here
        
                    $url = smsUrl($to,$msg);
                
                    $client = new Client();
                    
                    try {
                            $r = $client->request('GET', $url);
                        } catch (\GuzzleHttp\Exception\ConnectException $e) {
                        } catch (\GuzzleHttp\Exception\ClientException $e) {
                        }
                }
                
                
                
            }
            
        //**********Send SMS ***************//
        

        return view(welcomeTheme().'carts.orderPayment',compact('order','active'));
    }
    
    public function orderPaymentSend($type,$id){
         $order =Order::find($id);

        if(!$order){
            Session::flash('error','This Order Invoic Are Not Found');
            return redirect()->route('customer.myOrders');
        }
        $general =General::first();
        $user =Auth::user();
        
        if($type=='wallet'){
            
            if($order->due_amount > $user->balance){
                Session::flash('error','Your Wallet Balance Are Not available.Please Re-charge.');
                return redirect()->route('customer.myOrders');
            }
            
            $balance =new Transaction();
            $balance->type=0;
            $balance->order_id=$order->id;
            $balance->user_id=$user->id;
            $balance->billing_name=$order->name;
            $balance->billing_mobile=$order->mobile;
            $balance->billing_email=$order->email;
            $balance->billing_address=$order->address;
            $balance->billing_note='Customer pay bill by wallet method.';
            $balance->transection_id=mt_rand(100000,999999).'TSBD'.$order->id;
            $balance->payment_method='wallet';
            $balance->amount=$order->due_amount;
            $balance->currency=$general->currency;
            $balance->status='success';
            $balance->addedby_id=Auth::id();
            $balance->save();

            $general->balance+=$balance->amount;
            $general->save();

            $user->balance -=$balance->amount;
            $user->save();

            $order->paid_amount +=$balance->amount;

            if($order->paid_amount >=$order->grand_total){
            $order->extra_amount=$order->paid_amount - $order->grand_total;
            $order->due_amount=0;
            
            }else{
            $order->extra_amount=0;
            $order->due_amount=$order->grand_total-$order->paid_amount;
            }
            
            if($order->due_amount==0){
            $order->payment_status='paid';
            }elseif($order->due_amount==$order->grand_total){
            $order->payment_status='unpaid';
            }else{
            $order->payment_status='partial';
            }

            $order->payment_method='wallet';
            $order->save();
            
            foreach($order->items as $item){
                $item->payment_status=$order->payment_status;
                $item->save();
            }
            
            //send SMS
            
            //Send Mail
            
            Session::flash('success','You Order Is Successfully Place. Thank You for Shopping!');
            return redirect()->route('customer.orderDetails',$order->id);
             
        }else if($type=='handcash'){
            
            $order->payment_method='Cash On Delivery';
            $order->save();
            
            Session::flash('success','You Order Is Successfully Place. Thank You for Shopping!');
            return redirect()->route('customer.orderDetails',$order->id);
            
        }else{
            
             Session::flash('error','Worng Paydment Method is not Allow');
            return redirect()->route('customer.myOrders');
        }
    }
    
    


    public function selectDeliveryArea(Request $r,$id){

    	if($r->ajax())
        {

	    	$cookie = $r->cookie('carts');

	    	if($cookie)
	    	{
    			$general =General::first();
    			$carts = Cart::where('cookie', $cookie)->select(['id','product_id', 'quantity','color','size'])->latest()->paginate(500);
    			
    			$deliveryCharge =0;
        	    $deliveryChargeIn =(int)($general->indhaka_charge?:0);
        	    $deliveryChargeOut =(int)($general->outofdhaka_charge?:0);
        	    $dhaka=0;
        	    
        	    foreach($carts as $cart){
        	        $productShippingIn =$cart->product?$cart->product->shipping_cost:0;
                    $deliveryChargeIn += $cart->quantity*$productShippingIn;
                    
                    $productShippingOut =$cart->product?$cart->product->shipping_cost2:0;
                    $deliveryChargeOut += $cart->quantity*$productShippingOut;
                    
        	    }
        	    
        	    if($id==15){
            		$dhaka =1;
            		$deliveryCharge =$deliveryChargeIn;
            	}elseif($id==0 || $id==null){
            	   $dhaka=0;
            	}else{
            	    $dhaka =2;
            	    $deliveryCharge =$deliveryChargeOut;
            	}
    			
	    		
	    		$datas=Country::where('parent_id',$id)->get();
	    		$geoData = View('geofilter',compact('datas'))->render();


		    	$cartTotalPrice = 0;
		    	$couponDisc = 0;

		    	foreach ($carts as $cart) 
                {
                    
                    $cartTotalPrice += $cart->subtotal();

                }

                if ($mci = Session::get('my_coupon_id')) 
                {
                    $mc = Coupon::where('id',$mci)->first();

                    if($mc)
                    {
                      $couponDisc = $cartTotalPrice * ($mc->discount / 100);
                    }
                }

                $grandTotal = $cartTotalPrice - $couponDisc;

		    	$cartSummery =view(welcomeTheme().'carts.includes.orderSummery',compact('carts','cartTotalPrice','grandTotal','couponDisc','dhaka','deliveryCharge','deliveryChargeIn','deliveryChargeOut'))->render();

    			return Response()->json([
			            'success' => true,
			            'geoData' =>$geoData,
			            'cartSummery' => $cartSummery,
			            'grandTotal' => $grandTotal+$deliveryCharge,
			          ]);

    		}



    	}


    }




    public function wishlistCompareUpdate(Request $r,$id,$action){   
        
        $product =Post::where('type',2)->find($id);
        if(!$product){
            return abort(404);
        }
		$cookie = $r->cookie('carts');
        if(!$cookie){
            return redirect()->route('index');
        }

        if($action=='wishlist'){
            $statusType =0;
            $overCount =48;
        }else{
            $statusType =1;
            $overCount =20;
        }
					
        $oldData = WishList::where('cookie', $cookie)->where('type',$statusType)->where('product_id', $product->id)->first();
        if($oldData){
            $oldData->delete();
            $status =false;
            $alert=false;
        }else{
            $totalCount =WishList::where('cookie',$cookie)->where('type',$statusType)->count();
            if($overCount > $totalCount){
                $data = new WishList;
                $data->user_id = Auth::id();
                $data->product_id = $product->id;
                $data->cookie = $cookie;
                $data->type =$statusType;
                $data->save();
                $status =true;
                $alert=false;
            }else{
                $status =false;
                $alert=true;
            }
        }

        if($action=='wishlist'){
            $wlCount =WishList::where('cookie',$cookie)->where('type',$statusType)->count();
            
            $products = Post::whereHas('wishlists',function($qq)use($cookie){
                $qq->where('cookie',$cookie);
            })->paginate(48);

            $itemsView = view(welcomeTheme().'carts.includes.wishlistItems',compact('products','wlCount'))->render();

        }else{
            
            $cpCount =WishList::where('cookie',$cookie)->where('type',$statusType)->count();

            $products = Post::whereHas('comparelists',function($qq)use($cookie){
                $qq->where('cookie', $cookie);
            })->paginate(20);

            $itemsView = view(welcomeTheme().'carts.includes.compareItems',compact('products','cpCount'))->render();
        }

        if($r->ajax()){

            return Response()->json([
                'success' => true,	
                'status' => $status,
                'alert' => $alert,
                'statusType' => $statusType,
                'count' => WishList::where('cookie',$cookie)->whereHas('product')->where('type',$statusType)->count(),		        
                'itemsView' => $itemsView,	        
            ]);
            
        }else{

            return back()->with('success', 'Your Action successfully Done');;
        }


		
	}


	public function myWishlist(Request $r){

			$products = Post::whereHas('wishlists',function($qq){
			 		$qq->where('cookie', Cookie::get('carts'));
			 	})->paginate(24);
            
			return view(welcomeTheme().'carts.myWishlist',compact('products'));
	}


	public function myCompare(Request $r){
        $cookie = $r->cookie('carts');
        if(!$cookie){
            return redirect()->route('index');
        }
        $products =Post::whereHas('comparelists',function($qq)use($cookie){
            $qq->where('cookie', $cookie);
        })->paginate(20);

		return view(welcomeTheme().'carts.myCompare',compact('products'));
	}
	
	public function OrderTrack(Request $r){
	   // return $r;
	   $order =Order::latest()->where('invoice',$r->invoice)->first();
	   
	    return view(welcomeTheme().'carts.orderTrack',compact('r','order'));
	}


    public function orderNow(Request $r,$id){
        $product =Post::find($id);
        if(!$product){
            Session::flash('error','Product Not Found');
            return redirect()->route('index');
        }
        $check = $r->validate([
            'name' => 'required|max:100',
            'email' => 'nullable|max:100',
            'transection' => 'nullable|max:100',
            'payment_method' => 'required|max:100',
            'mobile' => 'required|numeric',
            'address' => 'required|max:500',
        ]);

        if(!$check){
            return back();
        }
        
        $user =Auth::user();
        
        $order =new Order();
       $order->save();
       $order->invoice=$order->created_at->format('ymd').$order->id;
       $order->user_id=$user?$user->id:null;
       $order->name=$r->name;
       $order->mobile=$r->mobile;
       $order->email=$r->email;
       $order->address=$r->address;
      
       $addr =$order->address;

       $order->full_address=$addr;
       
       $order->order_status='pending';
       $order->pending_at=Carbon::now();
       $order->pending_by=$user?$user->id:null;
       $order->save();

            $item = new OrderItem;
      		$item->order_id = $order->id;
            $item->user_id = $user?$user->id:null;
            $item->invoice = $order->invoice;
            $item->seller_id = $product->seller_id;
            $item->product_id = $product->id;
            $item->product_name = $product->title;
            $item->quantity = 1;

            if($product->price_variation){
                
            }else{
                if($product->quantity > $item->quantity){
                    $product->quantity-=$item->quantity;
                    $product->sell_count+=1;
                    $product->save();
                }
            }

            $item->price = $product->final_price;
            $item->total_price = $product->final_price;
        
            $item->final_price = $product->final_price;
            $item->pending_at = Carbon::now();
            $item->pending_by =null;
            $item->addedby_id =null;
            $item->status='pending';
            $item->order_status='pending';
            $item->seller_paid=$item->final_price;
            
            $key =$order->invoice;
            if($order->name){
            $key.=' '.$order->name;
            }
            if($order->mobile){
            $key.=' '.$order->mobile;
      	    }
      	    if($order->email){
            $key.=' '.$order->email;
            }
            $item->seller_paid=$item->final_price;
            $item->search_key=$key;
            $item->save();

        $general =General::first();

        $order->total_price=$item->final_price;
        $order->grand_total =$item->final_price;
        $order->paid_amount=0;
        $order->payment_method=$r->payment_method;
        $order->transection=$r->transection;
        $order->due_amount=$order->grand_total;
        $order->save();
        
        // $order =new ProductSize();
        // $order->product_id=$product->id;
        // $order->title=$r->name;
        // $order->email=$r->email;
        // $order->mobile=$r->mobile;
        // $order->address=$r->address;
        // $order->transection=$r->transection;
        // $order->addedby_id=0;
        // $order->save();
        Session::flash('success','Your Order is Success. We are contact as soon as possible.');
        return redirect()->back();
    }













}
