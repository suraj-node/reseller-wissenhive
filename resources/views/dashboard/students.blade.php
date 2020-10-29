@extends('dashboard.base')

@section('content')
            <div class="container-fluid">
                <h3 class="card-title">Student Details</h3>
                <div class="row">
                    <div class="col-12">
                      
                        <div class="card">
                            <div class="card-body">
                                
                                <div class="row">
                                    <a href="{{ route('reseller.enrollment') }}" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i>Enroll Student</a>
                                    &nbsp;&nbsp;
                                    <a href="javascript:void(0)" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add-new-user"><i class="mdi mdi-plus"></i>Add New Student</a>
                                </div>
                                <div class="table-responsive mt-5">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
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
                                                            <td><a href="">1</a></td>
                                                            <td>
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
                                        <tfoot>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Course Taken</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
   

   @endsection

