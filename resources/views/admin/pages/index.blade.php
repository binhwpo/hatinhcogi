@extends('admin.layout.master')
@section('content')
  <div class="page-header d-lg-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Quản lý trang</h4>
    </div>
     <div class="page-rightheader ml-md-auto">
            <div class="btn-list mb0">
              <a href="{{ route('page.create') }}">
                <button  class="btn btn-success"> + Thêm trang mới </button>
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
                  <th style="width: 200px;">Tên trang</th>
                  <th style="border-bottom-0">Người tạo</th>
                  <th style="border-bottom-0">Ngày tạo</th>
                  <th style="border-bottom-0 width: 400px;">Hành động</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pages as $item)
                  <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->user->name }}</td>
                      <td>{{ $item->created_at->format('H:i d/m/Y') }}</td>
                      <td>
                        <div class="d-flex">
                          <a href="{{ route('page.edit', ['page'=>$item->id]) }}" class="action-btns1">
                            <i class="feather feather-edit-2 text-success" data-toggle="tooltip" data-placement="top" title="Sửa trang"></i>
                          </a>
                          <a href="{{ route('page.destroy', ['page'=>$item->id]) }}" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Xóa trang"><i onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không, nếu chắc chắn muốn xóa nhấn vào ok còn chưa chắc chắn nhấn cancel?');" class="feather feather-trash-2 text-danger"></i></a>
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
