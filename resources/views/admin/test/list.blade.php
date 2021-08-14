<div id="medialist" style="height: 315px;overflow-y: scroll;" class="row">
    @foreach ($media as $item)
      <div style="margin-top: 4px;height: 150px;" class="col-md-2">
        <label for="{{ $item->id }}">
          <img id="img{{ $item->id }}" onclick="return selectimage({{ $item->id }})" class="imagedisplay" src="{{ $item->image_url }}" alt="">
        </label>
      </div>
    @endforeach
    
    @foreach ($media as $item)
      <input name="imgselect[]" style="display: none" type="checkbox" value="{{ $item->id }}" id="{{ $item->id }}">
    @endforeach
  </div>
</div>