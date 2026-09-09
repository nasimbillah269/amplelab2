<!--@if($slider =slider('Front Page Slider'))-->
<!-- @foreach($slider->subSliders as $i=>$slide)-->
<!--<div class="home-banner p-right">                             <img class="img-fluid" src="{{assetUrl($slide->image())}}" alt="" />-->
<!--               <div class="contain-banner"> -->
<!--                 <div> -->
<!--                   <h4>Hot Offer  <span>START TODAY </span></h4>-->
<!--                   <h1>{!!$slide->name!!} </h1>-->
                      
<!--                                    <p> {!!$slide->description!!}</p>-->
                                   

                  
<!--                   <div class="link-hover-anim underline"><a class="btn btn_underline link-strong link-strong-unhovered" href="collection-left-sidebar.html">Show Now-->
<!--                       <svg>-->
<!--                         <use href="../assets/svg/icon-sprite.svg#arrow"></use>-->
<!--                       </svg></a><a class="btn btn_underline link-strong link-strong-hovered" href="#">Show Now-->
<!--                       <svg>-->
<!--                         <use href="../assets/svg/icon-sprite.svg#arrow"></use>-->
<!--                       </svg></a></div>-->
<!--                 </div>-->
<!--               </div>-->
<!--             </div>-->
<!--@endforeach-->
<!--             <ul class="social-icon"> -->
<!--               <li>  <a href="#">-->
<!--                   <h6>Follow Us </h6></a></li>-->
<!--               <li>  <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>-->
<!--               <li>  <a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>-->
<!--             </ul>-->
<!--@endif-->








<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
      @foreach($slider->subSliders as $i=>$slide)
    <div class="carousel-item {{$i==0?'active':''}}">
      <img src="{{assetUrl($slide->image())}}" class="d-block w-100" alt="...">
    </div>
    @endforeach
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>