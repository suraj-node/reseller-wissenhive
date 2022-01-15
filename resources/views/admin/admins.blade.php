@extends('admin.base')

@section('content')

<div class="app-wrapper">
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
          <h1 class="app-page-title mb-0">Admins</h1>
        </div>
        <div class="col-auto text-right">
          <a class="btn app-btn-primary" href="{{ route('reseller.admin-add') }}">Add Admin</a>
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
                  <th class="cell">Full Name</th>
                  <th class="cell">Email</th>
                  <th class="cell">Action</th>
                </tr>
              </thead>
              <tbody>

              @if($admins)
                   @php $count = 1 @endphp

                    @foreach($admins as $admin)
                <tr>
                  
                  <td class="cell">{{ $count++ }}</td>
                  <td class="cell"><strong>{{ $admin->name }}</strong></td>
                  <td class="cell">{{ $admin->email }}</td>
                  <td class="cell">
                    @if(Session::get('admin')->id != $admin->id)
                      <a href="{{ route('reseller.admin-remove', ['admin_id'=>base64_encode($admin->id)]) }}" class="badge bg-danger">Remove</a>
                    @endif

                    <a href="{{ route('reseller.admin-change-password', ['admin_id'=>base64_encode($admin->id)]) }}" class="badge bg-info">Change Password</a>

                    <a href="{{ route('reseller.admin-edit', ['admin_id'=>base64_encode($admin->id)]) }}" class="badge bg-warning">Edit</a>
                    

                    {{--<a href='{{ route("reseller.admin-reseller-remove", ["reseller_id"=>base64_encode($reseller->id)]) }}' class="btn btn-danger btn-sm">Remove</a>
                    <a href="{{ route('reseller.admin-reseller-students', ['reseller_id'=>base64_encode($reseller->id)]) }}" class="btn btn-success btn-sm">View</a>
                    <a href="{{ route('reseller.admin-reseller-change', ['reseller_id'=>base64_encode($reseller->id)]) }}" class="btn btn-info btn-sm">Change Password</a>--}}
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