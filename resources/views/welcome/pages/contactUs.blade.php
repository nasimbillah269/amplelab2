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

</style>
@endpush @section('contents')

{{--<div class="pageTitleHeader">
    <div class="container">
        <h1>{{$page->name}}</h1>
    </div>
</div>--}}


<!-- ===================== Contact Hero ===================== -->
<section class="contact-hero"   style="background-image: url('{{ assetUrl(assetLink().'/images/ample/fainal_cotact.jpeg') }}');background-size: cover;
    background-repeat: no-repeat;
    background-position: center;">
  <div class="container position-relative">

    <!-- ===================== Breadcrumb ===================== -->
<div class="breadcrumb-strip">
    <a href="{{route('index')}}">Home</a><span class="sep">&gt;</span><span class="text-muted">{{$page->name}}</span>
</div>

    <div class="row align-items-center">
      <div class="col-lg-7">
        <h1 class="fw-800" style="font-size:38px;font-weight:800;">Contact Us</h1>
        <p class="mb-0">We are here to help you with the best laboratory solutions.</p>
        <div class="hero-underline"></div>
      </div>
      <div class="col-lg-5 mt-4 mt-lg-0">
        <!-- <div class="contact-hero-img">
          <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?q=80&w=1200&auto=format&fit=crop" alt="Lab">
        </div> -->
      </div>
    </div>
  </div>
</section>

<!-- ===================== Form + Info ===================== -->
<section class="section-pad">
  <div class="container">
    <div class="row g-4">
      <!-- Send message -->
      <div class="col-lg-7">
        <div class="contact-card">
          <h4>Send Us a Message</h4>
          <p class="sub">Have a question or need a quotation? Fill out the form and our team will get back to you as soon as possible.</p>
          
          
                @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <strong>Success! </strong> {{Session::get('success')}}.
                        </div>
                        @endif

     
          <form action="{{route('contactMail')}}" id="contactForm" method="post" id="contactForm">
    @csrf

    <div class="row g-3">

        {{-- Name --}}
        <div class="col-md-6">
            <label class="form-label small text-muted">
                Your Name *
            </label>

            <div class="input-icon-group">
                <i class="fa-solid fa-user"></i>

                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       class="form-control ps-5 @error('name') is-invalid @enderror"
                       placeholder="Enter your name"
                       required>
            </div>

            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>


        {{-- Email --}}
        <div class="col-md-6">
            <label class="form-label small text-muted">
                Email Address *
            </label>

            <div class="input-icon-group">
                <i class="fa-solid fa-envelope"></i>

                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="form-control ps-5 @error('email') is-invalid @enderror"
                       placeholder="Enter your email"
                       required>
            </div>

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>


        {{-- Phone --}}
        <div class="col-md-6">
            <label class="form-label small text-muted">
                Phone Number *
            </label>

            <div class="input-icon-group">
                <i class="fa-solid fa-phone"></i>

                <input type="text"
                       name="phone"
                       value="{{ old('phone') }}"
                       class="form-control ps-5 @error('phone') is-invalid @enderror"
                       placeholder="Enter your phone"
                       required>
            </div>

            @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>


        {{-- Subject --}}
        <div class="col-md-6">
            <label class="form-label small text-muted">
                Subject *
            </label>

            <div class="input-icon-group">
                <i class="fa-solid fa-file-lines"></i>

                <input type="text"
                       name="subject"
                       value="{{ old('subject') }}"
                       class="form-control ps-5 @error('subject') is-invalid @enderror"
                       placeholder="Enter subject"
                       required>
            </div>

            @error('subject')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>


        {{-- Inquiry Type --}}
        <div class="col-12">
            <label class="form-label small text-muted">
                Select Inquiry Type *
            </label>

            <select name="inquiry_type"
                    class="form-select @error('inquiry_type') is-invalid @enderror"
                    required>

                <option value="">Select Inquiry Type *</option>

                <option value="Product Inquiry"
                    {{ old('inquiry_type') == 'Product Inquiry' ? 'selected' : '' }}>
                    Product Inquiry
                </option>

                <option value="Quotation Request"
                    {{ old('inquiry_type') == 'Quotation Request' ? 'selected' : '' }}>
                    Quotation Request
                </option>

                <option value="Tender Support"
                    {{ old('inquiry_type') == 'Tender Support' ? 'selected' : '' }}>
                    Tender Support
                </option>

                <option value="After Sales Service"
                    {{ old('inquiry_type') == 'After Sales Service' ? 'selected' : '' }}>
                    After Sales Service
                </option>

                <option value="Other"
                    {{ old('inquiry_type') == 'Other' ? 'selected' : '' }}>
                    Other
                </option>

            </select>

            @error('inquiry_type')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>


        {{-- Message --}}
        <div class="col-12">
            <label class="form-label small text-muted">
                Your Message *
            </label>

            <div class="input-icon-group">
                <i class="fa-solid fa-pen"
                   style="top:24px; transform:none;"></i>

                <textarea name="message"
                          class="form-control ps-5 @error('message') is-invalid @enderror"
                          rows="5"
                          placeholder="Write your message here..."
                          required>{{ old('message') }}</textarea>
            </div>

            @error('message')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>


        {{-- Submit --}}
        <div class="col-12">

            <button type="submit"
                    class="btn-alab submitbutton"
                   >

                Send Message
                <i class="fa-solid fa-paper-plane"></i>
            </button>

            <div class="privacy-note">
                <i class="fa-solid fa-shield-halved"></i>
                Your information is safe with us. We respect your privacy.
            </div>

        </div>
        {{-- Submit --}}
        <!--<div class="col-12">-->

        <!--    <button type="submit"-->
        <!--            class="g-recaptcha btn-alab submitbutton"-->
        <!--            data-sitekey="6LdTLTkrAAAAADMlQDwpl77bDA5tYg68ff5iv6Fx"-->
        <!--            data-callback="onSubmit"-->
        <!--            data-action="submit">-->

        <!--        Send Message-->
        <!--        <i class="fa-solid fa-paper-plane"></i>-->
        <!--    </button>-->

        <!--    <div class="privacy-note">-->
        <!--        <i class="fa-solid fa-shield-halved"></i>-->
        <!--        Your information is safe with us. We respect your privacy.-->
        <!--    </div>-->

        <!--</div>-->

    </div>
</form>
          
        </div>
      </div>

      <!-- Contact info -->
      <div class="col-lg-5">
        <div class="contact-card info-list">
          <h4 class="mb-4">Contact Information</h4>

          <div class="info-row">
            <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
            <div>
              <h6>Our Office</h6>
              <p>House # 12, Road # 5, Mirpur DOHS<br>Dhaka-1216, Bangladesh</p>
            </div>
          </div>

          <div class="info-row">
            <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
            <div>
              <h6>Phone &amp; WhatsApp</h6>
              <p>+880 1712 345 678<br>+880 1912 345 678</p>
            </div>
          </div>

          <div class="info-row">
            <div class="info-icon"><i class="fa-solid fa-envelope"></i></div>
            <div>
              <h6>Email Us</h6>
              <p>info@amplelab.com<br>sales@amplelab.com</p>
            </div>
          </div>

          <div class="info-row">
            <div class="info-icon"><i class="fa-regular fa-clock"></i></div>
            <div>
              <h6>Office Hours</h6>
              <p>Saturday - Thursday<br>9:00 AM - 6:00 PM<br>Friday: Closed</p>
            </div>
          </div>

          <div class="info-row">
            <div class="info-icon"><i class="fa-solid fa-globe"></i></div>
            <div>
              <h6>Website</h6>
              <p>www.amplelab.com</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Map -->
    <div class="row g-4 mt-1">
      <div class="col-lg-4">
        <div class="map-panel">
          <h4>Find Us On Map</h4>
          <p class="sub mb-4" style="font-size:14px;">Visit our office for product demonstration, technical discussion or any inquiries.</p>

          <div class="d-flex align-items-center gap-3 mb-3">
            <i class="fa-solid fa-phone text-success"></i>
            <span>+880 1712 345 678</span>
          </div>
          <div class="d-flex align-items-center gap-3 mb-3">
            <i class="fa-solid fa-envelope text-success"></i>
            <span>info@amplelab.com</span>
          </div>
          <div class="d-flex align-items-start gap-3 mb-4">
            <i class="fa-solid fa-location-dot text-success mt-1"></i>
            <span>House # 12, Road # 5, Mirpur DOHS, Dhaka-1216, Bangladesh</span>
          </div>

          <a href="#" class="btn-alab">Get Directions <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="map-embed">
          <iframe
            src="https://www.google.com/maps?q=Mirpur+DOHS,+Dhaka&output=embed"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== Mini Feature strip ===================== -->
<section class="mini-features">
  <div class="container">
    <div class="row gy-4 text-center">
      <div class="col-6 col-md-4 col-lg">
        <div class="feature-item">
          <div class="icon-circle"><i class="fa-solid fa-award"></i></div>
          <h6>Quality Products</h6>
          <p>From trusted international brands</p>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg">
        <div class="feature-item">
          <div class="icon-circle"><i class="fa-solid fa-headset"></i></div>
          <h6>Expert Support</h6>
          <p>Professional technical assistance</p>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg">
        <div class="feature-item">
          <div class="icon-circle"><i class="fa-solid fa-gear"></i></div>
          <h6>Complete Solutions</h6>
          <p>End-to-end laboratory solutions</p>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg">
        <div class="feature-item">
          <div class="icon-circle"><i class="fa-solid fa-truck-fast"></i></div>
          <h6>On Time Delivery</h6>
          <p>Reliable and timely delivery</p>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg">
        <div class="feature-item">
          <div class="icon-circle"><i class="fa-solid fa-headset"></i></div>
          <h6>After Sales Service</h6>
          <p>Dedicated after sales support</p>
        </div>
      </div>
    </div>
  </div>
</section>






@endsection
@push('js')
@endpush


