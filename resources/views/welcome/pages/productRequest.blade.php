@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$page->seo_title?:websiteTitle($page->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$page->seo_title?:websiteTitle($page->name)}}" />
<meta name="description" property="og:description" content="{!!$page->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$page->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{assetUrl($page->image())}}" />
<meta name="url" property="og:url" content="{{route('pageView',$page->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('pageView',$page->slug?:'no-title')}}">
@endsection
@push('css')
<style>
.contactFormGrid .form-control {
    text-align: left;
    margin: 0;
}

</style>
@endpush 

@section('contents')

<div class="singleProHead">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$page->name}}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="cotactMainDiv">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                @include(welcomeTheme().'.alerts')
                <form class="formDiv" action="{{route('requestProductSubmit')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h2>{{$page->name}}</h2><br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contactFormGrid">
                                <div class="mb-3">
                                  <label  class="form-label">Your Name*</label>
                                  <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Enter Your Name" required="">
                                  @if ($errors->has('name'))
                                <p style="color: red; margin: 0;">{{ $errors->first('name') }}</p>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contactFormGrid">
                                <div class="mb-3">
                                  <label  class="form-label">Eamil address*</label>
                                  <input type="text" name="email" class="form-control" value="{{old('email')}}" placeholder="Enter Your Email Address" required="">
                                  @if ($errors->has('email'))
                                <p style="color: red; margin: 0;">{{ $errors->first('email') }}</p>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contactFormGrid">
                                <div class="mb-3">
                                  <label  class="form-label">Mobile number*</label>
                                  <input type="text" name="mobile" class="form-control" value="{{old('mobile')}}" placeholder="Enter Your Mobile Number" required="">
                                  @if ($errors->has('mobile'))
                                <p style="color: red; margin: 0;">{{ $errors->first('mobile') }}</p>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="contactFormGrid">
                                <div class="mb-3">
                                  <label class="form-label">Attachment Image <small style="color: gray;">(Max 2Mb)</small></label>
                                  <input type="file" name="attachment" class="form-control" accept="image/*" value="{{old('attachment')}}" >
                                  @if ($errors->has('attachment'))
                                <p style="color: red; margin: 0;">{{ $errors->first('attachment') }}</p>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="textArea">
                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" name="message"  placeholder="Message" rows="3" required="" style="text-align:left;">{{old('message')}}</textarea>
                                    @if ($errors->has('message'))
                                    <p style="color: red; margin: 0;">{{ $errors->first('message') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="contactSubmit">Request Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection @push('js') @endpush