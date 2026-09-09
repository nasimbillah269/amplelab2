<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Str;
use Hash;
use Mail;
use File;
use DB;
use Session;
use Cookie;
use Validator;
use Redirect,Response;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Post;
use App\Models\Transaction;
use App\Models\PostExtra;
use App\Models\Review;
use App\Models\General;
use App\Models\Media;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderReturnItem;
use App\Models\Attribute;
use App\Models\Permission;
use App\Models\PostAttribute;
use GuzzleHttp\Client;

use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

	public function orders(Request $r,$status=null){

        // Filter Action Start
      if($r->action){
        if($r->checkid){
            $datas=Order::latest()->where('order_type','customer_order')->whereIn('id',$r->checkid);
            if($r->action==1){
                $datas->update(['order_status'=>'pending']);
            }elseif($r->action==2){
                $datas->update(['order_status'=>'confirmed']);
            }elseif($r->action==3){
                $datas->update(['order_status'=>'shipped']);
            }elseif($r->action==4){
                $datas->update(['order_status'=>'delivered']);
            }elseif($r->action==5){
                $datas->update(['order_status'=>'cancelled']);
            }elseif($r->action==6){
                foreach($datas->get(['id']) as $data){
                    $data->items()->delete();
                    $data->delete();
                }
            }
        Session()->flash('success','Action Successfully Completed!');
        }else{
          Session()->flash('info','Please Need To Select Minimum One Post');
        }
        return redirect()->back();
      }
      //Filter Action End

        if($status==null || $status=='pending-payment' || $status=='pre-order' || $status=='unpaid' || $status=='pending' || $status=='confirmed' || $status=='shipped' || $status=='delivered' || $status=='cancelled'){

            $orders =Order::latest()->where('order_type','customer_order')->where('order_status','<>','temp')
            ->where(function($qq)  use ($status,$r)  {
                if($status){
                    if($status=='pending-payment'){
                        $qq->where('payment_method',null);
                    }else if($status=='unpaid'){
                        $qq->whereIn('payment_status',['unpaid','partial']);
                    }else if($status=='pre-order'){
                        $qq->whereHas('items',function($qqq){
                            $qqq->where('pre_order',true);
                        });
                    }else{
                        $qq->where('order_status',$status);
                    }
                }
                
                if($r->search){
                   $qq->where('invoice','LIKE','%'.$r->search.'%')->orWhere('email','LIKE','%'.$r->search.'%')->orWhere('mobile','LIKE','%'.$r->search.'%'); 
                }
                
                if($r->startDate || $r->endDate)
                {
                    if($r->startDate){
                        $from =$r->startDate;
                    }else{
                        $from=Carbon::now()->format('Y-m-d');
                    }

                    if($r->endDate){
                        $to =$r->endDate;
                    }else{
                        $to=Carbon::now()->format('Y-m-d');
                    }

                    $qq->whereBetween('created_at', [$from, $to]);
                }
                
            })
            ->paginate(25)->appends(['search'=>$r->search,'status'=>$r->status,'startDate'=>$r->startDate,'endDate'=>$r->endDate]);
            
            //Total Count Results
            $totals = DB::table('orders')
            ->where('order_type','customer_order')
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when order_status = 'pending' then 1 end) as pending")
            ->selectRaw("count(case when order_status = 'confirmed' then 1 end) as confirmed")
            ->selectRaw("count(case when order_status = 'shipped' then 1 end) as shipped")
            ->selectRaw("count(case when order_status = 'delivered' then 1 end) as delivered")
            ->selectRaw("count(case when order_status = 'cancelled' then 1 end) as cancelled")
            ->first();

            return view(adminTheme().'orders.ordersAll',compact('orders','totals','status'));


        }else{
            Session()->flash('error','Order Status Un-known Type');
            return redirect()->route('admin.orders');
        }

        
    }
    
    public function getStockAdjustment($order, $orderStatus)
        {
            $previousStatus = $order->order_status;
            $newStatus = $orderStatus;
            if (in_array($newStatus, ['pending', 'cancelled']) && in_array($previousStatus, ['confirmed', 'delivered', 'shipped'])) {
                //   {{$item->itemVariantData()}}
                foreach($order->items as $item){
                    $item->order_status=$order->order_status;
                    if($product=$item->product){
                        if($product->variation_status){
                            if($data =$item->itemVariantData()){
                                $data->quantity +=$item->quantity;
                                $data->save();   
                            }
                        }else{
                            $product->quantity +=$item->quantity;
                            $product->save();
                        }
                    }
                    $item->save();
                }
            }
        
            // Conditions for increasing stock ("plus")
            if (in_array($newStatus, ['confirmed', 'delivered', 'shipped']) && in_array($previousStatus, ['pending', 'cancelled'])) {
                 $stockStatus=true;
                foreach($order->items as $item){
                    if($stockStatus==true){
                        if($item->quantity > $item->itemStock()){
                            $stockStatus=false;
                        }
                    }
                }
                if($stockStatus){
                    
                    foreach($order->items as $item){
                        $item->order_status=$order->order_status;
                        if($product=$item->product){
                            if($product->variation_status){
                                if($data =$item->itemVariantData()){
                                    $data->quantity -=$item->quantity;
                                    $data->save();   
                                }
                            }else{
                                $product->quantity -=$item->quantity;
                                $product->save();
                            }
                        } 
                    }
                    
                }else{
                return 'stockout';
                }
               
                
            }
        
            // // No stock change cases
            // if (
            //     ($previousStatus == 'confirmed' && $newStatus == 'delivered') ||
            //     ($previousStatus == 'delivered' && $newStatus == 'confirmed') ||
            //     ($previousStatus == 'cancelled' && $newStatus == 'pending')
            // ) {
            //     return 'no_change';
            // }
        
            return 'no_change';
    }

    public function ordersAction(Request $r,$action,$id){
        $order =Order::find($id);
        if(!$order){
            Session()->flash('error','Order Are Not Found');
            return redirect()->route('admin.orders');
        }
        
        
        
        
        if($action=='update'){
            $check = $r->validate([
                'order_status' => 'required',
            ]);
            if($order->order_status!=$r->order_status){
                $data =$this->getStockAdjustment($order,$r->order_status);
                if($data=='stockout'){
                     Session()->flash('error','Order Status can not change product stock are not available!');
                     return redirect()->back();
                }

                $order->order_status=$r->order_status;
                $orderStatus =$r->order_status;
                if($orderStatus=='pending' || $orderStatus=='confirmed' || $orderStatus=='shipped' || $orderStatus=='delivered' || $orderStatus=='cancelled' ){
                    $columD =$orderStatus.'_at';
                    $columBy =$orderStatus.'_by';
                    $order[$columD]=Carbon::now();
                    $order[$columBy]=Auth::id();
                }
                $order->save();
            }
            //send mail or sms
            Session()->flash('success','Order Update Successfully Done!');
            return redirect()->back();

        }

        if($action=='payment'){
       
            $check = $r->validate([
                'amount' => 'required|numeric',
                'method' => 'required|numeric',
            ]);
            $method =Attribute::where('type',11)->find($r->method);
            if(!$method){
                Session()->flash('error','Method Type Are Found');
                return redirect()->back();
            }

            $transaction =new Transaction();
            $transaction->src_id =$order->id;
            if($r->transaction_type==1){
                $transaction->type =2;
            }else{
               $transaction->type =0; 
            }
            $transaction->status ='success';
            $transaction->method_id=$method->id;
            $transaction->transection_id=Carbon::now()->format('YmdHis');
            $transaction->amount=$r->amount;
            $transaction->billing_note=$r->note;
            $transaction->billing_name=$order->name;
            $transaction->billing_mobile=$order->mobile;
            $transaction->billing_email=$order->email;
            $transaction->billing_address=$order->address;
            $transaction->save();

            //Method Balance Update
            if($transaction->type==1){
                $method->amounts -=$transaction->amount;
            }else{
                $method->amounts +=$transaction->amount;
            }            
            $method->save();

            //Order payment Update
            $order->paid_amount=$order->transactionsSuccess->sum('amount');
            $order->return_amount=$order->transactionsRefund->sum('amount');

            if($order->grand_total >= $order->paid_amount){
                $order->due_amount=$order->grand_total-$order->paid_amount;
                $order->extra_amount=0;
            }else{
                $order->due_amount=0; 
                $order->extra_amount=$order->paid_amount-$order->grand_total; 
            }
            
            if($order->due_amount==0){
            $order->payment_status='paid';
            }elseif($order->due_amount==$order->grand_total){
            $order->payment_status='unpaid';
            }else{
            $order->payment_status='partial';
            }
            $order->save();
            if($transaction->type==1){
                Session()->flash('success','Payment Refund Successfully Done!');
            }else{
                Session()->flash('success','Payment Added Successfully Done!');
            }
            return redirect()->back();
        }
        
        if($action=='payment-delete'){
            
            $transaction =$order->transactionsAll()->find($r->transection_id);
            if($transaction){
               $transaction->delete(); 
            }
            
            $order->paid_amount=$order->transactionsSuccess->sum('amount');
            $order->return_amount=$order->transactionsRefund->sum('amount');

            if($order->grand_total >= $order->paid_amount){
                $order->due_amount=$order->grand_total-$order->paid_amount;
                $order->extra_amount=0;
            }else{
                $order->due_amount=0; 
                $order->extra_amount=$order->paid_amount-$order->grand_total; 
            }
            
            if($order->due_amount==0){
            $order->payment_status='paid';
            }elseif($order->due_amount==$order->grand_total){
            $order->payment_status='unpaid';
            }else{
            $order->payment_status='partial';
            }
            $order->save();
            
            Session()->flash('success','Payment Deleted Successfully Done!');
            return redirect()->back();
        }
        
        
        

        $methods =Attribute::where('type',11)->where('status','active')->where('parent_id',null)->orderBy('view','asc')->get();
        return view(adminTheme().'orders.ordersManage',compact('order','methods')); 
    }

    public function invoice($id){
        $order =Order::find($id);
        if(!$order){
            Session()->flash('error','Order Are Not Found');
            return redirect()->route('admin.orders');
        }
        
        $gram =0;
        $ml =0;
        
        foreach($order->items as $item){
            if($item->product){
                if($item->product->weight_unit){
                    $gram+= $item->quantity*$item->product->weight_amount;   
                }
            }
        }
        
        return view(adminTheme().'orders.invoice',compact('order'));
    }


    public function returnOrders(Request $r,$status=null){
        
        if($status==null || $status=='pending' || $status=='confirmed' || $status=='delivered' || $status=='refunded' || $status=='cancelled'){
            $returnItems =OrderReturnItem::latest()->where('return_type',true)
            ->where(function($qq)  use ($status,$r)  {

                if($status==null){
                    $qq->where('status','<>','temp');
                }else{
                    $qq->where('status',$status);
                }
            })
            ->paginate(25);

            return view(adminTheme().'orders.returnOrders',compact('returnItems','status','r'));
        }else{
            Session()->flash('error','Order Status Un-known Type');
            return redirect()->route('admin.returnOrders');
        }
        
    }

     public function returnOrdersManage($id){
        
        $order =Order::find($id);
        
        if(!$order){
            Session()->flash('error','Order Return Are Not Found');
            return redirect()->route('admin.returnOrders');
        }

        return view(adminTheme().'orders.returnOrderManage',compact('order'));
    }





}