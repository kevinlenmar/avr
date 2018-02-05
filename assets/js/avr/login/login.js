$('#login').ready(function() {
	var emp_id = "admin";
	var password = "admin";
	
	
	var userData;

	$('#btnSign').click(function(){

		/*userData = {
			emp_id : 	$('#emp_id').val(),
			password : 	$('#password').val(),
		}*/
		
		if(emp_id == $('#emp_id').val()){
			if(password == $('#password').val()){
				window.location.href = "calendar";
			}else{
				alert("User Incorrect");
				location.reload();
			}
		}else{
			alert("User Incorrect");
			location.reload();
		}

		/*$.ajax({
			url: 'avr/login',
			post: 'post',
			dataType: 'json',
			data: userData,
			success: function(result){				
				console.log(result);
				console.log(userData);
				if(result){
					window.location.href = "calendar";
				}else{
					alert("Your id and password don't match!");
					location.reload();
				}
			},
			error: function( xhr, status){
				alert("Error");
			}
		});*/
	});
});