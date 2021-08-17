@extends('admin.layout.master')
@section('content')
    <style>
        .cke_contents.cke_reset {
            height: 700px !important;
        } 
      
        .tag {
            background-color: #215bdc;
        }
    
        .bootstrap-tagsinput {
            width: 100%;
        }
    
        .bootstrap-tagsinput .label {
            margin-bottom: .2rem;
            margin-top: 0.2rem;
        }
    </style>
      <div class="page-header d-lg-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">Thêm bài viết mới</h4>
        </div>
      </div>
      <form action="{{ route('page.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-12">
                <div style="width: 100%;" class="card">
                    <div style="width: 100%;" class="card-body">
                        @if ($errors->any())
                            <div class="form-group">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="color: red;font-size: 16px;">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12 mb20">
                                <div class="form-group">
                                    <label class="form-label">Tên trang</label>
                                    <input value="{{ old('name') }}" onkeyup="return convert(this)" name="name" id="name" class="form-control" placeholder="Nhập tên trang">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb20">
                                <label class="form-label">Nội dung</label>
                                <button onclick="return resetbutton()" type="button" style="padding: 3px 8px;width: auto;margin-bottom: 3px" class="btn btn-block btn-outline-primary">Thêm media</button>
                                <textarea class="p-2" name="contents" id="content" cols="133" rows="10">{{ old('contents') }}</textarea>
                                <script src="{{ url('/assets/plugins/ckeditor/ckeditor.js') }}"></script>
                                <script>
                                    CKEDITOR.replace('content');
                                </script>
                            </div>
                        </div>
                        
                        <div style="position: relative;margin-bottom: 40px;" class="col-md-12 mb20">
                            <button style="position: absolute;right: 15px;" class="btn btn-primary">Lưu bài viết</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection