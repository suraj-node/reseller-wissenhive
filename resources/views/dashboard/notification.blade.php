@extends('dashboard.base')

@section('content')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12">
                        <div class="m-c-cont d-flex no-block align-items-center">
                            <h3 class="page-title">Notifications</h3>
                            <div class="ml-auto text-right">
                               <a href="{{ route('reseller.enrollment') }}" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i>Enroll Candidate</a>
                               <a href="javascript:void(0)" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add-new-user"><i class="mdi mdi-plus"></i>Add New Candidate</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                      
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="data_table" class="table table-bordered table-hover" style="width: 100%">
                                        <thead   class="thead-dark">
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Name</th>
                                                <th>Course</th>
                                                <th>Mode Of Payment</th>
                                                <th>Amount</th>
                                                <th>Your Comment</th>
                                                <th>Admin Comment</th>
                                                <th>Invoice Status</th>
                                                <th>Action Done By</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($notifications)
                                                @php $count = 1 @endphp
                                                @foreach($notifications as $notification)
                                                    <tr>
                                                        <td>{{ $count++ }}</td>
                                                        <td>{{ $notification->candidate_name }}</td>
                                                        <td>{{ $notification->course }}</td>
                                                        <td>
                                                            @if($notification->mode_of_payment == 0)
                                                                Stripe
                                                            @elseif($notification->mode_of_payment == 1)
                                                                Paypal
                                                            @else
                                                                Bank Transfer
                                                            @endif
                                                        </td>
                                                        <td>{{ $notification->amount }}</td>
                                                        <td>{{ $notification->reseller_comment }}</td>
                                                        <td>{{ $notification->admin_comment }}</td>
                                                         <td>
                                                             @if($notification->status == 1)
                                                                <p class="badge badge-success">Approve</p>
                                                            @else
                                                                <p class="badge badge-danger">Disapprove</p>
                                                             @endif
                                                         </td>
                                                         <td>{{ $notification->admin_name }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
   @endsection

