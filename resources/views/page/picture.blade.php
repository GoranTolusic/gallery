<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head')
<body>
    @include('layouts.partials.header')
    <div class="image-container">
        <img class="image" src="/images/{{$picture->url_path}}" alt="Slika" title="{{strtoupper($picture->title)}} - {{$picture->description}}">
    </div>
    @include('layouts.partials.footer')
</body>
</html>
