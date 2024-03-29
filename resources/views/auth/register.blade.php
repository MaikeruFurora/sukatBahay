<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SukatBahay</title>
    <link rel="stylesheet" href="{{ asset('userstyle/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('authstyle/style.css') }}">
    <style>
      
    </style>
</head>
<body>
    <div class="container">
        <div class="row height d-flex justify-content-center align-items-center">
            <div class="col-lg-4">
              @if (session()->has('msg'))
              <div class="alert alert-{{ session()->get('action') ?? 'success' }}" role="alert">
                {{ session()->get('msg') }}
              </div>
              @endif
              <div class="card p-2">
                <div class="card-body">
                  <div class="text-center">
                    <a href="{{ route('welcome') }}">
                      <img  src="{{ asset($logo.'sb.png') }}" height="80" alt="">
                    </a>
                    <h5 class="mb-4 mt-2 lead">Sign Up</h5>
                  </div>
                  <form method="POST" action="{{ route('auth.register_post') }}">@csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Fullname</label>
                      <input type="text" name="fullname" value="{{ old('fullname') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Email address</label>
                      <input type="email" name="email" value="{{ old('email') }}" class="form-control" >
                      <small class="text-danger">@error('email'){{ $message }}@enderror</small>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Confirm password</label>
                      <input type="password" name="confirm_password" class="form-control" id="" aria-describedby="emailHelp">
                      <small class="text-danger">@error('confirm_password'){{ $message }}@enderror</small>  
                    </div>
                    <div class="d-grid gap-2 mx-auto mt-4 mb-2  ">
                      <button class="btn btn-success" type="submit">Sign Up</button>
                    </div>
                      <label class="custom-switch mt-2">
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">I agree with terms and conditions</span>
                      </label>
                    <br>
                    <small>Already have an account? <a href="{{ route('auth.login') }}">Sign In</a></small>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('authstyle/js/bootstrap.min.js') }}"></script>
</body>
</html>