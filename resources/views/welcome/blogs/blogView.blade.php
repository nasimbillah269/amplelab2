@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle($post->seo_title?:$post->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle($post->seo_title?:$post->name)}}" />
<meta name="description" property="og:description" content="{!!$post->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$post->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{assetUrl($post->image())}}" />
<meta name="url" property="og:url" content="{{route('blogView',$post->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('blogView',$post->slug?:'no-title')}}">
@endsection @push('css')
<style>
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
.btn-coral {
    background: linear-gradient(45deg, #1e315b, #e43a59);
    color: #fff !important;
    border-right: none;
}
</style>
@endpush 

@section('contents')





    <section class="contact-cover-section">
        <div class="container">
            <h1 class="contact-cover-title">Project Details</h1>
            <div class="contact-cover-breadcrumb">
                <a href="{{route('index')}}">Home</a>
                <span class="separator"><i class="fa-solid fa-chevron-right"></i></span>
                <span class="current">{{$post->name}}</span>
            </div>
        </div>
    </section>




<!-- ==========================================================================
         BLOG DETAILS MAIN SECTION
         ========================================================================== -->
    <section class="blog-details-section section-padding">
        <div class="container">
            <div class="row g-5">
                
                <!-- MAIN ARTICLE CONTENT (LEFT) -->
                <div class="col-lg-8">
                    <article class="blog-article-content">
                        <!-- Hero Image -->
                        <div class="article-hero-img-wrap">
                            <img src="{{assetUrl($post->image())}}" alt="Garment Production" class="img-fluid article-hero-img">
                            <div class="article-date-badge">
                                <span class="article-date-day">{{ $post->created_at->format('d') }}</span>
                                <span class="article-date-month">{{ $post->created_at->format('M') }}</span>
                            </div>
                        </div>

                        <!-- Article Header -->
                        <div class="article-header">
                            <div class="article-meta">
                                <span><i class="fa-solid fa-folder-open"></i> Manufacturing</span>
                                <span><i class="fa-solid fa-user"></i> Admin</span>
                                <span><i class="fa-solid fa-comments"></i> 3 Comments</span>
                            </div>
                            <h2 class="article-main-title">{{$post->name}}</h2>
                        </div>

                        <!-- Article Body -->
                        <div class="article-body">
                           {!! $post->description !!}
                          
                        </div>

                        <!-- Article Footer (Tags & Share) -->
                        <div class="article-footer d-flex justify-content-between align-items-center flex-wrap">
                           
                            <div class="article-share">
                                <span class="share-title">Share:</span>
                                <a href="#" class="share-fb"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#" class="share-tw"><i class="fa-brands fa-twitter"></i></a>
                                <a href="#" class="share-in"><i class="fa-brands fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </article>

                    <!-- Comments Section -->
                    {{--<div class="article-comments-area mt-5">
                        <h3 class="comments-title">Comments (3)</h3>
                        
                        <div class="comment-list">
                           
                            <div class="comment-item">
                                <div class="comment-avatar">
                                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=f2424b&color=fff" alt="User Avatar">
                                </div>
                                <div class="comment-content">
                                    <div class="comment-header">
                                        <h5>John Doe</h5>
                                        <span class="comment-date">16 Aug, 2026</span>
                                    </div>
                                    <p>This is exactly the kind of insight we need. Sourcing sustainable materials has been a huge challenge for our retail brand. Glad to see Nuvesta leading the charge!</p>
                                    <a href="#" class="comment-reply-btn"><i class="fa-solid fa-reply"></i> Reply</a>
                                </div>
                            </div>
                    
                            <div class="comment-item reply-item">
                                <div class="comment-avatar">
                                    <img src="https://ui-avatars.com/api/?name=Admin&background=0f2957&color=fff" alt="User Avatar">
                                </div>
                                <div class="comment-content">
                                    <div class="comment-header">
                                        <h5>Admin</h5>
                                        <span class="comment-date">17 Aug, 2026</span>
                                    </div>
                                    <p>Thank you, John! We'd be happy to discuss how we can help your brand transition to more sustainable materials.</p>
                                    <a href="#" class="comment-reply-btn"><i class="fa-solid fa-reply"></i> Reply</a>
                                </div>
                            </div>
                        </div>

                      
                        <div class="comment-form-wrap mt-5">
                            <h3 class="comments-title">Leave a Reply</h3>
                            <p class="comment-note">Your email address will not be published. Required fields are marked *</p>
                            <form action="#" class="comment-form row g-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Your Name *" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" placeholder="Your Email *" required>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" rows="5" placeholder="Write your comment here..." required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-coral mt-2">Post Comment</button>
                                </div>
                            </form>
                        </div>
                    </div>--}}
                </div>

      
                <div class="col-lg-4">
                    	@include(welcomeTheme().'blogs.includes.sideBar')
                 
                </div>
            </div>
        </div>
    </section>











@endsection @push('js') @endpush