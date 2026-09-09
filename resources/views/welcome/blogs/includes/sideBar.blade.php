{{--<div class="blog-sidebar">
<div class="blogSearch">
		<h2 class="widget-title">Search Blog </h2>
		<form action="{{route('blogSearch')}}">
			<div class="input-group">
				<input type="text" name="search" value="{{request()->search}}" class="form-control" placeholder="Search" title="Search for." />
				<button type="submit" class="btn">
					<i class="fa fa-search"></i>
				</button>
			</div>
		</form>
	</div>
	
	
		<div class="widget_categories">
		<h2 class="widget-title">Recent Post </h2>
		@foreach(App\Models\Post::where('type',1)->where('status','active')->latest()->limit(5)->get() as $lPost)
		
		<div class="card mb-3" style="max-width: 540px;">
			<div class="row g-0 m-0">
				<div class="col-md-4 p-0">
				<img src="{{assetUrl($lPost->image())}}" class="img-fluid rounded-start" alt="{{$lPost->name}}">
				</div>
				<div class="col-md-8 p-0">
				<div class="card-body" style="padding:5px 10px;">
					<a href="{{route('blogView',$lPost->slug?:'no-title')}}">{{$lPost->name}}</a>
					<p style="margin:0;"><small>{{$lPost->created_at->format('d-m-Y')}}</small></p>
				</div>
				</div>
			</div>
		</div>

		@endforeach

	</div>
	
	<hr>


                        <div class="sidebar-widget mb-5 contact-widget-sidebar">
                            <div class="contact-box-overlay p-5 text-white">
                                <h4 class="text-white mb-3">Have Any Question?</h4>
                                <p class="opacity-75 mb-4">A refined apparel sourcing and production management partner for brands that value precision, quality.</p>
                                <div class="contact-info-item d-flex align-items-center mb-3">
                                    <i class="fas fa-phone-alt me-3"></i>
                                    <span>+8801681-291288</span>
                                </div>
                                <div class="contact-info-item d-flex align-items-center">
                                    <i class="fas fa-envelope me-3"></i>
                                    <span>info@needleforce.co.uk</span>
                                </div>
                            </div>
                        </div>
	

	
	
		<div class="widget_categories">
		<h2 class="widget-title">Categories </h2>
		<ul>
		@foreach(App\Models\Attribute::where('type',6)->where('status','active')->where('parent_id',null)->orderBy('name')->limit(5)->get() as $ctg)
		<li><a href="{{route('blogCategory',$ctg->slug?:'no-title')}}">{{$ctg->name}} ({{$ctg->activePosts()->count()}})</a></li>
		@endforeach
		</ul>
	</div>

	


	<div class="widget widget_meta">
		<h2 class="widget-title">Meta Tag</h2>
		<ul>
		@foreach(App\Models\Attribute::where('type',7)->where('status','active')->where('parent_id',null)->orderBy('name')->limit(5)->get() as $tag)
		<li><a href="{{route('blogTag',$tag->slug)}}"> {{$tag->name}} </a></li>
	 	@endforeach
		</ul>
	</div>

</div> --}}


   <aside class="blog-sidebar">
                        
                        <!-- Search Widget -->
                        <div class="sidebar-widget widget-search">
                            <h4 class="widget-title">Search</h4>
                            <form action="{{route('blogSearch')}}" class="sidebar-search-form">
                                <input type="text" name="search" value="{{request()->search}}" placeholder="Search keywords..." class="form-control">
                                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                        </div>

                        <!-- Categories Widget -->
                        <div class="sidebar-widget widget-categories">
                            <h4 class="widget-title">Categories</h4>
                            <ul class="category-list">
                                	@foreach(App\Models\Attribute::where('type',6)->where('status','active')->where('parent_id',null)->orderBy('name')->limit(5)->get() as $ctg)
                                <li><a  href="">{{$ctg->name}}</a></li>
                                	@endforeach
                            </ul>
                        </div>

                        <!-- Recent Posts Widget -->
                        <div class="sidebar-widget widget-recent-posts">
                            <h4 class="widget-title">Recent Posts</h4>
                            	@foreach(App\Models\Post::where('type',1)->where('status','active')->latest()->limit(5)->get() as $lPost)
                            <div class="recent-post-list">
                                
                                <a href="{{route('blogView',$lPost->slug?:'no-title')}}"" class="recent-post-item">
                                    <div class="recent-post-img">
                                        <img src="{{assetUrl($lPost->image())}}" alt="Post thumbnail">
                                    </div>
                                    <div class="recent-post-info">
                                        <h5><a href="#">{{$lPost->name}}</a></h5>
                                        <span class="recent-post-date"><i class="fa-regular fa-calendar-days"></i> {{$lPost->created_at->format('d-m-Y')}}</span>
                                    </div>
                                </a>
                                
                              
                            </div>
                            	@endforeach
                        </div>

             

                    </aside>
