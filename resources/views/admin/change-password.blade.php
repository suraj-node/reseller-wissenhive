@extends('admin.base')

@section('content')

<div class="app-wrapper">
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

      <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
          <h1 class="app-page-title mb-0">Change Password</h1>
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
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                  </svg></span>Change Password
              </h5>
            </div>
            <div class="app-card-body">
              <form action="{{ route('reseller.admin-reseller-change-make') }}" method="post"
                class="settings-form needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-floating">
                      <input type="hidden" id="input-email" name="reseller_id" value="{{ $reseller_id }}"> 
                      <input type="password" id="input-lname" name="password" value="{{ old('password') }}" class="form-control" placeholder="Password" autocomplete="off" />
                      <label for="password">Password</label>
                      <span class="error-message">{{ $errors->first('password') }}</span>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col">
                    <button type="submit" class="btn app-btn-primary">
                      <span class="me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                          <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                      </span>
                      Save Password
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