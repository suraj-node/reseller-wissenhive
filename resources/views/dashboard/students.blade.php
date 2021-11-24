@extends('dashboard.base')

@section('content')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12">
                        <div class="m-c-cont d-flex no-block align-items-center">
                            <h3 class="page-title">Student Details</h3>
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
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Course Taken</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($students)
                                                @if(count($students) > 0)
                                                @php $count = 1 @endphp
                                                    @foreach($students as $student)
                                                        <tr>
                                                            <td>{{ $count++ }}</td>
                                                            <td>{{ $student->fname.' '.$student->lname }}</td>
                                                            <td>{{ $student->email }}</td>
                                                            <td><a href="javascript:void(0)">{{ count($student->course_taken) }}</a></td>
                                                            <td class="text-center">
                                                                @if($student->status == 0)
                                                                <a href="{{ route('reseller.status-update-user', ['value'=>1, 'id'=>$student->id]) }}" class="btn btn-danger btn-sm">Unverify</a>
                                                                @else
                                                                <a href="{{ route('reseller.status-update-user', ['value'=>0, 'id'=>$student->id]) }}" class="btn btn-success btn-sm">Verify</a>
                                                                @endif

                                                                <a href="javascript:void(0)" onclick="showUpdateForm('{{ $student }}')" class="btn btn-primary btn-sm">Edit</a>
                                                            </td>
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

