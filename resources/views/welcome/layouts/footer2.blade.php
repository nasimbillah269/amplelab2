
<!--<div class="newsLetter" style="background-image: url(https://bytebliss.com.bd/demo/public/medies/Nov-2024/1732777816.6748175882de7.jpg); background-position: center; background-size: cover; background-repeat: no-repeat;">-->
<!--    <div class="newsLetOverlay">-->
<!--        <div class="container-fluid">-->
<!--            <div class="newLetBox">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-5">-->
<!--                        <h3>Sign Up For Newsletter<br>$ Get 20% Off</h3>-->
<!--                    </div>-->
<!--                    <div class="col-md-7">-->
<!--                        <form id="subscirbeForm" data-url="{{route('subscribe')}}">-->
<!--                            <div class="input-group">-->
<!--                                <input type="text" class="form-control" id="subscribeEmail" placeholder="Enter Email Address">-->
<!--                                <span class="input-group-text subsriberbtm">Subscribe</span>-->
<!--                            </div>-->
<!--                        </form>-->
<!--                         <div id="subscribeemailMsg"></div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!-- footer part start  -->
<footer>
    <div class="footPart" style="margin-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-12">
                    <div class="aboutCompa">
                        <a href="{{route('index')}}">
                            <img src="{{assetUrl(general()->footerLogo())}}" alt="{{general()->title}}">
                        </a>
                        @if(general()->copyright_text)
                        <p>
                            {!!general()->copyright_text!!}
                        </p>
                        @endif
                        
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    
                    <div class="footListPart">
                        @if($menu = menu('Footer Two'))
                        <h4>{{$menu->name}}</h4>
                        <ul class="footList">
                            @foreach($menu->subMenus as $menu)
                            <li><a href="{{assetUrl($menu->menuLink())}}">{{$menu->menuName()}}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="footListPart">
                        @if($menu = menu('Footer Three'))
                        <h4>{{$menu->name}}</h4>
                        <ul class="footList">
                            @foreach($menu->subMenus as $menu)
                            <li><a href="{{assetUrl($menu->menuLink())}}">{{$menu->menuName()}}</a></li>
                            @endforeach
                        </ul>
                        @endif
                        @if($pg=pageTemplate('Contact Us'))
                        <a href="{{route('pageView',$pg->slug?:'no-title')}}" class="btn btnStoreLocate">Store Location</a>
                        @endif
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="footListPart">
                        
                        <h4>Keep In Touch</h4>
                        <ul class="infoLinks">
                            <li>
                                <img src="{{assetUrl('public/welcome/images/phone3.png')}}">
                                <span>
                                    {{general()->mobile}}
                                </span>
                            </li>
                            <li>
                                <img src="{{assetUrl('public/welcome/images/envelope.png')}}">
                                <span>
                                    {{general()->email}}
                                </span>
                            </li>
                            <li>
                                <img src="{{assetUrl('public/welcome/images/map3.png')}}">
                                <span>
                                    {{general()->address_one}}
                                </span>
                            </li>
                        </ul>
                        <h4 style="margin:0;">Social Media Links</h4>
                        <ul class="socialLinks">
                            @if(general()->facebook_link)
                            <li>
                                <a href="{{general()->facebook_link}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            </li>
                            @endif
                            @if(general()->linkedin_link)
                            <li>
                                <a href="{{general()->linkedin_link}}" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                            </li>
                            @endif
                            @if(general()->twitter_link)
                            <li>
                                <a href="{{general()->twitter_link}}" target="_blank"><i class="fa fa-tiktok"></i></a>
                            </li>
                            @endif
                            @if(general()->instagram_link)
                            <li>
                                <a href="{{general()->instagram_link}}" target="_blank"><i class="fa fa-instagram"></i></a>
                            </li>
                            @endif
                            @if(general()->youtube_link)
                            <li>
                                <a href="{{general()->youtube_link}}" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                            </li>
                            @endif
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div style="background-color: #191a23;">
        <div class="container">
            <p style="text-align: center;margin-bottom: 10px;color: white;">
                We Accept
            </p>
            <img src="{{assetUrl('public/welcome/images/sslpayment.png')}}" alt="Bytebliss ssl payment" style="max-width:100%;">
        </div>
    </div>
    
    <div class="bootmFot">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <p>2025 Copyright <a href="{{route('index')}}">©Bytebliss. </a>All Rights Reserved. | Developed by <a href="#" target="_blank" style="color: #04C5FB;">Aalpin Digital</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer part end  -->