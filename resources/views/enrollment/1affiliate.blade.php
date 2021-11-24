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
                                                <th>Mobile</th>
                                                <th>Country</th>
                                                <th>Course Type</th>
                                                <th>Course</th>
                                                <th>Currency</th>
                                                <th>Amount</th>
                                                <th>Course Assignment Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($records)
                                            	
                                            	@php $count = 1 @endphp
                                            	@foreach($records as $record)
                                            		<tr>
                                            			<td>{{ $count++ }}</td>
                                            			<td>{{ $record->students[0]->fname.' '.$record->students[0]->lname }}</td>
                                            			<td>{{ $record->students[0]->email }}</td>
                                            			<td>{{ $record->students[0]->mobile }}</td>
                                            			<td>{{ $record->students[0]->country }}</td>
                                            			<td>
                                            				@if($record->course_type == 1)
                                            					Selfpaced
                                            				@elseif($record->course_type == 2)
                                            					Live Virtual
                                            				@else
                                            					One On One Training
                                            				@endif
                                            			</td>
                                            			<td>{{ $record->course[0]->title }}</td>
                                            			<td>{{ $record->currency == 1 ? 'INR':'USD' }}</td>
                                            			<td>{{ $record->amount }}</td>
                                            			<td>{{ $record->created_at }}</td>
                                            		</tr>
                                            	@endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Country</th>
                                                <th>Course Type</th>
                                                <th>Course</th>
                                                <th>Currency</th>
                                                <th>Amount</th>
                                                <th>Course Assignment Date</th>
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

