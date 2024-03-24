<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head')
<body>
@include('layouts.partials.header')

    <main class="content">

        <section class="services-section">
            <h2>Contact</h2>
            <ul class="service-list">
                @if($settings['contact_name'])
                <li class="service-item"><strong>{{$settings['contact_name']}}</strong></li>
                @endif

                @if($settings['contact_address'])
                <li class="service-item"><strong>Address: </strong>{{$settings['contact_address']}}</li>
                @endif

                @if($settings['contact_phone'])
                <li class="service-item"><strong>Phone Number: </strong>{{$settings['contact_phone']}}</li>
                @endif

                @if($settings['contact_email'])
                <li class="service-item"><strong>Email: </strong>{{$settings['contact_email']}}</li>
                @endif

                <li class="service-item">
                    @if($settings['contact_instagram'])
                    <a href="{{$settings['contact_instagram']}}"  target="_blank"><img style="width:40px;height:40px;"  src="/default/instagram.svg" alt=""></a>
                    @endif
                    
                    @if($settings['contact_facebook'])
                    <a href="{{$settings['contact_facebook']}}"  target="_blank"><img style="width:40px;height:40px;"  src="/default/facebook.svg" alt=""></a>
                    @endif
                    <br>
                </li>

                
                
            </ul>
            <br>
        </section>

        <section class="intro-section">
            <p>If you have any questions, please send me a message.</p>
        </section>

        <section class="services-section">
            <div class="contact-container">
                <form action="/contactMe" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="name">Subject:</label>
                        <input type="text" id="name" name="name" required placeholder="Enter subject here">
                    </div>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span><br><br>
                    @endif

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required placeholder="Enter your email here">
                    </div>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span><br>
                    @endif

                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" rows="5" required>Message...</textarea>
                    </div>
                    @if ($errors->has('message'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('message') }}</strong>
                        </span><br>
                    @endif

                    <div class="form-group">
                        <input type="submit" value="Submit">
                    </div>
                    @if(isset($created) && $created !== null)
                        <br>
                        <span class="success-feedback" role="alert">
                            <strong>Message is sent!</strong>
                        </span>
                        <br>
                    @endif
                </form>
            </div>
        </section>
    </main>

    @include('layouts.partials.footer')
</body>
</html>
