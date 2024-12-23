<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Final-admin</title>
    <!-- Favicon -->
    <link href="{{asset('admin/assets/img/brand/favicon.png')}}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300..800&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link href="{{asset('admin/assets/js/plugins/nucleo/css/nucleo.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{asset('admin/assets/css/argon-dashboard.css?v=1.1.2')}}" rel="stylesheet" />
    <style>
        body {
            font-family: "Roboto Slab", serif !important;
        }
        .py-lg-8 {
            padding-top: 2rem !important;
        }
        #errorMsg {
            color: red;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>

<body class="bg-default">
    <div class="main-content">
        <!-- Header -->
        <div class="header  py-lg-8">
            <div class="container">
                <div class="header-body text-center">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6">
                            <h1 class="text-white">Welcome!</h1>
                            <p class="text-lead text-light">Sign in to access your dashboard.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
            <div class="card-header bg-transparent pb-5">
              <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
              <div class="btn-wrapper text-center">
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="{{asset('admin/assets/img/icons/common/github.svg')}}"></span>
                  <span class="btn-inner--text">Github</span>
                </a>
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="{{asset('admin/assets/img/icons/common/google.svg')}}"></span>
                  <span class="btn-inner--text">Google</span>
                </a>
              </div>
            </div>
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-header bg-transparent pb-5">
                            <div class="text-center "><small>Sign in with credentials</small></div>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form" id="loginForm" action="{{ url('login') }}" method="POST">
                            @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" id="password" name="password" placeholder="Password" type="password" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4">Sign in</button>
                                </div>
                            </form>
                            <p id="errorMsg"></p>
                            <div id="message" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core -->
    <script src="{{asset('admin/assets/js/plugins/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Argon JS -->
    <script src="{{asset('admin/assets/js/argon-dashboard.min.js?v=1.1.2')}}"></script>


</body>

</html>
