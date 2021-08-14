{{--  <li><input name="category[]" id="category" style="margin-right: 3px" value="{{ $child_category->id }}" type="checkbox">{{ $child_category->category_name }}</li>
<ul style="padding-left: 15px">
    @foreach ($child_category->childrenCategories as $child)
        @include('admin.category.childpost', ['child_category' => $child])
    @endforeach   
</ul>   --}}
@if (isset($category))
    @php
        $check = 0;
    @endphp
    @foreach ($category as $cate)
        @if ($child_category->id == $cate->id)
            @php
                $check = 1;
            @endphp
        @elseif(isset($maxid) && $maxid == $child_category->id)
            @php
                $check = 1;
            @endphp
        @endif
    @endforeach
    @if ($check == 1)
        <li><input checked name="category[]" id="category{{ $child_category->id }}" style="margin-right: 3px" value="{{ $child_category->id }}" type="checkbox"><label for="category{{ $child_category->id }}">{{ $child_category->category_name }}</label></li>
    @else
        <li><input name="category[]" id="category{{ $child_category->id }}" style="margin-right: 3px" value="{{ $child_category->id }}" type="checkbox"><label for="category{{ $child_category->id }}">{{ $child_category->category_name }}</label></li>
    @endif
@else
    <li><input name="category[]" id="category{{ $child_category->id }}" style="margin-right: 3px" value="{{ $child_category->id }}" type="checkbox"><label for="category{{ $child_category->id }}">{{ $child_category->category_name }}</label></li>
@endif
{{--  <li><input name="category[]" id="category" style="margin-right: 3px" value="{{ $child_category->id }}" type="checkbox">{{ $child_category->category_name }}</li>  --}}
<ul style="padding-left: 25px">
    @foreach ($child_category->childrenCategories as $child)
        @include('admin.category.childpost', ['child_category' => $child])
    @endforeach   
</ul> 