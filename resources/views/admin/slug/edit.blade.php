@extends('admin.layout.master')
@section('content')
  <div class="page-header d-lg-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Sửa đường dẫn</h4>
    </div>
  </div>
  
  <form id="formpost" method="POST" action="{{ route('slug.update', ['slug' => $slug->id]) }}">
    @csrf
    {{ method_field('PATCH') }}
    <div class="row">
      <div class="col-12">
        <div style="width: 100%;" class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                @if ($errors->any())
                    <div class="form-group">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="color: red;font-size: 16px;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              </div>
              
              <div class="col-md-6 mb20">
                <div class="form-group">
                  <label class="form-label">Đường dẫn</label>
                  <input value="{{ $slug->slug }}" name="slug" id="slug" class="form-control" placeholder="Đường dẫn">
                </div>
              </div>

              <div class="col-md-6 mb20">
                <div class="form-group">
                  <label class="form-label">Chuyển hướng</label>
                  <select class="form-control" name="page_id" id="page_id">
                      <option value="0">Không chuyển hướng</option>
                      @foreach ($pages as $item)
                        @if ($slug->page_id == $item->id && isset($slug->page_id))
                          <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                        @else
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                      @endforeach
                  </select>
                </div>
              </div>

              <div style="position: relative;margin-bottom: 40px;" class="col-md-12 mb20">
                  <button style="position: absolute;left: 12px;" class="btn btn-primary">Lưu đường dẫn</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection