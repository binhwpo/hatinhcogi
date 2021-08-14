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
        <h4 class="page-title">Thêm địa điểm mới</h4>
    </div>
  </div>
  
  <form id="formplace" method="POST" action="{{ route('place.store') }}">
    @csrf
    <div class="row">
      <div class="col-lg-12 col-xl-8">
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
              
              <div class="col-md-12 col-lg-12 col-xl-6 mb20">
                <div class="form-group">
                  <label class="form-label">Tên địa điểm</label>
                  <input value="{{ old('place_name') }}" onkeyup="return convert(this)" name="place_name" id="place_name" class="form-control" placeholder="Nhập tên địa điểm">
                </div>
              </div>
              <div class="col-md-12 col-lg-12 col-xl-6 mb20">
                <div class="form-group">
                  <label class="form-label">Đường dẫn</label>
                  <input value="{{ old('slug') }}" name="slug" id="slug" class="form-control" placeholder="Nhập đường dẫn">
                </div>
              </div>

              <div id="mobile-infor" class="col-md-12 col-lg-12 mb20 mobile-infor">
                <div class="row">
                  <div class="col-lg-12 col-md-12 mb20">
                    <div class="form-group">
                      <label class="form-label">Trạng thái địa điểm</label>
                      <select class="form-control" name="status" id="status">
                        <option value="0">Chưa xác minh</option>
                        <option value="1">Đã xác minh</option>
                      </select>
                    </div>
                  </div>
  
                  <div id="addcategory" class="col-md-6 mb20">
                      <div id="contentcategory">
                          <label class="form-label">Danh mục</label>
                          <div style="margin: 0 0;margin-bottom: 5px;" class="card shadow-none border">
                            <div class="card-body">
                              <ul style="padding: 0 0;height: 160px;overflow: scroll;">    
                                  @foreach ($categories->childrenCategories as $item)
                                      <li><input name="category[]" id="category{{ $item->id }}" style="margin-right: 3px" value="{{ $item->id }}" type="checkbox"><label for="category{{ $item->id }}">{{ $item->category_name }}</label></li>
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
  
                              <button type="button" onclick="return addcategoryplace()" style="margin-top: 10px;background-color: transparent;padding: 2px 15px;color: #36f !important;" class="btn btn-primary">Thêm danh mục</button>
                          </div>
                      </div> 
                  </div>


                  <div id="addservice" class="col-md-6 mb20">
                    <div id="">
                        <label class="form-label">Dịch vụ</label>
                        <div style="margin: 0 0;margin-bottom: 5px;" class="card shadow-none border">
                          <div class="card-body">
                            <ul id="contentservice" style="padding: 0 0;height: 160px;overflow: scroll;">    
                                @foreach ($services as $item)
                                    <li><input name="services[]" id="services{{ $item->id }}" style="margin-right: 3px" value="{{ $item->id }}" type="checkbox"><label for="services{{ $item->id }}">{!! html_entity_decode($item->icon->icon) !!}{{ $item->name_services }}</label></li>
                                @endforeach
                            </ul>
                          </div>
                        </div>
  
                        <div style="margin-bottom: 10px">
                            <span onclick="return showformservice()" style="color: #188de0;text-decoration: underline;cursor: pointer;" class="addcategory">+ Thêm dịch vụ</span>
                        </div>
  
                        <div style="display: none" id="formservice" class="row">
                          <div class="col-md-1">
                            <label style="margin-bottom: .1rem;" for="">Icon</label>
                            <div onclick="return openicon()" style="width: 36px;height: 36px;border: 1px solid #d3dfea;border-radius: 5px;cursor: pointer;">
                              <span id="iconpro" style="display: block;;padding: 5px 11px;" for=""><i class="fa fa-plus" aria-hidden="true"></i></span>
                            </div>
                          </div>
      
                          <div class="col-md-8">
                            <label style="margin-bottom: .1rem;" for="">Tên dịch vụ</label>
                            <input type="text" name="name_services" id="name_services" class="form-control">
                          </div>
      
                          <div class="col-md-3">
                            <button type="button" onclick="return addformservice()" class="btn btn-primary" style="margin-top: 27px;padding: 5px 17px;">Thêm</button>
                          </div>
                        </div>
                    </div> 
                  </div>

  
                  <div class="col-lg-6 col-md-6 mb20">
                    <div class="form-group">
                      <label class="form-label">Ảnh bìa địa điểm</label>
                      <div class="img-div">
                        <label onclick="return changebuttoncover()" class="labelupload">
                          <div style="width: 100%;height: 100%;border-radius: 8px;cursor: pointer;text-align: center" class="border" >
                            <i id="buttonupload" class="fal fa-cloud-upload iupload"></i>
                            <img id='imgpreview' style="cursor: pointer;display: none;width: 100%;height: 100%;object-fit: cover;border-radius: 8px" src="{{ old('cover_image') }}" alt="">
                          </div>

                          <input style="display: none" type="text" name="cover_image" value="{{ old('cover_image') }}" id="cover_image">
                        </label>
                      </div>
                    </div>
                  </div>
                </div> 
              </div>

              <div class="col-md-12 col-lg-12 col-xl-6 mb20">
                <div class="form-group">
                  <label class="form-label">Giờ mở cửa (<span onclick="return showformtime()" style="color: rgb(30, 117, 199);text-decoration: underline;cursor: pointer;">Thêm giờ mở cửa</span>)</label>
                  <input type="hidden" id="schedule" name="schedule" value="">
                  <div style="display: none" id="formtime" class="row">
                    <div class="col-md-3">
                      <label for="">Thứ ngày</label>
                      <select class="form-control" style="display: block" name="" id="time">
                        <option value="0">Chọn ngày</option>
                        <option value="2">Thứ 2</option>
                        <option value="3">Thứ 3</option>
                        <option value="4">Thứ 4</option>
                        <option value="5">Thứ 5</option>
                        <option value="6">Thứ 6</option>
                        <option value="7">Thứ 7</option>
                        <option value="8">Chủ nhật</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="">Giờ mở cửa</label>
                      <input id="timeopen" class="form-control" type="time">
                    </div>
                    <div class="col-md-3">
                      <label for="">Giờ đóng cửa</label>
                      <input id="timeclose" class="form-control" type="time">
                    </div>
                    <div class="col-md-3">
                      <button type="button" onclick="return addformtime()" class="btn btn-primary" style="margin-top: 27px;padding: 5px 17px;">Thêm</button>
                    </div>
                  </div>

                  <table style="margin-top: 10px" id="listtime">
                  </table>
                </div>
              </div>

              <div class="col-md-12 col-lg-12 col-xl-6 mb20">
                <div class="form-group">
                  <label class="form-label">Thông tin về quán (<span onclick="return showforminfor()" style="color: rgb(30, 117, 199);text-decoration: underline;cursor: pointer;">Thêm thông tin</span>)</label>
                  <input type="hidden" id="infor" name="infor" value="">
                  <input type="hidden" id="numinfor" name="numinfor" value="0">
                  <div style="display: none" id="forminfor" class="row">
                    <div class="col-md-5">
                      <label style="margin-bottom: .1rem;" for="">Tên thông tin</label>
                      <select name="nameinfor" id="nameinfor" class="form-control">
                        <option value="Địa chỉ">Địa chỉ</option>
                        <option value="Số điện thoại">Số điện thoại</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Email">Email</option>
                        <option value="Website">Website</option>
                      </select>
                    </div>

                    <div class="col-md-5">
                      <label style="margin-bottom: .1rem;" for="">Thông tin</label>
                      <input type="text" name="value" id="value" class="form-control">
                    </div>

                    <div class="col-md-2">
                      <button type="button" onclick="return addforminfor()" class="btn btn-primary" style="margin-top: 27px;padding: 5px 17px;">Thêm</button>
                    </div>
                  </div>

                  <table style="margin-top: 10px" id="listinfor">
                  </table>
                </div>
              </div>

              <div class="col-md-12 col-lg-12 col-xl-12 mb20">
                <div class="form-group">
                  <label class="form-label">Ảnh của quán (<span onclick="return changebuttoninsert()" style="color: rgb(30, 117, 199);text-decoration: underline;cursor: pointer;">Thêm ảnh của quán</span>)</label>
                  <input type="hidden" id="media_place" name="media_place" value="">
                  <div id="listimgplace" class="row listimg">
                    
                  </div>
                </div>
              </div>

              <div class="col-md-12 mb20">
                <div class="form-group">
                  <label class="form-label">Thẻ tag</label>
                  <input placeholder="Nhập tag" class="form-control" name="tags" id="tags" type="text" value="{{ old('tags') }}" data-role="tagsinput" />
                </div>
              </div>
  
              <div class="col-md-12 mb20">
                <label class="form-label">Giới thiệu</label>
                <button onclick="return resetbutton()" type="button" style="padding: 3px 8px;width: auto;margin-bottom: 3px" class="btn btn-block btn-outline-primary">Thêm media</button>
                <textarea class="p-2" name="description" id="description" cols="133" rows="10">{{ old('description') }}</textarea>
                <script src="{{ url('/assets/plugins/ckeditor/ckeditor.js') }}"></script>
                <script>
                    CKEDITOR.replace('description');
                </script>
              </div>

              <div style="position: relative;margin-bottom: 40px;" class="col-md-12 mb20">
                  <button style="position: absolute;right: 15px;" class="btn btn-primary">Lưu địa điểm</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="laptop-infor" class="col-lg-4 col-xl-4 laptop-infor">
        <div style="width: 100%;" class="card">
            <div style="width: 100%;" class="card-body">
                <div class="col-lg-12 col-md-12 mb20">
                  <div class="form-group">
                    <label class="form-label">Trạng thái địa điểm</label>
                    <select class="form-control" name="status" id="status">
                      <option value="0">Chưa xác minh</option>
                      <option value="1">Đã xác minh</option>
                    </select>
                  </div>
                </div>

                <div id="addcategory" class="col-md-12 mb20">
                    <div id="contentcategory">
                        <label class="form-label">Danh mục</label>
                        <div style="margin: 0 0;margin-bottom: 5px;" class="card shadow-none border">
                          <div class="card-body">
                            <ul style="padding: 0 0;height: 160px;overflow: scroll;">    
                                @foreach ($categories->childrenCategories as $item)
                                    <li><input name="category[]" id="category{{ $item->id }}" style="margin-right: 3px" value="{{ $item->id }}" type="checkbox"><label for="category{{ $item->id }}">{{ $item->category_name }}</li>
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

                            <button type="button" onclick="return addcategoryplace()" style="margin-top: 10px;background-color: transparent;padding: 2px 15px;color: #36f !important;" class="btn btn-primary">Thêm danh mục</button>
                        </div>
                    </div> 
                </div>

                
                <div id="addservice" class="col-md-12 mb20">
                  <div id="">
                      <label class="form-label">Dịch vụ</label>
                      <div style="margin: 0 0;margin-bottom: 5px;" class="card shadow-none border">
                        <div class="card-body">
                          <ul id="contentservice" style="padding: 0 0;height: 160px;overflow: scroll;">    
                              @foreach ($services as $item)
                                  <li><input name="services[]" id="services{{ $item->id }}" style="margin-right: 3px" value="{{ $item->id }}" type="checkbox"><label for="services{{ $item->id }}">{!! html_entity_decode($item->icon->icon) !!}{{ $item->name_services }}</label></li>
                              @endforeach
                          </ul>
                        </div>
                      </div>

                      <div style="margin-bottom: 10px">
                          <span onclick="return showformservice()" style="color: #188de0;text-decoration: underline;cursor: pointer;" class="addcategory">+ Thêm dịch vụ</span>
                      </div>

                      <div style="display: none" id="formservice" class="row">
                        <div class="col-md-1">
                          <label style="margin-bottom: .1rem;" for="">Icon</label>
                          <div onclick="return openicon()" style="width: 36px;height: 36px;border: 1px solid #d3dfea;border-radius: 5px;cursor: pointer;">
                            <span id="iconpro" style="display: block;;padding: 5px 11px;" for=""><i class="fa fa-plus" aria-hidden="true"></i></span>
                          </div>
                        </div>
    
                        <div class="col-md-8">
                          <label style="margin-bottom: .1rem;" for="">Tên dịch vụ</label>
                          <input type="text" name="name_services" id="name_services" class="form-control">
                        </div>
    
                        <div class="col-md-3">
                          <button type="button" onclick="return addformservice()" class="btn btn-primary" style="margin-top: 27px;padding: 5px 17px;">Thêm</button>
                        </div>
                      </div>
                  </div> 
                </div>

                <div class="col-lg-12 col-md-12 mb20">
                  <div class="form-group">
                    <label class="form-label">Ảnh bìa địa điểm</label>
                    <div class="img-div">
                      <label onclick="return changebuttoncover()" class="labelupload">
                        <div style="width: 100%;height: 100%;border-radius: 8px;cursor: pointer;text-align: center" class="border" >
                          <i id="buttonupload" class="fal fa-cloud-upload iupload"></i>
                          <img id='imgpreview' style="cursor: pointer;display: none;width: 100%;height: 100%;object-fit: cover;border-radius: 8px" src="{{ old('cover_image') }}" alt="">
                        </div>
                      </label>
                      <input style="display: none" type="text" name="cover_image" value="{{ old('cover_image') }}" id="cover_image">
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

    if(Number($(window).width()) <= 1279){
      $('#laptop-infor').remove();
    }else{
      $('#mobile-infor').remove();
    }
  </script>
@endsection