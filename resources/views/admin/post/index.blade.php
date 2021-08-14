@extends('admin.layout.master')
@section('content')
  <div class="page-header d-lg-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Quản lý bài viết</h4>
    </div>
     <div class="page-rightheader ml-md-auto">
            <div class="btn-list mb0">
              <a href="{{ route('post.create') }}">
                <button  class="btn btn-success"> + Thêm bài viết mới </button>
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
                  <th style="width: 200px;">Tiêu đề</th>
                  <th style="border-bottom-0 text-align: center">Danh mục</th>
                  <th style="border-bottom-0">Trạng thái</th>
                  <th style="border-bottom-0">Tác giả</th>
                  <th style="border-bottom-0">Ngày viết</th>
                  <th style="border-bottom-0 width: 400px;">Hành động</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($posts as $item)
                  <tr>
                      <td>{{ $item->id }}</td>
                      <td style="">{{ $item->title }}</td>
                      <td>
                        @php
                            $cate = '';
                        @endphp
                        @foreach ($item->category as $category)
                          @php
                              if($cate == ''){
                                $cate = $category->category_name;
                              }else {
                                $cate = $cate.', '.$category->category_name;
                              }
                          @endphp
                        @endforeach
                        {{ $cate }}
                      </td>
                      <td>
                          @if ($item->status == 1)
                              <span style="color: green">Hiển thị</span>
                          @else
                              <span style="color: red">Ẩn</span>
                          @endif
                      </td>
                      <td>{{ $item->user->name }}</td>
                      <td>{{ $item->created_at->format('H:i d/m/Y') }}</td>
                      <td>
                        <div class="d-flex">
                          <a href="{{ route('detailpost', ['slug'=>$item->slug->slug]) }}" target="_blank" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Xem bài viết"><i class="feather feather-eye text-primary"></i></a>
                          <a href="{{ route('post.edit', ['post'=>$item->id]) }}" class="action-btns1">
                            <i class="feather feather-edit-2 text-success" data-toggle="tooltip" data-placement="top" title="Sửa bài viết"></i>
                          </a>
                          <a href="{{ route('post.destroy', ['post'=>$item->id]) }}" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Xóa bài viết"><i onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không, nếu chắc chắn muốn xóa nhấn vào ok còn chưa chắc chắn nhấn cancel?');" class="feather feather-trash-2 text-danger"></i></a>
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
