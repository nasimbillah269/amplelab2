<header> 
       @if($offerNote =App\Models\PostExtra::where('type',5)->where('status','active')->latest()->first())
       <div class="top_header"> 
            <p>{!!$offerNote->content!!}</p>
       </div>
       @endif
       <div class="headerMain">
       <div class="custom-container container header-1">
         <div class="row"> 
           <div class="col-12 p-0"> 
             <div class="mobile-fix-option"> 
               <ul> 
                 <li><a href="{{route('index')}}"><i class="iconsax" data-icon="home-1"></i>Home </a></li>
                 <li><a href="#"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><i class="iconsax" data-icon="search-normal-2"></i>Search </a></li>
                  <!--<li> -->
                  
                  <!--   <button  data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><i class="iconsax" data-icon="search-normal-2"></i>  <span>Search</span></button>-->
                  <!-- </li>-->
                 <li class="shopping-cart">  <a href="{{route('carts')}}"><i class="iconsax" data-icon="shopping-cart"></i>Cart </a></li>
                 <li><a href="{{route('myWishlist')}}"><i class="iconsax" data-icon="heart"></i>My Wish </a></li>
                 
                 <li> 
                 
                  @if(Auth::check())
                    <a href="{{route('customer.dashboard')}}">
                    @else
                    <a href="{{route('login')}}">
                    @endif
                        <div class="countPosiMobile">
                           <i class="iconsax" data-icon="user-2"></i>
                            <span>Login</span>
                        </div>
                    </a>
                 
                 
                 </li>
               </ul>
             </div>
             <div class="offcanvas offcanvas-start" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel">
               <div class="offcanvas-header">
                 <h3 class="offcanvas-title" id="staticBackdropLabel">Offcanvas </h3>
                 <button class="btn-close" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
               </div>
               <div class="offcanvas-body">
                 <div></div>I will not close  you click outside of .
               </div>
             </div>
           </div>
           <div class="col-12">
             <div class="main-menu">  
            
             <a class="brand-logo" href="{{route('index')}}">  <img class="img-fluid for-light" src="{{assetUrl(general()->logo())}}" alt="logo" />
                <img class="img-fluid for-dark" src="{{assetUrl(general()->logo())}}" alt="{{general()->title}}" />
             </a>
             
             
             
        
            
            
            
            <nav id="main-nav">
                @if($menu = menu('Header Menus'))
                    <ul class="nav-menu sm-horizontal theme-scrollbar" id="sm-horizontal">
                        @foreach($menu->subMenus as $menu)
                            <li>
                                <a class="nav-link" href="{{ assetUrl($menu->menuLink()) }}">
                                    {{ $menu->menuName() }}
                                    @if($menu->subMenus->count())
                                        <span><i class="fa-solid fa-angle-down"></i></span>
                                    @endif
                                </a>
            
                                {{-- First Submenu --}}
                                @if($menu->subMenus->count())
                                    <ul class="nav-submenu">
                                        @foreach($menu->subMenus as $submenu)
                                            <li>
                                                <a href="{{ assetUrl($submenu->menuLink()) }}">
                                                    {{ $submenu->menuName() }}
                                                    @if($submenu->subMenus->count())
                                                        <span><i class="fa-solid fa-angle-right"></i></span>
                                                    @endif
                                                </a>
            
                                                {{-- Second Submenu (New Added) --}}
                                                @if($submenu->subMenus->count())
                                                    <ul class="nav-submenu-child">
                                                        @foreach($submenu->subMenus as $childmenu)
                                                            <li>
                                                                <a href="{{ assetUrl($childmenu->menuLink()) }}">
                                                                    {{ $childmenu->menuName() }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
            
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
            
                            </li>
                        @endforeach
                    </ul>
                @endif
            </nav>
            

            

            <div class="sub_header">
                
                 <!--<div class="toggle-nav" id="toggle-nav"><i class="fa-solid fa-bars-staggered sidebar-bar"></i></div>-->
                 
               
                                 
                 <ul class="justify-content-end">
                   <li class="moboleSearch"> 
                     <button href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><i class="iconsax" data-icon="search-normal-2"></i></button>
                   </li>
                   <li>  <a href="{{route('myWishlist')}}"><i class="iconsax" data-icon="heart"></i><span class="cart_qty_cls wlcounter">@isset($wlCount){{$wlCount}}@endisset</span></a></li>
                   
                   <li class="onhover-div mobileLogin"><a href="#"><i class="iconsax" data-icon="user-2"></i></a>
                    
                     <div class="onhover-show-div user "> 
                       <ul> 
                         @if(Auth::check())
                         <li>   
                            <a href="{{route('customer.dashboard')}}">Dashboard</a>
                            </li>
                        @else
                         
                         <li>  <a href="{{route('login')}}">Login  </a></li>
                         <li>  <a href="{{route('register')}}">Register </a></li>
                         @endif
                       </ul>
                     </div>
                   </li>
                   <li class="onhover-div shopping-cart">  <a class="p-0" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                       <div class="shoping-prize"><i class="iconsax pe-2" data-icon="basket-2">  </i><span class="cartCounter">@isset($cartsCount){{$cartsCount}}@endisset</span> items </div></a></li>
                 </ul>
                   <!-- Menu Icon -->
                <div class="menu-toggle">
                    <i class="fa-solid fa-bars"></i>
                </div>
               </div>
             </div>
           </div>
         </div>
       </div>
       </div>
     </header>
     
     
     
     <!-- Overlay -->
<div class="overlay"></div>

<!-- Sidebar -->
<div class="sidebar">
    @if($menu = menu('Header Menus'))
        <ul class="menu">

            @foreach($menu->subMenus as $mainMenu)
                <li class="{{ $mainMenu->subMenus->count() ? 'has-sub' : '' }}">
                    
                    <a href="{{ assetUrl($mainMenu->menuLink()) }}">
                        {{ $mainMenu->menuName() }}

                        @if($mainMenu->subMenus->count())
                            <span class="toggle-icon">+</span>
                        @endif
                    </a>

                    {{-- First Level Submenu --}}
                    @if($mainMenu->subMenus->count())
                        <ul class="submenu">

                            @foreach($mainMenu->subMenus as $submenu)
                                <li class="{{ $submenu->subMenus->count() ? 'has-sub' : '' }}">

                                    <a href="{{ assetUrl($submenu->menuLink()) }}">
                                        {{ $submenu->menuName() }}

                                        @if($submenu->subMenus->count())
                                            <span class="toggle-icon">+</span>
                                        @endif
                                    </a>

                                    {{-- Second Level Submenu --}}
                                    @if($submenu->subMenus->count())
                                        <ul class="submenu">

                                            @foreach($submenu->subMenus as $childmenu)
                                                <li>
                                                    <a href="{{ assetUrl($childmenu->menuLink()) }}">
                                                        {{ $childmenu->menuName() }}
                                                    </a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    @endif

                                </li>
                            @endforeach

                        </ul>
                    @endif

                </li>
            @endforeach

        </ul>
    @endif
</div>
     
     
     
    
     
     
     
     
     