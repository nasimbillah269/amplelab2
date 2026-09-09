@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Dashboard')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Dashboard')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{assetUrl(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('customer.dashboard')}}" />
<link rel="canonical" href="{{route('customer.dashboard')}}" />
@endsection @push('css') 

<style>
    .sidebar-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.sidebar-title a {
    background: #ff1493;
    color: #fff;
    padding: 5px 10px;
    border-radius: 5px;
}
.heading-banner h4 {
    font-size: 16px !important;
}
.sidebar-title h5 {
    font-size: 16px;
}
.sidebar-title h4 {
    font-size: 16px;
}
</style>
@endpush @section('contents')

{{--<div class="section customInvoice">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                @include(welcomeTheme().'.customer.includes.sidebar')
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="dashboard_content">
                    <div class="card">
                        <div class="card-header">
                            <h3>Dashboard</h3>
                        </div>
                        <div class="card-body">
                            @include(welcomeTheme().'.alerts')
                            @if(Auth::user()->admin)
                            <p>
                                Go To <b> <a href="{{route('admin.dashboard')}}">Admin Dashboard</a></b>
                            </p>
                            @endif
                            <p>
                                From your account dashboard. you can easily check view your <b><a href="{{route('customer.profile')}}">edit your password and account details.</a></b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>--}}

  <section class="section-b-space pt-0"> 
       <div class="heading-banner">
         <div class="custom-container container">
           <div class="row align-items-center">
             <div class="col-sm-6">
               <h4>Dashboard </h4>
             </div>
             <div class="col-sm-6">
               <ul class="breadcrumb float-end">
                 <li class="breadcrumb-item">  <a href="{{route('index')}}">Home  </a></li>
                 <li class="breadcrumb-item active">  <a href="javascript:void(0)">Dashboard </a></li>
               </ul>
             </div>
           </div>
         </div>
       </div>
     </section>
   <section class="section-b-space pt-0"> 
      <div class="custom-container container user-dashboard-section"> 
        <div class="row">
          <div class="col-xl-3 col-lg-4">
            @include(welcomeTheme().'.customer.includes.sidebar')
          </div>
          <div class="col-xl-9 col-lg-8">
                <div class="dashboard-right-box">
                  <div class="my-dashboard-tab">
                    <div class="dashboard-items"> </div>
                    <div class="sidebar-title">
                      <div class="loader-line"></div>
                      <h4>My Dashboard</h4>
                      <a href="{{route('customer.profile')}}">Edit Profile</a>
                    </div>


                    <div class="profile-about"> 
                      <div class="row"> 
                        <div class="col-xl-7"> 
                          <div class="sidebar-title">
                            <div class="loader-line"></div>
                            <h5>Profile Information</h5>
                          </div>
                          <ul class="profile-information"> 
                            <li> 
                              <h6>Name :</h6>
                              <p>{{$user->name}}</p>
                            </li>
                            <li> 
                              <h6>Phone:</h6>
                              <p>{{$user->mobile}}</p>
                            </li>
                            <li> 
                              <h6>Address:</h6>
                              <p>{{$user->fullAddress()}}</p>
                            </li>
                          </ul>
                          <div class="sidebar-title">
                            <div class="loader-line"></div>
                            <h5>Login Details</h5>
                          </div>
                          <ul class="profile-information mb-0"> 
                            <li> 
                              <h6>Email :</h6>
                              <p>{{$user->email}}</p>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

          </div>
        </div>
      </div>
    </section>


@endsection @push('js') @endpush
