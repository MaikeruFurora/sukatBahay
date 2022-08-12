<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SukatBahay</title>
    <link rel="stylesheet" href="{{ asset('userstyle/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('authstyle/style.css') }}">
    
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
                    {{-- <h2 class="display-6 text-center"><span style="color: #088441;">Sukat</span><span style="color: #FEAF2F;">Bahay</span></h2> --}}
                    <h6 class="mb-4 mt-4 lead">Forgot Password</h6>
                   </div>
                  <form method="POST" action="{{ route('auth.forgot_post') }}">@csrf
                    <div class="mb-3">
                     <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your Email address" >
                     <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                    </div>
                  
                    <div class="d-grid gap-2 mx-auto mt-4 mb-2">
                      <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                    <small>Already have an account? <a href="{{ route('auth.login') }}">Sign In</a></small>
                   
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('userstyle/js/bootstrap.min.js') }}"></script>
</body>
</html>