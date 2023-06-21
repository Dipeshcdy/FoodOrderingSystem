<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@0;1&family=Roboto&display=swap" rel="stylesheet">
    
    <style>
      body{

        font-family: roboto,sans-serif !important;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<section class="vh-100 d-flex">
    <div class="container-fluid ">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form method="POST" action="{{route('login')}}">
            @csrf
            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
              <p class="lead fw-normal mb-3 me-3 text-primary">Sign in Here!</p>
            </div>
  
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{old('email')}}"
                placeholder="Enter a valid email address" required />
              <label class="form-label" for="email">{{__('Email Address')}}</label>

              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
  
            <!-- Password input -->
            <div class="form-outline mb-3">
              <input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                placeholder="Enter password" required />
              <label class="form-label" for="password">{{__('password')}}</label>
              @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>
  
            <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <div class="form-check mb-0">
                <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{old('remember') ? 'checked':''}} />
                <label class="form-check-label" for="remember">
                  {{__('Remember Me')}}
                </label>
              </div>
              @if (Route::has('password.request'))
              <a href="{{route('password.request')}}" class="text-body">{{__('Forgot Your Password?')}}</a>
              @endif
            </div>
  
            <div class="text-center text-lg-start mt-4 pt-2">
              <div class="d-flex">
                <button type="submit" class="btn btn-primary btn-lg me-2"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">{{__('login')}}</button>
                <a href="{{route('redirectToGoogle')}}" class="btn bg-black text-white btn-lg">
                  Login With Google
                </a>

              </div>
              <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{route('register')}}"
                  class="link-danger">Register</a></p>
            </div>
            
          </form>
        </div>
      </div>
    </div>
    
  </section>
</body>
</html>