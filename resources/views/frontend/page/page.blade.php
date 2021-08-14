@extends('frontend.layout1.master')

@section('content')
    <div style="padding-top: 0;padding-bottom: 40px" class="container-fluid contentpage">
        <div class="container">
            <div class="row">
                <div class="col-md-12 blog-image-larger">
                    <div class="text-blog-post">
                        {!! html_entity_decode($page->contents) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection