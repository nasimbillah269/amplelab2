
<!-- header part start -->
<header>
    <div class="topHeader">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <!--<p class="welcomeText">Welcome To <b>BYTEBLISS</b> Online Shopping Store.</p>-->
                </div>
                <div class="col-md-6">
                    @if(offerNotes()->count() > 0)
                    <div class="topText text-center headerTopPart">
                        <marquee behavior="scroll" direction="left" scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();">
                        @foreach(offerNotes() as $note)
                        <p>{!!$note->content!!}</p>
                        @endforeach
                        </marquee>
                    </div>
                    @endif
                    <!--@if(offerNotes()->count() > 0)-->
                    <!--<div class="headerTopPart">-->
                    <!--    @foreach(offerNotes() as $note)-->
                    <!--    <a class="slick-box selectedItem" href="javascript:void(0)">{!!$note->content!!}</a>-->
                    <!--    @endforeach-->
                    <!--</div>-->
                    <!--@endif-->
                </div>
                <div class="col-md-3">
                    <!--<ul class="accountList">-->
                    <!--    @if(Auth::check())-->
                    <!--    <li>-->
                    <!--        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form-head').submit();" ><i class="fa fa-user-plus"></i> Log-out</a>-->
                    <!--        <form id="logout-form-head" action="{{ route('logout') }}" method="POST" style="display: none;">-->
                    <!--            @csrf-->
                    <!--        </form>-->
                    <!--    </li>-->
                    <!--    @else-->
                    <!--    <li>-->
                    <!--        <a href="{{route('login')}}"><i class="fa fa-user-o"></i> Login</a>-->
                    <!--    </li>-->
                    <!--    <li>-->
                    <!--        <a href="{{route('register')}}"><i class="fa fa-user-plus"></i> Register</a>-->
                    <!--    </li>-->
                    <!--    @endif-->
                    <!--</ul>-->
                </div>
            </div>
        </div>
    </div>

    <div class="middleHeader">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3">
                    <div class="logoHeader">
                        <a href="{{route('index')}}" class="mainLogo">
                            <img src="{{assetUrl(general()->logo())}}" alt="{{general()->title}}" />
                        </a>
                    </div>
                </div>
                <div class="col-xl-5 col-12">
                    <div class="searchBox">
                        <form action="{{route('search')}}" class="searchHeaderArea" style="position:relative;" >
                            <div class="input-group" id="searchHeaderInput">
                                <input type="text" class="form-control" name="search" value="{{request()->search}}" placeholder="Search For Products..." />
                                <button type="submit" class="input-group-text"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="searchResultAjax"></div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4 col-12 p-0">
                
                    <ul class="cartWish">
                        @if($pg =pageTemplate('Product Request'))
                        <li class="headerExtraLink">
                            <a href="{{route('pageView',$pg->slug?:'no-title')}}" class="pre-order">Pre-Order</a>
                        </li>
                        @endif
                        
                        @if($pg =pageTemplate('Offer Products'))
                        <li class="headerExtraLink">
                            <!--<a href="{{route('pageView',$pg->slug?:'no-title')}}"  class="offer-text" > <img src="{{assetUrl('public/welcome/images/cion.png')}}" alt="Bytebliss" />     Offers</a>-->
                            <a href="javascript:void(0)"  class="offer-text hero-sectionClick" > <img src="{{assetUrl('public/welcome/images/cion.png')}}" alt="Bytebliss" />     Offers</a>
                        </li>
                        @endif
                        
                        <li class="l">
                            <a href="{{route('myWishlist')}}">
                                <div class="countPosi">
                                    <img src="{{assetUrl('public/welcome/images/heart.png')}}" alt="Bytebliss" />
                                    <span class="wlcounter">@isset($wlCount){{$wlCount}}@endisset</span>
                                </div>
                            </a>
                        </li>
                        <li class="l">
                            @if(Auth::check())
                            <a href="{{route('customer.dashboard')}}">
                            @else
                            <a href="{{route('login')}}">
                            @endif
                                <div class="countPosi">
                                    <img src="{{assetUrl('public/welcome/images/user.png')}}" alt="Bytebliss" />    
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('carts')}}">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="countPosi">
                                            <img src="{{assetUrl('public/welcome/images/Icon.png')}}" alt="Bytebliss" />   
                                            <span class="cartCounter">@isset($cartsCount){{$cartsCount}}@endisset</span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="bottomHeader" style="background:white;">
        <div class="container">
            <div class="row">
                <!--<div class="col-md-3">-->
                <!--    <div class="toglerCtg">-->
                <!--        <h3>Browse All Category <i class="fa fa-angle-down"></i></h3>-->
                <!--        <div class="ctgScrolBar">-->
                <!--            @if($menu = menu('Category Menus'))-->
                <!--            <ul class="allctgList">-->
                                
                <!--                @foreach($menu->subMenus as $menu)-->
                <!--                <li>-->
                <!--                    <a href="{{assetUrl($menu->menuLink())}}">-->
                <!--                        <div class="d-flex align-items-center">-->
                <!--                            <div class="flex-shrink-0">-->
                                                <!--<i class="fa fa-mobile"></i>-->
                <!--                                <img src="{{assetUrl($menu->image())}}" class="" alt="Bytebliss"/>-->
                <!--                            </div>-->
                <!--                            <div class="flex-grow-1 ms-2">-->
                <!--                                <span>{{$menu->menuName()}}</span>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </a>-->
                <!--                    @if($menu->subMenus()->count() > 0)-->
                <!--                    <i class="fa fa-angle-right"></i>-->
                <!--                    @endif-->
                <!--                    @if($menu->subMenus()->count() > 0)-->
                <!--                    <ul class="subCtg">-->
                <!--                        @foreach($menu->subMenus as $menu)-->
                <!--                        <li>-->
                <!--                            <a href="{{assetUrl($menu->menuLink())}}">{{$menu->menuName()}}</a>-->
                <!--                            @if($menu->subMenus()->count() > 0)-->
                <!--                            <i class="fa fa-angle-right"></i>-->
                <!--                            @endif-->
                <!--                            @if($menu->subMenus()->count() > 0)-->
                <!--                            <ul class="subsubCtg">-->
                <!--                                @foreach($menu->subMenus as $menu)-->
                <!--                                <li>-->
                <!--                                    <a href="{{assetUrl($menu->menuLink())}}">{{$menu->menuName()}}</a>-->
                <!--                                </li>-->
                <!--                                @endforeach-->
                <!--                            </ul>-->
                <!--                            @endif-->
                <!--                        </li>-->
                <!--                        @endforeach-->
                <!--                    </ul>-->
                <!--                    @endif-->
                <!--                </li>-->
                <!--                @endforeach-->
                <!--            </ul>-->
                <!--            @endif-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="col-md-12">
                  <div class="menuList">
@php
    function renderMenu($items) {
        echo '<ul class="submenu">';
        foreach ($items as $item) {
            $hasChild = $item->subMenus->count();
            echo '<li class="'.($hasChild ? 'has-submenu' : '').'">';
            echo '<a href="'.assetUrl($item->menuLink()).'">';
            echo e($item->menuName());

            if ($hasChild) {
                echo '<i class="fa fa-angle-right submenu-arrow"></i>';
            }

            echo '</a>';

            if ($hasChild) {
                renderMenu($item->subMenus);
            }

            echo '</li>';
        }
        echo '</ul>';
    }
@endphp

@if($menu = menu('Category Menus'))
    <ul class="main-menu">
        @foreach($menu->subMenus as $item)
            <li class="{{ $item->subMenus->count() ? 'has-submenu' : '' }}">
                <a href="{{ assetUrl($item->menuLink()) }}">
                    {{ $item->menuName() }}
                    @if($item->subMenus->count())
                        <i class="fa fa-angle-down submenu-arrow"></i>
                    @endif
                </a>

                @if($item->subMenus->count())
                    @php renderMenu($item->subMenus); @endphp
                @endif
            </li>
        @endforeach
    </ul>
@endif
</div>


                </div>
            </div>
        </div>
    </div>
</header>
<!-- header part end -->