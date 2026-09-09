@php
  /* Front page hero slider – data entered from Admin ▸ Sliders ("Front Page Slider" location).
     Each slide is an Attribute row: name, description, seo_title = Button Text,
     seo_description = Button Link, image() = desktop (1500x550), banner() = mobile (600x800). */
  $homeSlider = slider('Front Page Slider');
  $homeSlides = $homeSlider ? $homeSlider->subSliders : collect();

  /* Right side contact card values come from Admin ▸ General Settings (see heroContactCard) */
  $g = general();
@endphp

<!-- ===== Hero ===== -->
@if($homeSlides->count())

<style>
  @foreach($homeSlides as $slide)
    @if($slide->imageFile)
    #hero-slide-{{ $slide->id }}{ background-image:url('{{ assetUrl($slide->image()) }}'); }
    @endif
    @if($slide->bannerFile)
    @media (max-width:767.98px){ #hero-slide-{{ $slide->id }}{ background-image:url('{{ assetUrl($slide->banner()) }}'); } }
    @endif
  @endforeach
</style>

<div id="heroCarousel" class="carousel slide carousel-fade hero-carousel" data-bs-ride="carousel" data-bs-interval="6000">
  <div class="carousel-inner">
    @foreach($homeSlides as $i => $slide)
    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
      <section class="hero" id="hero-slide-{{ $slide->id }}">
        <div class="container">
          <div class="row align-items-center g-4">
            <div class="col-lg-5">
              <h1>{{ $slide->name }}</h1>
              @if($slide->description)
              <p class="lead-text mt-3">{!! nl2br(e($slide->description)) !!}</p>
              @endif
              <div class="d-flex gap-3 mt-4 flex-wrap">
                <a href="{{ route('pageView', 'products-all') }}" class="btn-al-primary">Explore Products <i class="fa-solid fa-arrow-right ms-1"></i></a>
                @if($slide->seo_title)
                <a href="{{ $slide->seo_description ?: '#' }}" class="btn-al-outline">{{ $slide->seo_title }} <i class="fa-solid fa-file-lines ms-1"></i></a>
                @endif
              </div>
            </div>
            <div class="col-lg-7">
              <div class="hero-image-wrap">
                @include(general()->theme.'.layouts.includes.heroContactCard')
              </div>
            </div>
          </div>

          @include(general()->theme.'.layouts.includes.heroFeatures')
        </div>
      </section>
    </div>
    @endforeach
  </div>

  @if($homeSlides->count() > 1)
  <div class="carousel-indicators">
    @foreach($homeSlides as $i => $slide)
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}"
            class="{{ $i === 0 ? 'active' : '' }}" @if($i === 0) aria-current="true" @endif
            aria-label="Slide {{ $i + 1 }}"></button>
    @endforeach
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
  @endif
</div>

@else

{{-- Fallback: no slide added in admin yet --}}
<section class="hero" style="background-image: url('{{ assetUrl(assetLink().'/images/ample/hero-bg.webp') }}');">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-lg-5">
        <h1>Complete Laboratory <span class="line-accent">Solutions</span> for Education, Research &amp; Industry</h1>
        <p class="lead-text mt-3">{{ $g->subtitle ?: 'Add a slide from Admin ▸ Sliders to control this section.' }}</p>
        <div class="d-flex gap-3 mt-4 flex-wrap">
          <a href="{{ route('pageView', 'products-all') }}" class="btn-al-primary">Explore Products <i class="fa-solid fa-arrow-right ms-1"></i></a>
          <a href="{{ route('pageView', 'request-quotation') }}" class="btn-al-outline">Request a Quotation <i class="fa-solid fa-file-lines ms-1"></i></a>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="hero-image-wrap">
          @include(general()->theme.'.layouts.includes.heroContactCard')
        </div>
      </div>
    </div>

    @include(general()->theme.'.layouts.includes.heroFeatures')
  </div>
</section>

@endif
