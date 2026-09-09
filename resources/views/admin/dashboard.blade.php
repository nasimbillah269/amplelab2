@extends(adminTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Dashboard')}}</title>
@endsection @push('css')
<style type="text/css">
    .BillingSummery tr td {
        padding: 5px;
    }
    .BillingSummery .Amount {
        font-size: 15px;
        font-weight: bold;
        color: #3f51b5;
    }
    .BillingSummery .Text {
        color: #6c6c6c;
    }

    /* ===== Dashboard stat cards — compact / professional ===== */
    .grouped-multiple-statistics-card .card{
        border:1px solid #ecEEF3;
        border-radius:14px;
        box-shadow:0 2px 12px rgba(20,30,45,.04);
    }
    .grouped-multiple-statistics-card .card-body{ padding:1.1rem .85rem; }

    .grouped-multiple-statistics-card .d-flex.align-items-start{
        align-items:center !important;
        gap:13px;
        padding:8px 14px;
        margin:0 !important;
    }
    .grouped-multiple-statistics-card [class*="border-right-"]{ border:0 !important; }
    @media (min-width:768px){
        .grouped-multiple-statistics-card .row > [class*="col-"]:not(:last-child) > .d-flex{
            border-right:1px solid #eef0f4 !important;
        }
    }

    .grouped-multiple-statistics-card .card-icon{
        width:42px; height:42px; min-width:42px;
        border-radius:11px;
        display:flex; align-items:center; justify-content:center;
        margin:0 !important;
        box-shadow:none;
    }
    .grouped-multiple-statistics-card .card-icon i{
        font-size:17px !important;
        padding:0 !important;
        line-height:1;
    }
    .grouped-multiple-statistics-card .card-icon.primary{ background:#e4f6f5; color:#13b5ad; }
    .grouped-multiple-statistics-card .card-icon.success{ background:#e7f7ee; color:#2bb673; }
    .grouped-multiple-statistics-card .card-icon.danger { background:#fdeef1; color:#ef6079; }
    .grouped-multiple-statistics-card .card-icon.warning{ background:#fef2e6; color:#f0972b; }

    .grouped-multiple-statistics-card .stats-amount{ margin:0 !important; flex:1 1 auto; min-width:0; }
    .grouped-multiple-statistics-card .stats-amount .heading-text{
        font-size:1.4rem; font-weight:700; line-height:1.1;
        margin:0 0 2px; color:#2c3345;
    }
    .grouped-multiple-statistics-card .stats-amount .sub-heading{
        font-size:.8rem; color:#8a93a5; margin:0;
        white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
    }

    .grouped-multiple-statistics-card .inc-dec-percentage{ align-self:flex-start; margin-left:auto; }
    .grouped-multiple-statistics-card .inc-dec-percentage small{
        display:inline-flex; align-items:center; gap:3px;
        font-size:.66rem; font-weight:600;
        padding:3px 8px; border-radius:20px;
        background:#f1f3f7; color:#7a8496;
        white-space:nowrap;
    }
    .grouped-multiple-statistics-card .inc-dec-percentage small i{ font-size:.6rem; }
</style>
@endpush @section('contents')
<div class="content-header row"></div>
<div class="content-body">
    <!-- Grouped multiple cards for statistics starts here -->
    <div class="row grouped-multiple-statistics-card">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                            <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                <span class="card-icon primary d-flex justify-content-center mr-3">
                                    <i class="fas fa-stream font-large-2 p-1"></i>
                                </span>
                                <div class="stats-amount mr-3">
                                    <h3 class="heading-text text-bold-600">{{$reports['product']}}</h3>
                                    <p class="sub-heading">Products</p>
                                </div>
                                <span class="inc-dec-percentage">
                                    <small class="info"><i class="fa fa-arrow-up"></i> Total</small>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                            <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                <span class="card-icon danger d-flex justify-content-center mr-3">
                                    <i class="fas fa-users font-large-2 p-1"></i>
                                </span>
                                <div class="stats-amount mr-3">
                                    <h3 class="heading-text text-bold-600">{{$reports['customer']}}</h3>
                                    <p class="sub-heading">Customers</p>
                                </div>
                                <span class="inc-dec-percentage">
                                    <small class="success"><i class="fa fa-arrow-up"></i> Total </small>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                            <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                <span class="card-icon success d-flex justify-content-center mr-3">
                                    <i class="fas fa-user-tie font-large-2 p-1"></i>
                                </span>
                                <div class="stats-amount mr-3">
                                    <h3 class="heading-text text-bold-600">{{$reports['admin']}}</h3>
                                    <p class="sub-heading">Admin User</p>
                                </div>
                                <span class="inc-dec-percentage">
                                    <small class="primary"><i class="fa fa-arrow-up"></i> Total </small>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                            <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                <span class="card-icon success d-flex justify-content-center mr-3">
                                    <i class="fas fa-users customize-icon font-large-2 p-1"></i>
                                </span>
                                <div class="stats-amount mr-3">
                                    <h3 class="heading-text text-bold-600">{{$reports['pages']}}</h3>
                                    <p class="sub-heading">Pages</p>
                                </div>
                                <span class="inc-dec-percentage">
                                    <small class="primary"><i class="fa fa-arrow-up"></i> Total </small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row grouped-multiple-statistics-card">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-xl-4 col-sm-6 col-12">
                            <div class="d-flex align-items-start">
                                <span class="card-icon warning d-flex justify-content-center mr-3">
                                    <i class="fas fa-money font-large-2 p-1"></i>
                                </span>
                                <div class="stats-amount mr-3">
                                    <h3 class="heading-text text-bold-600">{{priceFormat($reports['todaySale'])}}</h3>
                                    <p class="sub-heading">Sales ({{general()->currency}})</p>
                                </div>
                                <span class="inc-dec-percentage">
                                    <small class="success"><i class="fa fa-arrow-up"></i> Today</small>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4 col-sm-6 col-12">
                            <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                <span class="card-icon danger d-flex justify-content-center mr-3">
                                    <i class="fas fa-money font-large-2 p-1"></i>
                                </span>
                                <div class="stats-amount mr-3">
                                    <h3 class="heading-text text-bold-600">{{priceFormat($reports['monthlytSale'])}}</h3>
                                    <p class="sub-heading">Sales ({{general()->currency}})</p>
                                </div>
                                <span class="inc-dec-percentage">
                                    <small class="success"><i class="fa fa-arrow-up"></i> Monthly </small>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4 col-sm-6 col-12">
                            <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                <span class="card-icon success d-flex justify-content-center mr-3">
                                    <i class="fas fa-money font-large-2 p-1"></i>
                                </span>
                                <div class="stats-amount mr-3">
                                    <h3 class="heading-text text-bold-600">{{priceFormat($reports['yearlySale'])}}</h3>
                                    <p class="sub-heading">Sales ({{general()->currency}})</p>
                                </div>
                                <span class="inc-dec-percentage">
                                    <small class="primary"><i class="fa fa-arrow-up"></i> Yearly </small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row grouped-multiple-statistics-card">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                            <div class="d-flex align-items-start">
                                <span class="card-icon warning d-flex justify-content-center mr-3">
                                    <i class="fa fa-sitemap font-large-2 p-1"></i>
                                </span>
                                <div class="stats-amount mr-3">
                                    <h3 class="heading-text text-bold-600">{{$orderTotal->total}}</h3>
                                    <p class="sub-heading">Orders</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                            <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                <span class="card-icon danger d-flex justify-content-center mr-3">
                                    <i class="fa fa-sitemap font-large-2 p-1"></i>
                                </span>
                                <div class="stats-amount mr-3">
                                    <h3 class="heading-text text-bold-600">{{$orderTotal->pending}}</h3>
                                    <p class="sub-heading">Pending Orders</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                            <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                <span class="card-icon success d-flex justify-content-center mr-3">
                                    <i class="fa fa-sitemap font-large-2 p-1"></i>
                                </span>
                                <div class="stats-amount mr-3">
                                    <h3 class="heading-text text-bold-600">{{$orderTotal->confirmed}}</h3>
                                    <p class="sub-heading">Confirm Orders</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                            <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                <span class="card-icon success d-flex justify-content-center mr-3">
                                    <i class="fa fa-sitemap font-large-2 p-1"></i>
                                </span>
                                <div class="stats-amount mr-3">
                                    <h3 class="heading-text text-bold-600">{{$orderTotal->delivered}}</h3>
                                    <p class="sub-heading">Delivered Orders</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   
    <!-- active users and my task timeline cards starts here -->
    <div class="row match-height">
        <!-- active users card -->
        <div class="col-xl-12 col-lg-12">
            <div class="card active-users">
                <div class="card-header border-0">
                    <h4 class="card-title">Latest Products</h4>
                </div>
                <div class="card-content">
                    <div class="table-responsive position-relative card-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="min-width: 60px;">SL</th>
                                    <th style="min-width: 350px;">Product Name</th>
                                    <th style="min-width: 80px;">Image</th>
                                    <th style="min-width: 200px;">Catagory</th>
                                    <th style="min-width: 80px;">Status</th>
                                    <th style="min-width: 160px;">Action/Author</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $i=>$product)
                                <tr>
                                    <td>
                                        {{$products->currentpage()==1?$i+1:$i+($products->perpage()*($products->currentpage() - 1))+1}}
                                    </td>
                                    <td>
                                        <span><a href="{{route('productView',$product->slug?:'no-slug')}}" target="_blank">{{$product->name}}</a></span>
                                        <br />
                                        <span style="color: #ccc;"><b style="color: #1ab394;">{{general()->currency}}</b> {{priceFormat($product->final_price)}}</span>

                                        @if($product->fetured==true)
                                        <span><i class="fa fa-star" style="color: #1ab394;"></i></span>
                                        @endif @if($product->brand)
                                        <span style="color: #ccc;"><b style="color: #1ab394;">Brand:</b> {{$product->brand->name}}</span>
                                        @endif 
                                        @if($product->fetured==true)
                                        <span><i class="fa fa-star" style="color: #1ab394;"></i></span>
                                        @endif
                                        <span style="color: #ccc;"><i class="fa fa-calendar" style="color: #1ab394;"></i> {{$product->created_at->format('d-m-Y')}}</span>
                                    </td>
                                    <td style="padding: 5px; text-align: center;">
                                        <img src="{{assetUrl($product->image())}}" style="max-width: 70px; max-height: 50px;" />
                                    </td>
                                    <td>
                                        @foreach($product->productCategories as $i=>$ctg) {{$i==0?'':'-'}} {{$ctg->name}} @endforeach
                                    </td>
                                    <td>
                                        @if($product->status=='active')
                                        <span class="badge badge-success">Active </span>
                                        @elseif($product->status=='inactive')
                                        <span class="badge badge-danger">Inactive </span>
                                        @else
                                        <span class="badge badge-danger">Draft </span>
                                        @endif
                                    </td>
                                    <td style="padding: 5px;">
                                        <a href="{{route('admin.productsAction',['edit',$product->id])}}" class="btn btn-sm btn-info">Edit</a>
                                        @isset(json_decode(Auth::user()->permission->permission, true)['products']['delete'])
                                        <a href="{{route('admin.productsAction',['delete',$product->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Want To Delete?')">Delete</a>
                                        @endisset
                                        <br />
                                        <span style="color: #ccc;">
                                            <i class="fa fa-user" style="color: #1ab394;"></i>
                                            {{Str::limit($product->user?$product->user->name:'No Author',15)}}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    
</div>
@endsection @push('js')
<script></script>
@endpush