  <footer class="footer-layout-img"> 
       <section class="section-b-space footer-1">
         <div class="custom-container container">
           <div class="row"> 
              <!-- Column 1: Contact -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-12">
               <div class="footer-content">
                 <div class="footer-logo">
                     <a href="{{route('index')}}">
                        <img class="img-fluid" src="{{assetUrl(general()->footerLogo())}}" alt="{{general()->title}}">
                    </a>

                  </div>
                 <ul> 
                   <li>  <i class="iconsax" data-icon="location"></i>
                     <h6> {{general()->address_one}}</h6>
                   </li>
                   <li>  <i class="iconsax" data-icon="phone-calling"></i>
                     <h6> {{general()->mobile}} </h6>
                   </li>
                   <li>  <i class="iconsax" data-icon="mail"></i>
                     <h6> {{general()->email}} </h6>
                   </li>
                 </ul>
               </div>
             </div>
             <!-- Column 2: Footer Two -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                 
              @if($menu = menu('Footer Two'))
               <div class="footer-content">
                 <div> 
                   <div class="footer-title d-md-block"> 
                     <h5>{{$menu->name}} </h5>
                     <ul class="footer-details "> 
                        @foreach($menu->subMenus as $menu)
                            <li><a class="nav" href="{{assetUrl($menu->menuLink())}}">{{$menu->menuName()}} </a></li>
                        @endforeach
                     </ul>
                   </div>
                 </div>
               </div>
               @endif
               
             </div>
             <!-- Column 3: Footer Three -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                @if($menu = menu('Footer Three'))
               <div class="footer-content">
                 <div> 
                   <div class="footer-title d-md-block"> 
                     <h5>{{$menu->name}} </h5>
                     <ul class="footer-details "> 
                        @foreach($menu->subMenus as $menu)
                            <li><a class="nav" href="{{assetUrl($menu->menuLink())}}">{{$menu->menuName()}} </a></li>
                        @endforeach
                     </ul>
                   </div>
                 </div>
               </div>
               @endif
             </div>
              <!-- Column 4: Footer Five -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                @if($menu = menu('Footer Five'))
               <div class="footer-content">
                 <div> 
                   <div class="footer-title d-md-block"> 
                     <h5>{{$menu->name}} </h5>
                     <ul class="footer-details "> 
                        @foreach($menu->subMenus as $menu)
                            <li><a class="nav" href="{{assetUrl($menu->menuLink())}}">{{$menu->menuName()}} </a></li>
                        @endforeach
                     </ul>
                   </div>
                 </div>
               </div>
               @endif
             </div>

               </div>
               
               
               
               <!-- Newsletter Section -->
<!--<section class="newsletter-section py-5">-->
   
<!--        <div class="newsletter-box text-center">-->
           
<!--            <p class="text-muted mb-4">-->
<!--                Subscribe to our newsletter and get the latest updates.-->
<!--            </p>-->

<!--            <form>-->
<!--                <div class="input-group newsletter-input-group">-->
<!--                    <input type="email"-->
<!--                           class="form-control"-->
<!--                           placeholder="Enter your email address"-->
<!--                           required>-->
<!--                    <button class="btn btn-dark" type="submit">-->
<!--                        Subscribe-->
<!--                    </button>-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->

<!--</section>-->

<div class="col">
    <div class="footer-content">
        <ul class="socialLinks">

            @if(general()->facebook_link)
            <li class="fb1">
                <a href="{{general()->facebook_link}}" target="_blank">
                    <i class="fa-brands fa-facebook-f"></i>
                    <span>Facebook</span>
                </a>
            </li>
            @endif

            @if(general()->linkedin_link)
            <li>
                <a href="{{general()->linkedin_link}}" target="_blank">
                    <i class="fa-brands fa-tiktok"></i>
                    <span>Tiktok</span>
                </a>
            </li>
            @endif

            @if(general()->twitter_link)
            <li>
                <a href="{{general()->twitter_link}}" target="_blank">
                    <i class="fa-brands fa-x-twitter"></i>
                    <span>X</span>
                </a>
            </li>
            @endif

            @if(general()->instagram_link)
            <li>
                <a href="{{general()->instagram_link}}" target="_blank">
                    <i class="fa-brands fa-instagram"></i>
                    <span>Instagram</span>
                </a>
            </li>
            @endif

            @if(general()->youtube_link)
            <li>
                <a href="{{general()->youtube_link}}" target="_blank">
                    <i class="fa-brands fa-youtube"></i>
                    <span>YouTube</span>
                </a>
            </li>
            @endif

        </ul>
    </div>
</div>
               
               
               
             </div>
           </div>
         </div>
       </section>
       <div class="sub-footer"> 
         <div class="custom-container container">
           <div class="row"> 
             <div class="col-xl-6 col-md-6 col-sm-12">
               <div class="footer-end">
                 <h6>2026 ©Copyright By <span>Wafi furniture BD</span>  Develop By <a href="https://natoreit.com/" target="_blank">Natore-IT</a>  </h6>
               </div>
             </div>
             <div class="col-xl-6 col-md-6 col-sm-12">
               <div class="payment-card-bottom">
                 <ul> 
                   <li>  <img src="{{assetUrl('public/welcome/assets/images/footer/footers.png')}}" alt="" /></li>
                  
               </div>
             </div>
           </div>
         </div>
       </div>
     </footer>