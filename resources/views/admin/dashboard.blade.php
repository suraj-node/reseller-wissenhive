@extends('admin.base')

@section('content')
<div class="app-wrapper">
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <h1 class="app-page-title">Overview</h1>
      <div class="
              app-card
              alert alert-dismissible
              shadow-sm
              mb-4
              border-left-decoration
            " role="alert">
        <div class="inner">
          <div class="app-card-body p-3 p-lg-4">
            <h3 class="mb-0 text-white">
              Welcome to <strong>Pinnacledu Reseller</strong>!
            </h3>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      </div>
      <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
          <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
              <h4 class="stats-type mb-1">Total Sales</h4>
              <div class="stats-figure">$12,628</div>
              <div class="stats-meta text-success">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up" fill="currentColor"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                </svg>
                20%
              </div>
              <button type="submit" class="
                      btn btn-danger
                      text-white
                      mt-3
                      app-add-department-btn
                    ">
                Save Changes
              </button>
            </div>
            <!--//app-card-body-->
            <div class="app-card-body app-add-department" style="display: none">
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" />
                <label for="floatingInput">Department</label>
              </div>
              <button type="submit" class="btn btn-success text-white mt-1">
                <span class="me-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus"
                    viewBox="0 0 16 16">
                    <path
                      d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                  </svg>
                </span>
                Add
              </button>
            </div>
          </div>
          <!--//app-card-->
        </div>
        <!--//col-->

        <div class="col-6 col-lg-3">
          <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
              <h4 class="stats-type mb-1">Expenses</h4>
              <div class="stats-figure">$2,250</div>
              <div class="stats-meta text-success">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down" fill="currentColor"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                </svg>
                5%
              </div>
              <button type="submit" class="btn btn-warning mt-3">
                Save Changes
              </button>
            </div>
            <!--//app-card-body-->
          </div>
          <!--//app-card-->
        </div>
        <!--//col-->
        <div class="col-6 col-lg-3">
          <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
              <h4 class="stats-type mb-1">Projects</h4>
              <div class="stats-figure">23</div>
              <div class="stats-meta">Open</div>
              <button type="submit" class="btn btn-info text-white mt-3">
                Save Changes
              </button>
            </div>
            <!--//app-card-body-->
          </div>
          <!--//app-card-->
        </div>
        <!--//col-->
        <div class="col-6 col-lg-3">
          <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
              <h4 class="stats-type mb-1">Invoices</h4>
              <div class="stats-figure">6</div>
              <div class="stats-meta">New</div>
              <button type="submit" class="btn app-btn-primary mt-3">
                Save Changes
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection