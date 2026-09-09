@extends(adminTheme().'layouts.app')
@section('title')
<title>{{websiteTitle('Theme Setting')}}</title>
@endsection

@push('css')

<style type="text/css">
	.ProductGridSection {
    border: 1px solid gray;
    padding: 5px;
    text-align: center;
    }
	
	.ProductGrid {
    min-height: 120px;
    }
    
    .ProductGrid img {
    max-width: 100%;
    max-height: 115px;
    }
    /***** Chrome, Safari, Edge, Opera *****/
    .monthChargeInput::-webkit-outer-spin-button,
    .monthChargeInput::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    /***** Firefox *****/
    .monthChargeInput[type=number] {
        -moz-appearance: textfield;
    }
</style>

@endpush
@section('contents')


<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
     <h3 class="content-header-title mb-0">Theme Setting</h3>
     <div class="row breadcrumbs-top">
       <div class="breadcrumb-wrapper col-12">
         <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard </a></li>
           <li class="breadcrumb-item active">Theme Setting</li>
         </ol>
       </div>
     </div>
   </div>
   <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
     <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
       	<a class="btn btn-outline-primary" href="{{route('admin.themeSetting')}}">
       		<i class="fa-solid fa-rotate"></i>
       	</a>
     </div>
   </div>
</div>
 
	

 <div class="content-body"><!-- Basic Elements start -->
	 <section class="basic-elements">
	     <div class="row">
	         <div class="col-md-12">
	         	@include(adminTheme().'alerts')
	             <div class="card">
	             	<div class="card-header " style="border-bottom: 1px solid #e3ebf3;">
						<h4 class="card-title">theme Setting</h4>
					</div>
	                 <div class="card-content">
	                     <div class="card-body">
	                         <div class="offer-notes-list">
                                <h3>Home Popup Offer</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 200px;min-width:200px;">Action</th>
                                            <th>Offer Text</th>
                                            <th style="width: 200px;min-width:200px;">Image</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b>Status:</b>
                                                @if($bannerNote->status=='active')
                                                <span class="badge badge-sm badge-success">
                                                @else
                                                <span class="badge badge-sm badge-danger">
                                                @endif
                                                {{ucfirst($bannerNote->status)}}
                                                </span>
                                                <br>
                                                <a href="javascript:void(0)" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editBannerNote_{{$bannerNote->id}}" >Edit</a> 
                                            </td>
                                            <td>
                                                <b>Title:</b>
                                                {{$bannerNote->name}}
                                                <br><b>Link:</b>
                                                {{$bannerNote->sub_title}}
                                            </td>
                                            <td>
                                                <img src="{{assetUrl($bannerNote->image())}}" style="max-height:60px;">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="Feature-notes-list">
                                <h3>Home Featured Text <span class="btn btn-sm btn-info" data-toggle="modal" data-target="#editFeaturedNote">Edit</span></h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Payment & Delivery</th>
                                            <th>Return & Refund</th>
                                            <th>24x7 Free Support</th>
                                            <th>Flexible EMI Policy</th>
                                        </tr>
                                        @if($featuredNote)
                                        <tr>
                                            <td>{{$featuredNote->name}}</td>
                                            <td>{{$featuredNote->content}}</td>
                                            <td>{{$featuredNote->sub_title}}</td>
                                            <td>{{$featuredNote->description}}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
	                         <div class="offer-notes-list">
                                <h3>Offer Note For Top Header <a href="javascript:void(0)" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addOfferNote"><i class="fa fa-plus"></i> Add Note</a> </h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 200px;min-width:200px;">Action</th>
                                            <th>Note</th>
                                        </tr>
                                        @foreach($offerNotes as $n=>$note)
                                        <tr>
                                            <td>
                                                <b>Status:</b>
                                                @if($note->status=='active')
                                                <span class="badge badge-sm badge-success">
                                                @else
                                                <span class="badge badge-sm badge-danger">
                                                @endif
                                                {{ucfirst($note->status)}}
                                                </span>
                                                <br>
                                                <b>Date:</b> {{$note->created_at->format('d-m-Y')}}<br>
                                               <a href="javascript:void(0)" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editOfferNote_{{$note->id}}" >Edit</a> 
                                               <a href="{{route('admin.themeSettingAction',['delete-offer-note',$note->id])}}" class="btn btn-sm btn-danger mx-2" onclick="return confirm('Are You Want to Delete?')"><i class="fa fa-trash"></i></a> 
                                            </td>
                                            <td>
                                                {!!$note->content!!}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
	                         <hr>
	                         <div class="row">
	                             <div class="col-md-8">
	                                 <h3>Home Page Product Manage  <a class="btn btn-sm btn-primary" href="{{route('admin.themeSettingAction','create')}}" onclick="return confirm('Are You Want to Add?')"><i class="fa fa-plus"></i> Add</a></h3>
	                             </div>
	                         </div>
		                     <div class="table-responsive">
		                        <table class="table table-bordered">
		                             <tr>
		                                 <th style="width: 200px;min-width: 200px;">Title</th>
		                                 <th style="min-width: 100px;">Data Type</th>
		                                 <th style="min-width: 100px;">Image</th>
		                                 <th style="min-width: 120px;">Status</th>
		                                 <th style="min-width: 120px;">Date</th>
		                                 <th style="min-width: 100px;">Action</th>
		                             </tr>
		                             @foreach($homeDatas as $homedata)
		                             <tr>
		                                 <td>{!!$homedata->name!!}</td>
		                                 <td>
		                                     @if($homedata->data_type)
		                                     <span>{{$homedata->data_type}}</span>
		                                     @endif
		                                 </td>
		                                 <td>
		                                     <img src="{{assetUrl($homedata->image())}}" style="max-height:60px;max-width:80px;">
		                                 </td>
		                                 <td>
		                                     @if($homedata->status=='active')
		                                     <span class="badge badge-success">
		                                     @else
		                                     <span class="badge badge-danger">
		                                     @endif
		                                     {{ucfirst($homedata->status)}}
		                                     </span>
		                                 </td>
		                                 <td>
		                                     {{$homedata->created_at->format('d-m-Y')}}
		                                 </td>
		                                 <td>
		                                     <a href="{{route('admin.themeSettingAction',['edit',$homedata->id])}}" class="btn btn-sm btn-success">Edit</a>
		                                     <a href="{{route('admin.themeSettingAction',['delete',$homedata->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Want To Delete?')"><i class="fa fa-trash"></i></a>
		                                 </td>
		                             </tr>
		                             @endforeach
		                         </table>    
		                     </div>
		                     <hr>
		                     
		                     <div class="row">
	                             <div class="col-md-8">
	                                 <h3>EMI Bank Commission </h3>
	                             </div>
	                         </div>
		                      <div class="table-responsive">
		                        <table class="table table-bordered">
		                            <thead>
    		                             <tr>
    		                                 <th style="min-width: 250px;">Bank Name</th>
    		                                 <th style="min-width: 100px;width: 100px;">3 Months</th>
    		                                 <th style="min-width: 100px;width: 100px;">6 Months</th>
    		                                 <th style="min-width: 100px;width: 100px;">9 Months</th>
    		                                 <th style="min-width: 100px;width: 100px;">12 Months</th>
    		                                 <th style="min-width: 100px;width: 100px;">18 Months</th>
    		                                 <th style="min-width: 100px;width: 100px;">24 Months</th>
    		                                 <th style="min-width: 100px;width: 100px;">36 Months</th>
    		                                 <th style="min-width: 60px;width: 60px;">
    		                                     <span class="badge badge-success addAMI" data-url="{{route('admin.themeSettingAction',['ami-add'])}}" style="cursor:pointer;" ><i class="fa fa-plus"></i></span>
    		                                 </th>
    		                             </tr>
		                            </thead>
		                             <tbody class="amiBody">
		                                 @include(adminTheme().'theme-setting.includes.emiList')
		                             </tbody>

		                         </table>    
		                     </div>
	                     </div>
	                     
	                 </div>
	             </div>


	         </div>
	     </div>
	 </section>
	 <!-- Basic Inputs end -->
</div>


<!-- Modal -->
<div class="modal fade text-left" id="editBannerNote_{{$bannerNote->id}}" tabindex="-1" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('admin.themeSettingAction',['update-banner-note',$bannerNote->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit Offer Banner</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control {{$errors->has('title')?'error':''}}" name="title" placeholder="Enter Note" value="{{old('title')?:$bannerNote->name}}" required="" />
                        @if ($errors->has('title'))
                        <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('title') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Banner Link</label>
                        <input type="text" class="form-control {{$errors->has('sub_title')?'error':''}}" name="sub_title" placeholder="Enter Link" value="{{old('sub_title')?:$bannerNote->sub_title}}" />
                        @if ($errors->has('sub_title'))
                        <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('sub_title') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="image">Banner Image (800 X 600 px)</label>
                        <input type="file" name="image" class="form-control {{$errors->has('image')?'error':''}}" />
                        @if ($errors->has('image'))
                        <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('image') }}</p>
                        @endif
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="status_banner" name="status" {{$bannerNote->status=='active'?'checked':''}}/>
                                <label class="custom-control-label" for="status_banner">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Update Offer Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($featuredNote)
<!-- Modal -->
<div class="modal fade text-left" id="editFeaturedNote" tabindex="-1" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('admin.themeSettingAction',['update-featured-note',$featuredNote->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit Home Featured Text</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Payment & Delivery</label>
                        <input type="text" class="form-control {{$errors->has('payment_delivery')?'error':''}}" name="payment_delivery" placeholder="Enter Note" value="{{old('payment_delivery')?:$featuredNote->name}}" required="" />
                        @if ($errors->has('payment_delivery'))
                        <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('payment_delivery') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Return & Refund</label>
                        <input type="text" class="form-control {{$errors->has('return_refund')?'error':''}}" name="return_refund" placeholder="Enter Note" value="{{old('return_refund')?:$featuredNote->content}}" required="" />
                        @if ($errors->has('return_refund'))
                        <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('return_refund') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>24x7 Free Support</label>
                        <input type="text" class="form-control {{$errors->has('online_support')?'error':''}}" name="online_support" placeholder="Enter Note" value="{{old('online_support')?:$featuredNote->sub_title}}" required="" />
                        @if ($errors->has('online_support'))
                        <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('online_support') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Special Gift Cards</label>
                        <input type="text" class="form-control {{$errors->has('gift_card')?'error':''}}" name="gift_card" placeholder="Enter Note" value="{{old('gift_card')?:$featuredNote->description}}" required="" />
                        @if ($errors->has('gift_card'))
                        <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('gift_card') }}</p>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Update Text</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif


@foreach($offerNotes as $note)
<!-- Modal -->
<div class="modal fade text-left" id="editOfferNote_{{$note->id}}" tabindex="-1" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('admin.themeSettingAction',['update-offer-note',$note->id])}}" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit Offer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Enter Note</label>
                        <input type="text" class="form-control {{$errors->has('note_title')?'error':''}}" name="note_title" placeholder="Enter Note" value="{{old('note_title')?:$note->content}}" required="" />
                        @if ($errors->has('note_title'))
                            <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('note_title') }}</p>
                            @endif
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="status_{{$note->id}}" name="status" {{$note->status=='active'?'checked':''}}/>
                                <label class="custom-control-label" for="status_{{$note->id}}">Active</label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Created Date</label>
                            <input type="date" class="form-control {{$errors->has('note_title')?'error':''}}" name="created_at" value="{{$note->created_at->format('Y-m-d')}}" required="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Update Note</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


<!-- Modal -->
<div class="modal fade text-left" id="addOfferNote" tabindex="-1" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('admin.themeSettingAction','add-offer-note')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add Offer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Enter Note</label>
                        <input type="text" class="form-control {{$errors->has('note_title')?'error':''}}" name="note_title" placeholder="Enter Note" value="{{old('note_title')}}" required="" />
                        @if ($errors->has('note_title'))
                            <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('note_title') }}</p>
                            @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Note</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@push('js')
<script>
$(document).ready(function(){

    // ADD
    $('.addAMI').click(function(){
        $.get($(this).data('url'), function(res){
            if(res.success){
                $('.amiBody').html(res.view);
            }
        });
    });

    // UPDATE (keyup)
    $(document).on('keyup', '.ami-input', function(){
        $.get($(this).data('url'), {
            id: $(this).data('id'),
            field: $(this).data('field'),
            value: $(this).val()
        });
    });

    // DELETE
    $(document).on('click', '.deleteAMI', function(){
        if(!confirm('Delete this EMI row?')) return;

        $.get($(this).data('url'), {
            id: $(this).data('id')
        }, function(res){
            if(res.success){
                $('.amiBody').html(res.view);
            }
        });
    });

});
</script>

@endpush