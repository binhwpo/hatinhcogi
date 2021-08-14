<div class="modal fade" id="addftp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Thêm tài khoản</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('accountftp.store') }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Tên FTP</label>
                    <div class="input-icon">
                        <input id="name" name="name" type="text" class="form-control" placeholder="Tên FTP">
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Máy chủ</label>
                    <div class="input-icon">
                        <input id="host" name="host" type="text" class="form-control" placeholder="Máy chủ">
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Tài khoản</label>
                    <div class="input-icon">
                        <input id="username" name="username" type="text" class="form-control" placeholder="Tài khoản">
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Mật khẩu</label>
                    <div class="input-icon">
                        <input id="password" name="password" type="password" class="form-control" placeholder="Mật khẩu">
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Cổng</label>
                    <div class="input-icon">
                        <input id="port" name="port" value="21" type="text" class="form-control" placeholder="Cổng">
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Cho phép lưu trữ (Đơn vị GB)</label>
                    <div class="input-icon">
                        <input id="storage" name="storage" type="text" class="form-control" placeholder="Cho phép lưu trữ">
                    </div>
                </div>

                <div class="form-group">
                    <label class="custom-switch">
                        <span style="padding-top: 4px;" class="custom-switch-description mr-2">Trạng thái</span>
                        <input checked name="status" id="status" type="checkbox" name="custom-switch-checkbox3" class="custom-switch-input">
                        <span class="custom-switch-indicator custom-radius"></span>
                    </label>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Thêm tài khoản</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </form>
      </div>
    </div>
</div>