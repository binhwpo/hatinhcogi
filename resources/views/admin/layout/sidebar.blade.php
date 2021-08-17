<ul class="side-menu">
    <li class="side-item side-item-category mt-4">Dashboards</li>
    @can('view-dashboard')
        <li class="slide">
            <a class="side-menu__item" href="{{ route('dashboard') }}">
                <i class="feather feather-home sidemenu_icon"></i>
                <span class="side-menu__label">Dashboard</span>
            </a>
        </li>
    @endcan
    <li class="slide">
        <a class="side-menu__item"  href="chat-livechat.html">
            <i class="feather feather-headphones sidemenu_icon"></i>
            <span class="side-menu__label">Hỗ trợ</span>
        </a>
    </li>


    <li class="side-item side-item-category">Giao diện</li>
    <li class="slide">
        <a class="side-menu__item"  href="{{ route('category.index') }}">
            <i class="feather feather-codepen sidemenu_icon"></i>
            <span class="side-menu__label">Danh mục</span>
        </a>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
            <i class="feather feather-file sidemenu_icon"></i>
            <span class="side-menu__label">Bài viết</span><i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a class="slide-item" href="{{ route('post.index') }}">Danh sách bài viết</a></li>
            <li><a class="slide-item" href="{{ route('post.create') }}">Viết bài mới</a></li>
            {{--  <li><a class="slide-item" href="hr-addemployee.html">Thùng rác</a></li>  --}}
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
            <i class="feather feather-map-pin sidemenu_icon"></i>
            <span class="side-menu__label">Địa điểm</span><i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a class="slide-item" href="{{ route('place.index') }}">Danh sách địa điểm</a></li>
            <li><a class="slide-item" href="{{ route('place.create') }}">Thêm địa điểm</a></li>
            {{--  <li><a class="slide-item" href="hr-addemployee.html">Thùng rác</a></li>  --}}
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
            <i class="feather feather-codepen sidemenu_icon"></i>
            <span class="side-menu__label">Quản lý files</span><i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a class="slide-item" href="{{ route('media.index') }}">Tất cả</a></li>
            @foreach ($listftp as $item)
                <li><a class="slide-item" href="{{ route('media.index', ['serveri'=>$item->id,'server'=>$item->name]) }}">{{ $item->name }}</a></li>
            @endforeach
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
            <i class="feather feather-copy sidemenu_icon"></i>
            <span class="side-menu__label">Page</span><i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a class="slide-item" href="">Danh sách page</a></li>
            <li><a class="slide-item" href="">Thêm page</a></li>
        </ul>
    </li>
    


    <li class="side-item side-item-category">Truy cập</li>
    <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
            <i class="feather feather-users sidemenu_icon"></i>
            <span class="side-menu__label">Nhóm tài khoản</span><i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a class="slide-item" href="{{ route('group.index') }}">Danh sách nhóm tài khoản</a></li>
            <li><a class="slide-item" href="{{ route('group.create') }}">Thêm nhóm tài khoản</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
            <i class="feather feather-user sidemenu_icon"></i>
            <span class="side-menu__label">Tài khoản</span><i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a class="slide-item" href="{{ route('user.index') }}">Danh sách tài khoản</a></li>
            <li><a class="slide-item" href="{{ route('user.create') }}">Thêm tài khoản</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="{{ route('accountftp.index') }}">
            <i class="feather feather-layers sidemenu_icon"></i>
            <span class="side-menu__label">Danh sách tài khoản FTP</span>
        </a>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="">
            <i class="feather feather-paperclip sidemenu_icon"></i>
            <span class="side-menu__label">Đường dẫn</span>
        </a>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
            <i class="feather feather-message-square sidemenu_icon"></i>
            <span class="side-menu__label">Bình luận</span>
        </a>
    </li>
</ul>