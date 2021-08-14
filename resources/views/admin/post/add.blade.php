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
  
  <form id="formpost" method="POST" action="{{ route('post.store') }}">
    @csrf
    <div class="row">
      <div class="col-lg-9">
        <div style="width: 100%;" class="card">
          <div class="card-body">
            <div class="row">
              {{--  <div class="col-sm-6 col-md-4 col-xl-12">
                <a class="modal-effect btn btn-primary btn-block mb-3" data-effect="effect-sign" data-toggle="modal" href="#modalimg">Sign</a>
              </div>  --}}
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
                  <label class="form-label">Tiêu đề</label>
                  <input value="{{ old('title') }}" onkeyup="return convert(this)" name="title" id="title" class="form-control" placeholder="Nhập tiêu đề">
                </div>
              </div>
              <div class="col-md-6 mb20">
                <div class="form-group">
                  <label class="form-label">Đường dẫn</label>
                  <input value="{{ old('slug') }}" name="slug" id="slug" class="form-control" placeholder="Nhập đường dẫn">
                </div>
              </div>
  
              <div class="col-md-12 mb20">
                <div class="form-group">
                  <label class="form-label">Thẻ tag</label>
                  <input placeholder="Nhập tag" class="form-control" name="tags" id="tags" type="text" value="{{ old('tags') }}" data-role="tagsinput" />
                </div>
              </div>
  
              <div class="col-md-12 mb20">
                <label class="form-label">Nội dung</label>
                <button onclick="return resetbutton()" type="button" style="padding: 3px 8px;width: auto;margin-bottom: 3px" class="btn btn-block btn-outline-primary">Thêm media</button>
                <textarea class="p-2" name="contents" id="content" cols="133" rows="10">{{ old('contents') }}</textarea>
                <script src="{{ url('/assets/plugins/ckeditor/ckeditor.js') }}"></script>
                <script>
                    CKEDITOR.replace('content');
                </script>
              </div>

              <div style="position: relative;margin-bottom: 40px;" class="col-md-12 mb20">
                  <button style="position: absolute;right: 15px;" class="btn btn-primary">Lưu bài viết</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <div style="width: 100%;" class="card">
            <div style="width: 100%;" class="card-body">
                <div class="col-lg-12 col-md-12 mb20">
                  <div class="form-group">
                    <label class="form-label">Trạng thái bài viết</label>
                    <select class="form-control" name="status" id="status">
                      <option value="0">Bản nháp</option>
                      <option value="1">Đã duyệt</option>
                    </select>
                  </div>
                </div>

                <div id="addcategory">
                    <div id="contentcategory" class="col-md-12 mb20">
                        <label class="form-label">Danh mục</label>
                        <div style="margin: 0 0;margin-bottom: 5px;" class="card shadow-none border">
                          <div class="card-body">
                            <ul style="padding: 0 0;height: 160px;overflow: scroll;">    
                                @foreach ($categories->childrenCategories as $item)
                                    <li><input name="category[]" id="category" style="margin-right: 3px" value="{{ $item->id }}" type="checkbox">{{ $item->category_name }}</li>
                                    <ul style="padding-left: 15px">
                                        @foreach ($item->childrenCategories as $child)
                                            @include('admin.category.childpost', ['child_category' => $child])
                                        @endforeach   
                                    </ul> 
                                @endforeach
                            </ul>
                          </div>
                        </div>

                        <div style="margin-bottom: 10px">
                            <span onclick="return showadd()" style="color: #188de0;text-decoration: underline;cursor: pointer;" class="addcategory">+ Thêm danh mục</span>
                        </div>

                        <div style="display: none" id="addshow">
                            <input style="height: 30px;margin-bottom: 10px;padding: 4px 8px;" class="form-control" type="text" name="category_name" id="category_name">

                            <select style="height: 30px;padding: 4px;" class="form-control" name="parent_id" id="parent_id">
                                <option value="0">Danh mục cha</option>
                                @foreach ($categories->childrenCategories as $item)
                                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                    @foreach ($item->childrenCategories as $child)
                                        @include('admin.category.childadd', ['child_category' => $child])
                                    @endforeach  
                                @endforeach
                            </select>

                            <button type="button" onclick="return addcategorypost()" style="margin-top: 10px;background-color: transparent;padding: 2px 15px;color: #36f !important;" class="btn btn-primary">Thêm danh mục</button>
                        </div>
                    </div> 
                </div>

                <div class="col-lg-12 col-md-12 mb20">
                  <div class="form-group">
                    <label class="form-label">Ảnh tiêu đề</label>
                    <div  class="img-div">
                      <label onclick="return changebutton()" style="width: 100%;height: 210px;display: block;">
                        <div style="width: 100%;height: 100%;border-radius: 8px;cursor: pointer;text-align: center" class="border" >
                          <i id="buttonupload" style="font-size: 70px;padding: 69px 0;" class="fal fa-cloud-upload"></i>
                          <img id='imgpreview' style="cursor: pointer;display: none;width: 100%;height: 100%;object-fit: cover;border-radius: 8px" src="{{ old('featured_image') }}" alt="">
                        </div>
                      </label>
                      <input style="display: none" type="text" name="featured_image" value="{{ old('featured_image') }}" id="featured_image">
                    </div>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </form>

  <script>
    $("form").bind("keypress", function (e) {
      if (e.keyCode == 13) {
          return false;
      }
    });
  </script>
@endsection