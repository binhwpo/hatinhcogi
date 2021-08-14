<div id="divmodalcategory">
    <form action="{{ route('category.postadd') }}" method="POST">
        @csrf
        <div class="modal-header">
            <h6 class="modal-title">Thêm danh mục mới</h6><button aria-label="Close" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            @if (isset($category))
                <span>Thêm danh mục con cho danh mục {{ $category->category_name }}</span>
                <input value="{{ $category->id }}" name="checkcategory" id="checkcategory" style="display: none" type="text" >
            @else
                <input value="0" name="checkcategory" id="checkcategory" style="display: none" type="text" >
            @endif
            <div class="form-group">
                <label for="">Tên danh mục</label>
                <div class="input-icon">
                    <input onkeyup="return convert(this)" id="category_name" name="category_name" type="text" class="form-control" placeholder="Tên danh mục">
                </div>
            </div>

            <div class="form-group">
                <label for="">Slug</label>
                <div class="input-icon">
                    <input id="slug" name="slug" type="text" class="form-control" placeholder="Slug">
                </div>
            </div>

            <div class="form-group">
                <label for="">Mô tả</label>
                <div class="input-icon">
                    <input id="description" name="description" type="text" class="form-control" placeholder="Mô tả">
                </div>
            </div>

            
            <div class="form-group">
                <div style="display: flex">
                    <span style="padding: 8px 3px 0 3px;">Icon </span>
                    <button onclick="return loadimage()" type="button" data-toggle="modal" data-target=".bd-example-modal-lg" style="border: none;background: transparent;font-size: 20px" type="submit" class=""><i class="fas fa-cloud-upload-alt"></i></button>
                </div>
                <div class="input-icon">
                    <input id="icon" name="icon" type="text" class="form-control" placeholder="Icon">
                </div>
            </div>

            <div class="form-group">
                <label class="custom-switch">
                    <span style="padding-top: 4px;" class="custom-switch-description mr-2">Trạng thái</span>
                    <input checked name="status" id="status" type="checkbox" name="custom-switch-checkbox3" class="custom-switch-input">
                    <span class="custom-switch-indicator custom-radius"></span>
                </label>

                <label style="margin-left: 50px" class="custom-switch">
                    <span style="padding-top: 4px;" class="custom-switch-description mr-2">Mega menu</span>
                    <input name="megamenu" id="megamenu" type="checkbox" name="custom-switch-checkbox3" class="custom-switch-input">
                    <span class="custom-switch-indicator custom-radius"></span>
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Lưu</button> 
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>