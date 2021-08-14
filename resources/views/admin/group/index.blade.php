@extends('admin.layout.master')
@section('content')
  <div class="page-header d-lg-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Quản lý nhóm tài khoản</h4>
    </div>
     <div class="page-rightheader ml-md-auto">
            <div class="btn-list mb0">
                <a href="{{ route('group.create') }}">
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
                  <th >Tên nhóm</th>
                  <th >Đường dẫn</th>
                  <th >Ngày tạo</th>
                  <th >Hành động</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($groups as $item)
                  <tr>
                      <td>{{ $item->id }}</td>
                      <td >{{ $item->group_name }}</td>
                      <td >{{ $item->slug }}</td>
                      <td>{{ $item->created_at->format('H:i d/m/Y') }}</td>
                      <td>
                        <div class="d-flex">
                          <a href="{{ route('group.edit', ['group'=>$item->id]) }}" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Sửa nhóm tài khoản"><i class="feather feather-edit-2  text-success"></i></a>
                          <a href="{{ route('group.destroy', ['group'=>$item->id]) }}" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Xóa nhóm tài khoản"><i onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không, nếu chắc chắn muốn xóa nhấn vào ok còn chưa chắc chắn nhấn cancel?');" class="feather feather-trash-2 text-danger"></i></a>
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