@extends('admin.layout.master')
@section('content')
  <div class="page-header d-lg-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Danh sách đường dẫn</h4>
    </div>
     <div class="page-rightheader ml-md-auto">
            <div class="btn-list mb0">
              <a href="{{ route('slug.create') }}">
                <button  class="btn btn-success"> + Thêm đường dẫn mới </button>
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
                  <th style="border-bottom-0 text-align: center">Đường dẫn</th>
                  <th style="border-bottom-0 text-align: center">Chuyển hướng</th>
                  <th style="border-bottom-0">Ngày tạo</th>
                  <th style="border-bottom-0 width: 400px;">Hành động</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($slugs as $item)
                  <tr>
                      <td>{{ $item->id }}</td>
                      <td style="">{{ $item->slug }}</td>
                      <td>{{ $item->page['name'] }}</td>
                      <td>{{ $item->created_at->format('H:i d/m/Y') }}</td>
                      <td>
                        <div class="d-flex">
                          {{--  <a href="{{ route('detailpost', ['slug'=>$item->slug->slug]) }}" target="_blank" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Xem bài viết"><i class="feather feather-eye text-primary"></i></a>  --}}
                          <a href="{{ route('slug.edit', ['slug'=>$item->id]) }}" class="action-btns1">
                            <i class="feather feather-edit-2  text-success" data-toggle="tooltip" data-placement="top" title="Sửa đường dẫn"></i>
                          </a>
                          <a href="{{ route('slug.destroy', ['slug'=>$item->id]) }}" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Xóa đường dẫn"><i onclick="return confirm('Bạn có chắc chắn muốn xóa đường dẫn này không, nếu chắc chắn muốn xóa nhấn vào ok còn chưa chắc chắn nhấn cancel?');" class="feather feather-trash-2 text-danger"></i></a>
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
