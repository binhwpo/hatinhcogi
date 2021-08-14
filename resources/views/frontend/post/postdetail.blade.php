@extends('frontend.layout1.master')

@section('content')
    <div style="padding-top: 0;padding-bottom: 40px" class="container-fluid contentpage">
        <div class="container">
            <div style="padding-top: 40px !important;padding-bottom: 0 !important" class="row breadcrumb">
                <nav>
                    <ol class="cd-breadcrumb custom-separator">
                        <li><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li><a href="{{ route('allpost') }}">Bài viết</a></li>
                        @if ($post->type == 1)
                            <li class="current"><em>{{ $post->category[0]->category_name }}</em></li>
                        @else
                            <li class="current"><em>{{ $post->place->place_name }}</em></li>
                        @endif
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-9 blog-image-larger">
                    <a class="img-blog details-thum" href="{{ route('detailpost', ['slug'=>$post->slug->slug]) }}">
                        <img src="{{ $post->featured_image }}" alt="">
                    </a>

                    <div class="text-blog-post">
                        <div class="row header-single-blog">
                            <div style="margin: 0 0" class="post-category col-md-3">
                                @if ($post->type == 1)
                                    <a href="{{ route('detailcategory', ['slug'=>$post->category[0]->slug]) }}">{{ Str::limit($post->category[0]->category_name, 25) }}</a>
                                @else
                                    <a href="">Địa điểm</a>
                                @endif
                            </div>
                            <div class="post-author col-md-3">
                                <span>By</span>
                                <a href="{{ route('detailauthor', ['username'=>$post->user->username]) }}">{{ Str::limit($post->user->name, 25) }}</a>
                            </div>

                            <div style="text-align: center" class="post-date col-md-3">
                                <i class="fas fa-calendar-alt"></i>
                                <a class="date" href="">{{ $post->created_at->format('h/m/Y') }}</a>
                            </div>

                            <div class="post-action col-md-3">
                                <span style="float: right;padding: 4px 0;">
                                    <a href=""><i style="padding-right: 10px" class="far fa-bookmark"></i></a>
                                    <a href=""><i class="far fa-heart"></i></a>
                                </span>
                            </div>
                        </div>

                        <div style="height: auto !important" class="title-single-blog">
                            <a style="font-size: 24px" href="{{ route('detailpost', ['slug'=>$post->slug->slug]) }}">{{ $post->title }}</a>
                        </div>

                        <div style="text-align: justify" class="content-blog">
                            {!! html_entity_decode($post->contents) !!}
                        </div>

                        <div class="footer-detail-blog">
                            <div class="footer-tag">
                                <span>Tags:</span>
                                <ul>
                                    @foreach ($post->tag as $item)
                                        <li><a href="">{{ $item->tag_name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="footer-social list-item-social">
                                <a class="item-social" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="item-social" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="item-social" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="item-social" href=""><i class="fas fa-laptop"></i></a>
                            </div>
                        </div>

                        <section style="margin-top: 40px;border-radius: 8px;" class="content-item" id="comments">
                            <div style="padding: 0 40px;" class="container">     
                                <form>
                                    <h3 class="header">Bình luận</h3>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-2 hidden-xs">
                                                @if (Auth::check())
                                                    <img class="img-responsive" src="{{ Auth::user()->img_profile }}" alt="">
                                                @else
                                                    <img class="img-responsive" src="assets/images/web/default-avatar-men.png" alt="">
                                                @endif
                                            </div>
                                            <div class="form-group col-md-10">
                                                <textarea class="form-control" id="message" placeholder="Nhập bình luận" required=""></textarea>
                                            </div>
                                        </div>  	
                                    </fieldset>
                                    <button type="submit" class="btn btn-normal pull-right">Bình luận</button>
                                </form>
                                
                                <h3 class="commentlist">4 Bình luận</h3>
                                
                                <!-- COMMENT 1 - START -->
                                <div class="media">
                                    <a class="pull-left" href="#"><img class="media-object" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt=""></a>
                                    <div class="media-body">
                                        <h4 class="media-heading">John Doe</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        <div style="display: flex;position: relative;" class="footer-comment">
                                            <div class="date-comment">
                                                <span><i class="fa fa-calendar"></i>27/02/2014</span>
                                            </div>
                                            <div class="react-comment">
                                                <span>14<i s class="fas fa-thumbs-up"></i></span>
                                                <span>13<i class="fa fa-thumbs-down"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- COMMENT 1 - END -->
                            </div>
                        </section>

                        <div style="padding: 40px 0">
                            <div class="header">
                                <h3 class="header">Bài viết liên quan</h3>
                            </div>
                    
                            <div style="position: relative;" class="row related">
                                @foreach ($post->relatedpost(5) as $post)
                                    <div style="margin-top: 20px" class="col-md-6 blog-image-larger">
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
                                                <a href="{{ route('detailpost', ['slug'=>$post->slug->slug]) }}">{{ Str::limit($post->title, 80) }}</a>
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
                        </div>
                    </div>
                </div>

                <div class="col-md-3 right-column">
                    <div class="follow-author">
                        <div class="content-follow">
                            <div style="text-align: center;" class="img-author">
                                @if ($post->user->img_profile != null)
                                    <img src="{{ $post->user->img_profile }}" alt="">
                                @elseif($post->user->img_profile == null)
                                    <img src="assets/images/web/default-avatar-men.png" alt="">
                                {{-- @else
                                    <img src="assets/images/web/default-avatar-women.png" alt=""> --}}
                                @endif
                            </div>

                            <div class="author-name">
                                <a href="{{ route('detailauthor', ['username'=>$post->user->username]) }}">{{ Str::limit($post->user->name, 20) }}</a>
                                <span class="author-position">Biên tập viên</span>
                                <span class="author-description">{{ $post ->user->description }}</span>
                            </div>

                            <div class="list-item-social">
                                <a class="item-social" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="item-social" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="item-social" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="item-social" href=""><i class="fas fa-laptop"></i></a>
                            </div>

                            <div class="button-box">
                                <a class="btn" href="">View Profile <i class="fal fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="related-post">
                        <span style="font-size: 20px;font-weight: 500;">Mới nhất</span>
                        <div class="aarelated-post">
                            @php
                                $check = 0;
                            @endphp
                            @foreach ($postnew as $post)                         
                                @php
                                    $check++;
                                    if ($check == 1){
                                        echo '<li>';
                                    }
                                @endphp
                                <div class="row blog-image-small">
                                    <a style="padding-right: 0" class="col-md-4 img-blog" href="{{ route('detailpost', ['slug'=>$post->slug->slug]) }}">
                                        <img src="{{ $post->featured_image }}" alt="">
                                    </a>
    
                                    <div class="col-md-8 text-blog-post">                
                                        <div class="title-single-blog">
                                            <a href="{{ route('detailpost', ['slug'=>$post->slug->slug]) }}">{{ Str::limit($post->title, 28) }}</a>
                                        </div>
                
                                        <div class="footer-single-blog">
                                            <div style="width: 100%" class="post-date">
                                                <i class="fas fa-calendar-alt"></i>
                                                <a class="date" href="">{{ $post->created_at->format('h/m/Y') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    if ($check == 3){
                                        $check = 0;
                                        echo '</li>';
                                    }
                                @endphp
                            @endforeach
                        </div>
                    </div>

                    <div class="follow-me">
                        <span>Theo dõi chúng tôi</span>
                        <div style="margin-top: 30px;margin-right: -7px;margin-left: -7px;" class="row">
                            <div class="col-md-4">
                                <div class="item-follow it-facebook">
                                    <a href="">
                                        <i class="fab fa-facebook"></i>
                                        5,685K
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="item-follow it-youtube">
                                    <a href="">
                                        <i class="fab fa-youtube"></i>
                                        5,685K
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="item-follow it-instagram">
                                    <a href="">
                                        <i class="fab fa-instagram"></i>
                                        5,682K
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.related').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            prevArrow: '<button type="button" style="top: -36px;left: 750px;color: #ddd" class="aaa slick-prev"><i  class="fal fa-long-arrow-left"></i></button>',
            nextArrow: '<button type="button" style="top: -36px;right: 20px;color: #ddd" class="aaa slick-next"><i  class="fal fa-long-arrow-right"></i></button>',
        });

        $('.aarelated-post').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: '<button type="button" style="top: -33px;left: 160px;color: #ddd;padding: 5px 10px 4px 10px;" class="aaa slick-prev"><i  class="fal fa-long-arrow-left"></i></button>',
            nextArrow: '<button type="button" style="top: -33px;right: 0px;color: #ddd;padding: 5px 10px 4px 10px;" class="aaa slick-next"><i  class="fal fa-long-arrow-right"></i></button>',
        });
    </script>
@endsection