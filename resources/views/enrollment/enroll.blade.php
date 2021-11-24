@extends('dashboard.base')

@section('content')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12">
                        <div class="m-c-cont d-flex no-block align-items-center">
                            <h3 class="page-title">Enrollment Form</h3>
                            <div class="ml-auto text-right">
                               <a href="javascript:void(0)" class="btn btn-warning btn-sm ml-3" data-toggle="modal" data-target="#add-new-user"><i class="mdi mdi-plus"></i>Add New Student</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                  <div id="messages">
                      
                  </div>
                  
                 <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form class="form-horizontal" id="assign-form">
                                @csrf
                                <div class="card-body">
                                    
                                    <div class="form-group row">
                                    
                                        <div class="col-md-6">
                                            <select class="select2 form-control custom-select" id="student" style="width: 100%; height:36px;" name="_student">
                                                <option value="">Search User</option>
                                                <optgroup label="Students added by you">
                                                    @if($users)
                                                        @if(count($users) > 0)
                                                            @foreach($users as $user)
                                                                <option value="{{ $user->id }}">{{ $user->fname.' '.$user->lname }}</option>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </optgroup>
                                            </select>
                                            <p class="log-error mt-1" id='_student'></p>
                                        </div>

                                        <div class="col-md-6">
                                            <select class="form-control" id="course_type" name="_coursetype" style="width: 100%; height:36px;">
                                                <option value="" selected disabled>Select Course Type</option>
                                                <option value="1">Selfpaced Classes</option>
                                                <option value="2">Live Virtual Classes</option>
                                                <option value="3">One On One Training</option>
                                            </select>
                                            <p class="log-error mt-1" id='_coursetype'></p>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                    
                                        <div class="col-md-6">
                                            <select class="select2 form-control custom-select" id="course_id" onchange="updateSchedule(this.value)" style="width: 100%; height:36px;" name='_course'>
                                                <option value="">Select Course</option>
                                                <optgroup label="Recommended Courses">
                                                    @if($courses)
                                                        @if(count($courses) > 0)
                                                            @foreach($courses as $course)
                                                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </optgroup>
                                            </select>
                                            <p class="log-error mt-1" id='_course'></p>
                                        </div>

                                        <div class="col-md-6">
                                            <select class="form-control" id="course_schedule" name="_schedule" style="width: 100%; height:36px;" readonly>
                                                <option value="0" selected disabled>Schedule type</option>
                                            </select>
                                            <p class="log-error mt-1" id='_schedule'></p>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        
                                         <div class="col-md-6">
                                            <select class="form-control" id="currency" name="_currency" onchange="getCurrency(this.value)" style="width: 100%; height:36px;">
                                                <option value="" selected disabled>Select Currency</option>
                                                <option value="1">INR</option>
                                                <option value="2">USD</option>
                                            </select>
                                            <p class="log-error mt-1" id='_currency'></p>
                                        </div>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="amount" name="_amount" placeholder="Amount to be paid" readonly="">
                                            <p class="log-error mt-1" id='_amount'></p>
                                        </div>

                                    </div>
                                   
                                </div>
                                <div class="border-top">
                                    <div class="card-body d-flex">
                                        <button type="submit" class="btn btn-primary btn-sm">Assign</button>
                                        
                                        
                                        <div class="spinner-border text-primary ml-3 hide" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                   
                </div>

            </div>
            
            <script type="text/javascript">
                function updateSchedule(course_id){

                       var student = $("#student").val();
                       var current_course_type = $("#course_type").val();
                       $("#course_schedule").find('option').remove().end();
                       
                       if(current_course_type == null){

                            alert("Select valid course type");
                            $("#course_type").focus();
                            $("#course_schedule").append($("<option></option>")
                                                    .attr("value", '0')
                                                    .text('Schedule type'));
                            return false;

                       }else if(current_course_type !== '2'){
                            
                            if(course_id){

                                const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                               
                                $.ajax({

                                    url : "{{ route('reseller.get-schedulebytype') }}",
                                    method:'get',
                                    data:{'id':course_id},
                                    success:function(response){
                                        if(response.data){
                                            $.each(response.data, function(key, value){
                                                var date = new Date(value.date);
                                                $("#course_schedule").append($("<option></option>")
                                                    .attr("value", value.id)
                                                    .text(date.getDate()+' '+monthNames[date.getMonth()]+' '+value.schedule_type+' ('+value.duration+'Weeks'+')'));
                                            });
                                        }
                                    },
                                    error:function(response){

                                    }

                                });

                            }

                       }else{

                            $("#course_schedule").append($("<option></option>")
                                                    .attr("value", '0')
                                                    .text('Schedule type'));
                       }

                }

                
                    function getCurrency(value){
                        var current_course_type = $("#course_type").val();
                        var course_id           = $("#course_id").val();

                        $.ajax({

                                    url : "{{ route('reseller.get-amountbytype') }}",
                                    method:'get',
                                    data:{'course_id':course_id, 'course_type':current_course_type,'currency':value},
                                    success:function(response){
                                        if(response.data){
                                            $("#amount").val(response.data);
                                        }
                                    },
                                    error:function(response){

                                    }

                                });
                    }

            </script>

   @endsection


