<div id="listicon" class="row">
    @foreach ($icon as $item)
        <div onclick="return selecticon({{ $item->id }})" id="listicon{{ $item->id }}" class="col-lg-1 iconitem">
            {!! html_entity_decode($item->icon) !!}
        </div>
    @endforeach
</div>