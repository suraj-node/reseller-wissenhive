$(function(){


	var APP_URL			= $("#base").val();

	var USER_URL 	= APP_URL+'/reseller/users';

	var ADD_USER_URL 	= APP_URL+'/reseller/add-user';

	var UPDATE_USER_URL = APP_URL+'/reseller/update-user';

	var VERIFY_EMAIL 	= APP_URL+'/reseller/verify-old-password';

	var FORCED_LOGOUT 	= APP_URL+'/reseller/forced-logout';

	var GET_COURSE_URL 	= APP_URL+'/reseller/get-course';

	var ENROLLMENT		= APP_URL+'/reseller/assign-course';
	
	var AFFILIATE_URL   = APP_URL+'/reseller/affiliate-report';
	
	var SEND_INVOICE_URL   = APP_URL+'/reseller/send-invoice';

	var ADD_USER_BY_ADMIN_URL 	= APP_URL+'/pinnacle-admin/add-user';
	
	var UPDATE_USER_BY_ADMIN_URL = APP_URL+'/pinnacle-admin/update-user';

	var UPDATE_INVOICE_BY_ADMIN_URL = APP_URL+'/pinnacle-admin/updateinvoice';


	$("#invoice-update").on('submit', function(e){
		e.preventDefault();

			$.ajax({
				url : UPDATE_INVOICE_BY_ADMIN_URL,
				method:'POST',
				data:$("#invoice-update").serialize(),
				success:function(response){
					toastr.success('Notification has been sent to reseller', 'Congrats !');
					$("#exampleModal").modal('toggle');
					setTimeout(function(){
						location.reload();
					},3000);
				},
				error:function(response){
					
					var err = response.responseJSON;
					$.each(err.errors, function(key, value){

	                    $("#"+key+'err').html(value);
	                    setTimeout(function(){
	                        $("#"+key+'err').html('');
	                    }, 3000);
				});

			}

		});

	});


	$("#invoice").on('submit', function(e){
		e.preventDefault();

			$.ajax({
				url : SEND_INVOICE_URL,
				method:'POST',
				data:$("#invoice").serialize(),
				success:function(response){
					toastr.success('Invoice has been successfully sent to admin', 'Congrats !');
					$("#form-model").modal('toggle');
					setTimeout(function(){
						location.reload();
					},3000);
				},
				error:function(response){
					
					var err = response.responseJSON;
					$.each(err.errors, function(key, value){

	                    $("#"+key+'err').html(value);
	                    setTimeout(function(){
	                        $("#"+key+'err').html('');
	                    }, 3000);
				});

			}

		});

	});


	$("#add-user").on('submit', function(e){
		e.preventDefault();

			$.ajax({
				url : ADD_USER_URL,
				method:'POST',
				data:$("#add-user").serialize(),
				success:function(response){
					toastr.success('Student has been successfully added', 'Congrats !');
					$("#add-user").find("input[type=text], textarea").val("");
					$("#add-new-user").modal('toggle');
					setTimeout(function(){
						location.reload();
					},3000);
				},
				error:function(response){
					console.log(response);
					var err = response.responseJSON;
					$.each(err.errors, function(key, value){

	                    $("#"+key).html(value);
	                    setTimeout(function(){
	                        $("#"+key).html('');
	                    }, 3000);
				});

			}

		});

	});


	$("#add-user_byadmin").on('submit', function(e){
		e.preventDefault();
			
			$.ajax({
				url : ADD_USER_BY_ADMIN_URL,
				method:'POST',
				data:$("#add-user_byadmin").serialize(),
				success:function(response){
					toastr.success('Student has been successfully added', 'Congrats !');
					$("#add-user_byadmin").find("input[type=text], textarea").val("");
					$("#add-new-user").modal('toggle');
					setTimeout(function(){
						location.reload();
					},3000);
				},
				error:function(response){
					console.log(response);
					var err = response.responseJSON;
					$.each(err.errors, function(key, value){

	                    $("#"+key).html(value);
	                    setTimeout(function(){
	                        $("#"+key).html('');
	                    }, 3000);
				});

			}

		});

	});

	$("#update-user").on('submit', function(e){
		e.preventDefault();

			$.ajax({
				url : UPDATE_USER_URL,
				method:'POST',
				data:$("#update-user").serialize(),
				success:function(response){
					toastr.success('Student has been successfully updated', 'Congrats !');
					$("#update-user").find("input[type=text], textarea").val("");
					$("#update-old-user").modal('toggle');
					setTimeout(function(){
						location.reload();
					},3000);
				},
				error:function(response){
					var err = response.responseJSON;
					console.log(err);
					$.each(err.errors, function(key, value){

	                    $("#"+key+'err').html(value);
	                    setTimeout(function(){
	                        $("#"+key+'err').html('');
	                    }, 3000);
				});

			}

		});

	});



	$("#update-userbyadmin").on('submit', function(e){
		e.preventDefault();
			
			$.ajax({
				url : UPDATE_USER_BY_ADMIN_URL,
				method:'POST',
				data:$("#update-userbyadmin").serialize(),
				success:function(response){
					//console.log(response);return false;
					toastr.success('Student has been successfully updated', 'Congrats !');
					//$("#update-old-user").find("input[type=text], textarea").val("");
					$("#update-old-userbyadmin").modal('toggle');
					setTimeout(function(){
						location.reload();
					},3000);
				},
				error:function(response){
					var err = response.responseJSON;
					console.log(err);
					$.each(err.errors, function(key, value){

	                    $("#"+key+'err').html(value);
	                    setTimeout(function(){
	                        $("#"+key+'err').html('');
	                    }, 3000);
				});

			}

		});

	});


		$("#change-user-password").on('submit', function(e){
			e.preventDefault();
			$.ajax({

				url : VERIFY_EMAIL,
				data:$("#change-user-password").serialize(),
				method:'POST',
				success:function(response){
					if(response.custom_error){
						$("#old_password").html(response.custom_error);
						$("#password_field").focus();
						return false;
					}

					if(response.done == 1){
						window.location = FORCED_LOGOUT;
					}
					
				},

				error:function(response){
					
					var err = response.responseJSON;
						$.each(err.errors, function(key, value){

		                    $("#"+key).html(value);
		                    setTimeout(function(){
		                        $("#"+key).html('');
		                    }, 3000);

				});

			}


		});

	});

	$("#assign-form").on('submit', function(e){
		
		e.preventDefault();
		$(".spinner-border").show();
		$.ajax({

			url 	: ENROLLMENT,
			method	: 'POST',
			data 	: $("#assign-form").serialize(),
			success:function(response){
				
				if(response.error_msg){
					var htmlMsg = "<div class='alert alert-danger' role='alert'>"+response.error_msg+"</div>";
					$("#messages").html(htmlMsg);
					$(".spinner-border").hide();
				}

				if(response.success_msg){
					
					var htmlMsg = "<div class='alert alert-success' role='alert'>"+response.success_msg+"</div>";
					$("#messages").html(htmlMsg);	
					setTimeout(function(){
						window.location.href = AFFILIATE_URL;
					},2000);
				}
			},
			error:function(response){


				var err = response.responseJSON;
						$.each(err.errors, function(key, value){

		                    $("#"+key).html(value);
		                    setTimeout(function(){
		                        $("#"+key).html('');
		                    }, 3000);
		         });
			
				$(".spinner-border").hide();
			
			}

		});

	});


	$("#_type").on('change', function(){
		if(this.value == 1){
			$("#if_opportunity").css('display','block');
		}else{
			$("#if_opportunity").css('display','none');
		}

		if(this.value == 2){
			$("#if_sales").css('display','block');
		}else{
			$("#if_sales").css('display','none');
		}
	});


	$("#typeupd").on('change', function(){
		if(this.value == 1){
			$("#if_opportunity_edit").css('display','block');
		}else{
			$("#if_opportunity_edit").css('display','none');
		}

		if(this.value == 2){
			$("#if_sales_edit").css('display','block');
		}else{
			$("#if_sales_edit").css('display','none');
		}
	});

	$("#student_type").on('change', function(){
		var qry_string = this.value;
		if(qry_string != '-1'){
			var $url = APP_URL+'/reseller/users/?user_type='+qry_string;
			window.location = $url;
		}
	});

});

