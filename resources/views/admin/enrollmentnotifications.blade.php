@extends('admin.base')

@section('content')

<div class="app-wrapper">
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
          <h1 class="app-page-title mb-0">Notificatioins</h1>
        </div>
        <!-- <div class="col-auto text-right">
          <a class="btn app-btn-primary" href="{{ route('reseller.admin-reseller-add') }}">Add New</a>
        </div> -->
      </div>
      <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
          @include('admin.error')
          <div class="table-responsive">
            <table class="table app-table-hover mb-0 text-left" id="example">
              <thead class="thead-dark">
                <tr>
                  <th class="cell">Sr. No.</th>
                  <th class="cell">Candidate Name</th>
                  <th class="cell">Reseller Name</th>
                  <th class="cell">Amount</th>
                  <th class="cell">Course</th>
                  <th class="cell">Course Type</th>
                  <th class="cell">Amount Status</th>
                  <th class="cell">Action</th>
                </tr>
              </thead>
              
              <tbody>
                    @if($notifications)
                       
                        @php $count = 1 @endphp
                            @foreach($notifications as $notify)
                                <tr>
                                    <td class="cell">{{ $count++ }}</td>
                                    <td class="cell">{{ $notify->student_name }}</td>
                                    <td class="cell">{{ $notify->reseller_name }}</td>
                                    <td class="cell">{{ $notify->amount }}</td>
                                    <td class="cell">{{ $notify->course_name }}</td>
                                    <td class="cell">
                                        @if($notify->schedule_id == 0)
                                            <p class="badge bg-success badge-sm">Group training</p>
                                        @elseif($notify->schedule_id == 1)
                                            <p class="badge bg-danger badge-sm">One on one trainig</p>
                                        @elseif($notify->schedule_id == 2)
                                            <p class="badge bg-info badge-sm">Interview prepration</p>
                                        @else
                                            <p class="badge bg-warning badge-sm">Project support</p>
                                        @endif
                                    </td>
                                    <td class="cell">
                                        
                                        @if($notify->amount_status == 0)
                                            <p class="badge bg-success badge-sm">Amount paid</p>
                                        @else
                                            <p class="badge bg-danger badge-sm">Amount not paid</p>
                                        @endif
                                    </td>
                                   
                                    <td class="cell">
                                        {{--<a href="javascript:void(0)" onclick="generateForm('{{ $notify->id }}', 2)" class="btn btn-danger btn-sm">Disapprove</a>
                                        <a href="javascript:void(0)" onclick="generateForm('{{ $notify->id }}', 1)" class="btn btn-success btn-sm">Approve</a>
                                        <a href="{{ route('reseller.admin-invoice-remove', ['invoice_id'=>$notify->id]) }}" class="btn btn-info btn-sm">Remove</a>--}}
                                    </td>
                                </tr>
                            @endforeach
                       
                    @endif
                </tbody>




        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header" style="background: #000;">
                    <h5 class="modal-title" id="exampleModalLabel">Update Invoice</h5>
                    <button type="button" class="btn-close bg-white btn-sm" onclick="location.reload()">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background: #000;">
                    <form id="invoice-update">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                          <input   type="hidden" id="invoice_id" name="invoice_id" /> 
                            <input   type="hidden" id="status" name="status" /> 
                            <input class="form-control form-white @error('admin_comment') is-invalid @enderror"  placeholder="Enter comment or payment link" type="text" id="admin_comment" name="admin_comment" />
                          <label for="floatingInput">Comment</label>
                        <p class="log-error mt-1" id='admin_commenterr'></p>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer" style="background:#000;">
                   
                    <button type="submitt" class="btn btn-primary">Save changes</button>
                </div>
                </form>
                </div>
            </div>
        </div>

        <script>
            function generateForm(inv_id, status){

                $("#invoice_id").val(inv_id);
                $("#status").val(status);
                $("#exampleModal").modal('toggle');

            }
        </script>
@endsection
