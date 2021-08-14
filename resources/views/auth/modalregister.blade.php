<div class="modal" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-title text-center">
            <h4>Đăng ký</h4>
          </div>
          <div class="d-flex flex-column text-center">
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="form-group">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Nhập địa chỉ email">
              </div>
              <div class="form-group">
                <input type="text" name="username" value="{{ old('username') }}" class="form-control" id="username" placeholder="Nhập tài khoản">
              </div>
              <div class="form-group">
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Nhập họ tên">
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
              </div>
              <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Nhập lại mật khẩu">
              </div>
              <button type="submit" class="btn btn-info btn-block btn-round">Đăng ký</button>
            </form>
            
            <div class="text-center text-muted delimiter">Hoặc đăng nhập bằng mạng xã hội</div>
            <div class="d-flex justify-content-center social-buttons">
              <a href="{{ route('authsocial', ['provider'=>'facebook']) }}">
                <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Facebook">
                <i class="fab fa-facebook"></i>
                </button>
              </a>
              
              <a href="{{ route('authsocial', ['provider'=>'google']) }}">
                <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Linkedin">
                  <i class="fab fa-google"></i>
                </button>
              </a>
            </di>
          </div>
        </div>
      </div>
        <div class="modal-footer d-flex justify-content-center">
          <div class="signup-section">Đã có tài khoản? <span onclick="showlogin()" class="text-info"> Đăng nhập</span>.</div>
        </div>
    </div>
</div> 