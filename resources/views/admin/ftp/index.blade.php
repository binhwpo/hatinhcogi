@extends('admin.layout.master')
@section('content')
  <div class="page-header d-lg-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Quản lý FTP</h4>
    </div>
     <div class="page-rightheader ml-md-auto">
            <div class="btn-list mb0">
              <button type="button" data-toggle="modal" data-target="#addftp" class="btn btn-success"> + Thêm tài khoản mới </button>
            </div>
      </div> 
  </div>
  <div class="row">
    <div class="col-12">
      <div style="width: 100%;" class="card">
        <div style="width: 100%;" class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
              <thead> 
                <tr>
                  <th>#</th>
                  <th >Tên</th>
                  <th >Host</th>
                  <th >Tài khoản</th>
                  <th >Mật khẩu</th>
                  <th >Người thêm</th>
                  <th >Trạng thái</th>
                  <th >Ngày thêm</th>
                  <th >Hành động</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($ftps as $item)
                  <tr>
                      <td>{{ $item->id }}</td>
                      <td >{{ $item->name }}</td>
                      <td >{{ $item->host }}</td>
                      <td >{{ $item->username }}</td>
                      <td >{{ $item->password }}</td>
                      <td>{{ $item->user->name }}</td>
                      <td >
                          @if ($item->status == 1)
                              <span style="color: green">Hoạt động</span>
                          @else
                              <span style="color: red">Tắt</span>
                          @endif
                      </td>
                      <td>{{ $item->created_at->format('H:i d/m/Y') }}</td>
                      <td>
                        <div class="d-flex">
                          <span onclick="return loadmodaleditftp({{ $item->id }})" style="cursor: pointer;" class="action-btns1">
                            <i class="feather feather-edit-2  text-success" data-toggle="tooltip" data-placement="top" title="Sửa tài khoản"></i>
                          </span>
                          <a href="{{ route('accountftp.destroy', ['id'=>$item->id]) }}" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Xóa tài khoản"><i onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không, nếu chắc chắn muốn xóa nhấn vào ok còn chưa chắc chắn nhấn cancel?');" class="feather feather-trash-2 text-danger"></i></a>
                        </div>
                      </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('admin.ftp.add')

  <div class="modal fade" id="editftp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div id="divftp" class="modal-content">
        <div id="contentftp"></div>
      </div>
    </div>
  </div>

  <script>
    function loadmodaleditftp(id) {
      $(document).ready(function(){
          $.ajax({
              url:"admin/accountftp/editftp",
              data: {
                  id:id
              },
              method:'get',
              success: function(data){
                  $( "#contentftp" ).remove();
                  $( "#divftp" ).append( data );
                  $('#editftp').modal('show');
              },
          });
      });
    }
  </script>
@endsection