
 
  {{--<article class="blog-card">
                        <div class="blog-img-wrap">
                            <img src="{{assetUrl($post->image())}}" alt="Garment Production" class="img-fluid blog-img">
                            <div class="blog-date-badge">
                                <span class="blog-date-day">{{ $post->created_at->format('d') }}</span>
                                <span class="blog-date-month">{{ $post->created_at->format('M') }}</span>
                            </div>
                        </div>
                        <div class="blog-card-body">
                            <div class="blog-meta">
                                <span class="blog-category"><i class="fa-solid fa-folder-open"></i> Manufacturing</span>
                                <span class="blog-author"><i class="fa-solid fa-user"></i> Admin</span>
                            </div>
                            <h3 class="blog-title"><a href="{{route('blogView',$post->slug?:'no-title')}}">{{$post->name}}</a></h3>
                            <p class="blog-excerpt">{{$post->short_description}}</p>
                            <a href="{{route('blogView',$post->slug?:'no-title')}}" class="blog-read-more">Read More <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </article>--}}
                    
                      <article class="project-card">
            <span class="stamp stamp--completed">Completed</span>
            <a href="{{route('blogView',$post->slug?:'no-title')}}" class="card-main-link">
              <div class="card-image-wrapper">
                <img src="{{assetUrl($post->image())}}" alt="Concrete &amp; Materials Testing Lab" class="card-image">
              </div>
              <div class="card-content">
                <p class="card-meta"> @foreach($post->postCategories as $ctg) <span>>{{$ctg->name}}</span>      @endforeach &middot; February 2026</p>
                <h2 class="card-title">{{$post->name}}</h2>
                <p class="card-desc">
                  {{$post->short_description}}
                </p>
                <span class="card-link">View project details</span>
              </div>
            </a>
          </article>