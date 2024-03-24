<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head')
<body>
@include('layouts.partials.header')

    <main class="content">
        <section class="services-section">
            <div class="contact-container">
            <h2>Settings</h2>
                <form action="/admin/saveSettings" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="main-title">Main title:</label>
                        <input type="text" id="title" name="title" required placeholder="Enter your main title here" value="{{$settings['title']}}">
                    </div>
                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span><br><br>
                    @endif

                    <div class="form-group">
                        <label for="about">About me:</label>
                        <textarea id="about" name="about" rows="10">{{$settings['about']}}</textarea>
                    </div>
                    @if ($errors->has('about'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('about') }}</strong>
                        </span><br>
                    @endif

                    <div class="form-group">
                        <label for="quote">Inspirational Quote:</label>
                        <input type="text" id="quote" name="quote" placeholder="Enter your quote here" value="{{$settings['quote']}}">
                    </div>
                    @if ($errors->has('quote'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('quote') }}</strong>
                        </span><br>
                    @endif

                    <div class="form-group">
                        <label for="contact_address">Contact Address:</label>
                        <input type="text" id="contact_address" name="contact_address" placeholder="Enter your address here" value="{{$settings['contact_address']}}">
                    </div>
                    @if ($errors->has('contact_address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('contact_address') }}</strong>
                        </span><br>
                    @endif

                    <div class="form-group">
                        <label for="contact_email">Contact email:</label>
                        <input type="email" id="contact_email" name="contact_email" placeholder="Enter your email here" value="{{$settings['contact_email']}}">
                    </div>
                    @if ($errors->has('contact_email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('contact_email') }}</strong>
                        </span><br>
                    @endif

                    <div class="form-group">
                        <label for="contact_phone">Contact phone:</label>
                        <input type="text" id="contact_phone" name="contact_phone" placeholder="Enter your phone number here" value="{{$settings['contact_phone']}}">
                    </div>
                    @if ($errors->has('contact_phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('contact_phone') }}</strong>
                        </span><br>
                    @endif

                    <div class="form-group">
                        <label for="contact_name">Contact name:</label>
                        <input type="text" id="contact_name" name="contact_name" placeholder="Enter your contact name here" value="{{$settings['contact_name']}}">
                    </div>
                    @if ($errors->has('contact_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('contact_name') }}</strong>
                        </span><br>
                    @endif

                    <div class="form-group">
                        <label for="contact_facebook">Facebook url:</label>
                        <input type="text" id="contact_facebook" name="contact_facebook" placeholder="Enter your facebook url here" value="{{$settings['contact_facebook']}}">
                    </div>
                    @if ($errors->has('contact_facebook'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('contact_facebook') }}</strong>
                        </span><br>
                    @endif

                    <div class="form-group">
                        <label for="contact_instagram">Instagram url:</label>
                        <input type="text" id="contact_instagram" name="contact_instagram" placeholder="Enter your instagram url here" value="{{$settings['contact_instagram']}}">
                    </div>
                    @if ($errors->has('contact_instagram'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('contact_instagram') }}</strong>
                        </span><br>
                    @endif


                    <div class="form-group">
                        <label for="home_banner_picture">Main background picture:</label>
                    </div>
                    <div id="image-preview">
                        @if($settings['home_banner_picture'])
                        <img id="previewBackground" src="/background-picture/{{$settings['home_banner_picture']}}" alt="Preview">
                        @else
                        <img id="previewBackground" src="/default/background.avif" alt="Preview">
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="file" id="image-upload-background" name="background_picture" accept="image/*" onchange="previewImage(event, 'previewBackground')">
                    </div>
                    @if ($errors->has('home_banner_picture'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('home_banner_picture') }}</strong>
                        </span><br>
                    @endif


                    <div class="form-group">
                        <label for="profile_picture">Profile picture:</label>
                    </div>
                    <div id="image-preview">
                        @if($settings['profile_picture'])
                        <img id="previewProfile" src="/profile-picture/{{$settings['profile_picture']}}" alt="Preview">
                        @else
                        <img id="previewProfile" src="/default/profile.webp" alt="Preview">
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="file" id="image-upload-profile" name="profile_picture" accept="image/*" onchange="previewImage(event, 'previewProfile')">
                    </div>
                    @if ($errors->has('profile_picture'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('profile_picture') }}</strong>
                        </span><br>
                    @endif



                    <div class="form-group">
                        <label for="style">Page style:</label>
                    </div>
                    <label class="switch">
                        <input type="checkbox" id="style" name="style" onchange="updateSwitchValue()" value="{{$settings['style']}}">
                        <span class="toggle"></span>
                    </label>

                    @if($settings['style'] == 'normal')
                    <span class="switch_label" id="switchLabel">Normal</span>
                    @endif

                    @if($settings['style'] == 'dark_mode')
                    <span class="switch_label" id="switchLabel">Dark</span>
                    @endif
                    
                    @if ($errors->has('style'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('style') }}</strong>
                        </span><br>
                    @endif
                    <br><br>

                   
                    <div class="form-group">
                        <input type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script>
    function previewImage(event, preview) {
      const input = event.target;
      const reader = new FileReader();
      reader.onload = function() {
        const imagePreview = document.getElementById(preview);
        imagePreview.src = reader.result;
      }
      reader.readAsDataURL(input.files[0]);
    }

    function updateSwitchValue() {
        var switchLabel = document.getElementById("switchLabel");
        var switchInput = document.getElementById("style");

        switch(switchInput.value) {
            case 'dark_mode' :
                switchInput.value = 'normal'
                switchLabel.textContent = 'Normal'
                break;
            case 'normal' :
                switchInput.value = 'dark_mode'
                switchLabel.textContent = 'Dark'
                break;
        }
    }

  </script>
    @include('layouts.partials.footer')
</body>
</html>
