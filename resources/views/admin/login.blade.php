<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pinncaledu Reseller</title>
    <!-- Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Pinncaledu Reseller" />
    <meta name="author" content="Pinncaledu" />
    <link rel="stylesheet" href="{{ asset('assets/css/portal.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
    <link rel="shortcut icon" href="https://wissenhivedatastorage.nyc3.digitaloceanspaces.com/my_storage_key/liveimage/1637908115.png" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
</head>

<body class="">
    <section class="app_login">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 p-0 app_login__left">
                    <div class="app_login_block">
                        <div class="app_logo_layout">
                            <a href="https://dreambig-it.com/" target="_blank">
                                <img src="https://wissenhivedatastorage.nyc3.digitaloceanspaces.com/my_storage_key/liveimage/1637907987.png"
                                    alt="" class="img-fluid" />
                            </a>
                        </div>

                        <div class="app_welcome_block">
                            <h4 class="app_welcome_text">
                                Welcome to Pinncaledu Reseller!
                            </h4>
                            <hr class="mx-auto" />
                            <h6 class="app_signin_text">Sign In</h6>
                        </div>

                        @if($errors->first('server_error'))
                        <div class="flash-message alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{$errors->first()}}</strong>
                        </div>
                        @endif

                        @if ($message = Session::get('success'))
                        <div class="flash-message alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif

                        <div class="app_form_layout">
                            <form class="login-form" id="loginform" action="{{ route('reseller.admin-authentication') }}" method="post">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" 
                                        placeholder="name@example.com" />
                                    <label for="floatingInput">Email address</label>
                                    <p class='error-class'>{{ $errors->first('email') }}</p>
                                </div>
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="password" value="{{ old('password') }}"
                                        placeholder="Password" />
                                    <label for="floatingPassword">Password</label>
                                    <p class='error-class'>{{ $errors->first('password') }}</p>
                                </div>
                                <div class="w-100">
                                    <button type="submit" class="btn app_custom_btn shadow">
                                        Sign In
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12 p-0 app_login__right">
                    <div class="app_inner_right_block">
                        <h2><span>200+ Active users</span> Sign In to Chat With them</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Javascript -->
    <script src="{{ asset('assets/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Page Specific JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>