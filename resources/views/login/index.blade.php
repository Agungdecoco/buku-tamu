<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">

    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        
</head>

<body class="hold-transition login-page" style="background-image: radial-gradient( circle farthest-corner at 84.6% 77.8%,  rgba(86,89,218,1) 0%, rgba(95,208,248,1) 90% );">
    <div class="login-box">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('loginError'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session()->has('loginSuccess'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <ul class="nav d-felx justify-content-center">
                    <a href="/" class="brand-link"><img src="assets/img/logokominfo.png" class="brand-image"></a>
                </ul>
            </div>
            <div class="card-body ">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope" style="color: #577BC1"></span>
                            </div>
                        </div>
                        <input type="email" id="email" class="form-control " name="email" placeholder="Email" autofocus required>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                            @enderror
                        </div>
                    
                    
                    <div class="input-group mb-3" id="show_hide_password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock" style="color: #577BC1"></span>
                            </div>
                        </div>
                        <input type="password" id="password" class="form-control " name="password" placeholder="Password" required>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn" style="background-color: #577BC1">Login</button>
                        </div>
                        <br>
                        <div class="text-center">
                            <p class="d-text-center">Not registered ?<a href="{{ route('register') }}">Register
                                    Now!</a></p>
                        </div>

                    </div>
                </div>    

                    

                </form>
            </div>
        </div>
    </div>
</body>

<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/dist/js/demo.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />

</html>
