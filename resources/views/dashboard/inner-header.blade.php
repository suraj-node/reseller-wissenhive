            @if(Session::get('reseller')->type == 0)
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12">
                        <div class="m-c-cont d-flex no-block align-items-center">
                            <h3 class="page-title">Candidates Details</h3>
                            <div class="ml-auto text-right">
                               <a href="{{ route('reseller.enrollment') }}" class="btn btn-info btn-sm mr-3"><i class="mdi mdi-plus"></i>Enroll Candidate</a>
                                    <a href="javascript:void(0)" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add-new-user"><i class="mdi mdi-plus"></i>Add New Candidate</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif