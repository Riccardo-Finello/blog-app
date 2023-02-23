<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')
    <body>
        @include('partials.menu')
        <main class="container">
            <div class="p-4 p-md-5 mb-4 rounded text-bg-dark">
              <div class="col-md-12 px-0">
                Register
              </div>
            </div>
        </main>
        <div style="margin-left:35%; width:30%">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                     @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                     @endforeach
                    </ul>
                </div>
            @endif
            <form id="registerForm" method="POST" action="{{route("doRegister")}}">
                @csrf
                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" class="form-control" id="inputName" aria-describedby="nameHelp" placeholder="Enter your name" name="name">
                
                </div>
                <div class="form-group">
                <label for="inputMail">Email address</label>
                <input type="email" class="form-control" id="inputMail" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
                </div>
                <div class="form-group">
                <label for="inputPasswordRepeat">Password</label>
                <input type="password" class="form-control" id="inputPasswordRepeat" placeholder="Repeat Password" name="confirmPassword">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        @include('partials.footer')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>