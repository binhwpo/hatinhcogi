<div id="contentcategory">
    <label class="form-label">Danh mục</label>
    <div style="margin: 0 0;margin-bottom: 5px;" class="card shadow-none border">
      <div class="card-body">
        <ul style="padding: 0 0;height: 160px;overflow: scroll;">    
            @if (isset($post))
                @foreach ($categories->childrenCategories as $item)
                    @php
                        $check = 0;
                        $category = $post->category;
                    @endphp
                    @foreach ($post->category as $cate)
                        @if ($item->id == $cate->id || $item->id == $maxid)
                            @php
                                $check =1;
                            @endphp
                        @endif
                    @endforeach
                    @if ($check == 1)
                        <li><input checked name="category[]" id="category{{ $item->id }}" style="margin-right: 3px" value="{{ $item->id }}" type="checkbox"><label for="category{{ $item->id }}">{{ $item->category_name }}</label></li>
                    @else
                        <li><input name="category[]" id="category{{ $item->id }}" style="margin-right: 3px" value="{{ $item->id }}" type="checkbox"><label for="category{{ $item->id }}">{{ $item->category_name }}</label></li>
                    @endif
                    <ul style="padding-left: 15px">
                        @foreach ($item->childrenCategories as $child)
                            @include('admin.category.childpost', ['child_category' => $child,'category' => $category])
                        @endforeach   
                    </ul> 
                @endforeach
            @else
                @foreach ($categories->childrenCategories as $item)
                    <li><input name="category[]" id="category{{ $item->id }}" style="margin-right: 3px" value="{{ $item->id }}" type="checkbox"><label for="category{{ $item->id }}">{{ $item->category_name }}</label></li>
                    <ul style="padding-left: 25px">
                        @foreach ($item->childrenCategories as $child)
                            @include('admin.category.childpost', ['child_category' => $child])
                        @endforeach   
                    </ul> 
                @endforeach
            @endif
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