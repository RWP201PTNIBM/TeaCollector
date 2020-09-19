<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Edit Officer Details</title>

	<!-- Font Icon -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/material-icon/css/material-design-iconic-font.min.css">

	<!-- Main css -->
	<link class="second" rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
</head>

<body>

	<div class="main">

		<section class="signup">
			<!-- <img src="images/signup-bg.jpg" alt=""> -->
			<div class="container ">
				<div class="signup-content">
					<form method="POST" id="edit_officer_form" class="signup-form" action="">
						<h2 class="form-title">Edit Officer</h2>
							<input type="text" class="form-input" name="officer_id" id="officer_id" placeholder="Enter officer's name" value="<?php echo set_value('officer_id',$officer['officer_id']);?>" hidden/>
							
							<label for="officer_name">Officer Name</label>
							<input type="text" class="form-input" name="officer_name" id="officer_name" placeholder="Enter officer's name" value="<?php echo set_value('officer_name',$officer['name']);?>" />
							<span id="officer_name_error" class="text-danger"></span>

							<label for="email">Email</label>
							<input type="text" class="form-input" name="email" id="email" placeholder="Enter officer's email" value="<?php echo set_value('email',$officer['email']);?>" />
							<span id="email_error" class="text-danger"></span>
						
						    <label for="user_name">User Name</label>
							<input type="text" class="form-input" name="user_name" id="user_name" placeholder="Enter UserName" value="<?php echo set_value('user_name',$officer['username']);?>" />
							<span id="user_name_error" class="text-danger"></span>
                        
                            <label for="password">Password</label>
							<input type="password" class="form-input" name="password" id="password" placeholder="Password"  value="<?php echo isset($officer['password']) ? set_value('password',$officer['password']) : '';?>"  />
							<span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
							<span id="password_error" class="text-danger"></span>
						
						    <label for="re_password">Confirm Password</label>
							<input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password"  value="<?php echo isset($officer['password']) ? set_value('re_password',$officer['password']) : '';?>" />
							<span id="re_password_error" class="text-danger"></span>

							<input type="hidden" name="current_email" id="current_email" value="<?php echo set_value('current_email',$officer['email']);?>" />
						    <input type="hidden" name="current_status" id="current_status" value="<?php echo set_value('current_status',$officer['status']);?>" />
							<br>
							<br>
							<input type="submit" name="register" id="register" class="form-submit" value="Update" />
							
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
		$('#edit_officer_form').on('submit', function(event) {
			event.preventDefault();
			$('#officer_name_error').html('');
			$('#email_error').html('');
			$('#user_name_error').html('');
			$('#password_error').html('');
			$('#re_password_error').html('');
			$.ajax({
				url: "<?php echo base_url().'officer/editOfficerValidations/'.$officer['officer_id'];?>",
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
                        
						window.location = "<?php echo base_url(); ?>home/<?php echo $this->session->userdata('url');?>";
					}
					$('#register').attr('disabled', false);
				}
			})

		});

	});
</script>