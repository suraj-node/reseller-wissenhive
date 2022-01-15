@extends('dashboard.base')

@section('content')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12">
                        <div class="m-c-cont d-flex no-block align-items-center">
                            <h3 class="page-title">Course Information</h3>
                            <div class="ml-auto text-right">
                               <a href="{{ route('reseller.enrollment') }}" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i>Enroll Student</a>
                               <a href="javascript:void(0)" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add-new-user"><i class="mdi mdi-plus"></i>Add New Student</a>
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
                                                <th>Course Name</th>
                                                <th>Course Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($courses)
                                            
                                            @php $count = 1 @endphp
                                                @if(count($courses) > 0)
                                                    @foreach($courses as $course)
                                                        <tr>
                                                            <td>{{ $count++ }}</td>
                                                            {{--<td>{{ $course[0]->course[0]->title }}</td>
                                                            <td>{{ count($course) }}</td>--}}
                                                            <td>{{ $course->title }}</td>
                                                            <td>{{ $course->amount }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
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

