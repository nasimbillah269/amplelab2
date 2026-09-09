<!--<div class="sliderPart">-->
<!--    <div class="">-->
<!--        <div class="row">-->
            <!--<div class="col-xl-3"></div>-->
<!--            <div class="col-xl-12">-->
<!--                @if($slider =slider('Front Page Slider'))-->
<!--                <div class="sliderImages">-->
<!--                    <div class="carousel slide" data-bs-ride="carousel">-->
<!--                        <div class="carousel-inner">-->
<!--                            @foreach($slider->subSliders as $i=>$slider)-->
<!--                            <a href="{{$slider->seo_description?:'javascript:void(0);'}}">-->
<!--                            <div class="carousel-item {{$i==0?'active':''}}" style="background-image:url({{assetUrl($slider->image())}})">-->
<!--                                <div class="sliderContent">-->
                                    <!--<span>HP</span>-->
<!--                                    @if($slider->name)-->
<!--                                    <h1>{!!$slider->name!!}</h1>-->
<!--                                    @endif-->
<!--                                    @if($slider->description)-->
<!--                                    <p>{!!$slider->description!!}</p>-->
<!--                                    @endif-->
<!--                                    @if($slider->seo_title && $slider->seo_description)-->
<!--                                    <a href="{{$slider->seo_description}}" class="shopNowBtn">{!!$slider->seo_title!!}</a>-->
<!--                                    @endif-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            </a>-->
<!--                            @endforeach-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                @endif-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--@if($slider =slider('Front Page Slider'))-->
<!--<div class="hero">-->
<!--    <div class="container-flui">-->
<!--    <div class="row align-items-center">-->


<!--      <div class="col-md-6">-->
<!--        <div id="heroImageSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">-->
<!--          <div class="carousel-inner">-->
<!--            @foreach($slider->subSliders as $i=>$slide)-->
<!--            <div class="carousel-item {{$i==0?'active':''}}">-->
<!--                 <img src="{{assetUrl($slide->image())}}" alt="{{general()->title}}" />   -->
<!--            </div>-->
<!--            @endforeach-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->

      <!-- Static text -->
<!--      <div class="col-md-6">-->
<!--       <div class="sliderInfo">-->
<!--           <img class="fImg" src="{{assetUrl($slider->image())}}" alt="Bytebliss" />  -->
<!--            <h1 class="fw-bold">{!!$slider->name!!}</h1>-->
<!--            <p class="lead">{!!$slider->description!!}</p>-->
<!--            @if($pg =pageTemplate('Latest Products'))-->
<!--            <a href="{{route('pageView',$pg->slug?:'no-title')}}" class="btn btn-light">Browse Products <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>-->
<!--            @endif-->
<!--             <img class="LImg" src="{{assetUrl('public/welcome/images/New Project (2).webp')}}" alt="Bytebliss" /> -->
<!--       </div>-->
<!--      </div>-->

<!--    </div>-->
<!--  </div>-->
<!--</div>-->
<!--@endif-->

@if($slider =slider('Front Page Slider'))
<div class="hero">




        <div id="heroImageSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
   
          <div class="carousel-inner">
            @foreach($slider->subSliders as $i=>$slide)
              
             <div class="carousel-item {{$i==0?'active':''}}">
               <div class="">
            
             <div class="row">
                  <div class="col-md-12">
                    <a href="{{$slide->seo_description?:'javascript:void(0)'}}" target="_blank" >
                    <img src="{{assetUrl($slide->image())}}" alt="{{general()->title}}" />   
                    </a>   
                  </div>
                  <!--<div class="col-md-6">-->
                  <!--      <div class="sliderInfo">-->
                  <!--         <img class="fImg" src="{{assetUrl($slider->image())}}" alt="Bytebliss" />  -->
                  <!--          <h1 class="fw-bold">{!!$slide->name!!}</h1>-->
                  <!--          <p class="lead">{!!$slide->description!!}</p>-->
                            
                  <!--           @if($slide->seo_title && $slide->seo_description)-->
                                   
                  <!--          <a href="{{$slide->seo_description}}" class="btn btn-light">{!!$slide->seo_title!!} <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>-->
                  <!--                  @endif-->

                  <!--           <img class="LImg" src="{{assetUrl('public/welcome/images/New Project (2).webp')}}" alt="Bytebliss" /> -->
                  <!--     </div>-->
                  <!--</div>-->
              </div>
              </div>
            
           </div>
            
            
            @endforeach
          </div>
  
        </div>




</div>
@endif













