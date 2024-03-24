<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head')
<body>
@include('layouts.partials.header')
    <main class="content">
        @if($settings['profile_picture'])
        <div class="container">
            <img src="profile-picture/{{$settings['profile_picture']}}" alt="Profile picture">
        </div>
        @else
        <div class="container">
            <img src="default/profile.webp" alt="Default profile picture">
        </div>
        @endif

        <section class="container">
            <h2>About me!</h2><br>
        </section>
        
        <section class="container-wrap">
            @if($settings['about'])
            @php
            $formated_text = nl2br($settings['about'])
            @endphp
            <p><?php echo $formated_text ?></p>
            @endif
        </section>
    </main>
    @include('layouts.partials.footer')
</body>
</html>
