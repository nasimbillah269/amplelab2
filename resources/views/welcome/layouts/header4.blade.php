<!-- ============================================= -->
    <!-- SITE HEADER START -->
    <!-- ============================================= -->
    <header class="site-header" id="site-header">

        <!-- === Top Header Bar === -->
        <div class="header-top-bar">
            <div class="custom-container">
                <div class="header-top-inner">

                    <!-- Logo -->
                    <div class="header-logo-wrap">
                        <a href="{{route('index')}}" aria-label="Wafi Furniture Home">
                            <img src="{{assetUrl(general()->logo())}}" alt="Wafi Furniture BD Logo" class="header-logo-img">
                        </a>
                    </div>

                    <!-- Mobile Hamburger Toggle -->
                    <button class="header-mobile-toggle" id="mobileNavToggle" aria-label="Open Menu">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Utility Links (desktop) -->
                    <nav class="header-utility-links" aria-label="Utility Navigation">
                        <!--<a href="#" class="header-utility-link">Help Center</a>-->
                        <!--<a href="#" class="header-utility-link">About Us</a>-->
                        <!--<a href="#" class="header-utility-link">Contact Us</a>-->
                        <a href="#" class="header-utility-link"><i class="fas fa-phone"></i> +8801326-245535</a>
                        <a href="#" class="header-utility-link"><i class="fas fa-envelope"></i> wafis4u@gmail.com</a>
                    </nav>

                    <!-- Search Bar -->
                    <div class="header-search-wrap">
                        <form class="header-search-form" action="{{ route('search') }}" method="GET" role="search">
                             <i class="fas fa-search header-search-icon"></i>
                            <input type="search"
                                   class="header-search-input"
                                   id="headerSearchInput"
                                   name="search"
                                   placeholder="Search entire store here..."
                                   aria-label="Search entire store"
                                   autocomplete="off">
                        </form>
                    </div>

                   
                    <!--<div class="header-action-icons">-->
                 
                    <!--    <a href="account.html" class="header-action-btn" aria-label="My Account" title="My Account">-->
                    <!--        <i class="fa-regular fa-user"></i>-->
                    <!--    </a>-->

                        <!-- Cart -->
                    <!--    <a href="cart.html" class="header-action-btn" aria-label="Shopping Cart" title="Shopping Cart">-->
                    <!--        <i class="fas fa-shopping-cart"></i>-->
                    <!--        <span class="header-cart-badge" id="cartBadgeCount">0</span>-->
                    <!--    </a>-->

                 
                    <!--    <a href="#" class="header-action-btn header-action-globe" aria-label="Language"-->
                    <!--        title="Language">-->
                    <!--        <i class="fas fa-globe"></i>-->
                    <!--    </a>-->
                    <!--</div>-->
                    
                    
                    
                          <div class="sub_header">
                
                 <!--<div class="toggle-nav" id="toggle-nav"><i class="fa-solid fa-bars-staggered sidebar-bar"></i></div>-->
                 
               
                                 
                 <ul class="justify-content-end">
                   <li class="moboleSearch"> 
                     <button href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><i class="iconsax" data-icon="search-normal-2"></i></button>
                   </li>
                   <li>  <a href="{{route('myWishlist')}}"> <i class="fa-regular fa-heart"></i><span class="cart_qty_cls wlcounter">@isset($wlCount){{$wlCount}}@endisset</span></a></li>
                   
                   <li class="onhover-div mobileLogin"><a href="#"> <i class="fa-regular fa-user"></i></a>
                    
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
        <!-- === End Top Header Bar === -->

        <!-- === Category Navigation Bar === -->
    <nav class="header-category-bar" aria-label="Product Categories">
    <div class="container">
        @if($menu = menu('Header Menus'))
            <ul class="header-category-list" id="categoryNav">

                @foreach($menu->subMenus as $mainMenu)

                    @php
    $mega = false;

    foreach ($mainMenu->subMenus as $column) {
        if ($column->subMenus->count() > 0 && $mega == false) {
            $mega = true;
        }
    }
@endphp
                    

                        <li class="header-category-item has-dropdown {{$mega?'has-mega-dropdown':''}}">
                            <a href="{{ assetUrl($mainMenu->menuLink()) }}" class="header-category-link">
                                {{ $mainMenu->menuName() }}
                                @if($mainMenu->subMenus->count())
                                    <i class="fas fa-chevron-down dropdown-arrow"></i>
                                @endif
                            </a>

                            @if($mainMenu->subMenus->count() > 0 && $mega)
                                <div class="header-mega-dropdown">
                                    <div class="mega-dropdown-inner">

                                        @foreach($mainMenu->subMenus as $column)
                                            <div class="mega-dropdown-col">

                                                <h3 class="mega-col-title">
                                                    {{ $column->menuName() }}
                                                </h3>

                                                @if($column->subMenus->count())
                                                    <ul class="mega-col-links">
                                                        @foreach($column->subMenus as $item)
                                                            <li>
                                                                <a href="{{ assetUrl($item->menuLink()) }}" class="mega-link">
                                                                    <i class="fas fa-angle-right mega-link-arrow"></i>
                                                                    {{ $item->menuName() }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif

                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                @elseif($mainMenu->subMenus->count() > 0)
                                <ul class="header-dropdown-menu">

                                    @foreach($mainMenu->subMenus as $submenu)

                                        <li>
                                            <a href="{{ assetUrl($submenu->menuLink()) }}"
                                               class="header-dropdown-link">
                                                <i class="fas fa-angle-right dropdown-link-arrow"></i>
                                                {{ $submenu->menuName() }}
                                            </a>

                                            {{-- Sub Sub Menu --}}
                                            @if($submenu->subMenus->count())
                                                <ul class="header-dropdown-submenu">

                                                    @foreach($submenu->subMenus as $child)

                                                        <li>
                                                            <a href="{{ assetUrl($child->menuLink()) }}">
                                                                {{ $child->menuName() }}
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
</nav>
        <!-- === End Category Navigation Bar === -->

    </header>
    <!-- ============================================= -->
    <!-- SITE HEADER END -->
    <!-- ============================================= -->
    
    
   <header class="header2"> 
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
    <h4>Menu</h4>
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











<div class="mobile-bottom-nav">
    <a href="{{route('index')}}" class="nav-item">
        <span class="icon"><i class="fa-solid fa-store"></i></span>
        <span class="text">Home</span>
    </a>

    <a href="#" class="nav-item active" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
        <span class="cart-wrapper">
           <i class="fa-solid fa-cart-shopping"></i>
            <span class="badge">@isset($cartsCount){{$cartsCount}}@endisset</span>
        </span>
        <span class="text">Cart</span>
    </a>

    <a href="{{route('login')}}" class="nav-item">
       <span class="icon"> <i class="fa-regular fa-user"></i></span>
        <span class="text">Account</span>
    </a>

    <a href="#" class="nav-item moboleSearch " data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
       <span class="icon"><i class="fa-solid fa-magnifying-glass"></i></span>
        <span class="text">Search</span>
    </a>
    

</div>



