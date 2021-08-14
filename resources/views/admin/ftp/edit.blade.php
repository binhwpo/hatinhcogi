<div id="#divftp" class="modal-content">
    <div id="contentftp">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Sửa tài khoản</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" action="{{ route('accountftp.postedit', ['id'=>$ftp->id]) }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Tên FTP</label>
                    <div class="input-icon">
                        <input id="name" name="name" value="{{ $ftp->name }}" type="text" class="form-control" placeholder="Tên FTP">
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Máy chủ</label>
                    <div class="input-icon">
                        <input id="host" name="host" value="{{ $ftp->host }}" type="text" class="form-control" placeholder="Máy chủ">
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Tài khoản</label>
                    <div class="input-icon">
                        <input id="username" name="username" value="{{ $ftp->username }}" type="text" class="form-control" placeholder="Tài khoản">
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Mật khẩu</label>
                    <div class="input-icon">
                        <input id="password" name="password" value="{{ $ftp->password }}" type="password" class="form-control" placeholder="Mật khẩu">
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Cổng</label>
                    <div class="input-icon">
                        <input id="port" name="port" type="text" value="{{ $ftp->port }}" class="form-control" placeholder="Cổng">
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Cho phép lưu trữ (Đơn vị GB)</label>
                    <div class="input-icon">
                        <input id="storage" name="storage" type="text" value="{{ $ftp->storage }}" class="form-control" placeholder="Cho phép lưu trữ">
                    </div>
                </div>

                <div class="form-group">
                    <label class="custom-switch">
                        <span style="padding-top: 4px;" class="custom-switch-description mr-2">Trạng thái</span>
                        @if ($ftp->status == 1)
                            <input checked name="status" id="status" type="checkbox" name="custom-switch-checkbox3" class="custom-switch-input">
                        @else
                            <input name="status" id="status" type="checkbox" name="custom-switch-checkbox3" class="custom-switch-input">
                        @endif
                        <span class="custom-switch-indicator custom-radius"></span>
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Sửa tài khoản</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </form>
    </div>
</div>