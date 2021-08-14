<li class="showicon"><a class="linkbut" href="#">{{ $child_category->category_name }}</a>
    <span class="iconflex"> 
        <i onclick="return loadmodaleditcategory({{ $child_category->id }});" data-placement="top" data-toggle="tooltip" title="" data-original-title="Chỉnh sửa danh mục" class="fas fa-pen iconcategory"></i>
        <i style="color: red !important;" onclick="return deletecategory({{ $child_category->id }});" data-placement="top" data-toggle="tooltip" title="" data-original-title="Xóa danh mục" class="fas fa-trash-alt iconcategory"></i>
    </span>
    <ul>
        @if (count($child_category->childrenCategories) > 0)
            @foreach ($child_category->childrenCategories as $child)
                @include('admin.category.childcategoy', ['child_category' => $child])
            @endforeach
        @endif
        <li class="addcategory"><button onclick="return loadmodalcategory({{ $child_category->id }})" style="width: 100%;text-align: left" type="button" data-toggle="modal" data-target=".modalx"><i class="si si si-plus"></i> Thêm danh mục con mới</button></li>
    </ul>
</li>