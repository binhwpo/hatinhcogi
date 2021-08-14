@extends('admin.layout.master')
@section('content')
    <div class="page-header d-lg-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">Quản lý danh mục</h4>
        </div>
    </div>
    <style>
        .addcategory {
            background-color: rgb(189 189 243) !important;
        }

        .modal-content {
            height: auto !important;
        }

        .modal-header {
            padding: 10px 10px !important;
        }

        .modal-body {
            padding: 10px 10px !important;
        }

        .modal-footer {
            -webkit-justify-content: flex-end;
        }

        #tree2 li {
            position: relative;
        }

        .iconcategory {
            display: inline-block !important;
            cursor: pointer;
        }

        .iconflex {
            display: none;
            float: right;
        }

        .showicon:hover .iconflex {
            display: block;
        }

    </style>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <ul id="tree2">
                        @foreach ($categories as $item)
                            <li class="showicon"><a class="linkbut" href="#">{{ $item->category_name }}</a>
                                <span class="iconflex"> 
                                    <i onclick="return loadmodaleditcategory({{ $item->id }});" data-placement="top" data-toggle="tooltip" title="" data-original-title="Chỉnh sửa danh mục" class="fas fa-pen iconcategory"></i>
                                    <i style="color: red !important;" onclick="return deletecategory({{ $item->id }});" data-placement="top" data-toggle="tooltip" title="" data-original-title="Xóa danh mục" class="fas fa-trash-alt iconcategory"></i>
                                </span>
                                <ul>
                                    @if (count($item->childrenCategories) > 0)
                                        @foreach ($item->childrenCategories as $child)
                                            @include('admin.category.childcategoy', ['child_category' => $child])
                                        @endforeach
                                    @endif
                                    <li class="addcategory"><button onclick="return loadmodalcategory({{ $item->id }})" style="width: 100%;text-align: left" type="button" data-toggle="modal" data-target=".modalx"><i class="si si si-plus"></i> Thêm danh mục con mới</button></li>
                                </ul>
                            </li>
                        @endforeach
                        <li class="addcategory"><button onclick="return loadmodalcategory(0)" style="width: 100%;text-align: left" type="button" data-toggle="modal" data-target=".modalx"><i class="si si si-plus"></i> Thêm danh mục mới</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modalx"  id="modalcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div id="contentmodalcategory" class="modal-content modal-content-demo">
                <div id="divmodalcategory"></div>
            </div>
        </div>
    </div>

    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#insertmedia").click(function(){
                $("#insertmedia").attr("disabled", true);
                var listimg = document.getElementById('check').value;
                var imgs = listimg.split(',');
                document.getElementById('icon').value = imgs[0];
                $('#mymodal').modal('hide');
            });
        });

        

        function loadmodalcategory(id) {
            $(document).ready(function(){
                $.ajax({
                    url:"admin/category/add",
                    data: {
                        id:id
                    },
                    method:'get',
                    success: function(data){
                        $( "#divmodalcategory" ).remove();
                        $( "#contentmodalcategory" ).append( data );
                    },
                });
            });
        }

        function loadmodaleditcategory(id) {
            $(document).ready(function(){
                $.ajax({
                    url:"admin/category/edit",
                    data: {
                        id:id
                    },
                    method:'get',
                    success: function(data){
                        $( "#divmodalcategory" ).remove();
                        $( "#contentmodalcategory" ).append( data );
                        $('#modalcategory').modal('show');
                    },
                    error: function(){
                        alert('Lỗi hệ thống');
                    },
                });
            });
        }

        function convert(e){
            var Text = e.value;
            {{--  Text = Text.toLowerCase() .replace(/[^\w ]+/g,'').replace(/ +/g,'-');  --}}
            //Đổi chữ hoa thành chữ thường
            slug = Text.toLowerCase();
        
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');

            $("#slug").val(slug); 
        }

        function deletecategory(id){
            var answer1 = confirm('Bạn có chắc chắn muốn xóa danh mục này không, nếu chắc chắn muốn xóa nhấn vào ok còn chưa chắc chắn nhấn cancel?');

            if (answer1) {
                var answer2 = confirm('Hỏi lại lần nữa cho chắc?');

                if (answer2) {
                    window.location.href = "admin/category/delete/"+id;
                }
            }
        }

        $('.linkbut').click(function(event){
            event.preventDefault();
        });
    </script>
@endsection