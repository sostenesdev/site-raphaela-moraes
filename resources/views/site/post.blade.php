@extends('layouts.site.master')
@section('title', 'Início')
@section('content')
<div class="col-12 col-lg-9">
    <h2>{{ $post->title }}</h2>
    @if($post->image != null)
        <img src="{{ route('admin.file.get_image',['name' => $post->image]) }}"
            alt="Thumbnail do post {{ $post->title }}">
    @endif
    <!-- Single Blog Area  -->
    <div class="single-blog-area blog-style-2 mb-50">
        <!-- Blog Content -->
        <div class="single-blog-content">
            <div class="line">
            </div>
            <a href="#" class="post-tag">{{$post->category()->name}}</a>
            <h4><a href="#" class="post-headline mb-0"></a></h4>
            <div class="post-meta mb-50">
                {{-- <p>By <a href="#">james smith</a></p>
                                <p>3 comments</p> --}}
            </div>
              <div class="row">
        <div class="col col-12 text-justify text-light">
            {!!$post->content!!}
        </div>
    </div>
        </div>
    </div>
  
    <!-- About Author -->
    {{-- <div class="blog-post-author mt-100 d-flex">
                        <div class="author-thumbnail">
                            <img src="img/bg-img/b6.jpg" alt="">
                        </div>
                        <div class="author-info">
                            <div class="line"></div>
                            <span class="author-role">Author</span>
                            <h4><a href="#" class="author-name">James Morrison</a></h4>
                            <p>Curabitur venenatis efficitur lorem sed tempor. Integer aliquet tempor cursus. Nullam vestibulum convallis risus vel condimentum. Nullam auctor lorem in libero luctus, vel volutpat quam tincidunt. Nullam vestibulum convallis risus vel condimentum. Nullam auctor lorem in libero.</p>
                        </div>
                    </div> --}}

    <!-- Comment Area Start -->
    {{-- <div class="comment_area clearfix mt-70">
                        <h5 class="title">Comments</h5>

                        <ol>
                            <!-- Single Comment Area -->
                            <li class="single_comment_area">
                                <!-- Comment Content -->
                                <div class="comment-content d-flex">
                                    <!-- Comment Author -->
                                    <div class="comment-author">
                                        <img src="img/bg-img/b7.jpg" alt="author">
                                    </div>
                                    <!-- Comment Meta -->
                                    <div class="comment-meta">
                                        <a href="#" class="post-date">March 12</a>
                                        <p><a href="#" class="post-author">William James</a></p>
                                        <p>Efficitur lorem sed tempor. Integer aliquet tempor cursus. Nullam vestibulum convallis risus vel condimentum. Nullam auctor lorem in libero luctus, vel volutpat quam tincidunt.</p>
                                        <a href="#" class="comment-reply">Reply</a>
                                    </div>
                                </div>
                                <ol class="children">
                                    <li class="single_comment_area">
                                        <!-- Comment Content -->
                                        <div class="comment-content d-flex">
                                            <!-- Comment Author -->
                                            <div class="comment-author">
                                                <img src="img/bg-img/b7.jpg" alt="author">
                                            </div>
                                            <!-- Comment Meta -->
                                            <div class="comment-meta">
                                                <a href="#" class="post-date">March 12</a>
                                                <p><a href="#" class="post-author">William James</a></p>
                                                <p>Efficitur lorem sed tempor. Integer aliquet tempor cursus. Nullam vestibulum convallis risus vel condimentum. Nullam auctor lorem in libero luctus, vel volutpat quam tincidunt.</p>
                                                <a href="#" class="comment-reply">Reply</a>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                            </li>

                            <!-- Single Comment Area -->
                            <li class="single_comment_area">
                                <!-- Comment Content -->
                                <div class="comment-content d-flex">
                                    <!-- Comment Author -->
                                    <div class="comment-author">
                                        <img src="img/bg-img/b7.jpg" alt="author">
                                    </div>
                                    <!-- Comment Meta -->
                                    <div class="comment-meta">
                                        <a href="#" class="post-date">March 12</a>
                                        <p><a href="#" class="post-author">William James</a></p>
                                        <p>Efficitur lorem sed tempor. Integer aliquet tempor cursus. Nullam vestibulum convallis risus vel condimentum. Nullam auctor lorem in libero luctus, vel volutpat quam tincidunt.</p>
                                        <a href="#" class="comment-reply">Reply</a>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </div>

                    <div class="post-a-comment-area mt-70">
                        <h5>Leave a reply</h5>
                        <!-- Reply Form -->
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="group">
                                        <input type="text" name="name" id="name" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Name</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="group">
                                        <input type="email" name="email" id="email" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group">
                                        <input type="text" name="subject" id="subject" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group">
                                        <textarea name="message" id="message" required></textarea>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Comment</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn original-btn">Reply</button>
                                </div>
                            </div>
                        </form>
                    </div> --}}
</div>
@endsection
