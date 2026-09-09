@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$page->seo_title?:websiteTitle($page->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$page->seo_title?:websiteTitle($page->name)}}" />
        <meta name="description" property="og:description" content="{!!$page->seo_description?:general()->meta_description!!}" />
        <meta name="keywords" content="{{$page->seo_keyword?:general()->meta_keyword}}" />
        <meta name="image" property="og:image" content="{{assetUrl($page->image())}}" />
        <meta name="url" property="og:url" content="{{route('pageView',$page->slug?:'no-title')}}" />
        <link rel="canonical" href="{{route('pageView',$page->slug?:'no-title')}}">
@endsection @push('css')
<style>
	.image a img {
    transition: 0.5s all;
    width: 100%;
}
.blogCompany {
    padding: 100px 0;
}
.blog-content .btn {
    border: 1px solid #0e580b;
    color: #1b5f17;
    background: unset;
}
.blog-sidebar .widget-title {
    color: #10570b;
}
.widget_categories .card-body a {
    color: #10570b;
}
.blog-sidebar {
    background-color: unset;
}





/* =========================================================
   Ample Lab — Projects Page
   ========================================================= */

/* ---------- Tokens ---------- */
:root {
  --color-bg: #F5F6F1;
  --color-surface: #FFFFFF;
  --color-ink: #1C2B2A;
  --color-ink-soft: #55645F;
  --color-line: #DBE1D6;

  --color-primary: #2F7A55;
  --color-primary-dark: #1F5A3D;
  --color-primary-tint: #E7F1EA;

  --color-accent: #B85C28;
  --color-accent-tint: #F4E7DA;

  --font-display: "Space Grotesk", "Segoe UI", sans-serif;
  --font-body: "IBM Plex Sans", "Segoe UI", sans-serif;
  --font-mono: "IBM Plex Mono", "Courier New", monospace;

  --radius-sm: 4px;
  --radius-md: 8px;

  --space-xs: 0.5rem;
  --space-sm: 1rem;
  --space-md: 1.75rem;
  --space-lg: 3rem;
  --space-xl: 4.5rem;

  --max-width: 1200px;
}

/* ---------- Reset ---------- */

h1, h2, h3 {
  font-family: var(--font-display);
  color: var(--color-ink);
  margin: 0;
}

p {
  margin: 0;
}

ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

dl, dd {
  margin: 0;
}

a {
  color: var(--color-primary-dark);
}

button {
  font-family: var(--font-body);
}


/* ---------- Intro ---------- */
.intro {
  display: flex;
  flex-direction: column;
  gap: var(--space-sm);
  max-width: 46rem;
}

.eyebrow {
  font-family: var(--font-mono);
  font-size: 0.75rem;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--color-primary-dark);
}

.intro h1 {
  font-size: clamp(2rem, 4vw, 2.75rem);
  font-weight: 600;
  line-height: 1.15;
}

.intro-text {
  color: var(--color-ink-soft);
  font-size: 1.05rem;
  max-width: 40rem;
}

.intro-stats {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-md);
  margin-top: var(--space-xs);
  padding-top: var(--space-md);
  border-top: 1px solid var(--color-line);
}

.stat {
  display: flex;
  flex-direction: column-reverse;
  gap: 0.15rem;
}

.stat dt {
  font-family: var(--font-mono);
  font-size: 0.72rem;
  letter-spacing: 0.04em;
  color: var(--color-ink-soft);
}

.stat dd {
  font-family: var(--font-display);
  font-size: 1.6rem;
  font-weight: 600;
  color: var(--color-primary-dark);
}

/* ---------- Filter bar ---------- */
.filter-section {
  border: 1px solid var(--color-line);
  border-radius: var(--radius-md);
  background-color: var(--color-surface);
  padding: var(--space-md);
}

.filter-bar {
  display: grid;
  grid-template-columns: 1fr;
  gap: var(--space-sm);
}

.field {
  display: flex;
  flex-direction: column;
  gap: 0.35rem;
}

.field label {
  font-family: var(--font-mono);
  font-size: 0.72rem;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  color: var(--color-ink-soft);
}

.field input,
.field select {
  font-family: var(--font-body);
  font-size: 0.95rem;
  color: var(--color-ink);
  background-color: var(--color-bg);
  border: 1px solid var(--color-line);
  border-radius: var(--radius-sm);
  padding: 0.6rem 0.75rem;
}

.field input:focus,
.field select:focus {
  outline: 2px solid var(--color-primary);
  outline-offset: 1px;
}

/* ---------- Results ---------- */
.results-section {
  display: flex;
  flex-direction: column;
  gap: var(--space-md);
  padding: 0px 0px;
}

.project-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: var(--space-md);
}

/* ---------- Project card ---------- */
.project-card {
  position: relative;
  height: 100%;
  display: flex;
  flex-direction: column;
  background-color: var(--color-surface);
  border: 1px solid var(--color-line);
  border-radius: var(--radius-md);
  overflow: hidden;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.project-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
}

.card-main-link {
  display: flex;
  flex-direction: column;
  height: 100%;
  padding: 0 0 var(--space-md) 0;
  text-decoration: none;
  color: inherit;
}

.card-image-wrapper {
  width: 100%;
  height: 200px;
  overflow: hidden;
  background-color: var(--color-bg);
}

.card-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.card-content {
  display: flex;
  flex-direction: column;
  flex-grow: 1;
  padding: 0 var(--space-md);
}

/* Signature element: inspection-stamp status badge */
.stamp {
  position: absolute;
  top: var(--space-sm);
  right: var(--space-sm);
  font-family: var(--font-mono);
  font-size: 0.68rem;
  font-weight: 500;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  padding: 0.3rem 0.6rem;
  border: 1.5px dashed currentColor;
  border-radius: 999px;
  transform: rotate(-6deg);
  z-index: 2;
  pointer-events: none;
}

.stamp--completed {
  color: var(--color-primary-dark);
  background-color: var(--color-primary-tint);
}

.stamp--ongoing {
  color: var(--color-accent);
  background-color: var(--color-accent-tint);
}

.card-meta {
  font-family: var(--font-mono);
  font-size: 0.75rem;
  color: var(--color-ink-soft);
  margin-top: var(--space-xs);
}

.card-title {
  font-size: 1.15rem;
  font-weight: 600;
  line-height: 1.3;
  margin-top: 0.35rem;
}

/* Full display without truncation/limits */
.card-desc {
  color: var(--color-ink-soft);
  font-size: 0.95rem;
  margin-top: 0.35rem;
  height: 3em; /* Limits to roughly 2 lines based on line-height */
  overflow: hidden;
}

.card-link {
  margin-top: auto;
  font-weight: 600;
  font-size: 0.9rem;
  color: #ffffff;
  background-color: #0d3d33;
  padding: 10px 10px;
  border-radius: 7px;
  text-align: center;
  margin-top: 20px;
}

.project-card:hover .card-link {
  text-decoration: none;
  background-color: red;
}

/* ---------- Grid footer ---------- */
.grid-footer {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: var(--space-xs);
  padding: 10px 0px;
}

.load-more {
  font-family: var(--font-mono);
  font-size: 0.85rem;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  color: var(--color-primary-dark);
  background-color: var(--color-surface);
  border: 1.5px solid var(--color-primary-dark);
  border-radius: var(--radius-sm);
  padding: 0.65rem 1.5rem;
  cursor: pointer;
}

.load-more:hover,
.load-more:focus-visible {
  background-color: var(--color-primary-dark);
  color: var(--color-surface);
}

/* =========================================================
   Responsive breakpoints
   ========================================================= */

/* Tablet */
@media (min-width: 600px) {
  .filter-bar {
    grid-template-columns: 1fr 1fr;
  }

  .field--search {
    grid-column: 1 / -1;
  }

  .project-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

/* Desktop */
@media (min-width: 1024px) {
  .filter-bar {
    grid-template-columns: 2fr 1fr 1fr 1fr;
    align-items: end;
  }

  .field--search {
    grid-column: auto;
  }

  .project-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}















</style>
@endpush 

@section('contents')

{{--<div class="breadcrumb-area"
@if($page->bannerFile)
style="background-image:url({{assetUrl($page->banner())}});background-repeat: no-repeat;
    background-size: cover;padding: 50px 0;"
@endif
>
    <div class="container">
        <div class="title">
            <h1>{{$page->name}}</h1>
            <ul>
                <li><a href="{{route('index')}}">Home</a></li>
                <li>{{$page->name}}</li>
            </ul>
        </div>
    </div>
</div>--}}

<!-- ===================== Breadcrumb ===================== -->
<div class="breadcrumb-strip">
  <div class="container">
    <a href="{{ route('index') }}">Home</a><span class="sep">&gt;</span><span class="text-muted">{{ $page->name }}</span>
  </div>
</div>
    
    
    
        <section class="blog-grid-section section-padding">
        <div class="container">
   
            
            <div class="row g-4">
                <!-- Blog Post 1 -->
                @foreach($posts as $post)
                <div class="col-lg-4 col-md-6">
                     @include(welcomeTheme().'blogs.includes.blogGrid')
                   
                </div>
                 @endforeach

            </div>

            	<!-- pagination -->
			{{$posts->links(welcomeTheme().'blogs.pagination')}}

            <!-- Pagination -->
           {{-- <div class="row mt-5">
                <div class="col-12">
                    <nav aria-label="Blog pagination">
                        <ul class="pagination justify-content-center blog-pagination">
                            <li class="page-item disabled"><a class="page-link" href="#"><i class="fa-solid fa-chevron-left"></i></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>--}}
        </div>
    </section>



{{--<div class="blogCompany">
    <div class="container">
		<div class="row">
		<div class="col-md-12">
            <div class="row">
                @foreach($posts as $post)
                <div class="col-md-4">
                  
                </div>
                @endforeach
            </div>
			<!-- pagination -->
			{{$posts->links(welcomeTheme().'blogs.pagination')}}
		</div>
	<div class="col-md-4">
			@include(welcomeTheme().'blogs.includes.sideBar')
		</div>
		</div>
	</div>
</div>--}}




@endsection @push('js') @endpush