@extends('admin.layout.master')
@section('content')
    <style>
        td {
            font-size: 14px;
        }

        li {
            list-style: none;
        }

        .cke_contents.cke_reset {
            height: 400px !important;
        }

        .card-header {
            border-bottom: grey solid 1px;
            padding: 5px 10px;
        }
    </style>
      <div class="page-header d-lg-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">Chỉnh sửa bài viết</h4>
        </div>
      </div>
      <form action="{{ route('post.posteditplace', ['id' => $post->id]) }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
            
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
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chọn địa điểm</label>
                            <select class="form-control" name="place_id" id="place_id">
                                <option value="">Chọn địa điểm</option>
                                @foreach ($places as $place)
                                    @if ($place->id == $post->place_id)
                                        <option selected value="{{ $place->id }}">{{ $place->place_name }}</option>
                                    @else
                                        <option value="{{ $place->id }}">{{ $place->place_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tiêu đề</label>
                            <input value="{{ $post->title }}" onkeyup="return convert(this)" type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Nhập tiêu đề">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Đường dẫn</label>
                            <input value="{{ $post->slug }}"  type="text" name="slug" id="slug" class="form-control" id="exampleInputEmail1" placeholder="Nhập đường dẫn">
                        </div>
        
                        <div class="">
                            <button onclick="resetbutton();" type="button" data-toggle="modal" data-target=".bd-example-modal-lg" style="padding: 3px 8px;width: auto;margin-bottom: 3px" type="submit" class="btn btn-block btn-outline-primary">Thêm media</button>
                            <textarea class="p-2" name="contents" id="content" cols="133" rows="10">{{ $post->contents }}</textarea>
                            <script src="{{ url('/ckeditor/ckeditor.js') }}"></script>
                            <script>
                                CKEDITOR.replace('content');
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div style="width: 100%;" class="card">
                    <div style="width: 100%;" class="card-body">
                        <div class="card-body" style="padding: 0 0;">
                            
                            <div style="background: #f7f7f7;;border: rgb(116, 107, 107) solid 1px;border-radius: 5px;">
                                <div class="card-header">
                                    <span class="textheader">Lưu</span>
                                </div>
                                <div class="card-body" style="padding: 3px 10px;">
                                    <div style="display: flex;margin-top: 10px">
                                        <div>
                                            <button style="font-size: 14px;padding: 3px 3px" class="btn btn-block btn-outline-primary">Lưu nháp</button>
                                        </div>
                                    </div>
                                    
                                    <div style="margin-top: 10px">
                                        <table>
                                            <tr>
                                                <td style="padding-right: 10px"><i class="fas fa-thermometer-half"></i></td>
                                                <td style="padding-right: 5px;color: #505458">Trạng thái: </td>
                                                <td style="color: #3c434a">
                                                    <select name="status" id="status">
                                                        @if ($post->status == 1)
                                                            <option selected value="1">Hoàn thiện</option>
                                                            <option value="0">Bản nháp</option>
                                                        @else
                                                            <option value="1">Hoàn thiện</option>
                                                            <option selected value="0">Bản nháp</option>
                                                        @endif
                                                        
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                
                                        <table style="margin-top: 10px">
                                            <tr>
                                                <td style="padding-right: 10px"><i class="fas fa-thermometer-half"></i></td>
                                                <td style="padding-right: 5px;color: #505458">Hiển thị: </td>
                                                <td style="color: #3c434a">
                                                    <select name="status_display" id="status_display">
                                                        @if ($post->status_display == 1)
                                                            <option selected value="1">Công khai</option>
                                                            <option value="0">Riêng tư</option>
                                                        @else
                                                            <option value="1">Công khai</option>
                                                            <option selected value="0">Riêng tư</option>
                                                        @endif
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                
                                </div>
                
                                <div class="card-header" style="border-top: grey solid 1px;padding: 3px 10px;">
                                    <button style="padding: 3px 8px;float: right;" type="submit" class="btn btn-primary">Lưu lại</button>
                                </div>
                            </div>

                            <div style="background: #f7f7f7;;border: rgb(116, 107, 107) solid 1px;border-radius: 5px;margin-top: 20px;margin-bottom: 10px">
                                <div class="card-header" >
                                    <span class="textheader">Ảnh đại diện</span>
                                </div>
                                <div class="card-body" style="padding: 3px 10px;">
                                    <button onclick="loadimage();changebuttonfeaturedimage()();" type="button" data-toggle="modal" data-target=".bd-example-modal-lg" style="padding: 3px 0px;width: auto;margin-bottom: 3px;border: none;background: transparent;text-decoration: underline;color: turquoise" type="submit" class="">Đặt ảnh đại diện</button>
                                    <input value="{{ $post->featured_image }}" style="display: none" type="text" name="featured_image" id="featured_image"><br>
                                    <div id="formpreview" style="width: 85px;height: 100px">
                                        <img style="object-fit: cover;width: 100%;height: 100%" id="imgaepriview" src="{{ $post->featured_image }}" alt="">
                                    </div>
                                </div>
                            </div>
                
                            <div style="background: #f7f7f7;;border: rgb(116, 107, 107) solid 1px;border-radius: 5px;margin-top: 20px">
                                <div class="card-header" >
                                    <span class="textheader">Thẻ</span>
                                </div>
                                <div class="card-body" style="padding: 3px 10px;">
                                    <div style="display: flex;margin-top: 10px">
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
                                        <input value="{{ $tagold }}"  name="tag" id="tag" style="width: 100%;margin-right: 10px" type="text">
                                        <button style="padding: 0 3px;width: auto;" class="btn btn-block btn-outline-primary">Thêm</button>
                                    </div>
                                    <span style="font-size: 13px">Phân cách các thẻ bằng dấu phẩy (,).</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>

        function resetbutton(){
            document.getElementById('divinsertmedia').innerHTML = '';
            $('#divinsertmedia').append('<button disabled onclick="return insertmedia()" type="button" id="insertmedia" class="btn btn-primary">Chèn ảnh</button>');
            loadimage();
        }

        function insertmedia(){
            $("#insertmedia").attr("disabled", true);
            var listimg = document.getElementById('check').value;
            var imgs = listimg.split(',');
            for(var i = 0;i < imgs.length;i++){
                CKEDITOR.instances.content.insertHtml( '<img src="'+imgs[i]+'" style="width: 150px;height: 150px" alt="">' );    
            }
            $('#mymodal').modal('hide');
        }

        function changebutton(){
            document.getElementById('divinsertmedia').innerHTML = '';
            $('#divinsertmedia').append('<button onclick="return insertpostmedia()" type="button" id="insertpostmedia" class="btn btn-primary">Đặt ảnh đại diện</button>');
        }

        function insertpostmedia() {
            $("#insertpostmedia").attr("disabled", true);
            var listimg = document.getElementById('check').value;
            var imgs = listimg.split(',');
            var len = Number(imgs.length) - 1;
            document.getElementById('featured_image').value = imgs[len];
            document.getElementById('imgaepriview').src = imgs[len];
            $('#mymodal').modal('hide');
        }
    </script>
@endsection