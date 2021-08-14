<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <base href="{{ asset('') }}">

    <title>Hà Tĩnh Có Gì</title>
    <link rel="icon" href="assets/images/web/logoht-daude.svg">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/stylefe.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('assets/libs/js/jquery-3.4.1.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</head>
<body>
    <div class="container-fluid headerpost">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <ul style="float: left" class="list-item-header list-item-weather">
                        <li class="item-header-contact item-weather">
                            <a href="">
                                <span>Hà Tĩnh</span>    
                                <img src="assets/images/wayder.png" alt="">
                                <span>28° C</span>    
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-5">
                    <ul class="list-item-header">
                        <li class="item-header-contact">
                            <a href="">
                                <img src="assets/images/contact-call.png" alt="">
                                <span>(970) 262-1413</span>    
                            </a>
                        </li>
                        <li class="item-header-contact">
                            <a href="">
                                <img src="assets/images/contact-emaill.png" alt="">
                                <span>address@gmail.com</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <ul style="float: right" class="list-item-header">
                        @if (Auth::check())
                            <li class="item-header">
                                <a href="">Trợ giúp</a>
                            </li>
                            @if (Auth::user()->group->slug != 'normal-user')
                                <li class="item-header"><a href="{{ route('post.create') }}">Viết bài</a></li>
                            @else
                                <li class="item-header">
                                    <a href="">Bài viết</a>
                                </li>
                            @endif
                        @else
                            <li class="item-header"><span onclick="showlogin()">Đăng nhập</span></li>
                            <li class="item-header"><span onclick="showregister()">Đăng ký</span></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid headerpost2">
        <div class="container">
            <div class="aaheader">
                <div class="divlogo header-logo">
                    <div class="logo">
                        <a href="">
                            <img style="display: inherit" src="./assets/images/HATINHCOGI LOGO-new.svg" alt="">
                        </a>
                    </div>
                </div>
                <div class="header-banner">
                    <div class="banner">
                        <a href="">
                            <img style="display: inherit" src="assets/images/header-add-banner.jpg" alt="">
                        </a>
                    </div>
                </div>

                <div class="header-menu">
                    <ul class="list-item-menu">
                        <li class="item-menu"><i class="fas fa-search"></i></li>
                        <li class="item-menu"><i class="far fa-bell"></i></li>
                        <li class="item-menu"><i class="fas fa-bookmark"></i></li>
                        <li class="item-menu btnuser"><i class="fas fa-user"></i>
                            <ul class="dropdown-content">
                                @if (Auth::check())
                                    {{-- <li><a href="#">{{ Auth::user()->name }}</a></li> --}}
                                    <li><a href="#">Thông tin cá nhân</a></li>
                                    @if (Auth::user()->group->slug != 'normal-user')
                                        <li><a href="{{ route('dashboard') }}">Trang quản trị</a></li>
                                    @endif
                                    <form method="POST" action="logout">
                                        @csrf
                                        <li><button type="submit">Đăng xuất</button></li>
                                    </form>
                                @else
                                    <li onclick="showlogin()">Đăng nhập</li>
                                    <li onclick="showregister()">Đăng ký</li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container headerpost-bottom">
        <div class="row">
            <div class="col-md-4">
                <div class="list-item-social">
                    <a class="item-social" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="item-social" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="item-social" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="item-social" href=""><i class="fas fa-laptop"></i></a>
                </div>
            </div>

            <div class="col-md-8">
                <ul class="category-menu">
                    <li class="category-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    @foreach ($dataunique_category as $item)
                        <li class="category-item">
                            <a class="aaaaaa" href="">{{ $item->category_name }}<i class="fas fa-chevron-down"></i></a>
                            <ul class="menu-content">
                                <li><a href="">Home 1</a></li>
                                <li><a href="">Home 1</a></li>
                                <li><a href="">Home 1</a></li>
                                <li><a href="">Home 1</a>
                                </li>
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <main>
        @yield('content')
    </main>
    
    <div class="container-fluid content-category">
        <div class="container">
            {{--  <div class="trending-topic">
                <div class="row">
                    <div class="title-trending">
                        <h3 class="header trendingh">Trending topic</h3>
                    </div>
                    <ul class="topic">
                        <li>
                            <a href="">
                                <img src="assets/images/03_topic.jpg" alt="">
                                <span class="text-topic">Design</span>
                            </a>
                        </li>

                        <li>
                            <a href="">
                                <img src="assets/images/03_topic.jpg" alt="">
                                <span class="text-topic">Design</span>
                            </a>
                        </li>

                        <li>
                            <a href="">
                                <img src="assets/images/03_topic.jpg" alt="">
                                <span class="text-topic">Design</span>
                            </a>
                        </li>


                        <li>
                            <a href="">
                                <img src="assets/images/03_topic.jpg" alt="">
                                <span class="text-topic">Design</span>
                            </a>
                        </li>

                        <li>
                            <a href="">
                                <img src="assets/images/03_topic.jpg" alt="">
                                <span class="text-topic">Design</span>
                            </a>
                        </li>

                        <li>
                            <a href="">
                                <img src="assets/images/03_topic.jpg" alt="">
                                <span class="text-topic">Design</span>
                            </a>
                        </li>

                        <li>
                            <a href="">
                                <img src="assets/images/03_topic.jpg" alt="">
                                <span class="text-topic">Design</span>
                            </a>
                        </li>

                        <li>
                            <a href="">
                                <img src="assets/images/03_topic.jpg" alt="">
                                <span class="text-topic">Design</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </div>  --}}

            <div style="padding-top: 80px" class="subrices-email">
                <div class="content-sub">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <div class="section-title mb-4">
                                <h3 class="header">Đăng kí nhận tin mới</h3>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="newsletter-input-box aos-init aos-animate" data-aos="fade-up">
                                <input class="newsletter-input" type="text" placeholder="Nhập email của bạn">
                                <div class="buttonbox">
                                    <a href="#" class="btn-yellow">Đăng kí ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="newsletter-image">
                        <img class="newsletter-image-01" src="assets/images/1-newsletter.png" alt="">
                        <img class="newsletter-image-02" src="assets/images/2-newsletter.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="">
                                <img src="./assets/images/HATINHCOGI LOGO-new.svg" alt="">
                            </a>
                        </div>
                        <p>Lorem Ipsum is simply dummy text
                            the printing and typesetting industry
                            has been the industry is standard
                            text ever since.
                        </p>
                        <div class="list-item-social">
                            <a class="item-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="item-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="item-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="item-social" href=""><i class="fas fa-laptop"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget footer-subscribe-center">
                        <div class="footer-widget-title">
                            <h4 class="title">Subscribe</h4>
                        </div>
                        <div class="footer-subscribe-wrap">
                            <div class="single-input">
                                <input type="text" placeholder="Your Name">
                            </div>
                            <div class="single-input">
                                <input type="email" placeholder="Email Address">
                            </div>
                            <div class="buttonbox">
                                <button class="btn-yellow" type="submit">Subscribe Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="footer-menu-widget">
                        <div class="single-footer-menu">
                            <div class="footer-widget-title">
                                <h4 class="title">Company</h4>
                            </div>
                            <ul class="footer-widget-menu-list">
                                <li><a href="about-us.html">About Us</a></li>
                                <li><a href="contact-us.html">Contact Us</a></li>
                                <li><a href="#!">Local Print Ads</a></li>
                                <li><a href="faq.html">FAQ’s</a></li>
                                <li><a href="#!">Careers</a></li>
                            </ul>
                        </div>
                        <div class="single-footer-menu">
                            <div class="footer-widget-title">
                                <h4 class="title">Quick Links</h4>
                            </div>
                            <ul class="footer-widget-menu-list">
                                <li><a href="#!">Privacy Policy</a></li>
                                <li><a href="#!">Discussion</a></li>
                                <li><a href="#!">Terms &amp; Conditions</a></li>
                                <li><a href="#!">Customer Support</a></li>
                                <li><a href="#!">Course FAQ’s</a></li>
                            </ul>
                        </div>
                        <div class="single-footer-menu">
                            <div class="footer-widget-title">
                                <h4 class="title">Category</h4>
                            </div>
                            <ul class="footer-widget-menu-list">
                                <li><a href="#!">Lefestyle</a></li>
                                <li><a href="#!">Healthy</a></li>
                                <li><a href="#!">Restaurent</a></li>
                                <li><a href="#!">Travel Tips</a></li>
                                <li><a href="#!">Marketing</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-bottom-inner">
                        <div class="copy-right-text">
                            <p>© 2021 <a href="#">Hà Tĩnh Có Gì</a>. Made with ❤️ by <a target="_blank" rel="noopener" href="https://hasthemes.com/">HTCG</a></p>
                        </div>
                        <div class="button-right-box">
                            <a href="#!" class="btn-yellow">Share your thinking <i class="fal fa-long-arrow-right"></i></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (!Auth::check())
        <script>
            function showlogin() {
                $('#loginModal').modal('show');
                $('#registerModal').modal('hide');
            }

            function showregister() {
                $('#registerModal').modal('show');
                $('#loginModal').modal('hide');
            }
        </script>

        <div>@include('auth.modallogin')</div>
        @include('auth.modalregister')
    @endif
</body>
</html>