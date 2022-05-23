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
              <div class="card p-2">
                <div class="card-body">
                  <div class="text-center">
                    <img  src="{{ asset($logo) }}" height="80" alt="">
                    {{-- <h2 class="display-6 text-center"><span style="color: #088441;">Sukat</span><span style="color: #FEAF2F;">Bahay</span></h2> --}}
                    <h5 class="mb-4 mt-2 lead">Sign in</h5>
                  </div>
                  <form method="POST" action="{{ route('auth.login_post') }}">@csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="d-grid gap-2 mx-auto mt-4 mb-2">
                      <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                    <small>Dont have an account? <a href="{{ route('auth.register') }}">Register</a></small>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('userstyle/js/bootstrap.min.js') }}"></script>
</body>
</html>