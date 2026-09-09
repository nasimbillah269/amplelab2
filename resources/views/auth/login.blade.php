@extends(welcomeTheme().'layouts.app')  @section('title')
<title>{{websiteTitle('Login')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{general()->meta_title}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keyword" property="og:keyword" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{assetUrl(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('login')}}" />
<link rel="canonical" href="{{route('login')}}">
@endsection
@push('css')

<style>

.loginPage {
    padding: 50px 0;
    background-color: #f9f9f9;
}
.loginForm {
    padding: 22px 30px;
    background-color: #fff;
    border: 1px solid #ededed;
    border-radius: 10px;
}
.loginForm h4 {
    text-align: center;
    font-weight: bold;
    color: #ff1493;
}
.loginForm .form-label {
    font-weight: 600;
    font-size: 14px;
    color: #726161;
    margin-bottom: 2px;
}
.loginForm .form-control {
    text-align: left;
    border-radius: 0;
    padding: 10px 20px;
    margin: 0;
}
.loginForm  .form-control:focus {
    border-color: #86b7fe;
    box-shadow: none;
}
.loginForm p {
    text-align: right;
}
.loginForm p a {
    display: block;
    text-align: center;
    margin-top: 20px;
    letter-spacing: 1px;
}
a.signBtn {
    display: block;
    background-color: #000;
    text-align: center;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-top: 20px;
    padding: 10px 0;
    transition-duration: 0.2s;
}
.loginForm button.btn-auth {
    background-color: #ff1493;
    color: #fff;
    font-size: 16px;
    display: block;
    text-transform: uppercase;
    border: none;
    padding: 10px 0;
    display: block;
    width: 100%;
    margin-top: 15px;
    transition: .2s all;
    letter-spacing: 1px;
}
.loginForm button.btn-auth:hover {
    background-color: #7a1219;
}
</style>

@endpush 

@section('contents')




 <section class="section-b-space pt-0"> 
       <div class="heading-banner">
         <div class="custom-container container">
           <div class="row align-items-center">
             <div class="col-sm-6">
               <h4>Login </h4>
             </div>
             <div class="col-sm-6">
               <ul class="breadcrumb float-end">
                 <li class="breadcrumb-item">  <a href="#">Home  </a></li>
                 <li class="breadcrumb-item active">  <a href="#">Login </a></li>
               </ul>
             </div>
           </div>
         </div>
       </div>
     </section>
     
     
   <div class="loginPage">
    <div class="container">
           <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form class="loginForm" action="{{route('login')}}" method="post">
                        @csrf
                        
                        <div class="loginFormHeader">
                            <h4>Login Your Account</h4>
                            <p style="text-align: center;margin: 10px 0;color: gray;">
                               Access your account by logging in below 
                            </p>
                        </div>
    
                        @include(welcomeTheme().'.alerts')
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" value="{{old('email')}}" name="email" class="form-control" placeholder="Enter Your Email">
                            @if($errors->has('email'))
                                <span style="color:red;display: block;">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password*</label>
                            <input type="password" name="password" class="form-control"  placeholder="Enter Your Password">
                            @if($errors->has('password'))
                                <span style="color:red;display: block;">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn-auth">Login</button>
                            </div>
                            <div class="col-md-6">
                                <p><a href="{{route('forgotPassword')}}">Forgot Password?</a></p>
                            </div>
                        </div>
                        <p style="text-align: center;margin-top: 30px;">
                            You have not account? click <a  href="{{route('register')}}" style="display:inline;">Sign Up</a>
                        </p>
                    </form>
                </div>
                <div class="col-md-3"></div>
        </div>
    </div>
</div>


   {{--<section class="section-b-space pt-0 login-bg-img">
       <div class="custom-container container login-page"> 
         <div class="row align-items-center"> 
           <div class="col-xxl-7 col-6 d-none d-lg-block">
             <div class="login-img">  <img class="img-fluid" src="{{assetUrl('public/welcome/assets/images/login/1.svg')}}" alt="" /></div>
           </div>
           <div class="col-xxl-4 col-lg-6 mx-auto">
             <div class="log-in-box">
               <div class="log-in-title"> 
                 <h4>Welcome To katie </h4>
                 <p>Register Your Account </p>
               </div>
               <div class="login-box"> 
                 <form class="row g-3">
                   <div class="col-12"> 
                     <div class="form-floating">
                       <input class="form-control" id="floatingInputValue" type="email" placeholder="name@example.com" value="test@example.com" />
                       <label for="floatingInputValue">Enter Your Email </label>
                     </div>
                   </div>
                   <div class="col-12"> 
                     <div class="form-floating">
                       <input class="form-control" id="floatingInputValue1" type="password" placeholder="Password" value="password" />
                       <label for="floatingInputValue1">Enter Your Password </label>
                     </div>
                   </div>
                   <div class="col-12">
                     <div class="forgot-box">
                       <div>
                         <input class="custom-checkbox me-2" id="category1" type="checkbox" name="text" />
                         <label for="category1">Remember me </label>
                       </div><a href="forget-password.html">Forgot Password? </a>
                     </div>
                   </div>
                   <div class="col-12"> 
                     <button class="btn login btn_black sm" type="submit" data-bs-dismiss="modal" aria-label="Close">Log In </button>
                   </div>
                 </form>
               </div>
               <div class="other-log-in"> 
                 <h6>OR </h6>
               </div>
               <div class="log-in-button"> 
                 <ul> 
                   <li>  <a href="https://www.google.com/" target="_blank">  <i class="fa-brands fa-google me-2">  </i>Google </a></li>
                   <li>  <a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f me-2"></i>Facebook  </a></li>
                 </ul>
               </div>
               <div class="other-log-in"></div>
               <div class="sign-up-box"> 
                 <p>Don't have an account? </p><a href="sign-up.html">Sign Up </a>
               </div>
             </div>
           </div>
         </div>
       </div>
     </section>--}}




@endsection @push('js') @endpush