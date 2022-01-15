@extends('admin.base')

@section('content')

<div class="app-wrapper">
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
          <h1 class="app-page-title mb-0">Students</h1>
        </div>
        <div class="col-auto text-right">
          <a class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-user"><i class="mdi mdi-plus"></i>Add New</a>
        </div>
      </div>

      <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
          @include('admin.error')
          <div class="table-responsive">
            <table class="table app-table-hover mb-0 text-left" id="example">
              <thead>
                <tr>
                  <th class="cell">Sr. No.</th>
                  <th class="cell">Student Name</th>
                  <th class="cell">Email</th>
                  <th class="cell">Mobile</th>
                  <th class="cell">Country</th>
                  <th class="cell">Action</th>
                </tr>
              </thead>
              <tbody>

                @if($students)
                @php $count = 1 @endphp

                @foreach($students as $student)
                <tr class="gradeX">
                  <td class="cell">{{ $count++ }}</td>
                  <td class="cell">{{ $student->fname.' '.$student->lname }}</td>
                  <td class="cell">{{ $student->email }}</td>
                  <td class="cell">{{ $student->mobile }}</td>
                  <td class="cell">{{ $student->country }}</td>
                  <td class="cell">
                    @if(count($student->enrollment_status) > 0)
                    <a href="javascript:void(0)" class="btn btn-success btn-sm">Assigned</a>
                    @else
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm text-white">Unassigned</a>
                    @endif
                    <a href="javascript:void(0)" onclick="showUpdateForm('{{ $student }}')" class="btn btn-info btn-sm text-white">Edit</a>
                   
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
            
          </div>
          <!--//table-responsive-->
        </div>
        <!--//app-card-body-->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add-new-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark" style="background:#000;">
                    <h4 class="modal-title"><strong>Add</strong> new student</h4>
                    
                </div>
                <div class="modal-body bg-dark" style="background:#000;">
                    <form id="add-user_byadmin">
                        @csrf
                        <div class="row form-row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                  <input class="form-control form-white @error('fname') is-invalid @enderror"  placeholder="Enter first name" type="text" name="fname" />
                                  <label for="floatingInput">first name</label>
                                <p class="log-error mt-1" id='fname'></p>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-floating mb-3">
                                  <input class="form-control form-white form-white @error('lname') is-invalid @enderror" placeholder="Enter last name" type="text" name="lname" />
                                  <label for="floatingInput">last name</label>
                                <p class="log-error mt-1" id='lname'></p>
                                </div>
                            </div>

                        </div>
                        <div class="row form-row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                  <input class="form-control form-white form-white @error('email') is-invalid @enderror" placeholder="Enter email" type="email" name="email" />
                                  <label for="floatingInput">email</label>
                                <p class="log-error mt-1" id='email'></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                

                                <div class="form-floating mb-3">
                                  <input class="form-control form-white form-white @error('mobile') is-invalid @enderror" placeholder="Enter mobile" type="text" name="mobile" />
                                  <label for="floatingInput">mobile</label>
                                <p class="log-error mt-1" id='mobile'></p>
                                </div>
                            </div>
                        </div>


                        <div class="row form-row">
                            <div class="col-md-12">
                                

                                <div class="form-floating mb-3">
                                  <input class="form-control form-white form-white @error('linkedin_url') is-invalid @enderror" placeholder="Enter linkedin url" type="text" name="linkedin_url" autocomplete="off"/>
                                  <label for="floatingInput">linkedin url</label>
                                <p class="log-error mt-1" id='linkedin_url'></p>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row form-row">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select @error('country') is-invalid @enderror" name="country">
                                    @if(isset($countries))
                                            <option value="" selected disabled>Select Country</option>
                                        @foreach($countries as $cont)
                                            <option>{{ $cont->nicename }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <label for="country">Select Country</label>
                                <p class="log-error mt-1" id='country'></p>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select @error('type') is-invalid @enderror" id="_type" name="type">
                                        <option value="0">Student</option>
                                        <option value="1">Opportunity</option>
                                        <option value="2">Sales</option>
                                    </select>
                                    <label for="type">Type</label>
                                    <p class="log-error mt-1" id='type'></p>
                                </div>
                                
                            </div>
                        </div>


                        <div class="row form-row">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select form-white form-white @error('added_by') is-invalid @enderror" name="added_by">
                                    @if(isset($resellers))
                                            <option value="" selected disabled>Select Resellers</option>
                                        @foreach($resellers as $reseller)
                                            <option value="{{ $reseller->id }}">{{ $reseller->company_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                    <label for="type">Resellers</label>
                                <p class="log-error mt-1" id='added_by'></p>
                                </div>
                            </div>
                        </div>

                        


                        <div id="if_opportunity">
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('coated_amount') is-invalid @enderror" placeholder="Enter coated amount" type="number" name="coated_amount" />
                                        <label for="floatingInput">coated amount</label>
                                        <p class="log-error mt-1" id='coated_amount'></p>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-white form-white @error('interested_course') is-invalid @enderror" placeholder="Enter course name" type="text" name="interested_course" />
                                        <label for="floatingInput">course name</label>
                                        <p class="log-error mt-1" id='interested_course'></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="if_sales">
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-white form-white @error('sales_amount') is-invalid @enderror" placeholder="Enter sales amount" type="number" name="sales_amount" />
                                        <label for="floatingInput">sales amount</label>
                                        <p class="log-error mt-1" id='sales_amount'></p>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-white form-white @error('amount_paid') is-invalid @enderror" placeholder="Amount paid" type="number" name="amount_paid" />
                                        <label for="floatingInput">Amount paid</label>
                                        <p class="log-error mt-1" id='amount_paid'></p>
                                    </div>
                                    
                                    
                                </div>
                            </div>

                            <div class="row form-row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-white form-white @error('balance') is-invalid @enderror" placeholder="Balance" type="number" name="balance" />
                                        <label for="floatingInput">Balance</label>
                                        <p class="log-error mt-1" id='balance'></p>
                                    </div>
                                    
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select form-white form-white @error('mode_of_payment') is-invalid @enderror" name="mode_of_payment">
                                            <option value="0">Stripe</option>
                                            <option value="1">Paypal</option>
                                            <option value="2">Bank Transfer</option>
                                        </select>
                                        <label for="type">Payment Mode</label>
                                        <p class="log-error mt-1" id='resellers'></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer" style="background:#000;">
                    <button type="submit" class="btn btn-success btn-sm waves-effect waves-light save-category">Add</button>
                </div>
            </form>
            </div>
        </div>
</div>


<div class="modal fade" id="update-old-userbyadmin">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background:#000;">
                    <h4 class="modal-title"><strong>Update</strong> student</h4>
                    <button type="button" class="btn-close bg-white" onclick="location.reload()">&times;</button>
                </div>
                <div class="modal-body" style="background:#000;">
                    <form id="update-userbyadmin">
                        @csrf
                        <div class="row form-row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="hidden" name="student_id" id="student_id">
                                    <input class="form-control form-white @error('fnameupd') is-invalid @enderror"  placeholder="Enter first name" type="text" name="fnameupd" id='_fname' />
                                    <label for="floatingInput">first name</label>
                                    <p class="log-error mt-1" id='fnameupderr'></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control form-white form-white @error('lnameupd') is-invalid @enderror" placeholder="Enter last name" type="text" name="lnameupd" id='_lname'/>
                                    <label for="floatingInput">last name</label>
                                    <p class="log-error mt-1" id='lnameupderr'></p>
                                </div>
                            </div>

                        </div>
                        <div class="row form-row">
                            
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control form-white form-white @error('emailupd') is-invalid @enderror" placeholder="Enter email" type="email" name="emailupd" id="_email"/>
                                    <label for="floatingInput">course name</label>
                                    <p class="log-error mt-1" id='emailupderr'></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control form-white form-white @error('mobileupd') is-invalid @enderror" placeholder="Enter mobile" type="text" name="mobileupd" id="_mobile"/>
                                    <label for="floatingInput">email</label>
                                    <p class="log-error mt-1" id='mobileupderr'></p>
                                </div>
                            </div>
                        </div>

                        <div class="row form-row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input class="form-control form-white form-white @error('linkedin_urlupd') is-invalid @enderror" placeholder="Enter linkedin url" type="text" id="linkedin_urlupd" name="linkedin_urlupd" autocomplete="off"/>
                                    <label for="floatingInput">linkedin url</label>
                                    <p class="log-error mt-1" id='linkedin_urlupderr'></p>
                                </div>
                            </div>
                        </div>

                        <div class="row form-row">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select form-white form-white @error('countryupd') is-invalid @enderror" id="_country" name="countryupd">
                                        @if(isset($countries))
                                                
                                            @foreach($countries as $cont)
                                                <option>{{ $cont->nicename }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label for="type">countries</label>
                                    <p class="log-error mt-1" id='countryupderr'></p>
                                </div>
                            </div>
                           
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select form-white form-white @error('typeupd') is-invalid @enderror" id="typeupd" name="typeupd">
                                        <option value="0">Student</option>
                                        <option value="1">Opportunity</option>
                                        <option value="2">Sales</option>
                                    </select>
                                    <label for="type">Select</label>
                                    <p class="log-error mt-1" id='typeupderr'></p>
                                </div>
                            </div>

                            
                        </div>


                        <div class="row form-row">
                          <div class="col-md-12">
                              <div class="form-floating">
                                    <select class="form-select form-white form-white @error('added_by') is-invalid @enderror" id="added_byupd" name="added_byupd">
                                          @if(isset($resellers))
                                                  <option value="{{ $admin->id }}">{{ $admin->company_name }}</option>
                                              @foreach($resellers as $reseller)
                                                  <option value="{{ $reseller->id }}">{{ $reseller->company_name }}</option>
                                              @endforeach
                                          @endif
                                    </select>
                                    <label for="type">Resellers</label>
                                    <p class="log-error mt-1" id='added_byupderr'></p>
                              </div>
                          </div>
                         </div>

                        <div id="if_opportunity_edit">
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-white form-white @error('coated_amountupd') is-invalid @enderror" placeholder="Enter coated amount" type="number" id='coated_amountupd' name="coated_amountupd" />
                                        <label for="floatingInput">coated amount</label>
                                        <p class="log-error mt-1" id='coated_amountupderr'></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-white form-white @error('interested_courseupd') is-invalid @enderror" id='interested_courseupd' placeholder="Enter course interest" type="text" name="interested_courseupd" />
                                        <label for="floatingInput">course interest</label>
                                        <p class="log-error mt-1" id='interested_courseupderr'></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="if_sales_edit">
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-white form-white @error('sales_amountupd') is-invalid @enderror" id='sales_amountupd' placeholder="Enter sales amount" type="number" name="sales_amountupd" />
                                        <label for="floatingInput">sales amount</label>
                                        <p class="log-error mt-1" id='sales_amountupderr'></p>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-white form-white @error('amount_paidupd') is-invalid @enderror" id='amount_paidupd' placeholder="Amount paid" type="number" name="amount_paidupd" />
                                        <label for="floatingInput">Amount paid</label>
                                        <p class="log-error mt-1" id='amount_paidupderr'></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-white form-white @error('balanceupd') is-invalid @enderror" id='balanceupd' placeholder="Balance" type="number" name="balanceupd" />
                                        <label for="floatingInput">Balance</label>
                                        <p class="log-error mt-1" id='balanceupderr'></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select   form-white form-white @error('mode_of_paymentupd') is-invalid @enderror" name="mode_of_paymentupd" id="mode_of_paymentupd">
                                            <option value="0">Stripe</option>
                                            <option value="1">Paypal</option>
                                            <option value="2">Bank Transfer</option>
                                        </select>
                                        <label for="floatingInput">Payment Mode</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                    </div>
                <div class="modal-footer" style="background:#000;">
                    <button type="submit" class="btn btn-success btn-sm waves-effect waves-light save-category">Update</button>
                </div>
            </form>
            </div>
        </div>
</div>



           
@endsection