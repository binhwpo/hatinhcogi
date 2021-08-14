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
            <h4 class="page-title">Chỉnh sửa bài viết</h4>
        </div>
      </div>
      <form action="{{ route('post.update', ['post' => $post->id]) }}" enctype="multipart/form-data" method="POST">
        @csrf
        {{ method_field('PATCH') }}
        <div class="row">
            <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">
            <div class="col-12 col-lg-9">
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
                            <div class="col-md-6 mb20">
                                <div class="form-group">
                                    <label class="form-label">Tiêu đề</label>
                                    <input value="{{ $post->title }}" onkeyup="return convert(this)" name="title" id="title" class="form-control" placeholder="Nhập tiêu đề">
                                </div>
                              </div>
                            <div class="col-md-6 mb20">
                                <div class="form-group">
                                    <label class="form-label">Đường dẫn</label>
                                    <input value="{{ $post->slug->slug }}" name="slug" id="slug" class="form-control" placeholder="Nhập đường dẫn">
                                </div>
                            </div>

                            <div class="col-md-12 mb20">
                                <div class="form-group">
                                    <label class="form-label">Thẻ tag</label>
                                    @php
                                        $tagold = '';
                                    @endphp
                                    @foreach ($post->tag as $item)
                                        @if ($tagold == '')
                                            @php
                                                $tagold = $item->tag_name;
                                            @endphp
                                        @else
                                            @php
                                                $tagold = $tagold.','.$item->tag_name;                                               
                                            @endphp
                                        @endif
                                    @endforeach
                                    <input placeholder="Nhập tag" class="form-control" name="tags" id="tags" type="text" value="{{ $tagold }}" data-role="tagsinput" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb20">
                                <label class="form-label">Nội dung</label>
                                <button onclick="return resetbutton()" type="button" style="padding: 3px 8px;width: auto;margin-bottom: 3px" class="btn btn-block btn-outline-primary">Thêm media</button>
                                <textarea class="p-2" name="contents" id="content" cols="133" rows="10">{{ $post->contents }}</textarea>
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
                                            @php
                                                $check = 0;
                                                $category = $post->category;
                                            @endphp
                                            @foreach ($post->category as $cate)
                                                @if ($item->id == $cate->id)
                                                    @php
                                                        $check =1;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($check == 1)
                                                <li><input checked name="category[]" id="category" style="margin-right: 3px" value="{{ $item->id }}" type="checkbox">{{ $item->category_name }}</li>
                                            @else
                                                <li><input name="category[]" id="category" style="margin-right: 3px" value="{{ $item->id }}" type="checkbox">{{ $item->category_name }}</li>
                                            @endif
                                            <ul style="padding-left: 15px">
                                                @foreach ($item->childrenCategories as $child)
                                                    @include('admin.category.childpost', ['child_category' => $child,'category' => $category])
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
                                    {{--  <i id="buttonupload" style="font-size: 70px;padding: 69px 0;" class="fal fa-cloud-upload"></i>  --}}
                                    <img id='imgpreview' style="cursor: pointer;width: 100%;height: 100%;object-fit: cover;border-radius: 8px" src="{{ $post->featured_image }}" alt="">
                                  </div>
                                </label>
                                <input style="display: none" type="text" name="featured_image" value="{{ $post->featured_image }}" id="featured_image">
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

        console.log($('.img-div label').width());
    </script>
@endsection