@if (isset($group))
    <div id="contentpermission" class="form-group">
        <label class="form-label">Danh sách quyền</label>
        {{-- <span style="cursor: pointer;text-decoration: underline;color: rgb(56, 27, 221)" onclick="return checkall()">Chọn tất cả</span> <span style="margin-left: 15px;cursor: pointer;text-decoration: underline;color: rgb(56, 27, 221)" onclick="return uncheckall()">Bỏ chọn tất cả</span>  --}}
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
@else
    <div id="contentpermission" class="form-group">
        <label class="form-label">Danh sách quyền</label>
        {{-- <span style="cursor: pointer;text-decoration: underline;color: rgb(56, 27, 221)" onclick="return checkall()">Chọn tất cả</span> <span style="margin-left: 15px;cursor: pointer;text-decoration: underline;color: rgb(56, 27, 221)" onclick="return uncheckall()">Bỏ chọn tất cả</span>  --}}
        <table style="width: 100%">
        
        @php  
            $check = 0;
        @endphp
        @foreach ($permissions as $item)
            @php
                $check++;
                if ($check == 1){
                echo '<tr>';
                }
            @endphp
            <td><input class="checkboxper" value="{{ $item->id }}" type="checkbox" name="permissions[]" id=""><span class="textper">{{ $item->permission_name }}</span></td>
            @php
            if ($check == 4){
                $check = 0;
                echo '</tr>';
            }
            @endphp
        @endforeach
        </table>
    </div>
@endif