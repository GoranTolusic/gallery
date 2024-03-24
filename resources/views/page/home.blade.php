<!DOCTYPE html>
<html lang="en">
    @include('layouts.partials.head')
    <body>
        @include('layouts.partials.header')
            @if($settings['home_banner_picture'])
            <div class="background-image" style="background-image: url('/background-picture/{{ $settings['home_banner_picture'] }}')">
            @else
            <div class="background-image">
            @endif
                <div class="quote">
                    <p>{{$quote}}</p>
                    @if($quoteAuthor)
                        {{ $quoteAuthor }}
                    @endif
                </div>
            </div>
        @include('layouts.partials.footer')
    </body>
</html>
