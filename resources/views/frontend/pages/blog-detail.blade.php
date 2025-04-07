@extends('frontend.layout.main')
@section('title', $blog->title)
@section('content')
    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Blog Detail</h2>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>


    <section class="blog-list grid-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-wrapper">
                        <div class="blog-post-wrap">
                            <div class="blog-post-upper">
                                <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}">
                            </div>
                            <div class="blog-post-detail">
                                <div class="blog-content blog-content-1">
                                    <div class="blog-date">
                                        <p><i class="fa fa-clock-o"></i> Posted On :
                                            {{ \Carbon\Carbon::parse($blog->created_at)->format('d M, Y') }}</p>
                                    </div>
                                    <h3>{{ $blog->title }}</h3>
                                    <div>
                                        {!! $blog->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="sidebar-sticky" class="col-lg-4">
                    <aside class="detail-sidebar sidebar-wrapper">
                        <div class="item-sidebar">
                            <div class="recent-post clearfix sidebar-item">
                                <div class="detail-title">
                                    <h3>Recent Posts</h3>
                                </div>
                                @foreach ($recentBlogs as $recentBlog)
                                    <div class="recent-item">
                                        <div class="recent-image">
                                            <img src="{{ $recentBlog->image_url }}" alt="{{ $recentBlog->title }}">
                                        </div>
                                        <div class="recent-content">
                                            <h4><a
                                                    href="{{ route('blog.details', $recentBlog->id) }}">{{ $recentBlog->title }}</a>
                                            </h4>
                                            <div class="author-detail">
                                                <p>{{ Str::limit(strip_tags($recentBlog->description), 50) }}</p>
                                                <p><i class="fa fa-clock-o"></i>
                                                    {{ \Carbon\Carbon::parse($recentBlog->created_at)->format('d M, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
