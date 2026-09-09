<!--<div class="dashboard_menu">-->
<!--    <ul class="nav nav-tabs flex-column">-->
<!--        <li class="nav-item">-->
<!--        <a class="nav-link {{Request::is('customer/dashboard')? 'active' : ''}}" href="{{route('customer.dashboard')}}"><i class="ti-layout-grid2"></i>Dashboard</a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--        <a class="nav-link {{Request::is('customer/orders*')? 'active' : ''}}"  href="{{route('customer.myOrders')}}"><i class="ti-shopping-cart-full"></i>Orders</a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--        <a class="nav-link {{Request::is('customer/profile*')? 'active' : ''}}"  href="{{route('customer.profile')}}"><i class="ti-id-badge"></i>Profile</a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--        <a class="nav-link {{Request::is('customer/change-password*')? 'active' : ''}}"  href="{{route('customer.changePassword')}}"><i class="ti-key"></i>Change Password</a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--        <a class="nav-link" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti-lock"></i>Logout</a>-->
<!--        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">-->
<!--            @csrf-->
<!--        </form>-->
<!--        </li>-->
<!--    </ul>-->
<!--</div>-->

 <div class="left-dashboard-show">
      <button class="btn btn_black sm rounded bg-primary">Show Menu</button>
    </div>
    <div class="dashboard-left-sidebar sticky">
      <div class="profile-box"> 
        <div class="profile-bg-img"></div>
        <div class="dashboard-left-sidebar-close"><i class="fa-solid fa-xmark"></i></div>
        <div class="profile-contain">
          <div class="profile-image"> <img class="img-fluid" src="{{assetUrl(Auth::user()->image())}}" alt="{{Auth::user()->name}}"></div>
          <div class="profile-name"> 
            <h4>{{Auth::user()->name}}</h4>
          </div>
        </div>
      </div>
      <ul class="nav flex-column nav-pills dashboard-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <li>
            <a class="nav-link {{Request::is('customer/dashboard*')? 'active' : ''}}" href="{{route('customer.dashboard')}}" >
              <i class="iconsax" data-icon="home-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 18V15" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M10.07 2.81997L3.14002 8.36997C2.36002 8.98997 1.86002 10.3 2.03002 11.28L3.36002 19.24C3.60002 20.66 4.96002 21.81 6.40002 21.81H17.6C19.03 21.81 20.4 20.65 20.64 19.24L21.97 11.28C22.13 10.3 21.63 8.98997 20.86 8.36997L13.93 2.82997C12.86 1.96997 11.13 1.96997 10.07 2.81997Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                </i> 
                Dashboard
            </a>
        </li>
        <li>
            <a class="nav-link {{Request::is('customer/orders*')? 'active' : ''}}" href="{{route('customer.myOrders')}}" >
              <i class="iconsax" data-icon="receipt-square"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 22.75H9C3.57 22.75 1.25 20.43 1.25 15V9C1.25 3.57 3.57 1.25 9 1.25H15C20.43 1.25 22.75 3.57 22.75 9V15C22.75 20.43 20.43 22.75 15 22.75ZM9 2.75C4.39 2.75 2.75 4.39 2.75 9V15C2.75 19.61 4.39 21.25 9 21.25H15C19.61 21.25 21.25 19.61 21.25 15V9C21.25 4.39 19.61 2.75 15 2.75H9Z" fill="#292D32"></path>
                <path d="M12 18.6294C11.44 18.6294 10.91 18.3494 10.54 17.8594L9.94 17.0594C9.87 16.9694 9.79001 16.9194 9.70001 16.9094C9.61001 16.9094 9.53001 16.9494 9.45001 17.0294L8.89999 16.5194L9.45001 17.0294C8.48001 18.0694 7.68999 17.9694 7.29999 17.8194C6.90999 17.6594 6.25 17.1794 6.25 15.6994V9.06938C6.25 6.28938 7.14 5.35938 9.78 5.35938H14.23C16.87 5.35938 17.76 6.29938 17.76 9.06938V15.6994C17.76 17.1794 17.1 17.6694 16.71 17.8194C16.33 17.9694 15.54 18.0694 14.56 17.0294C14.48 16.9494 14.39 16.9094 14.3 16.9094C14.21 16.9094 14.13 16.9694 14.06 17.0594L13.47 17.8494C13.09 18.3494 12.56 18.6294 12 18.6294ZM9.69 15.4094C9.72 15.4094 9.75 15.4094 9.78 15.4094C10.31 15.4394 10.8 15.7094 11.13 16.1594L11.73 16.9594C11.9 17.1794 12.09 17.1794 12.25 16.9594L12.84 16.1694C13.17 15.7194 13.67 15.4494 14.2 15.4194C14.72 15.3794 15.25 15.6094 15.63 16.0194C15.91 16.3194 16.09 16.3994 16.16 16.4194C16.15 16.3694 16.24 16.1694 16.24 15.7094V9.07938C16.24 7.02938 15.93 6.86937 14.21 6.86937H9.76001C8.04001 6.86937 7.73001 7.02938 7.73001 9.07938V15.7094C7.73001 16.1694 7.82001 16.3694 7.85001 16.4294C7.88001 16.3894 8.05999 16.3094 8.32999 16.0094C8.32999 15.9994 8.34001 15.9994 8.35001 15.9894C8.72001 15.6294 9.2 15.4094 9.69 15.4094Z" fill="#292D32"></path>
                </svg>
                </i> 
                Order
            </a>
        </li>
      </ul>
      <div class="logout-button"> 
        <a class="btn btn_black sm" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
          <i class="iconsax me-1" data-icon="logout-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.4389 15.3714C17.2489 15.3714 17.0589 15.3014 16.9089 15.1514C16.6189 14.8614 16.6189 14.3814 16.9089 14.0914L18.9389 12.0614L16.9089 10.0314C16.6189 9.74141 16.6189 9.26141 16.9089 8.97141C17.1989 8.68141 17.6789 8.68141 17.9689 8.97141L20.5289 11.5314C20.8189 11.8214 20.8189 12.3014 20.5289 12.5914L17.9689 15.1514C17.8189 15.3014 17.6289 15.3714 17.4389 15.3714Z" fill="#292D32"></path>
            <path d="M19.9317 12.8086H9.76172C9.35172 12.8086 9.01172 12.4686 9.01172 12.0586C9.01172 11.6486 9.35172 11.3086 9.76172 11.3086H19.9317C20.3417 11.3086 20.6817 11.6486 20.6817 12.0586C20.6817 12.4686 20.3417 12.8086 19.9317 12.8086Z" fill="#292D32"></path>
            <path d="M11.7617 20.75C6.61172 20.75 3.01172 17.15 3.01172 12C3.01172 6.85 6.61172 3.25 11.7617 3.25C12.1717 3.25 12.5117 3.59 12.5117 4C12.5117 4.41 12.1717 4.75 11.7617 4.75C7.49172 4.75 4.51172 7.73 4.51172 12C4.51172 16.27 7.49172 19.25 11.7617 19.25C12.1717 19.25 12.5117 19.59 12.5117 20C12.5117 20.41 12.1717 20.75 11.7617 20.75Z" fill="#292D32"></path>
            </svg>
            </i> 
        Logout 
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>