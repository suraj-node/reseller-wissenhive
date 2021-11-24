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
    <link href="{{ asset('web-assets/assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web-assets/dist/css/style.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('web-assets/assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web-assets/dist/datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web-assets/dist/datatable/css/buttons.bootstrap4.min.css') }}">
    <style>
        /*.dataTables_filter {float:right;}
        #zero_config_paginate{float: right !important;}
        .table-responsive thead {background: cadetblue; color:white;}
        .table-responsive tfoot {background: cadetblue; color:white;}
        table{font-size:12px;}*/
        .form-row{margin-top:5%}
        .log-error{color:red;font-size:12px;font-weight: bold;}
   
    
        .spinner-border {
        display: inline-block;
        width: 1.5rem;
        height: 1.5rem;
        vertical-align: text-bottom;
        border: .25em solid currentColor;
        border-right-color: rgb(0 0 0 / 0%);
        border-radius: 50%;
        -webkit-animation: spinner-border .75s linear infinite;
        animation: spinner-border .75s linear infinite;
        }
        @keyframes spinner-border {
        to { transform: rotate(360deg); }
        }

        .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        overflow: hidden;
        clip: rect(0,0,0,0);
        white-space: nowrap;
        border: 0;
        }
        .show {display:block;}
        .hide {display:none;}
</style>
</head>

<body>
    <input type="hidden" id="base" value="{{ url('/') }}">
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
           @php 
           $countries = countries();
           @endphp
           <!-- ADD NEW USER FORM -->
           <div class="modal fade none-border" id="add-new-user">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Add</strong> new student</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form id="add-user">
                                    @csrf
                                    <div class="row form-row">
                                        <div class="col-md-6">
                                            <input class="form-control form-white @error('fname') is-invalid @enderror"  placeholder="Enter first name" type="text" name="fname" />
                                            <p class="log-error mt-1" id='fname'></p>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control form-white form-white @error('lname') is-invalid @enderror" placeholder="Enter last name" type="text" name="lname" />
                                            <p class="log-error mt-1" id='lname'></p>
                                        </div>

                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-6">
                                            <input class="form-control form-white form-white @error('email') is-invalid @enderror" placeholder="Enter email" type="email" name="email" />
                                            <p class="log-error mt-1" id='email'></p>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control form-white form-white @error('mobile') is-invalid @enderror" placeholder="Enter mobile" type="text" name="mobile" />
                                            <p class="log-error mt-1" id='mobile'></p>
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-6">
                                            <select class="form-control form-white form-white @error('country') is-invalid @enderror" name="country">
                                                @if(isset($countries))
                                                        <option value="" selected disabled>Select Country</option>
                                                    @foreach($countries as $cont)
                                                        <option>{{ $cont->nicename }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <p class="log-error mt-1" id='country'></p>
                                        </div>
                                        <div class="col-md-6">
                                           <select class="form-control form-white form-white @error('status') is-invalid @enderror" name="status">
                                                <option value="0">Enable</option>
                                                <option value="1">Disable</option>
                                            </select>
                                            <p class="log-error mt-1" id='status'></p>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-sm waves-effect waves-light save-category">Add</button>
                            </div>
                        </form>
                        </div>
                    </div>
            </div>
           <!-- USER FORM FINISH -->


           <!-- USER UPDATE FORM  -->
           <!-- ADD NEW USER FORM -->
           <div class="modal fade none-border" id="update-old-user">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Update</strong> student</h4>
                                <button type="button" class="close" onclick="location.reload()">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form id="update-user">
                                    @csrf
                                    <div class="row form-row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="student_id" id="student_id">
                                            <input class="form-control form-white @error('fnameupd') is-invalid @enderror"  placeholder="Enter first name" type="text" name="fnameupd" id='_fname' />
                                            <p class="log-error mt-1" id='fnameupd'></p>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control form-white form-white @error('lnameupd') is-invalid @enderror" placeholder="Enter last name" type="text" name="lnameupd" id='_lname'/>
                                            <p class="log-error mt-1" id='lnameupd'></p>
                                        </div>

                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-6">
                                            <input class="form-control form-white form-white @error('emailupd') is-invalid @enderror" placeholder="Enter email" type="email" name="emailupd" id="_email"/>
                                            <p class="log-error mt-1" id='emailupd'></p>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control form-white form-white @error('mobileupd') is-invalid @enderror" placeholder="Enter mobile" type="text" name="mobileupd" id="_mobile"/>
                                            <p class="log-error mt-1" id='mobileupd'></p>
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-6">
                                            <select class="form-control form-white form-white @error('countryupd') is-invalid @enderror" id="_country" name="countryupd">
                                                @if(isset($countries))
                                                        
                                                    @foreach($countries as $cont)
                                                        <option>{{ $cont->nicename }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <p class="log-error mt-1" id='countryupd'></p>
                                        </div>
                                        <div class="col-md-6">
                                           <select class="form-control form-white form-white @error('statusupd') is-invalid @enderror" name="statusupd" id="_status">
                                                <option value="0">Verified</option>
                                                <option value="1">Unverified</option>
                                            </select>
                                            <p class="log-error mt-1" id='statusupd'></p>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-sm waves-effect waves-light save-category">Update</button>
                            </div>
                        </form>
                        </div>
                    </div>
            </div>
           <!-- USER FORM FINISH -->
           <!-- USER UPDATE FORM FINISH -->


           <!-- CHANGE PASSWORD -->

           <div class="modal fade none-border" id="change-password">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Change</strong> password</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form id="change-user-password">
                                    @csrf
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <input class="form-control form-white @error('old_password') is-invalid @enderror"  placeholder="Enter your old password" type="password" name="old_password" id='password_field' />
                                            <p class="log-error mt-1" id='old_password'></p>
                                        </div>
                                    </div>

                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <input class="form-control form-white @error('new_password') is-invalid @enderror"  placeholder="Enter your new password" type="password" name="new_password" />
                                            <p class="log-error mt-1" id='new_password'></p>
                                        </div>
                                    </div>

                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <input class="form-control form-white @error('confirm_password') is-invalid @enderror"  placeholder="Confirm password" type="password" name="confirm_password" />
                                            <p class="log-error mt-1" id='confirm_password'></p>
                                        </div>
                                    </div>
                                    
                                   
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-sm waves-effect waves-light save-category">Change Password</button>
                            </div>
                        </form>
                        </div>
                    </div>
            </div>

           <!-- CHANGE PASSWORD FINISH -->
           <!-- MODEL MATERIALS FINISH -->

           <script type="text/javascript">
               function showUpdateForm(studentObject){
                    var status = '' ;
                    var json_decoded_object = JSON.parse(studentObject);

                    if(json_decoded_object.status == 0){
                        status = 'Verified';
                    }else{
                        status = 'Unverfied';
                    }
                    $("#student_id").val(json_decoded_object.id);
                    $("#_fname").val(json_decoded_object.fname);
                    $("#_lname").val(json_decoded_object.lname);
                    $("#_email").val(json_decoded_object.email);
                    $("#_mobile").val(json_decoded_object.mobile);
                    $("#_country").prepend($("<option selected></option>").attr("value", json_decoded_object.country).text(json_decoded_object.country));
                    $("#_status").prepend($("<option selected></option>").attr("value", json_decoded_object.status).text(status));
                    $('#update-old-user').modal({backdrop: 'static',keyboard: false});
                }

           </script>

            <footer class="footer text-center fixed-bottom mt-5">
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
    <!-- <script src="{{ asset('web-assets/assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{ asset('web-assets/assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script src="{{ asset('web-assets/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script type="text/javascript">$('#zero_config').DataTable();</script> -->
    <script src="{{ asset('web-assets/dist/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('web-assets/dist/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('web-assets/dist/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('web-assets/dist/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('web-assets/dist/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('web-assets/dist/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('web-assets/dist/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('web-assets/dist/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('web-assets/dist/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('web-assets/dist/datatable/js/buttons.colVis.min.js') }}"></script>

    <!-- DATATABLE FINISH -->

    <script src="{{ asset('web-assets/assets/libs/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('web-assets/assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('web-assets/dist/js/pages/calendar/cal-init.js') }}"></script>
    <script type="text/javascript" src="{{ asset('app.js') }}"></script>
    <script src="{{ asset('web-assets/assets/libs/toastr/build/toastr.min.js') }}"></script>
    <script src="{{ asset('web-assets/assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('web-assets/assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(".select2").select2();
    </script>

        <script type="text/javascript">
        $(document).ready(function() {
            var newDate = new Date();
            var substring = newDate.getHours()+'-'+newDate.getMinutes()+'-'+newDate.getSeconds();
            var table = $('#data_table').DataTable( {
            
                lengthChange: false,
                responsive: true,
                text: 'Export',
                "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
                "iDisplayLength": 10,
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'exl-export-'+substring,

                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'pdf-export-'+substring
                    },
                    {

                       extend: 'colvis',
                    }
                ]
            
            } );
         
            table.buttons().container()
                .appendTo( '#data_table_wrapper .col-md-6:eq(0)' );
        } );
    </script>
</body>

</html>
