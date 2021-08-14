@extends('frontend.layout1.master')

@section('content')
    <div class="container-fluid content-category">
        <div class="container main-category">
            <div class="row">
                <div class="col-md-3 left-comlumn">
                    @foreach ($category_post as $item)
                        <a class="item-category-left" href="{{ route('detailcategory', ['slug'=>$item->slug]) }}">

                            @if ($item->icon != null)
                                <img style="display: inherit" src="{{ $item->icon }}" alt="">
                            @else
                                <img style="display: inherit" src="assets/images/technology.jpg" alt="">
                            @endif

                            <div class="item-hover">
                                <span>{{ $item->category_name }}</span>
                                <i class="fal fa-long-arrow-right"></i>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="col-md-6 middle-column">
                    <a class="" href="bai-viet">
                        <img style="display: inherit" src="https://scontent.fhph1-2.fna.fbcdn.net/v/t1.6435-9/218401078_4094100550707560_8855276478496515003_n.jpg?_nc_cat=105&ccb=1-3&_nc_sid=8bfeb9&_nc_ohc=7zWcRzDlCmYAX-k4pSk&tn=avcAbFHp6Gmjvp7J&_nc_ht=scontent.fhph1-2.fna&oh=c93c414e9445a5a62b2da06e812a3550&oe=61279867" alt="">
                    </a>
                </div>
                <div class="col-md-3 right-column">
                    @foreach ($post_hot as $item)
                        <div class="single-blog-post">
                            <div class="header-single-blog">
                                <div class="post-category">
                                    <a href="{{ route('detailcategory', ['slug'=>$item->category[0]->slug]) }}">{{ Str::limit($item->category[0]->category_name, 7) }}</a>
                                </div>
                                <div class="post-author">
                                    <span>By</span>
                                    <a href="{{ route('detailauthor', ['username'=>$item->user->username]) }}">{{ Str::limit($item->user->name, 11) }}</a>
                                </div>
                            </div>

                            <div class="title-single-blog">
                                <a href="{{ route('detailpost', ['slug'=>$item->slug->slug]) }}">{{ Str::limit($item->title, 37) }}</a>
                            </div>

                            <div class="content-single-blog">
                                <span>{!! html_entity_decode(Str::limit($item->contents, 100)) !!}</span>
                            </div>

                            <div class="footer-single-blog">
                                <div style="width: 50%;" class="post-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    <a class="date" href="">{{ $item->created_at->format('h/m/Y') }}</a>
                                </div>
                                <div style="width: 50%" class="post-action">
                                    <span style="float: right;padding: 4px 0;">
                                        <a href=""><i style="padding-right: 10px" class="far fa-bookmark"></i></a>
                                        <a href=""><i class="far fa-heart"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div style="padding-bottom: 0" class="container main-trending">
        <div class="header-trending">
            <h3 class="header">Địa điểm nổi bật</h3>
        </div>

        <div style="position: relative" class="trending">
            <li>
                <div class="row content-trending">
                    @foreach ($place_trending as $item)
                        <div class="col-md-6">
                            <div class="row blog-image-small">
                                <a class="col-md-4 img-blog" href="">
                                    @if ($item->cover_image != null)
                                        <img src="{{ $item->cover_image }}" alt="">
                                    @else
                                        <img src="assets/images/web/food-default.png" alt="">    
                                    @endif
                                </a>

                                <div class="col-md-8 text-blog-post">
                                    <div class="header-single-blog">
                                        <div class="name-place">
                                            <a href="">{{ $item->place_name }}</a>
                                        </div>
                                    </div>
            
                                    <div style="margin: 7px 0;height: 60px;" class="title-single-blog">
                                        <span style="display: block;height: 45px;">{{ Str::limit($item->description, 70) }}</span>
                                        <span style="display: block;font-size: 15px;font-weight: 600;margin-top: 7px;"><i style="color: red" class="fas fa-star"></i> 4.5 (213 đánh giá)</span>
                                    </div>
            
                                    <div class="footer-single-blog">
                                        <div style="width: 50%" class="post-date">
                                            <i class="fas fa-calendar-alt"></i>
                                            <a class="date" href="">{{ $item->created_at->format('h/m/Y') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </li>
        </div>
    </div>

    <div class="container main-trending">
        <div class="header-trending">
            <h3 class="header">Bài viết thịnh hành</h3>
        </div>

        <div style="position: relative" class="trending">
            <li>
                <div class="row content-trending">
                    @foreach ($post_trending as $item)
                        <div class="col-md-6">
                            <div class="row blog-image-small">
                                <a class="col-md-4 img-blog" href="{{ route('detailpost', ['slug'=>$item->slug->slug]) }}">
                                    <img src="{{ $item->featured_image }}" alt="">
                                </a>

                                <div class="col-md-8 text-blog-post">
                                    <div class="header-single-blog">
                                        <div class="post-category">
                                            @if ($item->type == 1)
                                                <a href="{{ route('detailcategory', ['slug'=>$item->category[0]->slug]) }}">{{ Str::limit($item->category[0]->category_name, 10) }}</a>
                                            @else
                                                <a href="">Địa điểm</a>
                                            @endif
                                        </div>
                                        <div class="post-author">
                                            <span>By</span>
                                            <a href="{{ route('detailauthor', ['username'=>$item->user->username]) }}">{{ Str::limit($item->user->name, 15) }}</a>
                                        </div>
                                    </div>
            
                                    <div class="title-single-blog">
                                        <a href="{{ route('detailpost', ['slug'=>$item->slug->slug]) }}">{{ Str::limit($item->title, 70) }}</a>
                                    </div>
            
                                    <div class="footer-single-blog">
                                        <div style="width: 50%" class="post-date">
                                            <i class="fas fa-calendar-alt"></i>
                                            <a class="date" href="">{{ $item->created_at->format('h/m/Y') }}</a>
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
                        </div>
                    @endforeach
                </div>
            </li>
        </div>
    </div>

    <div style="padding-bottom: 100px" class="container">
        <div class="header-follow">
            <h3 class="header">Tác giả nổi bật</h3>
        </div>

        <div class="follow" style="position: relative;">
            @php
                $check = 0;
            @endphp
            @foreach ($arrauthor as $item)
                @php
                    $check++;

                    if($check == 4){
                        break;
                    }
                @endphp
                <li>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                @foreach ($item->posts_trending() as $post)
                                    <div class="col-md-6 blog-image-larger">
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
                        <div class="col-md-3">
                            <div class="follow-author">
                                <div class="content-follow">
                                    <div class="img-author">
                                        @if ($item->img_profile != null)
                                            <img src="{{ $item->img_profile }}" alt="">
                                        @elseif($item->img_profile == null && $item->sex == 1)
                                            <img src="assets/images/web/default-avatar-men.png" alt="">
                                        @else
                                            <img src="assets/images/web/default-avatar-women.png" alt="">
                                        @endif
                                    </div>

                                    <div class="author-name">
                                        <a href="">{{ Str::limit($item->name, 20) }}</a>
                                        <span class="author-position">Biên tập viên</span>
                                        <span class="author-description">{{ $item->description }}</span>
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
                            {{--  <div class="follow-img">
                                <img src="https://scontent-hkt1-2.xx.fbcdn.net/v/t1.6435-0/p526x296/217065209_2863488927299970_2180699507534415341_n.jpg?_nc_cat=103&ccb=1-3&_nc_sid=825194&_nc_ohc=z4jzz3yLPoUAX86Dcma&_nc_ht=scontent-hkt1-2.xx&oh=d1975b4d7dbfcd181aa619917c3ab343&oe=60F5129D" alt="">
                            </div>  --}}
                        </div>
                    </div>
                </li>
            @endforeach
        </div>
    </div>

    <script>
        $('.trending').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: '<button type="button" style="top: -76px;left: 1000px;" class="aaa slick-prev"><i class="fal fa-long-arrow-left"></i></button>',
            nextArrow: '<button type="button" style="top: -76px;right: 20px;" class="aaa slick-next"><i class="fal fa-long-arrow-right"></i></button>',
        });

        $('.follow').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: '<button type="button" style="top: -59px;left: 1000px" class="aaa slick-prev"><i  class="fal fa-long-arrow-left"></i></button>',
            nextArrow: '<button type="button" style="top: -59px;right: 20px;" class="aaa slick-next"><i  class="fal fa-long-arrow-right"></i></button>',
        });

        $('.topic').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            centerPadding: '60px',
            prevArrow: '<button type="button" style="top: 80px;left: -232px" class="aaa blackbtn slick-prev"><i  class="fal fa-long-arrow-left"></i></button>',
            nextArrow: '<button type="button" style="top: 80px;right: 1050px;" class="aaa blackbtn slick-next"><i  class="fal fa-long-arrow-right"></i></button>',
        });
    </script>
@endsection