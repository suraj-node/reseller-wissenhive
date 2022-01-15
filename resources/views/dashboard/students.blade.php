@extends('dashboard.base')

@section('content')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12">
                        <div class="m-c-cont d-flex no-block align-items-center">
                            <h3 class="page-title">Candidates Details</h3>
                            <div class="ml-auto text-right">
                               <a href="{{ route('reseller.enrollment') }}" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i>Enroll Candidate</a>
                               <a href="javascript:void(0)" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add-new-user"><i class="mdi mdi-plus"></i>Add New Candidate</a>
                               <select id="student_type" class="form-control mt-2">
                                    <option value='-1'>Filter by user type</option>
                                    <option value='0'>Candidate</option>
                                    <option value='1'>Opportunity</option>
                                    <option value='2'>Sales</option>
                               </select>
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
                                                <th>Phone</th>
                                                <th>Candidate Type</th>
                                                <th>Invoice Status</th>
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
                                                            {{--<td><a href="javascript:void(0)">{{ count($student->course_taken) }}</a></td>--}}
                                                            <td>{{ $student->mobile }}</td>
                                                            <td>
                                                                @if($student->type == 0)
                                                                    <p class='badge badge-info'>Student</p>
                                                                @elseif($student->type == 1)
                                                                    <p class='badge badge-success'>Opportunity</p>
                                                                @else
                                                                    <p class='badge badge-danger'>Sales</p>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($student->status == 0)
                                                                    <p class='badge badge-danger'>Invoice not sent</p>
                                                                @else
                                                                    <p class='badge badge-success'>Invoice sent</p>
                                                                @endif
                                                            </td>
                                                            <td class="text-left">
                                                                @if($student->status == 0)
                                                                    @if($student->type !== 2)
                                                                        <a href="javscript:void(0)" onclick="generateForm('{{ $student }}')" class="btn btn-danger btn-sm">Send Invoice</a>
                                                                    @endif
                                                                @else
                                                                <a href="{{ route('reseller.status-update-user', ['value'=>0, 'id'=>$student->id]) }}" class="btn btn-success btn-sm">Reset</a>
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

    <div class="modal fade" id="form-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm the values</h5>
            <button type="button" onclick="location.reload()">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="invoice">
                @csrf
                <div class="row form-row">
                    <div class="col-md-6">
                        <input   type="hidden" id="candidate_id" name="candidate_id" /> 
                        <input class="form-control form-white @error('amount') is-invalid @enderror"  placeholder="Enter amount" type="number" id="amount" name="amount" />
                        <p class="log-error mt-1" id='amounterr'></p>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control form-white form-white @error('course') is-invalid @enderror" placeholder="Enter course name" type="text" id="course" name="course" />
                        <p class="log-error mt-1" id='courseerr'></p>
                    </div>

                    <div class="col-md-12">
                        <select class="form-control  form-white form-white @error('mode_of_payment') is-invalid @enderror" id="mode_of_payment" name="mode_of_payment">
                            <option value="0">Stripe</option>
                            <option value="1">Paypal</option>
                            <option value="2">Bank Transfer</option>
                        </select>
                    </div>
                    <div class="col-md-12 mt-3">
                        <input class="form-control form-white form-white @error('comment') is-invalid @enderror" placeholder="Comment" type="text" name="comment" />
                        <p class="log-error mt-1" id='commenterr'></p>
                    </div>

                </div>
           
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Send Invoice</button>
            </div>
            </form>
        </div>
    </div>
    </div>

    <script>
        function generateForm(studentObject){
        
            var json_decoded_object = JSON.parse(studentObject);
            var m_o_p = '';

            if(json_decoded_object.mode_of_payment == 0){
                m_o_p = 'Stripe';
            }else if(json_decoded_object.mode_of_payment == 1){
                m_o_p = 'Paypal';
            }else if(json_decoded_object.mode_of_payment == 2){
                m_o_p = 'Bank Transfer';
            }else{
                m_o_p = 'Select';
            }

            $("#candidate_id").val(json_decoded_object.id);
            $("#amount").val(json_decoded_object.coated_amount);
            $("#course").val(json_decoded_object.interested_course);
            $("#mode_of_payment").prepend($("<option selected></option>").attr("value", json_decoded_object.type).text(m_o_p));
            $("#form-model").modal('toggle');

        }
    </script>

   @endsection

