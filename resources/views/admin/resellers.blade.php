@extends('admin.base')

@section('content')

<div class="app-wrapper">
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
          <h1 class="app-page-title mb-0">Resellers</h1>
        </div>
        <div class="col-auto text-right">
          <a class="btn app-btn-primary" href="{{ route('reseller.admin-reseller-add') }}">Add New</a>
        </div>
      </div>
      <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
          @include('admin.error')
          <div class="table-responsive">
            <table class="table app-table-hover mb-0 text-left" id="example">
              <thead>
                <tr>
                  <th class="cell">Sr. No.</th>
                  <th class="cell">Company Name</th>
                  <th class="cell">Email</th>
                  <th class="cell">Url</th>
                  <th class="cell">Type</th>
                  <th class="cell">Profit</th>
                  <th class="cell">Action</th>
                </tr>
              </thead>
              <tbody>

                @if($resellers)
                @php $count = 1 @endphp

                @foreach($resellers as $reseller)
                <tr>
                  <td class="cell">{{ $count++ }}</td>
                  <td class="cell">
                    <img src='{{ asset("resellers/logo/".$reseller->logo) }}' width='20' class="img-fluid me-3">
                    <strong>{{ $reseller->company_name }}</strong>
                  </td>
                  <td class="cell">
                    <span class="truncate">{{ $reseller->email }}</span>
                  </td>
                  <td class="cell">{{ $reseller->url }}</td>
                  <td class="cell">
                    @if($reseller->type == 0)
                    Reseller
                    @else
                    Marketer
                    @endif
                  </td>
                  <td class="cell"><strong>{{ $reseller->profit }} %</strong></td>
                  <td class="cell">
                    <a href="{{ route('reseller.admin-reseller-edit', ['reseller_id'=>base64_encode($reseller->id)]) }}" class="badge bg-success">Edit</a>
                    <a href='{{ route("reseller.admin-reseller-remove", ["reseller_id"=>base64_encode($reseller->id)]) }}'' class="badge bg-danger">Remove</a>
                    <a href="{{ route('reseller.admin-reseller-students', ['reseller_id'=>base64_encode($reseller->id)]) }}" class="badge bg-warning">View</a>
                    <a href="{{ route('reseller.admin-reseller-change', ['reseller_id'=>base64_encode($reseller->id)]) }}" class="badge app-btn-secondary">Change Password</a>
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
          <!--//table-responsive-->
        </div>
        <!--//app-card-body-->
      </div>
    </div>
  </div>
</div>
@endsection