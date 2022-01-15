<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="https://wissenhivedatastorage.nyc3.digitaloceanspaces.com/my_storage_key/liveimage/1637908115.png">
    <title> Business with Pinnacledu</title>
    <!-- Custom CSS -->
    <link href="{{ asset('web-assets/dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web-assets/dist/css/login.css') }}" rel="stylesheet">
    <style type="text/css">
        .error-msg{color:red;font-size:13px;}
    </style>
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <section class="section_login" style="background-image: url('{{ asset('web-assets/assets/images/background/banner.jpg') }}');">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-xl-7 col-lg-7 col-md-7 login-left">
                    <div class="row">
                        <div class="col">
                            <a href="https://www.wissenhive.com/" target="_blank" class="logo_anchor">
                                <img src="https://wissenhivedatastorage.nyc3.digitaloceanspaces.com/my_storage_key/liveimage/1637907987.png" class="login_logo" alt=""><span>for
                                    business</span>
                            </a>
                        </div>
                    </div>
                    
                    <div class="row py-5 headings_login">
                        <div class="col mt-3">
                            <img src="{{ asset('resellers/logo/').'/'.$reseller->logo }}"
                                class="client_logo" alt="">
                            <h1>Pinnacledu understands! </h1>
                            <p>Pinnacledu offers it Corporate clientele the most engaging and reliable online learning
                                platform. </p>
                        </div>
                    </div>
                    
                    <div class="row py-2">
                        <div class="col-lg-6 col-sm-12 col-md-6 col-12">
                            <div class="section_list">
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="content">
                                    <h5>5,00,000</h5>
                                    <p>Satisfied customers</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-6 col-12">
                            <div class="section_list">
                                <div class="icon">
                                    <i class="far fa-clock"></i>
                                </div>
                                <div class="content">
                                    <h5>24x7</h5>
                                    <p>Support</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-6 col-12">
                            <div class="section_list">
                                <div class="icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="content">
                                    <h5>97% </h5>
                                    <p>Instructor rating</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-6 col-12">
                            <div class="section_list">
                                <div class="icon">
                                    <i class="fas fa-tasks"></i>
                                </div>
                                <div class="content">
                                    <h5>70%</h5>
                                    <p>Completion rates</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-5 login-right">
                    <div class="row">
                        <div class="col">
                            <ul class="d-flex align-items-center justify-content-center list-style-none calltop">
                                <li class="">
                                    <i class="fas fa-envelope"></i><a
                                        href="mailto:corp@pinnacledu.com">corp@pinnacledu.com</a>
                                </li>
                                <li class="ml-4">
                                    <i class="far fa-phone"></i><a href="tel:+91 8080857310">+91 8080857310 </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <form class="login_form" method="post" action="{{ route('web.validate') }}">
                                
                                @if(Session::has('error'))
                                <div class="alert alert-danger">
                                    <strong>{{ Session::get('error') }}</strong>
                                </div>
                                @endif
                                @if(Session::has('success'))
                                <div class="alert alert-success">
                                    <strong>{{ Session::get('success') }}</strong>
                                </div>
                                @endif
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address*</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter email address" value="{{ old('email') }}">

                                    <p class="mt-2 error-msg">{{ $errors->first('email') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password*</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1"
                                        placeholder="Enter password" value="{{ old('password') }}">
                                    <p class="mt-2 error-msg">{{ $errors->first('password') }}</p>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('web-assets/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('web-assets/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('web-assets/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('web-assets/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('web-assets/assets/extra-libs/sparkline/sparkline.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('web-assets/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('web-assets/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('web-assets/dist/js/custom.min.js') }}"></script>
</body>

</html>
