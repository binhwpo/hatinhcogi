<div id="listimg" class="row">
    @foreach ($media as $item)
        <div onclick="return selectimage({{ $item->id }})" id="listmedia{{ $item->id }}" class="col-lg-2 itemimg ">
            <img id="img{{ $item->id }}" class="imgmodal" src="http://{{ $item->ftp->host }}{{ $item->image_url }}" alt="">
            <span onclick="return opennotifi({{ $item->id }})" class="deletebutton"><i class="fe fe-trash-2"></i></span>
        </div>
    @endforeach
</div>