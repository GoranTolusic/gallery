<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head')
<body>
@include('layouts.partials.header')

    <main class="content">
        <section class="services-section">
            <div class="contact-container">
                <form action="/admin/login" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="password">Enter password:</label>
                        <input type="password" id="password" name="password" required placeholder="Enter your password here">
                    </div>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span><br><br>
                    @endif
                    @php
                    $invalidPassword = session('invalidPassword')
                    @endphp
                    @if ($invalidPassword)
                        <span class="invalid-feedback" role="alert">
                            <strong>Invalid password</strong>
                        </span><br><br>
                    @endif

                    <div class="form-group">
                        <input type="submit" value="Submit">
                    </div>

                </form>
            </div>
        </section>
    </main>

    @include('layouts.partials.footer')
</body>
</html>
