<aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('reseller.dashboard') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('reseller.courses') }}" aria-expanded="false"><i class="mdi mdi-book-open-page-variant"></i><span class="hide-menu">Courses</span></a></li>
                       
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('reseller.users') }}" aria-expanded="false"><i class="mdi mdi-account-convert"></i><span class="hide-menu">Candidates</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('reseller.notifications') }}" aria-expanded="false"><i class="mdi mdi-alert"></i>Notifications
                        @if(notificationForReseller() > 0)
                            <sup style="color:yellow;size:12px;font-weight:bold">( {!! notificationForReseller() !!} )</sup>
                        @endif
                        </a></li>


                        @if(Session::get('reseller')->type == 0)
                         <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('reseller.enrollment') }}" aria-expanded="false"><i class="mdi mdi-account-plus"></i><span class="hide-menu">Enrollment</span></a></li>
                        @endif

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Reports </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ route('reseller.affiliate-report') }}" class="sidebar-link"><i class="mdi mdi-chart-line"></i><span class="hide-menu"> Affiliate Enrollment Report </span></a></li>
                            </ul>
                        </li>
                       
                    </ul>
                </nav>
                
            </div>
            
        </aside>
