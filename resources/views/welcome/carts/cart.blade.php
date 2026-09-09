@extends(welcomeTheme().'layouts.app') 
@section('title')
<title>{{websiteTitle('Cart Items')}}</title>
@endsection 
@section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Cart Items')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keyword" property="og:keyword" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{assetUrl(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('carts')}}" />
<link rel="canonical" href="{{route('carts')}}">
@endsection 
@push('css')

<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button{ -webkit-appearance:none; margin:0; }
    input[type=number]{ -moz-appearance:textfield; }
    textarea:focus, input:focus{ outline:none; }

    /* ============ Cart page — refreshed UI ============ */
    .cartItemsList{ padding:36px 0 60px; }

    /* items card */
    .cartItemsList .cart-table{
        background:#fff;
        border:1px solid #ecEEF3;
        border-radius:14px;
        padding:20px 22px;
        box-shadow:0 2px 16px rgba(20,30,45,.05);
    }
    .cartItemsList .table-title h5{
        font-weight:700; font-size:1.05rem; color:#2c3345; margin:0 0 14px;
    }
    .cartItemsList .table-title h5 span{ color:#8a93a5; font-weight:600; }

    .cartItemsList .table-responsive{ border:0 !important; }
    .cartItemsList .table-responsive::-webkit-scrollbar{ height:6px; }
    .cartItemsList .table-responsive::-webkit-scrollbar-thumb{ background:#d7dce3; border-radius:10px; }
    .cartItemsList .table-responsive::-webkit-scrollbar-track{ background:transparent; }

    .cartItemsList #cart-table{ margin:0; }
    .cartItemsList #cart-table thead th{
        background:#f7f8fa; color:#8a93a5;
        font-weight:600; font-size:.76rem; letter-spacing:.04em; text-transform:uppercase;
        border:0 !important; padding:12px 14px; text-align:center;
    }
    .cartItemsList #cart-table thead th:first-child{ text-align:left; border-radius:8px 0 0 8px; }
    .cartItemsList #cart-table thead th:last-child{ border-radius:0 8px 8px 0; }
    .cartItemsList #cart-table tbody td{
        border:0 !important; border-bottom:1px solid #f0f2f5 !important;
        padding:18px 14px !important; vertical-align:middle; text-align:center;
        font-size:.9rem; color:#3c4453; box-shadow:none !important;
    }
    .cartItemsList #cart-table tbody tr:last-child td{ border-bottom:0 !important; }
    .cartItemsList #cart-table tbody td:first-child{ text-align:left; }

    /* product cell */
    .cartItemsList .cart-box{ display:flex; align-items:center; gap:12px; }
    .cartItemsList .cart-box img{
        width:72px; height:72px; object-fit:cover;
        border:1px solid #eef0f4; border-radius:10px; background:#fff;
    }
    .cartItemsList .cart-box h5{
        font-size:.9rem; font-weight:600; color:#2c3345; line-height:1.35;
        white-space:normal;
        display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
    }

    /* price */
    .cartItemsList del{ color:#aab2c0; font-weight:400; margin:0 4px; }
    .cartItemsList .offer-btn{
        display:inline-block; margin-left:4px;
        background:#e7f7ee; color:#2bb673;
        font-size:.7rem; font-weight:700; padding:2px 8px; border-radius:20px;
    }

    /* quantity stepper */
    .cartItemsList .quantity{
        display:inline-flex; align-items:center;
        border:1px solid #e3e8ef; border-radius:10px; overflow:hidden;
    }
    .cartItemsList .quantity button{
        width:34px; height:38px; border:0 !important; border-radius:0 !important;
        background:#f4f6f9; color:#3c4453; cursor:pointer;
        display:flex; align-items:center; justify-content:center; font-size:12px;
    }
    .cartItemsList .quantity button:hover{ background:#e9edf2; color:#1f7a4d; }
    .cartItemsList .quantity input{
        width:44px; height:38px; border:0 !important; border-radius:0 !important;
        border-left:1px solid #e3e8ef !important; border-right:1px solid #e3e8ef !important;
        text-align:center; font-size:.88rem; background:#fff;
    }

    .cartItemsList .deleteButton{ color:#ef6079 !important; font-size:15px; }

    /* ---- sidebar summary ---- */
    .cartItemsList .cart-items{
        background:#fff;
        border:1px solid #ecEEF3;
        border-radius:14px;
        padding:22px 20px;
        box-shadow:0 2px 16px rgba(20,30,45,.05);
        position:sticky; top:90px;
    }
    .cartItemsList .cart-body h6,
    .cartItemsList .coupon-box h6{
        font-weight:700; font-size:.95rem; color:#2c3345; margin-bottom:14px;
    }
    .cartItemsList .cart-body ul{ list-style:none; padding:0; margin:0; }
    .cartItemsList .cart-body ul li{
        display:flex; justify-content:space-between; align-items:center;
        padding:7px 0; font-size:.86rem; color:#6b7382;
    }
    .cartItemsList .cart-body ul li p{ margin:0; }
    .cartItemsList .cart-body ul li span{ font-weight:600; color:#2c3345; }

    .cartItemsList .cart-bottom{
        border-top:1px dashed #e3e8ef; margin:10px 0 4px; padding-top:14px;
    }
    .cartItemsList .cart-bottom h6{
        display:flex; justify-content:space-between; align-items:center;
        font-weight:700; font-size:1rem; color:#2c3345; margin:0;
    }
    .cartItemsList .cart-bottom h6 span{ color:#1f7a4d; }

    /* coupon */
    .cartItemsList .coupon-box{ border-top:1px solid #eef0f4; margin-top:16px; padding-top:16px; }
    .cartItemsList .coupon-box ul{ list-style:none; padding:0; margin:0; }
    .cartItemsList .coupon-box ul li{ display:flex; gap:8px; align-items:stretch; }
    .cartItemsList .coupon-box ul li span{ position:relative; flex:1; }
    .cartItemsList .coupon-box ul li span input{
        width:100%; border:1px solid #e3e8ef !important; border-radius:10px !important;
        padding:.6rem .8rem .6rem 2.1rem; font-size:.84rem; background:#f5f7fb;
    }
    .cartItemsList .coupon-box ul li span i{
        position:absolute; left:.65rem; top:50%; transform:translateY(-50%); color:#9aa4b6;
    }
    .cartItemsList .coupon-box ul li button{
        border:1px solid #1f7a4d !important; background:#1f7a4d !important; color:#fff !important;
        border-radius:10px !important; padding:.55rem 1.1rem !important; font-weight:600; font-size:.84rem;
        transition:.2s;
    }
    .cartItemsList .coupon-box ul li button:hover{ background:#17603b !important; border-color:#17603b !important; }

    /* checkout */
    .cartItemsList a.btn_black{
        background:#0d3d33 !important; border:0 !important; color:#fff !important;
        border-radius:10px !important; padding:.85rem 1rem !important;
        font-weight:600; margin-top:16px; display:block; text-align:center;
        transition:.2s;
    }
    .cartItemsList a.btn_black:hover{ background:#0a2e27 !important; }

    /* empty cart */
    .cart_empty{
        max-width:460px; margin:40px auto; text-align:center;
        background:#fff; padding:48px 30px;
        border:1px solid #ecEEF3; border-radius:16px;
        box-shadow:0 2px 16px rgba(20,30,45,.05);
    }
    .cart_empty h4{ margin-bottom:18px; font-weight:700; color:#2c3345; }
    .cart_empty .btn{
        background:#1f7a4d !important; border-color:#1f7a4d !important; color:#fff !important;
        border-radius:10px !important; padding:.7rem 1.8rem;
    }

    @media (max-width: 1199.98px){
        .cartItemsList .cart-items{ position:static; margin-top:8px; }
    }
</style>

@endpush 

@section('contents')
{{--<div class="singleProHead">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </nav>
    </div>
</div>--}}
<!-- START SECTION SHOP -->
{{--<div class="section">
    <div class="container cartItemsList">
      @include(welcomeTheme().'.carts.includes.cartItems')
    </div>
</div>--}}
<!-- END SECTION SHOP -->





<section class="section-b-space pt-0"> 
       <div class="heading-banner">
         <div class="custom-container container">
           <div class="row align-items-center">
             <div class="col-sm-6">
               <h4>Cart </h4>
             </div>
             <div class="col-sm-6">
               <ul class="breadcrumb float-end">
                 <li class="breadcrumb-item">  <a href="{{route('index')}}">Home  </a></li>
                 <li class="breadcrumb-item active">  <a href="javascript:void(0)">Cart </a></li>
               </ul>
             </div>
           </div>
         </div>
       </div>
     </section>
     <section class="section-b-space pt-0">
       <div class="custom-container cartItemsList container">
            @include(welcomeTheme().'.carts.includes.cartItems')
       </div>
     </section>



@endsection 
@push('js') 

<script>
    $(document).ready(function(){
        
            $(document).on('change','.cartQtyChange',function(){

                  var url = $(this).data('url');
                  var qty = $(this).val();
                  var Dcharge =parseInt($('.cartDeliveryCharge').text());

                  if (isNaN(Dcharge)){
                    Dcharge =0;
                  }
                
                if(qty==''){
                    qty=1;
                }
                
                $.ajax({
                  url: url,
                  type: 'GET',
                  dataType: 'json',
                  cache: false,
                  data: {'qty':qty},
                })
                .done(function(data) {
                    $(".cartItemsList").empty().append(data.cartItems);
                    $(".headerCartItem").empty().append(data.headerCartItems);
                })
                .fail(function() {
                  // alert("error");
                });


            });
    });
</script>

@endpush