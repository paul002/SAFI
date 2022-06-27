<!DOCTYPE html>
<html lang="en">
<head>
	<title>SAFI - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body> 
	<div class="limiter">
		<div class="container-login100 main-bg">
			<div class="wrap-login100">
				<form id="loginForm" class="login100-form validate-form">
					<span class="login100-form-title p-b-20">
						<img src="images/logo.png" alt="logo" width="128">
					</span>
					<span class="login100-form-title p-b-26">
						Login
					</span>
					<div id="alert" class="alert m-b-26 fs-14" role="alert"></div>
					<div class="wrap-input100 validate-input" data-validate = "Valid format is: email@domain.com">
						<input class="input100" type="text" name="email" id="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass" id="pass">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" id="login" class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

					<div class="text-center p-t-50">
						<span class="txt1">
							Don’t have an account?
						</span>

						<a class="txt2" href="#">
							Reset Password
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<script>
	$(document).ready(function(){
		$('#alert').hide();
	})
    $('#loginForm').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
		var userEmail = $('#email').val();
		var userPass = $('#pass').val();
		if(userEmail != "" && userPass != ""){
			$.ajax({
            url: "scripts/login.php",
            data: formData,
			type: "POST",
			dataType: "json",
            processData: false,
            contentType: false,
			success:function(response){
					var status = response.status;
					console.log(response);
					switch(status){
						case 1:
							if(response.isActive == 0){
								var htmlAlertIcon = '<i class="fa fa-info-circle">&nbsp;</i> Your account is not active';
								$('#alert').removeClass('alert-danger');
								$('#alert').addClass('alert-success');
								$('#alert').show().fadeOut(2000);
								$('#alert').html(htmlAlertIcon);
								return false;
							}else{
								window.location.href="dashboard/index.php";
							}
							break;
						case -1:
							var htmlAlertIcon = '<i class="fa fa-exclamation-triangle">&nbsp;</i>Invalid Request';
							$('#alert').removeClass('alert-success');							
							$('#alert').addClass('alert-danger');
							$('#alert').show().fadeOut(2000);
							$('#alert').html(htmlAlertIcon);
						break;
						default:
							var htmlAlertIcon = '<i class="fa fa-exclamation-triangle">&nbsp;</i>Invalid Credentials';
							$('#alert').removeClass('alert-success');							
							$('#alert').addClass('alert-danger');
							$('#alert').show().fadeOut(2000);
							$('#alert').html(htmlAlertIcon);
						break;
					}
				}
			})
		}
    });
</script>