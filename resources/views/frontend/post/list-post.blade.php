@extends('frontend.layout1.master')

@section('content')
    <div style="padding-top: 0;padding-bottom: 40px" class="container-fluid contentpage">
        <div class="container">
            <div style="padding-top: 40px !important;padding-bottom: 0 !important" class="row breadcrumb">
                <nav>
                    <ol class="cd-breadcrumb custom-separator">
                        <li><a href="{{ route('home') }}">Trang chủ</a></li>
                        @if (isset($categoriespost) && $categoriespost != null)
                            <li><a href="{{ route('allpost') }}">Bài viết</a></li>
                            <li class="current"><em>Danh mục: {{ $categoriespost->category_name }}</em></li>
                        @elseif (isset($author) && $author != null)
                            <li><a href="{{ route('allpost') }}">Bài viết</a></li>
                            <li class="current"><em>Tác giả: {{ $author->name }}</em></li>
                        @else
                            <li class="current"><em>Bài viết</em></li>
                        @endif
                    </ol>
                </nav>
            </div>
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-4 blog-image-larger">
                        <a class="img-blog" href="{{ route('detailpost', ['slug'=>$post->slug->slug]) }}">
                            <img src="{{ $post->featured_image }}" alt="">
                        </a>

                        <div class="text-blog-post">
                            <div class="header-single-blog">
                                <div class="post-category">
                                    @if ($post->type == 1)
                                        <a href="{{ route('detailcategory', ['slug'=>$post->category[0]->slug]) }}">{{ Str::limit($post->category[0]->category_name, 15) }}</a>
                                    @else
                                        <a href="">Địa điểm</a>
                                    @endif
                                </div>
                                <div class="post-author">
                                    <span>By</span>
                                    <a href="{{ route('detailauthor', ['username'=>$post->user->username]) }}">{{ Str::limit($post->user->name, 15) }}</a>
                                </div>
                            </div>

                            <div class="title-single-blog">
                                <a href="{{ route('detailpost', ['slug'=>$post->slug->slug]) }}">{{ Str::limit($post->title, 70) }}</a>
                            </div>

                            <div class="footer-single-blog">
                                <div style="width: 50%" class="post-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    <a class="date" href="">{{ $post->created_at->format('h/m/Y') }}</a>
                                </div>
                                <div style="width: 50%" class="post-action">
                                    <span style="float: right;padding: 4px 0;">
                                        <a href=""><i style="padding-right: 10px" class="far fa-bookmark"></i></a>
                                        <a href=""><i class="far fa-heart"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{--  {!! $posts->links() !!}  --}}
        </div>
    </div>
@endsection