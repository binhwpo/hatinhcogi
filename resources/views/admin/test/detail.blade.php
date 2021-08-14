<div id="mediadetail">
    <span>CHI TIẾT ĐÍNH KÈM</span><br>
    <img style="max-width: 80%;max-height: 70px;" class="" src="{{ $media->image_url }}" alt="">
    @php
        $item = explode("/", $media->image_url);
        $count = count($item) - 1;
    @endphp
    <br><span style="font-size: 16px;font-weight: bold">{{ $item[$count] }}</span>
    <br><span style="font-size: 14px;color: rgb(129, 111, 111)">{{ $media->created_at->format('H:i d/m/Y') }}</span>
    <br><span style="color: red">Xóa vĩnh viễn</span>
</div>