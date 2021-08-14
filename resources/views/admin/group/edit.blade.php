@extends('admin.layout.master')
@section('content')
  <div class="page-header d-lg-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Sửa nhóm tài khoản</h4>
    </div>
  </div>
  
  <form id="formpost" method="POST" action="{{ route('group.update', ['group'=>$group->id]) }}">
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
                  <label class="form-label">Tên nhóm</label>
                  <input value="{{ $group->group_name }}" onkeyup="return convert(this)" name="group_name" id="group_name" class="form-control" placeholder="Tên nhóm">
                </div>
              </div>

              <div class="col-md-6 mb20">
                <div class="form-group">
                  <label class="form-label">Đường dẫn</label>
                  <input value="{{ $group->slug }}" name="slug" id="slug" class="form-control" placeholder="Đường dẫn">
                </div>
              </div>

              <div class="col-md-12 mb20">
                <div class="form-group">
                  <label class="form-label">Danh sách quyền</label> 
                  <span style="cursor: pointer;text-decoration: underline;color: rgb(56, 27, 221)" onclick="return checkall()">Chọn tất cả</span> <span style="margin-left: 15px;cursor: pointer;text-decoration: underline;color: rgb(56, 27, 221)" onclick="return uncheckall()">Bỏ chọn tất cả</span>
                  <table style="width: 100%">
                    @php
                      $check = 0;
                    @endphp
                    @foreach ($permissions as $item)
                      @php
                          $check++;
                          $checkper = 0;
                          if ($check == 1){
                            echo '<tr>';
                          }
                      @endphp
                      @foreach ($group->permissions as $ite)
                        @if ($item->id == $ite->id)
                            @php
                              $checkper = 1;
                            @endphp
                        @endif
                      @endforeach
                        @if ($checkper == 1)
                          <td><input class="checkboxper" checked value="{{ $item->id }}" type="checkbox" name="permissions[]" id=""><span class="textper">{{ $item->permission_name }}</span></td>
                        @else
                          <td><input class="checkboxper" value="{{ $item->id }}" type="checkbox" name="permissions[]" id=""><span class="textper">{{ $item->permission_name }}</span></td>
                        @endif
                      @php
                        if ($check == 4){
                          $check = 0;
                          echo '</tr>';
                        }
                      @endphp
                    @endforeach
                  </table>
                </div>
              </div>

              <div style="position: relative;margin-bottom: 40px;" class="col-md-12 mb20">
                  <button style="position: absolute;left: 12px;" class="btn btn-primary">Lưu nhóm tài khoản</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection