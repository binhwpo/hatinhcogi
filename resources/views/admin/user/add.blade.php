@extends('admin.layout.master')
@section('content')
  <div class="page-header d-lg-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Thêm tài khoản mới</h4>
    </div>
  </div>
  
  <form id="formpost" enctype="multipart/form-data" method="POST" action="{{ route('user.store') }}">
    @csrf
    <div class="row">
      <div class="col-12">
        @if ($errors->any())
          <div style="width: 100%;" class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li style="color: red;font-size: 16px;">{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif

        <div style="width: 100%;" class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 div_img_profile">
                <div class="div_change_img">
                  <img id="imgpreview" class="img_profile" src="assets/images/web/default-avatar-men.png" alt="">
                  <label for="img_profile">
                    <i style="color: #28aac796;" class="fas fa-camera-alt"></i>
                  </label>
                  <input onchange="return chanegeimgprofile()" style="display: none" type="file" name="img_profile" id="img_profile">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div style="width: 100%;" class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <h1>Thông tin cơ bản</h1>
              </div>
  
              <div class="col-lg-6 col-md-12 mb20">
                <div class="form-group">
                  <label class="form-label">Tài khoản</label>
                  <input value="{{ old('username') }}" name="username" id="username" class="form-control" placeholder="Tài khoản">
                </div>
              </div>

              <div class="col-md-6 mb20">
                <div class="form-group">
                  <label class="form-label">Email</label>
                  <input value="{{ old('email') }}" name="email" id="email" class="form-control" placeholder="Email">
                </div>
              </div>
  
              <div class="col-md-6 mb20">
                <div class="form-group">
                  <label class="form-label">Họ tên</label>
                  <input value="{{ old('name') }}" name="name" id="name" class="form-control" placeholder="Họ và tên">
                </div>
              </div>

              <div class="col-md-6 mb20">
                <div class="form-group">
                  <label class="form-label">Số điện thoại</label>
                  <input value="{{ old('phone') }}" name="phone" id="phone" class="form-control" placeholder="Số điện thoại">
                </div>
              </div>

              <div class="col-md-12 mb20">
                <div class="form-group">
                  <label class="form-label">Địa chỉ</label>
                  <input value="{{ old('address') }}" name="address" id="address" class="form-control" placeholder="Địa chỉ">
                </div>
              </div>

              <div class="col-md-12 mb20">
                <div class="form-group">
                  <label class="form-label">Mô tả</label>
                  <textarea style="width: 100%;padding: 5px 10px;" name="description" id="description" cols="30" rows="4">{{ old('description') }}</textarea>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div style="width: 100%;" class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <h1>Quyền truy cập</h1>
              </div>
              <div class="col-md-12 mb20">
                <div class="form-group">
                  <label class="form-label">Nhóm tài khoản</label>
                  <select onchange="return selectgroup(this)" class="form-control" name="group_id" id="group_id">
                      <option value="0">Chọn nhóm tài khoản</option>
                      @foreach ($groups as $item)
                        <option value="{{ $item->id }}">{{ $item->group_name }}</option>
                      @endforeach
                  </select>
                </div>
              </div>

              <div id="divpermission" class="col-md-12 mb20">
                <div id="contentpermission" class="form-group">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div style="width: 100%;" class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <h1>Bảo mật</h1>
              </div>
              <div class="col-md-6 mb20">
                <div class="form-group">
                  <label class="form-label">Mật khẩu</label>
                  <div class="input-group">
                    <input type="password" value="{{ old('password') }}" id="password" class="form-control" placeholder="Mật khẩu" name="password" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div style="position: relative" class="input-group-append">
                      <span style="cursor: pointer;background-color: #258ee2;color: #fff;border-radius: 0 5px 5px 0;" onclick="return randompassword()" class="input-group-text" id="basic-addon2">Tạo mật khẩu random</span>
                      <i id="showpass" onclick="return showpass()" class="fas fa-eye showpass"></i>
                      <i id="hidepass" onclick="return showpass()" style="display: none" class="fas fa-eye-slash showpass"></i>
                    </div>
                  </div>
                </div>
              </div>

              <div style="position: relative;margin-bottom: 40px;" class="col-md-12 mb20">
                <button style="position: absolute;left: 12px;" class="btn btn-primary">Lưu tài khoản</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <script>
    $(document).ready(function () {
      randompassword();
    });
  </script>
@endsection