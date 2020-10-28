 <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    
                    <a class="navbar-brand" href="index.html">
                    
                        <b class="logo-icon p-l-10">
                    
                            <img src="{{ asset('web-assets/assets/images/icon.ico') }}" height="50" alt="homepage" class="light-logo" />
                           
                        </b>
                        
                        <span class="logo-text mt-3">
                             <h3>Wiss<span style="color:#27a9e3">enhive</span></h3>
                        </span>
                        
                    </a>
                    
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
                             <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>   
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                       
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li> -->
                         <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ Config::get('constant.logo_url').'/'.Session::get('reseller')->logo }}" alt="user" width="100" height="60">
                            </a>
                            
                        </li>
                    </ul>
                    
                    <ul class="navbar-nav float-right">
                        
                        
                       

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-envelope'></i>&nbsp;info@wissenhive.com
                            </a>
                            
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-phone'></i>&nbsp;+91-1204229536
                            </a>
                            
                        </li>
                       
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Session::get('reseller')->company_name }}</a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                              
                                <a class="dropdown-item" href="{{ route('reseller.logout') }}"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#change-password"><i class="mdi mdi-account-key m-r-5 m-l-5"></i> Change Password</a>
                              
                            </div>
                        </li>
                      
                    </ul>
                </div>
            </nav>
        </header>