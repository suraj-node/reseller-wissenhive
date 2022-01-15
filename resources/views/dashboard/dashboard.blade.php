@extends('dashboard.base')

@section('content')

                <div class="container-fluid">
                   
                    <div class="row">
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                    <h6 class="text-white">
                                        <a href="{{ route('reseller.courses') }}" class="text-white">Courses</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3">
                            <div class="card card-hover">
                                <div class="box bg-success text-center">
                                    <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                                    <h6 class="text-white">
                                        <a href="{{ route('reseller.users') }}" class="text-white">Students</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                         <!-- Column -->
                        <div class="col-md-6 col-lg-3">
                            <div class="card card-hover">
                                <div class="box bg-warning text-center">
                                    <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                                    <h6 class="text-white">
                                        <a href="{{ route('reseller.enrollment') }}" class="text-white">Enrollments</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3">
                            <div class="card card-hover">
                                <div class="box bg-danger text-center">
                                    <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                                    <h6 class="text-white">
                                        <a href="{{ route('reseller.affiliate-report') }}" class="text-white">Reports</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            
            @endsection