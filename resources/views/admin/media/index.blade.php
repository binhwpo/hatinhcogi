@extends('admin.layout.master')
@section('content')
    <style>
        .mb-1.font-weight-semibold.mt-4 {
            overflow: hidden;
        }
    </style>
    <div class="page-header d-lg-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">Quản lý file</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3">
            <div class="card">
                {{--  <div class="card-body d-flex">
                    <div class="chart-circle chart-circle-sm chart-circle-primary ml-0 mr-4" data-value="0.85" data-thickness="5" data-color="#3366ff">
                        <div class="mx-auto chart-circle-value text-center fs-14">85%</div>
                    </div>
                    <div class="mt-3">
                        <h5 class="mb-1 font-weight-bold">Storage</h5>
                        <p class="mb-0"><span class="text-muted">13.65gb</span> / <span class="text-muted">16gb</span></p>
                    </div>
                </div>  --}}
                <div class="card-body">
                    <div class="list-group list-group-transparent mb-0 file-manger">
                        <a href="#all" data-toggle="tab" class="list-group-item list-group-item-action d-flex align-items-center px-0 active">
                            <span class="icons"><i class="ri-shield-keyhole-line"></i></span> Tất cả
                        </a>
                        <a href="#tabimages" data-toggle="tab" class="list-group-item list-group-item-action d-flex align-items-center px-0">
                            <span class="icons"><i class="ri-image-line"></i></span> Ảnh
                        </a>
                        <a href="#tabvideos" data-toggle="tab" class="list-group-item list-group-item-action d-flex align-items-center px-0">
                            <span class="icons"><i class="ri-live-line"></i></span>	Videos
                        </a>
                        <a href="#tabdocs" data-toggle="tab" class="list-group-item list-group-item-action d-flex align-items-center px-0">
                            <span class="icons"><i class="ri-folders-line"></i></span> Tài liệu
                        </a>
                        <a href="#tabmore" data-toggle="tab" class="list-group-item list-group-item-action d-flex align-items-center px-0">
                            <span class="icons"><i class="ri-indent-decrease"></i></span> Khác
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="row">
                <div class="col mb-4">
                    <label class="btn btn-primary" for="mediaupload">
                        <i style="color: #fff" class="fe fe-plus"></i> Tải lên file mới
                    </label>
                    <input onchange="return uploadmediaadmin()" multiple style="display: none" type="file" name="mediaupload" id="mediaupload">
                    {{--  <a href="#" class="btn btn-light"><i class="fe fe-folder"></i> Tạo thư mục mới</a>  --}}
                </div>
                {{--  <div class="col col-auto mb-4">
                    <div class="form-group w-100">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <i class="fe fe-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Search Files">
                        </div>
                    </div>
                </div>  --}}
            </div>
            <div style="padding: 0 0" class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="all">
                        <div id="listmedia" class="row">
                            @foreach ($media as $item)
                                <div id="listmedia{{ $item->id }}" class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="card border p-0 shadow-none">
                                        <div class="d-flex align-items-center px-4 pt-4">
                                            <div class="float-right ml-auto">
                                                <div class="btn-group ml-3 mb-0">
                                                    <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i class="fe fe-share mr-2"></i> Chia sẻ</a>
                                                        <a class="dropdown-item" href="#"><i class="fe fe-download mr-2"></i> Tải xuống</a>
                                                        <span style="cursor: pointer" onclick="return opennotifi({{ $item->id }})" class="dropdown-item" href="#"><i class="fe fe-trash mr-2"></i> Xóa</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 text-center">
                                            @php
                                                $arrname = explode('/', $item->image_url);
                                                $name = $arrname[count($arrname) - 1];
                                            @endphp
                                            <div class="file-manger-icon">
                                                @if ($item->type == 'img')
                                                    <img src="http://{{ $item->ftp->host }}{{ $item->image_url }}" alt="img" class="br-7">
                                                @elseif ($item->type == 'video')
                                                    <i class="fas fa-video"></i>
                                                @elseif ($item->type == 'doc')
                                                    <i class="fal fa-file-alt"></i>
                                                @else
                                                    <i class="fal fa-file"></i>
                                                @endif
                                            </div>
                                            <h6 class="mb-1 font-weight-semibold mt-4"><a target="_blank" href="http://{{ $item->ftp->host }}{{ $item->image_url }}">{{ $name }}</a></h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane" id="tabimages">
                        <div id="listimg" class="row">
                            @foreach ($img as $item)
                                <div id="listimg{{ $item->id }}" class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="card border p-0 shadow-none">
                                        <div class="d-flex align-items-center px-4 pt-4">
                                            <div class="float-right ml-auto">
                                                <div class="btn-group ml-3 mb-0">
                                                    <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i class="fe fe-share mr-2"></i> Chia sẻ</a>
                                                        <a class="dropdown-item" href="#"><i class="fe fe-download mr-2"></i> Tải xuống</a>
                                                        <span style="cursor: pointer" onclick="return opennotifi({{ $item->id }})" class="dropdown-item" href="#"><i class="fe fe-trash mr-2"></i> Xóa</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 text-center">
                                            @php
                                                $arrname = explode('/', $item->image_url);
                                                $name = $arrname[count($arrname) - 1];
                                            @endphp
                                            <div class="file-manger-icon">
                                                <img src="http://{{ $item->ftp->host }}{{ $item->image_url }}" alt="img" class="br-7">
                                            </div>
                                            <h6 class="mb-1 font-weight-semibold mt-4"><a target="_blank" href="http://{{ $item->ftp->host }}{{ $item->image_url }}">{{ $name }}</a></h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="tab-pane" id="tabvideos">
                        <div id="listvideo" class="row">
                            @foreach ($video as $item)
                                <div id="listvideo{{ $item->id }}" class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="card border p-0 shadow-none">
                                        <div class="d-flex align-items-center px-4 pt-4">
                                            <div class="float-right ml-auto">
                                                <div class="btn-group ml-3 mb-0">
                                                    <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i class="fe fe-share mr-2"></i> Chia sẻ</a>
                                                        <a class="dropdown-item" href="#"><i class="fe fe-download mr-2"></i> Tải xuống</a>
                                                        <span style="cursor: pointer" onclick="return opennotifi({{ $item->id }})" class="dropdown-item" href="#"><i class="fe fe-trash mr-2"></i> Xóa</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 text-center">
                                            @php
                                                $arrname = explode('/', $item->image_url);
                                                $name = $arrname[count($arrname) - 1];
                                            @endphp
                                            <div class="file-manger-icon">
                                                <i class="fas fa-video"></i>
                                            </div>
                                            <h6 class="mb-1 font-weight-semibold mt-4"><a target="_blank" href="http://{{ $item->ftp->host }}{{ $item->image_url }}">{{ $name }}</a></h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="tab-pane" id="tabdocs">
                        <div id="listdocx" class="row">
                            @foreach ($doc as $item)
                                <div id="listdocx{{ $item->id }}" class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="card border p-0 shadow-none">
                                        <div class="d-flex align-items-center px-4 pt-4">
                                            <div class="float-right ml-auto">
                                                <div class="btn-group ml-3 mb-0">
                                                    <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i class="fe fe-share mr-2"></i> Chia sẻ</a>
                                                        <a class="dropdown-item" href="#"><i class="fe fe-download mr-2"></i> Tải xuống</a>
                                                        <span style="cursor: pointer" onclick="return opennotifi({{ $item->id }})" class="dropdown-item" href="#"><i class="fe fe-trash mr-2"></i> Xóa</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 text-center">
                                            @php
                                                $arrname = explode('/', $item->image_url);
                                                $name = $arrname[count($arrname) - 1];
                                            @endphp
                                            <div class="file-manger-icon">
                                                <i class="fal fa-file-alt"></i>
                                            </div>
                                            <h6 class="mb-1 font-weight-semibold mt-4"><a target="_blank" href="http://{{ $item->ftp->host }}{{ $item->image_url }}">{{ $name }}</a></h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="tab-pane" id="tabmore">
                        <div id="listother" class="row">
                            @foreach ($other as $item)
                                <div id="listother{{ $item->id }}" class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="card border p-0 shadow-none">
                                        <div class="d-flex align-items-center px-4 pt-4">
                                            <div class="float-right ml-auto">
                                                <div class="btn-group ml-3 mb-0">
                                                    <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i class="fe fe-share mr-2"></i> Chia sẻ</a>
                                                        <a class="dropdown-item" href="#"><i class="fe fe-download mr-2"></i> Tải xuống</a>
                                                        <span style="cursor: pointer" onclick="return opennotifi({{ $item->id }})" class="dropdown-item" href="#"><i class="fe fe-trash mr-2"></i> Xóa</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 text-center">
                                            @php
                                                $arrname = explode('/', $item->image_url);
                                                $name = $arrname[count($arrname) - 1];
                                            @endphp
                                            <div class="file-manger-icon">
                                                <i class="fal fa-file"></i>
                                            </div>
                                            <h6 class="mb-1 font-weight-semibold mt-4"><a target="_blank" href="http://{{ $item->ftp->host }}{{ $item->image_url }}">{{ $name }}</a></h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  @include('admin.media.upload')  --}}
    <script>
        alert=function(){};
    </script>
@endsection