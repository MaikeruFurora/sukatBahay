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
              <div class="card p-2">
                <div class="card-body">
                  <div class="text-center">
                    <a href="{{ route('welcome') }}">
                      <img  src="{{ asset($logo.'sb.png') }}" height="80" alt="">
                    </a>
                    <h5 class="mb-4 mt-3 lead">Reset Password</h5>
                  </div>
                  <form method="POST" action="{{ route('auth.reset_now') }}">@csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-3">
                        <label for="" class="form-label">Your Email Address</label>
                        <input type="email" name="email" readonly class="form-control" value="{{ $email ?? old('email') }}">
                      </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">New Password</label>
                      <input type="password" name="new_password" class="form-control" id="exampleInputPassword1">
                      <span class="text-danger">@error('new_password'){{ $message }}@enderror</span>
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Confirm Password</label>
                      <input type="password" name="confirm_password" class="form-control" id="" aria-describedby="emailHelp">
                      @error('confirm_password')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="d-grid gap-2 mx-auto mt-4 mb-2  ">
                      <button class="btn btn-success" type="submit">Reset Password</button>
                    </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('authstyle/js/bootstrap.min.js') }}"></script>
</body>
</html>