@extends('admin.base')

@section('content')

<div class="app-wrapper">
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
          <h1 class="app-page-title mb-0">Add Course</h1>
        </div>
        <div class="col-auto text-right">
          <a class="btn app-btn-primary" href="{{ route('reseller.course-add') }}">Add Course</a>
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
                  <th class="cell">Course Title</th>
                  <th class="cell">Group Training</th>
                  <th class="cell">One on one</th>
                  <th class="cell">Interview Preparation</th>
                  <th class="cell">Project Status</th>
                  <th class="cell">Action</th>
                </tr>
              </thead>
              <tbody>

              @if($courses)
                   @php $count = 1 @endphp

                    @foreach($courses as $course)
                <tr>
                  <td class="cell">{{ $count++ }}</td>
                  <td class="cell">
                    <span class="truncate">{{ $course->title }}</span>
                  </td>
                  <td class="cell">{{ $course->amount }}</td>
                  <td class="cell">{{ $course->one_on_one }}</td>
                  <td class="cell">{{ $course->interview_preparation }}</td>
                  <td class="cell">{{ $course->project_support }}</td>
                  <td class="cell">
                    <a href='{{ route("reseller.course-remove", ["course_id"=>base64_encode($course->id)]) }}' class="badge bg-danger">Remove</a>
                    <a href="{{ route('reseller.course-edit', ['course_id'=>base64_encode($course->id)]) }}" class="badge bg-primary">Edit</a>
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