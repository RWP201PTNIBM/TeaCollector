<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Factory Officer Registration</title>

	<!-- Font Icon -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/material-icon/css/material-design-iconic-font.min.css">

	<!-- Main css -->
	<link class="one" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link class="second" rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
</head>

<body>

	<div class="main">

		<section class="signup">
			<!-- <img src="images/signup-bg.jpg" alt=""> -->
			<div class="container ">
				<div class="signup-content">
				        <div class="form-group">
                          <span id="success_message"></span>
						</div>
					<form method="POST" id="officer_registration_form" class="signup-form" action="">
						<h2 class="form-title">Officer Registration</h2>
					
						<div class="form-group">
							<input type="text" class="form-input" name="officer_name" id="officer_name" placeholder="Enter officer's name"  />
							<span id="officer_name_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
							<input type="text" class="form-input" name="email" id="email" placeholder="Enter officer's email" />
							<span id="email_error" class="text-danger"></span>
						</div>
						<div class="form-group">
							<input type="text" class="form-input" name="user_name" id="user_name" placeholder="Enter UserName"/>
							<span id="user_name_error" class="text-danger"></span>
                        </div>
                       <div class="form-group">
							<input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
							<span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
							<span id="password_error" class="text-danger"></span>
						</div>
						<div class="form-group">
							<input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password"/>
							<span id="re_password_error" class="text-danger"></span>
                        </div>

						<div class="form-group">
							<input type="submit" name="register" id="register" class="form-submit" value="Register" />
						</div>
					</form>
				</div>
			</div>
		</section>

	</div>

	<!-- JS -->
	<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
</body>

</html>
<script>
	$(document).ready(function() {
		$('#officer_registration_form').on('submit', function(event) {
			event.preventDefault();
			$('#officer_name_error').html('');
			$('#email_error').html('');
			$('#user_name_error').html('');
			$('#password_error').html('');
			$('#re_password_error').html('');
			$.ajax({
				url: "<?php echo base_url(); ?>officer/officer_registration_validation",
				method: "POST",
				data: $(this).serialize(),
				dataType: "json",
				beforeSend: function() {
					$('#register').attr('disabled', 'disabled');

				},
				success: function(data) {

					if (data.error) {
						if (data.officer_name_error != '') {
							$('#officer_name_error').html(data.officer_name_error);
						} else {
							$('#officer_name_error').html('');
						}
						if (data.email_error != '') {
							$('#email_error').html(data.email_error);
						} else {
							$('#email_error').html('');
						}
						if (data.user_name_error != '') {
							$('#user_name_error').html(data.user_name_error);
						} else {
							$('#user_name_error').html('');
						}
						if (data.password_error != '') {
							$('#password_error').html(data.password_error);
						} else {
							$('#password_error').html('');
						}
						if (data.re_password_error != '') {
							$('#re_password_error').html(data.re_password_error);
						} else {
							$('#re_password_error').html('');
						}
					} else {
						$('#officer_name_error').html('');
						$('#email_error').html('');
						$('#user_name_error').html('');
						$('#password_error').html('');
						$('#re_password_error').html('');
						$('#officer_registration_form')[0].reset();
                        $('#success_message').html(data.success);
						
					}
					$('#register').attr('disabled', false);
				}
			})

		});

	});
</script>