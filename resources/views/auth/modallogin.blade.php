<div class="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-title text-center">
            <h4>Đăng nhập</h4>
          </div>
          <div class="d-flex flex-column text-center">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Nhập tài khoản hoặc địa chỉ email">
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
              </div>
              <button type="submit" class="btn btn-info btn-block btn-round">Đăng nhập</button>
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
          <div class="signup-section">Chưa có tài khoản? <span onclick="showregister()" class="text-info"> Đăng ký</span>.</div>
        </div>
    </div>
</div> 