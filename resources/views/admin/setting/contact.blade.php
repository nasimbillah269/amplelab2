@extends(adminTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Contact Setting')}}</title>
@endsection @push('css')
<style type="text/css"></style>
@endpush @section('contents')

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Contact Setting</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard </a></li>
                    <li class="breadcrumb-item active">Contact Setting</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group">
            <a class="btn btn-outline-primary reloadPage" href="javascript:void(0)">
                <i class="fa-solid fa-rotate"></i>
            </a>
        </div>
    </div>
</div>

@include(adminTheme().'alerts')
<form action="{{route('admin.settingUpdate','contact')}}" method="post">
    @csrf
<div class="card">
    <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
        <h4 class="card-title">Contact Page Information</h4>
        <p class="mb-0" style="font-size: 12px; color: #fff;">Changes here update the Contact Us page. Leave a field empty to use the value from General Setting.</p>
    </div>
    <div class="card-content">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 form-group">
                    <label for="contact_address">Office Address</label>
                    <textarea name="contact_address" rows="3" placeholder="House # 12, Road # 5, Mirpur DOHS, Dhaka-1216, Bangladesh" class="form-control {{$errors->has('contact_address')?'error':''}}">{{ old('contact_address', $general->contact_address ?: $general->address_one) }}</textarea>
                    @if ($errors->has('contact_address'))
                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('contact_address') }}</p>
                    @endif
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 form-group">
                    <label for="contact_phones">Phone &amp; WhatsApp Numbers <small class="text-muted">(one per line)</small></label>
                    <textarea name="contact_phones" rows="3" placeholder="+880 1712 345 678" class="form-control {{$errors->has('contact_phones')?'error':''}}">{{ old('contact_phones', $general->contact_phones ?: $general->mobile) }}</textarea>
                    @if ($errors->has('contact_phones'))
                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('contact_phones') }}</p>
                    @endif
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 form-group">
                    <label for="contact_emails">Email Addresses <small class="text-muted">(one per line)</small></label>
                    <textarea name="contact_emails" rows="3" placeholder="info@amplelab.com" class="form-control {{$errors->has('contact_emails')?'error':''}}">{{ old('contact_emails', $general->contact_emails ?: $general->email) }}</textarea>
                    @if ($errors->has('contact_emails'))
                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('contact_emails') }}</p>
                    @endif
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 form-group">
                    <label for="contact_hours">Office Hours <small class="text-muted">(one per line)</small></label>
                    <textarea name="contact_hours" rows="3" placeholder="Saturday - Thursday&#10;9:00 AM - 6:00 PM&#10;Friday: Closed" class="form-control {{$errors->has('contact_hours')?'error':''}}">{{ old('contact_hours', $general->contact_hours) }}</textarea>
                    @if ($errors->has('contact_hours'))
                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('contact_hours') }}</p>
                    @endif
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 form-group">
                    <label for="contact_map_title">Map Section Title</label>
                    <input type="text" name="contact_map_title" value="{{ old('contact_map_title', $general->contact_map_title) }}" placeholder="Find Us On Map" class="form-control {{$errors->has('contact_map_title')?'error':''}}" />
                    @if ($errors->has('contact_map_title'))
                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('contact_map_title') }}</p>
                    @endif
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 form-group">
                    <label for="contact_map_text">Map Section Description</label>
                    <textarea name="contact_map_text" rows="2" placeholder="Visit our office for product demonstration, technical discussion or any inquiries." class="form-control {{$errors->has('contact_map_text')?'error':''}}">{{ old('contact_map_text', $general->contact_map_text) }}</textarea>
                    @if ($errors->has('contact_map_text'))
                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('contact_map_text') }}</p>
                    @endif
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 form-group">
                    <label for="contact_map_embed_code">Google Map Embed Code</label>
                    <textarea name="contact_map_embed_code" rows="5" placeholder='<iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>' class="form-control {{$errors->has('contact_map_embed_code')?'error':''}}">{{ old('contact_map_embed_code', $general->contact_map_embed_url) }}</textarea>
                    <small class="text-muted">Google Maps &rarr; Share &rarr; Embed a map &rarr; copy the HTML and paste it here. Leave empty to show a map of the office address.</small>
                    @if ($errors->has('contact_map_embed_code'))
                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('contact_map_embed_code') }}</p>
                    @endif
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 form-group">
                    <label for="contact_website">Website</label>
                    <input type="text" name="contact_website" value="{{ old('contact_website', $general->website) }}" placeholder="www.amplelab.com" class="form-control {{$errors->has('contact_website')?'error':''}}" />
                    @if ($errors->has('contact_website'))
                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('contact_website') }}</p>
                    @endif
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 form-group">
                    <label for="contact_directions_url">Get Directions Link</label>
                    <input type="text" name="contact_directions_url" value="{{ old('contact_directions_url', $general->contact_directions_url) }}" placeholder="https://maps.google.com/?q=Mirpur+DOHS" class="form-control {{$errors->has('contact_directions_url')?'error':''}}" />
                    @if ($errors->has('contact_directions_url'))
                    <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('contact_directions_url') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <button type="submit" class="btn btn-primary">Save Contact Setting</button>
    </div>
</div>
</form>

@endsection
@push('js')
@endpush
