@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle('My Orders')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('My Orders')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{assetUrl(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('customer.myOrders')}}" />
<link rel="canonical" href="{{route('customer.myOrders')}}" />
@endsection @push('css')

<style>

.card-header h3 {
    font-size: 18px;
}
.heading-banner h4 {
    font-size: 16px;
}

.btn-cansel {
    background: #cf0673;
    color: #fff;
    padding: 2px 5px;
}



</style>

@endpush @section('contents')

  <section class="section-b-space pt-0"> 
       <div class="heading-banner">
         <div class="custom-container container">
           <div class="row align-items-center">
             <div class="col-sm-6">
               <h4>Orders </h4>
             </div>
             <div class="col-sm-6">
               <ul class="breadcrumb float-end">
                 <li class="breadcrumb-item">  <a href="{{route('index')}}">Home  </a></li>
                 <li class="breadcrumb-item active">  <a href="javascript:void(0)">Order </a></li>
               </ul>
             </div>
           </div>
         </div>
       </div>
     </section>

   <section class="section-b-space pt-0"> 
      <div class="custom-container container user-dashboard-section"> 
        <div class="row">
          <div class="col-xl-3 col-lg-4">
            @include(welcomeTheme().'.customer.includes.sidebar')
          </div>
        <div class="col-xl-9 col-lg-8">
            <div class="dashboard_content">
                    <div class="card">
                        <div class="card-header">
                            <h3>My Orders</h3>
                        </div>
                        <div class="card-body">
                            @include(welcomeTheme().'.alerts')
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Order</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $i=>$order)
                                        <tr>
                                            <td>#{{ $order->invoice }}</td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>
                                                @if($order->payment_method==null)
                                                <a class="" href="{{ route('orderPayment', $order->id) }}">Pay now</a><br />
                                                <b style="color: #ff5722;">Payment Pending</b>
                                                @else @if($order->order_status=='confirmed')
                                                <span class="badge badge-success" style="background: #e91e63;">{{ucfirst($order->order_status)}}</span>
                                                @elseif($order->order_status=='shipped')
                                                <span class="badge badge-success" style="background: #673ab7;">{{ucfirst($order->order_status)}}</span>
                                                @elseif($order->order_status=='delivered')
                                                <span class="badge badge-success" style="background: #1c84c6;">{{ucfirst($order->order_status)}}</span>
                                                @elseif($order->order_status=='cancelled')
                                                <span class="badge badge-success" style="background: #f44336;">{{ucfirst($order->order_status)}}</span>
                                                @else
                                                <span class="badge badge-success" style="background: #ff9800;">{{ucfirst($order->order_status)}}</span>
                                                @endif @endif
                                            </td>
                                            <td>{{ priceFullFormat($order->grand_total)}}for {{$order->items->count()}} item</td>
                                            <td>
                                                <a href="{{ route('customer.orderDetails',$order->invoice) }}" class="btn btn-fill-out btn-sm">View </a>
                                                
                                                    @if($order->order_status=='pending')
                                                    <a href="{{ route('customer.orderCancel',$order->id) }}" onclick="return confirm('are you want to cencel order')" class="btn btn-fill-out btn-sm btn-cansel">Cancel </a>
                                                    @endif
                                                    
                                                </td>
                                        </tr>
                                        @endforeach @if($orders->count()==0)
                                        <tr>
                                            <td colspan="5" style="text-align: center;">No Order</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <br />
                            {{ $orders->links('pagination') }}
                        </div>
                    </div>
                </div>
        </div>
    </div>
 </section>

@endsection @push('js') @endpush