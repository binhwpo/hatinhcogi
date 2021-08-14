<option value="{{ $child_category->id }}">{{ $child_category->category_name }}</option>
@foreach ($child_category->childrenCategories as $child)
    @include('admin.category.childadd', ['child_category' => $child])
@endforeach  