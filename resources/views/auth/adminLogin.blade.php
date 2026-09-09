@extends('auth.layouts.app')  @section('title')
<title>{{websiteTitle('Admin Login')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{general()->meta_title}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keyword" property="og:keyword" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{assetUrl(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('admin')}}" />
<link rel="canonical" href="{{route('admin')}}">
@endsection
@push('css')

<style>
  .flexbox-container{ min-height: calc(100vh - 60px); }
  .flexbox-container .box-shadow-2{ box-shadow:none !important; }

  .flexbox-container .card{
    border:1px solid #e6e8ec;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 24px 60px rgba(20,30,45,.14);
  }
  .flexbox-container .card-header{ padding:28px 32px 6px; }
  .flexbox-container .card-body{ padding:20px 32px 34px; }

  .flexbox-container .card-subtitle span{ font-weight:600; color:#5a6472; }

  /* gap between the input fields */
  .flexbox-container form .form-group{ margin-bottom:18px; }
  .flexbox-container form .form-group:last-of-type{ margin-bottom:10px; }

  .flexbox-container .form-control,
  .flexbox-container .form-control-lg{
    border-radius:12px;
    border:1px solid #e3e8ef;
    background:#f5f7fb;
    padding:.85rem 1rem .85rem 3rem !important;
    min-height:52px;
    height:auto;
    line-height:1.4;
    transition:border-color .15s ease, box-shadow .15s ease, background .15s ease;
  }
  .flexbox-container .form-control:focus,
  .flexbox-container .form-control-lg:focus{
    background:#fff;
    border-color:#1cbcb4;
    box-shadow:0 0 0 3px rgba(28,188,180,.18);
  }
  /* left icon — perfectly centered inside the rounded input */
  .flexbox-container .has-icon-left .form-control-position,
  .flexbox-container .position-relative .form-control.form-control-lg ~ .form-control-position{
    top:0 !important;
    left:0 !important;
    right:auto !important;
    width:3rem !important;
    height:100% !important;
    line-height:1 !important;
    display:flex !important;
    align-items:center;
    justify-content:center;
    color:#9aa4b6;
    font-size:.95rem;
    z-index:3;
  }
  .flexbox-container .has-icon-left .form-control-position i{ line-height:1; }

  .flexbox-container .chk-remember{ margin-right:6px; vertical-align:middle; }

  .flexbox-container .btn-primary.btn-lg{
    border-radius:12px;
    padding:.85rem 1rem;
    font-weight:600;
    letter-spacing:.4px;
    margin-top:6px;
  }
</style>

@endpush 

@section('contents')


 <div class="content-header row"></div>
    <div class="content-body">
        <section class="row flexbox-container">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                    <div class="card border-grey border-lighten-3 m-0">
                        <div class="card-header border-0">
                            <div class="card-title text-center">
                                <div class="p-1"><a href="{{route('index')}}"><img src="{{assetUrl(general()->logo())}}" alt="{{general()->title}}" style="max-width: 100%;max-height: 50px;" /></a></div>
                            </div>
                            <h6 class="card-subtitle line-on-side text-muted text-center pt-2" style="font-size: 24px;"><span>Admin Login </span></h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @include(adminTheme().'.alerts')
                                <form class="form-horizontal form-simple" action="{{route('admin')}}"  method="post">
                                    @csrf
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="email" class="form-control form-control-lg" name="email"  value="{{old('email')}}" placeholder="Your Email" required="" />
                                        <div class="form-control-position">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                    </fieldset>
                                    @if($errors->has('email'))
                                        <span style="color:red;display: block;">{{ $errors->first('email') }}</span>
                                    @endif
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" class="form-control form-control-lg" name="password" value="{{old('password')}}" placeholder="Enter Password" required="" />
                                        <div class="form-control-position">
                                            <i class="fa-solid fa-key"></i>
                                        </div>
                                    </fieldset>
                                    @if($errors->has('password'))
                                        <span style="color:red;display: block;">{{ $errors->first('password') }}</span>
                                    @endif
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-12 text-center text-sm-left">
                                            <fieldset>
                                                <input type="checkbox" name="remember" id="remember-me" class="chk-remember" />
                                                <label for="remember-me"> Remember Me </label>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-6 col-12 text-center text-sm-right">
                                            
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa-solid fa-unlock"></i> Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


{{--
<div class="loginPage">
    <div class="container">
           <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form class="loginForm" action="{{route('admin')}}" method="post">
                        @csrf
                        <h4>Admin Login</h4>
                        
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
                            <div class="col-md-12">
                                <button type="submit" class="btn-auth">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>
        </div>
    </div>
</div>
--}}

@endsection @push('js') @endpush