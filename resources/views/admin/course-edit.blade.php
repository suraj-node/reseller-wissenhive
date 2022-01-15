@extends('admin.base')

@section('content')

<div class="app-wrapper">
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

      <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
          <h1 class="app-page-title mb-0">Edit Course</h1>
        </div>
      </div>


      <div class="row">
        <div class="col-12">
          <div class="app-card">
            <div class="app-card-header">
              <h5>
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    <path fill-rule="evenodd"
                      d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                  </svg></span>Course Information
              </h5>
            </div>
            <div class="app-card-body">
            @include('admin.error')
              <form action="{{ route('reseller.course-edit-make') }}" method="post"
                class="settings-form needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-floating">
              <input type="hidden" class="form-control" id="input-fname" name="course_id" value="{{ $course->id }}">
              <input type="text" id="input-fname" class="form-control" name="title" placeholder="Course title" value="{{ old('title', $course->title) }}">
                      <label for="email">Course Title</label>
                      <span class="error-message">{{ $errors->first('title') }}</span>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-floating">
                      <input type="number" id="input-lname" class="form-control" name="amount" placeholder="Course amount" value="{{ old('amount', $course->amount) }}">
                      <label for="c_name">Group Training</label>
                      <span class="error-message">{{ $errors->first('amount') }}</span>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="form-floating">
                      <input type="number" class="form-control" id="input-fname" name="one_on_one" placeholder="One on one training" value="{{ old('one_on_one', $course->one_on_one) }}">
                      <label for="email">One On One Training</label>
                      <span class="error-message">{{ $errors->first('one_on_one') }}</span>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="form-floating">

                      <input type="number" class="form-control" id="input-lname" name="interview_preparation" placeholder="Interview preparation amount" value="{{ old('interview_preparation', $course->interview_preparation) }}">
                      <label for="c_name">Interview Preparation</label>
                      <span class="error-message">{{ $errors->first('interview_preparation') }}</span>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="form-floating">

                      <input type="number" class="form-control" id="input-lname" name="project_support" placeholder="Project support amount" value="{{ old('project_support', $course->project_support) }}">
                      <label for="c_name">Project Support</label>
                      <span class="error-message">{{ $errors->first('project_support') }}</span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <button type="submit" class="btn app-btn-primary">
                      <span class="me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                          class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
                          <path fill-rule="evenodd"
                            d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z" />
                          <path
                            d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z" />
                        </svg>
                      </span>
                      Update Course
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection