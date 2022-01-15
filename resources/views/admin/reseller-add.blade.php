@extends('admin.base')

@section('content')

<div class="app-wrapper">
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

      <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
          <h1 class="app-page-title mb-0">Add Reseller</h1>
        </div>
        <div class="col-auto text-right">
          <a class="btn app-btn-primary" href="{{ route('reseller.admin-resellers') }}">View Reseller</a>
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
                  </svg></span>Personal Information
              </h5>
            </div>
            <div class="app-card-body">
              <form action="{{ route('reseller.admin-reseller-add-make') }}" method="post"
                class="settings-form needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" name="email" placeholder="Email"
                        value="{{ old('email') }}" autocomplete="off" />
                      <label for="email">Email</label>
                      <span class="error-message">{{ $errors->first('email') }}</span>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-floating">

                      <input type="text" id="input-fname" name="company_name" placeholder="Company Name"
                        value="{{ old('company_name') }}" class="form-control" autocomplete="off">
                      <label for="c_name">Company Name</label>
                      <span class="error-message">{{ $errors->first('company_name') }}</span>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-floating">
                      <input type="password" id="input-lname" name="password" value="{{ old('password') }}"
                        class="form-control" placeholder="Password" autocomplete="off" />
                      <label for="password">Password</label>
                      <span class="error-message">{{ $errors->first('password') }}</span>
                    </div>
                  </div>

                  <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-floating">
                      <select class="form-select" name="type">
                        <option value="0">Reseller</option>
                        <option value="1">Marketer</option>
                      </select>
                      <label for="floatingSelect">Works with selects</label>
                      <span class="error-message">{{ $errors->first('type') }}</span>
                    </div>
                  </div>

                  <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-floating">
                      <input class="form-control" type="number" id="input-lname" name="profit"
                        placeholder="Profit value" value="{{ old('profit') }}">
                      <label for="profit">Profit value</label>
                      <span class="error-message">{{ $errors->first('profit') }}</span>
                    </div>
                  </div>

                  <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" name="url" placeholder="Url" value="{{ old('url') }}">
                      <label for="url">URL</label>
                      <span class="error-message d-none">Please enter URL</span>
                    </div>
                  </div>
                </div>



                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="input-group mb-4">
                      <input type="file" class="form-control" name="logo" />
                      <label class="input-group-text" for="inputGroupFile02">Company Logo
                      </label>
                      <span class="error-message d-none">{{ $errors->first('logo') }}</span>
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
                      Save Info
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