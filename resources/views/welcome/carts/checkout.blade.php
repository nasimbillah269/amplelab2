@extends(welcomeTheme().'layouts.app') 
@section('title')
<title>{{websiteTitle('Checkout')}}</title>
@endsection 
@section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Checkout')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keyword" property="og:keyword" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{assetUrl(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('carts')}}" />
<link rel="canonical" href="{{route('carts')}}">
@endsection 
@push('css')
<style>

.singleProHead {
    padding: 12px 0;
    background: #086766;
}

ol.breadcrumb {
    margin: 0;
}


.breadcrumb-item a {
    color: #fff;
}


.breadcrumb-item.active {
    color: #fff;
}
.breadcrumb-item + .breadcrumb-item::before {
    color: #fff;
}


     .section {
        padding: 60px 0;
        background-color: #f9f9f9;
    }
    .orderForm {
        background-color: #fff;
        padding: 20px;
    }
    .orderForm h4 {
        padding-bottom: 8px;
    }
    .order_review {
        padding: 20px;
        background-color: #fff;
    }
    .payment_method h4 {
        color: #292b2c;
        font-weight: 700;
        padding-bottom: 20px;
    }
    p.payment-text {
        padding: 10px 0;
        font-size: 14px;
        font-weight: bold;
    }
    .order_review button {
        background-color: #e72834;
        width: 100%;
        border: none;
        padding: 10px 0;
        font-weight: bold;
        margin-top: 10px;
    }
    .orderForm .form-control:focus {
        box-shadow: none;
    }
    .orderForm .form-control {
        text-align: left;
        /*border-radius: 0;*/
        margin: 10px 0;
        /*font-size: 14px;*/
    }
    .payment_method .ui-tabs .ui-tabs-nav .ui-tabs-anchor {
        padding: 10px 10px;
        font-size: 14px;
    }
    .payment_method .ui-tabs .ui-tabs-nav {
        padding: 10px 5px;
        background-color: #fff;
         border: none;
    }
    .payment_method .ui-widget.ui-widget-content {
        border: none;
    }
    .payment_method .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {
        border: 1px solid #20863a;
        background: #369943;
        font-weight: normal;
        color: #ffffff;
    }
    .payment_method .form-check-input:checked {
        background-color: #d55959;
        border-color: #d55959;
    }
    
     .payment_method .ui-tabs .ui-tabs-nav li {
        border: 1px solid lightgray;
    }
    .payment_method  .form-check {
        min-height: 0;
        margin-bottom: 0;
    }
    
    .methodPayment {
        padding: 10px;
        background: #f7f7f7;
        margin: 10px 0;
        border-radius: 10px;
        text-align: center;
    }     
    
    .methodPayment img{
        border-radius: 5px;
        border: 1px solid #d5d5d5;
    }
    
    .viewPlanEMI {
        border: 1px solid #0ba350;
        padding: 5px 7px;
        font-size: 12px;
        text-align: center;
        background: white;
        border-radius: 5px;
        cursor: pointer;
        line-height: 14px;
        display:none;
    }
    
    .bankDataEMI {
        background: #f0f0f0;
        padding: 10px;
        height: 300px;
        overflow: auto;
        border-radius: 5px;
    }
    
    .bankDataEMI ul li.active {
        color: #3b82f6;
        border-bottom: 2px solid #3b82f6;
        border-radius: 6px;
    }
    
    .bankDataEMI ul li {
        cursor: pointer;
        padding: 5px 0;
        font-size: 14px;
        line-height: 1.2em;
        transition: .3s ease;
        border-bottom: 2px solid #f0f0f0;
    }
    .bankDataCharge {
        background: #f0f0f0;
        padding: 10px;
        border-radius: 5px;
    }
    
    .chargeGCT, .chargeGC{
        display:none;
    }
    
    
    
    
    
    
    
    
    
    
    /* =========================
   ORDER FORM WRAPPER
========================= */
.orderForm {
    background: #fff;
    border: 1px solid #e9e9e9;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
    font-family: 'Inter', 'Segoe UI', sans-serif;
}

/* =========================
   HEADINGS
========================= */
.orderForm .heading_s1 h4 {
    font-size: 18px;
    font-weight: 600;
    color: #222;
    margin-bottom: 15px;
    letter-spacing: 0.3px;
}

/* =========================
   FORM INPUTS
========================= */
.orderForm .form-control {
    width: 100%;
    height: 44px;
    border: 1px solid #e2e2e2;
    border-radius: 8px;
    padding: 10px 12px;
    font-size: 14px;
    font-weight: 500;
    color: #333;
    background: #fff;
    transition: all 0.25s ease;
}

/* Focus effect */
.orderForm .form-control:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.12);
    outline: none;
}

/* Placeholder */
.orderForm .form-control::placeholder {
    font-size: 13px;
    color: #999;
    font-weight: 400;
}


.payment-box{
    display:flex;
    gap:20px;
}

.payment-card{
    padding:10px 20px;
    border-radius:15px;
    color:#fff;
    text-align:center;
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
    transition:0.3s;
    width: 100%;
}

.payment-card:hover{
    transform:translateY(-5px);
}

.payment-title{
    font-size:16px;
    font-weight:600;
}

.payment-number{
    font-size: 18px;
    font-weight:700;
    letter-spacing:2px;
}

.bkash{
    background:linear-gradient(135deg,#e2136e,#c7005a);
}

.nagad{
    background:linear-gradient(135deg,#ff7b00,#ff4d00);
}

/* =========================
   TEXTAREA STYLE
========================= */
.orderForm textarea.form-control {
    height: auto;
    min-height: 120px;
    resize: none;
    padding-top: 12px;
}

/* =========================
   FORM GROUP SPACING
========================= */
.orderForm .form-group {
    margin-bottom: 14px;
}

/* =========================
   SELECT STYLE (if used later)
========================= */
.orderForm select.form-control {
    appearance: none;
    cursor: pointer;
}

/* =========================
   LABEL IMPROVEMENT (optional)
========================= */
.orderForm label {
    font-size: 13px;
    font-weight: 500;
    color: #444;
    margin-bottom: 6px;
    display: block;
}

/* =========================
   SECTION SPACING
========================= */
.orderForm .heading_s1 {
    margin-top: 15px;
    margin-bottom: 10px;
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 768px) {
    .orderForm {
        padding: 15px;
    }

    .orderForm .form-control {
        font-size: 13px;
        height: 42px;
    }
    .payment-box{
        display:flex;
            flex-wrap: wrap;
    }
    
}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /* =========================
   ORDER REVIEW WRAPPER
========================= */
.order_review {
    background: #ffffff;
    border: 1px solid #e9e9e9;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
    font-family: 'Inter', 'Segoe UI', sans-serif;
}

/* =========================
   HEADING
========================= */
.order_review .heading_s1 h4 {
    font-size: 18px;
    font-weight: 600;
    color: #222;
    margin-bottom: 15px;
    letter-spacing: 0.3px;
}

/* =========================
   TABLE DESIGN
========================= */
.order_table table {
    width: 100%;
    border-collapse: collapse;
}

.order_table thead th {
    font-size: 13px;
    font-weight: 600;
    color: #666;
    text-transform: uppercase;
    padding: 12px 8px;
    border-bottom: 1px solid #eee;
}

.order_table tbody td {
    font-size: 14px;
    color: #333;
    padding: 12px 8px;
    border-bottom: 1px solid #f1f1f1;
    vertical-align: top;
}

/* Product name */
.order_table tbody td small {
    display: block;
    font-size: 12px;
    color: #888;
    margin-top: 3px;
}

/* Quantity style */
.product-qty {
    display: inline-block;
    margin-left: 6px;
    font-size: 13px;
    color: #555;
    font-weight: 500;
}

/* Price alignment */
.order_table tfoot th,
.order_table tfoot td {
    font-size: 15px;
    font-weight: 600;
    padding: 10px 8px;
    border-top: 1px solid #eee;
}

.order_table tfoot td {
    text-align: center;
}

/* Total highlight */
.chargeNo th,
.chargeNo td {
    font-size: 16px;
    font-weight: 700;
    color: #000;
}

/* =========================
   PAYMENT SECTION
========================= */
.payment_method {
    margin-top: 20px;
    padding-top: 10px;
}

.payment_method .heading_s1 h4 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 12px;
}

.payment_option {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.custome-radio {
       display: flex;
    gap: 8px;
    background: #efefef;
    padding: 8px;
    border-radius: 10px;
    color: #000;
    flex-wrap: wrap;
}

.custome-radio input[type="radio"] {
    accent-color: #28a745;
    transform: scale(1.1);
    cursor: pointer;
}

.custome-radio label {
     font-size: 15px;
    font-weight: bold;
    cursor: pointer;
    margin-bottom: 0;
}

/* =========================
   TERMS TEXT
========================= */
.order_review p {
    font-size: 13px;
    color: #555;
    line-height: 1.6;
}

.order_review p a {
    color: #28a745;
    text-decoration: none;
    font-weight: 500;
}

.order_review p a:hover {
    text-decoration: underline;
}

/* =========================
   BUTTON
========================= */
#submitBtn {
    width: 100%;
    padding: 12px;
    font-size: 15px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
    background: #086766;
    border: none;
}

#submitBtn:hover {
    background: #218838;
    transform: translateY(-1px);
    box-shadow: 0 6px 14px rgba(40, 167, 69, 0.25);
}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    @media only screen and (max-width: 767px) {
          .payment_method .ui-tabs .ui-tabs-nav li {
            width: 100%;
            margin-bottom: 10px;
            border: 1px solid lightgray;
        }
    }
</style>
@endpush 

@section('contents')

<div class="singleProHead">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('carts')}}">Cart View</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>
    </div>
</div>

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION SHOP -->
<div class="section">
    <div class="container">
    @isset($carts)
    @if($carts->count() > 0)
    <form action="{{route('checkout')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="orderForm">
                <div class="heading_s1">
                    <h4>Billing Details</h4>
                </div>
                    <div class="form-group mb-3">
                        <input type="text" required class="form-control" name="name" value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}" placeholder="Enter Your name *">
                    </div>
                    <div class="form-group mb-3">
                        <input class="form-control" required type="text" name="email" value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" placeholder="Email address *">
                    </div>
                    <div class="form-group mb-3">
                        <input class="form-control" required type="text" name="mobile" value="{{ old('mobile', auth()->check() ? auth()->user()->mobile : '') }}" placeholder="Phone *">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <div class="custom_select">
                                <select name="district" id="district" class="form-control" required>
                                    <option value="">Select District*</option>
                                    @foreach(geoData(3) as $data)
                                    <option value="{{$data->id}}" >{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <div class="custom_select">
                                <select name="city" id="city" class="form-control" required>
                                    <option value="">Select City*</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <input class="form-control" required type="text" name="address" value="{{ old('address_line1', auth()->check() ? auth()->user()->address_line1 : '') }}" placeholder="Address line*">
                    </div>
                    <div class="heading_s1">
                        <h4>Additional information</h4>
                    </div>
                    <div class="form-group mb-0">
                        <textarea rows="5" class="form-control" name="note" placeholder="Order notes"></textarea>
                    </div> 
                  </div>
            </div>
            <div class="col-md-6">
                <div class="order_review">
                    <div class="heading_s1">
                        <h4>Your Orders</h4>
                    </div>
                    <div class="table-responsive order_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th style="width: 140px;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carts as $cart)
                                <tr>
                                    <td>
                                    {{$cart->product->name}}
                                    @if($cart->itemAttributes())
                                    <small style="color: gray;">(
                                    @foreach($cart->itemAttributes() as $attributeName => $value)
        								{{ $value }}
        								@if(!$loop->last)
        									| 
        								@endif
        								@endforeach
                                    )
                                    </small>
                                    @endif
                                   
                                    <span class="product-qty">x {{$cart->quantity}}</span>
                                    
                                    </td>
                                    <td>{{priceFullFormat($cart->subtotal())}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SubTotal</th>
                                    <td class="product-subtotal" style="text-align: center;">{{priceFullFormat($cartTotalPrice)}}</td>
                                </tr>
                                <!--<tr>-->
                                <!--    <th>Discount</th>-->
                                <!--    <td style="text-align: center;">{{priceFullFormat($couponDisc)}}</td>-->
                                <!--</tr>-->
                                
                           
                            <tr>
                                <th>Shipping</th>
                                <td id="shipping_charge"
                                    data-inside="{{ general()->inside_dhaka_shipping_charge }}"
                                    data-outside="{{ general()->outside_dhaka_shipping_charge }}">
                                </td>
                            </tr>
                                

                                <tr class="chargeNo">
                                    <th>Total</th>
                                    <td id="grand_total" class="product-subtotal" style="text-align: center;">{{priceFullFormat($grandTotal)}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="payment_method" style="max-width: 300px;">
                        <div class="heading_s1">
                            <h4>Payment</h4>
                        </div>
                        <div class="payment_option">
                           
                            <div class="custome-radio">
                                <input class="form-check-input" type="radio" name="payment_option" id="Cash" value="Cash on delivery" checked="">
                                <label class="form-check-label" for="Cash " style="cursor: pointer;">Cash on delivery </label>
                            </div>
                         <!--<div class="custome-radio">-->
                         <!--       <input class="form-check-input" type="radio" name="payment_option" id="Bkash" value="Bkash">-->
                         <!--       <label class="form-check-label" for="Bkash">Bkash Payment</label>-->
                            
                         <!--       <div id="bkashBox" style="display:none;">-->
                         <!--           <strong>Bkash Number:</strong> 01955-222249-->
                         <!--       </div>-->
                         <!--   </div>-->
                            
                         <!--   <div class="custome-radio">-->
                         <!--       <input class="form-check-input" type="radio" name="payment_option" id="Nagad_Payment" value="Nagad Payment">-->
                         <!--       <label class="form-check-label" for="Nagad_Payment">Nagad Payment</label>-->
                            
                         <!--       <div id="nagadBox" style="display:none;">-->
                         <!--           <strong>Nagad Number:</strong> 01326245535-->
                         <!--       </div>-->
                         <!--   </div>-->

                        </div>
                    </div>
                    
                    <!--<div class="payment-box">-->
                    <!--    <div class="payment-card bkash">-->
                    <!--        <div class="payment-title">Bkash Payment</div>-->
                    <!--        <div class="payment-number">01955-222249</div>-->
                    <!--    </div>-->
                    
                    <!--    <div class="payment-card nagad">-->
                    <!--        <div class="payment-title">Nagad Payment</div>-->
                    <!--        <div class="payment-number">01326245535</div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    <br>
                    <p style="font-size: 14px;">
                        
                    <input type="checkbox" name="terms" required="" checked="" value="true">
                    I accept the <a href="{{assetUrl('/terms-and-conditions')}}" target="_blank">Terms And Conditions</a> outlined, including <a href="{{assetUrl('/return-policy')}}" target="_blank" >Return Policy</a>,<a href="{{assetUrl('/refund-policy')}}" target="_blank">Refund Policy</a>, <a href="{{assetUrl('/privacy-policy')}}" target="_blank">Privacy Policy</a> . I agree to comply before placing my order.
                    </p>
                    <button type="submit" id="submitBtn" class="btn btn-success btn-block">Place Order</button>
                </div>
                
            </div>
        </div>
    </form>
    </div>
    @else
    <div class="cart_empty">
        <i class="linearicons-cart"></i>
        <h4>Empty Cart</h4>
        <a href="{{route('index')}}" class="btn btn-success rounded-0 view-cart">Shopping</a>
    </div>
    @endif
    @endisset
</div>
<!-- END SECTION SHOP -->


</div>
<!-- END MAIN CONTENT -->



@endsection 

@push('js') 

<script>
    $(document).ready(function(){
        
         // Bank click calculation
        $('.bankDataEMI').on('click', 'li', function(){
    
            $('.bankDataEMI li').removeClass('active');
            $(this).addClass('active');
    
            calculateEmi($(this));
        });
    
        // 🔄 Recalculate when amount changes
        $('.totalFigueAmount').on('keyup change', function(){
            let activeBank = $('.bankDataEMI li.active');
            if(activeBank.length){
                calculateEmi(activeBank);
            }
        });
    
        // 🔥 Auto-load on page load
        $('.bankDataEMI li.active').trigger('click');
    
        // EMI Calculation Function
        function calculateEmi(bankLi){
    
            let amount = parseFloat($('.totalFigueAmount').val());
            if (!amount || amount <= 0) {
                $('.emiResultBody').html('');
                return;
            }
    
            let months = [3, 6, 9, 12, 18, 24, 36];
            let tbody = '';
    
            months.forEach(function(m){
    
                let percent = parseFloat(bankLi.attr('data-' + m));
                if (!percent || percent <= 0) return;
    
                let totalCharge = (amount * percent) / 100;
                let totalPayable = amount + totalCharge;
                let perMonth = totalPayable / m;
    
                tbody += `
                    <tr>
                        <td>${m} Months</td>
                        <td>${percent}%</td>
                        <td>${formatAmount(perMonth)}</td>
                        <td>${formatAmount(totalPayable)}</td>
                    </tr>
                `;
            });
    
            $('.emiResultBody').html(tbody);
        }
        
        function formatAmount(num) {
            return num.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }
        
        
        $('.ui-tabs .ui-tabs-nav li').click(function(){
            $(this).find('input').prop('checked',true);
        });
        
        $('.selectMethod').on('change', function () {
            let method = $(this).val();
        
            if (method === 'EMI Online Payment') {
                $('#paymentImage')
                    .attr('src', "{{ assetUrl('welcome/images/emi_bank.jpg') }}")
                    .show();
        
                $('.viewPlanEMI').show();
                $('#preOrderText').hide();
                $('#submitBtn').show();
                $('.chargeGCT').hide();
                $('.chargeGC').hide();
                $('.chargeNo').show();
            } else if (method === 'Pre Order') {
                $('#paymentImage').hide();
                $('.viewPlanEMI').hide();
                $('#preOrderText').show();
                $('#submitBtn').hide();
                $('.chargeGCT').hide();
                $('.chargeGC').hide();
                $('.chargeNo').show();
        
            } else if (method === 'Online Payment') {
                $('#paymentImage')
                    .attr('src', "https://i.imgur.com/QH1SUwO.jpeg")
                    .show();
                
                $('.viewPlanEMI').hide();
                $('#preOrderText').hide();
                $('#submitBtn').show();
                
                $('.chargeGCT').show();
                $('.chargeGC').show();
                $('.chargeNo').hide();
            } else {
                // Placeholder selected or unknown
                $('#paymentImage').hide();
                $('#preOrderText').hide();
                $('#submitBtn').hide();
                $('.chargeGCT').hide();
                $('.chargeGC').hide();
                $('.chargeNo').show();
            }
        });
        
        // Prevent form submission if Pre Order is selected
        $('form').on('keydown', function (e) {
            if (e.key === 'Enter' && $('.selectMethod').val() === 'Pre Order') {
                e.preventDefault();
                return false;
            }
        });
        
        $('form').on('submit', function (e) {
            if ($('.selectMethod').val() === 'Pre Order' || $('.selectMethod').val() === "") {
                e.preventDefault();
                return false;
            }
        });
        
        //  // payment method change
        // $('.selectMethod').on('change', function () {
        //     let method = $(this).val();
    
        //     if (method === 'EMI Online Payment') {
    
        //         $('#paymentImage')
        //             .attr('src', "{{ assetUrl('welcome/images/emi_bank.jpg') }}")
        //             .show();
    
        //         $('#preOrderText').hide();
        //         $('#submitBtn').show();
    
        //     } 
        //     else if (method === 'Pre Order') {
    
        //         // hide image
        //         $('#paymentImage').hide();
    
        //         // show contact text
        //         $('#preOrderText').show();
    
        //         // remove submit button
        //         $('#submitBtn').hide();
    
        //     } 
        //     else { // Online Payment
    
        //         $('#paymentImage')
        //             .attr('src', "https://i.imgur.com/QH1SUwO.jpeg")
        //             .show();
    
        //         $('#preOrderText').hide();
        //         $('#submitBtn').show();
        //     }
        // });
    
        // $('form').on('keydown', function (e) {
        //     if (e.key === 'Enter' && $('.selectMethod').val() === 'Pre Order') {
        //         e.preventDefault();
        //         return false;
        //     }
        // });
    
        // $('form').on('submit', function (e) {
        //     if ($('.selectMethod').val() === 'Pre Order') {
        //         e.preventDefault();
        //         return false;
        //     }
        // });
        
        
        $('.selectDateDelivery').change(function(date){
            var dateV =$(this).val();
            var lastDay =3;
            $( "#datepicker" ).datepicker({
            	minDate: +lastDay,
       			maxDate: "+30D"
            });
                
            if(dateV!=''){
                alert(dateV);
            }
                
        });
        
        $('.prefectureArea').change(function(date){
            var areaId =$(this).val();
            
            var url = "{{route('checkout')}}";

            $.ajax({
              url: url,
              type: 'GET',
              dataType: 'json',
              cache: false,
              data:{'areaId':areaId}
            })
            .done(function(data) {
                $(".selectDateDelivery").empty().append(data.view);
            })
            .fail(function() {
              // alert("error");
            });
                
        });
        
    });
    


// $('#district').on('change', function () {

//     var district = $(this).val();

//     var insideCharge = parseFloat($('#shipping_charge').data('inside'));
//     var outsideCharge = parseFloat($('#shipping_charge').data('outside'));

//     if (district == 'Dhaka District') {
//         $('#shipping_charge').text(
//             insideCharge > 0 ? 'BDT ' + insideCharge : 'Free Shipping'
//         );
//     } else {
//         $('#shipping_charge').text(
//             outsideCharge > 0 ? 'BDT ' + outsideCharge : 'Free Shipping'
//         );
//     }

// });
    
    
    
</script>


<script>
let insideShipping = {{ general()->inside_dhaka_shipping_charge }};
let outsideShipping = {{ general()->outside_dhaka_shipping_charge }};
let grandTotal = {{ $grandTotal }};

function updateShipping() {

    let district = $('#district').val();
    let shipping = 0;

    // Dhaka District ID
    if (district == '73') {
        shipping = insideShipping;
    } else if (district != '') {
        shipping = outsideShipping;
    }

    // Shipping Charge
    $('#shipping_charge').text(
        shipping > 0 ? 'BDT ' + shipping : 'BDT 0'
    );

    // Grand Total Update
    let finalTotal = parseFloat(grandTotal) + parseFloat(shipping);

    $('#grand_total').text('BDT ' + finalTotal.toFixed(2));
}

$(document).ready(function () {
    updateShipping();
});

$(document).on('change', '#district', function () {
    updateShipping();
});
</script>

<script>
    $(document).ready(function () {

    function togglePayment() {
        $('#bkashBox, #nagadBox').hide();

        let payment = $('input[name="payment_option"]:checked').val();

        if (payment === 'Bkash') {
            $('#bkashBox').slideDown();
        } else if (payment === 'Nagad Payment') {
            $('#nagadBox').slideDown();
        }
    }

    togglePayment();

    $('input[name="payment_option"]').on('change', function () {
        togglePayment();
    });

});
</script>

@endpush