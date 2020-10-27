<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('web-assets/assets/images/icon.ico') }}">
    <title>Reseller Dashboard</title>
    
    <link href="{{ asset('web-assets/assets/libs/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('web-assets/assets/extra-libs/calendar/calendar.css') }}" rel="stylesheet" />
    <link href="{{ asset('web-assets/dist/css/style.min.css') }}" rel="stylesheet">
    <style>
        .dataTables_filter {float:right;}
        #zero_config_paginate{float: right !important;}
        .table-responsive thead {background: cadetblue; color:white;}
        .table-responsive tfoot {background: cadetblue; color:white;}
        table{font-size:12px;}
        .form-row{margin-top:5%}
    </style>
</head>

<body>
    
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    
    <div id="main-wrapper">
    
       @include('dashboard.header')
       
       @include('dashboard.sidebar') 
        
        <div class="page-wrapper">
        
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        @if(Session::has('success'))
                                <div class="alert alert-success">
                                    <strong>{{ Session::get('success') }}</strong>
                                </div>
                                @endif
                       
                    </div>
                </div>
            </div>
           

           @yield('content')


           <!-- MODEL MATERIALS -->

           <!-- ADD NEW USER FORM -->
           <div class="modal fade none-border" id="add-new-user">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Add</strong> new student</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row form-row">
                                        <div class="col-md-6">
                                            <input class="form-control form-white" placeholder="Enter first name" type="text" name="fname" />
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control form-white" placeholder="Enter last name" type="text" name="lname" />
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-6">
                                            <input class="form-control form-white" placeholder="Enter email" type="email" name="email" />
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control form-white" placeholder="Enter mobile" type="text" name="mobile" />
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-6">
                                            <select class="form-control form-white" data-placeholder="Choose a color..." name="status">
                                                <option value="success">Success</option>
                                                <option value="danger">Danger</option>
                                                <option value="info">Info</option>
                                                <option value="primary">Primary</option>
                                                <option value="warning">Warning</option>
                                                <option value="inverse">Inverse</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                           <select class="form-control form-white" data-placeholder="Choose a color..." name="country">
                                                <option value="success">Success</option>
                                                <option value="danger">Danger</option>
                                                <option value="info">Info</option>
                                                <option value="primary">Primary</option>
                                                <option value="warning">Warning</option>
                                                <option value="inverse">Inverse</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success btn-sm waves-effect waves-light save-category">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
           <!-- USER FORM FINISH -->

           <!-- MODEL MATERIALS FINISH -->

            <footer class="footer text-center">
                All Rights Reserved by <a href="http://143.110.180.70/">Dreambig-it.com</a> Designed and Developed by <a href="https://www.wissenhive.com/" target="_blank">Wissenhive</a>.
            </footer>
            
        </div>
        
    </div>
    
    <script src="{{ asset('web-assets/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('web-assets/dist/js/jquery.ui.touch-punch-improved.js') }}"></script>
    <script src="{{ asset('web-assets/dist/js/jquery-ui.min.js') }}"></script>

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
    <!-- this page js -->

    <!-- DATATABLE -->
    <script src="{{ asset('web-assets/assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{ asset('web-assets/assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script src="{{ asset('web-assets/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script type="text/javascript">$('#zero_config').DataTable();</script>
    <!-- DATATABLE FINISH -->

    <script src="{{ asset('web-assets/assets/libs/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('web-assets/assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('web-assets/dist/js/pages/calendar/cal-init.js') }}"></script>

</body>

</html>