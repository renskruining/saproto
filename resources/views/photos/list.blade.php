@extends('website.layouts.default-nobg')

@section('page-title')
    Albums
@endsection

@section('content')

    @foreach($albums as $key => $album)
        <div class="col-md-4 col-xs-6">
            <a href="{{ route('photo::album::list', ['id' => $album->id]) }}" class="album-link">
                <div class="album"
                     style="background-image: url('{!! $album->primary_photo_extras->url_m !!}')">
                    <div class="album-name">
                        {{ $album->title->_content }}
                    </div>
                </div>
            </a>
        </div>
    @endforeach

@endsection
