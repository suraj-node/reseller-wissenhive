<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pinncaledu Reseller Admin</title>
    <!-- Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Pinncaledu Reseller" />
    <meta name="author" content="Pinncaledu" />
    <link rel="stylesheet" href="{{ asset('assets/css/portal.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatable/datatables.min.css') }}" />
    <link rel="shortcut icon"
        href="https://wissenhivedatastorage.nyc3.digitaloceanspaces.com/my_storage_key/liveimage/1637908115.png" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
    <link href="{{ asset('web-assets/assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet">
    <style>
        .show {display:block;}
        .hide {display:none;}
        #if_opportunity{display:none}
        #if_sales{display:none}
        .log-error{color:red;font-size:12px;font-weight: bold;}
    </style>
</head>

    <body class="app">
    <input type="hidden" id="base" value="{{ url('/') }}">
    <header class="app-header fixed-top">
        @include('admin.header')
        @include('admin.sidebar')
    </header>
    

    

    @yield('content')
    <script type="text/javascript">
               function showUpdateForm(studentObject){
                
                    var status = '' ;
                    var type   = '';
                    var m_o_p  = '';
                    
                    var json_decoded_object = JSON.parse(studentObject);

                    if(json_decoded_object.status == 0){
                        status = 'Verified';
                    }else{
                        status = 'Unverfied';
                    }


                    if(json_decoded_object.type == 0){
                        
                        type = 'Student';
                        $("#if_opportunity_edit").css('display','none');
                        $("#if_sales_edit").css('display','none');

                    }else if(json_decoded_object.type == 1){
                        type = 'Opportunity';
                        $("#if_sales_edit").css('display','none');
                    }else{
                        type = 'Sales';
                        $("#if_opportunity_edit").css('display','none');
                    }

                    

                    if(json_decoded_object.mode_of_payment == 0){
                        m_o_p = 'Stripe';
                    }else if(json_decoded_object.mode_of_payment == 1){
                        m_o_p = 'Paypal';
                    }else if(json_decoded_object.mode_of_payment == 2){
                        m_o_p = 'Bank Transfer';
                    }else{
                        m_o_p = 'Select';
                    }
                    
                    $("#student_id").val(json_decoded_object.id);
                    $("#_fname").val(json_decoded_object.fname);
                    $("#_lname").val(json_decoded_object.lname);
                    $("#_email").val(json_decoded_object.email);
                    $("#_mobile").val(json_decoded_object.mobile);
                    $("#_country").prepend($("<option selected></option>").attr("value", json_decoded_object.country).text(json_decoded_object.country));
                    $("#typeupd").prepend($("<option selected></option>").attr("value", json_decoded_object.type).text(type));
                    $("#_status").prepend($("<option selected></option>").attr("value", json_decoded_object.status).text(status));
                    
                    $("#coated_amountupd").val(json_decoded_object.coated_amount);
                    $("#interested_courseupd").val(json_decoded_object.interested_course);
                    $("#sales_amountupd").val(json_decoded_object.sales_amount);
                    $("#amount_paidupd").val(json_decoded_object.amount_paid);
                    $("#balanceupd").val(json_decoded_object.balance);
                    $("#mode_of_paymentupd").prepend($("<option selected></option>").attr("value", json_decoded_object.type).text(m_o_p));

                    $('#update-old-userbyadmin').modal('toggle');
                }

                

           </script>
    @include('admin.footer')