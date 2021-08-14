@extends('admin.layout.master')
@section('content')
  <div class="page-header d-lg-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Quản lý tài khoản</h4>
    </div>
     <div class="page-rightheader ml-md-auto">
            <div class="btn-list mb0">
                <a href="{{ route('user.create') }}">
                    <button type="button" class="btn btn-success"> + Thêm tài khoản mới </button>
                </a>
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
                  <th >Tài khoản</th>
                  <th >Email</th>
                  <th >Họ tên</th>
                  <th >Nhóm tài khoản</th>
                  <th >Trạng thái</th>
                  <th >Ngày tạo</th>
                  <th >Hành động</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $item)
                  <tr>
                      <td>{{ $item->id }}</td>
                      <td >{{ $item->username }}</td>
                      <td >{{ $item->email }}</td>
                      <td >{{ $item->name }}</td>
                      <td >{{ $item->group->group_name }}</td>
                      <td ><span style="color: green">Hoạt động</span></td>
                      <td>{{ $item->created_at->format('H:i d/m/Y') }}</td>
                      <td>
                        <div class="d-flex">
                          {{-- <a href="{{ route('user.show', ['user'=>$item->username]) }}" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Xem tài khoản"><i class="feather feather-eye text-primary"></i></a> --}}
                          <a href="{{ route('user.edit', ['user'=>$item->username]) }}" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Sửa tài khoản"><i class="feather feather-edit-2  text-success"></i></a>
                          <a href="{{ route('user.destroy', ['user'=>$item->username]) }}" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Xóa tài khoản"><i onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không, nếu chắc chắn muốn xóa nhấn vào ok còn chưa chắc chắn nhấn cancel?');" class="feather feather-trash-2 text-danger"></i></a>
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
@endsection