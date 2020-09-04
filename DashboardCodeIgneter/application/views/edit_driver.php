<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Edit Driver</title>

	<!-- Font Icon -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/material-icon/css/material-design-iconic-font.min.css">

	<!-- Main css -->
	<link class="one" rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">


</head>

<body>

	<div class="main">

		<section class="signup">
			<!-- <img src="images/signup-bg.jpg" alt=""> -->
			<div class="container ">
				<div class="signup-content">
					<form method="POST" id="driver_registration_form" class="signup-form" action="">
						<h2 class="form-title">Edit Driver</h2>
							<input type="text" class="form-input" name="driver_id" id="driver_id" placeholder="Enter driver's name" value="<?php echo set_value('driver_id',$driver['driver_id']);?>" hidden/>

                            <label for="driver_name">Driver Name</label>
							<input type="text" class="form-input" name="driver_name" id="driver_name" placeholder="Enter driver's name" value="<?php echo set_value('driver_name',$driver['name']);?>" />
							<span id="driver_name_error" class="text-danger"></span>

						    <label for="phone">Phone</label>
							<input type="text" class="form-input" name="phone" id="phone" placeholder="Enter driver's phone" value="<?php echo set_value('phone',$driver['phone']);?>" />
							<span id="phone_error" class="text-danger"></span>

						    <label for="NIC">NIC</label>
							<input type="text" class="form-input" name="NIC" id="NIC" placeholder="Enter NIC(national identity card)number" value="<?php echo set_value('NIC',$driver['nic']);?>"/>
							<span id="NIC_error" class="text-danger"></span>

						    <label for="user_name">User Name</label>
							<input type="text" class="form-input" name="user_name" id="user_name" placeholder="Enter user name" value="<?php echo set_value('user_name',$driver['username']);?>" />
							<span id="user_name_error" class="text-danger"></span>

						    <label for="license_no">License No</label>
							<input type="text" class="form-input" name="license_no" id="license_no" placeholder="Enter driver's license number" value="<?php echo set_value('license_no',$driver['license_no']);?>" />
							<span id="license_no_error" class="text-danger"></span>
						
						    <label for="vehicle_no">Vehicle No</label>
							<input type="text" class="form-input" name="vehicle_no" id="vehicle_no" placeholder="Enter vehicle license plate number" value="<?php echo set_value('vehicle_no',$driver['vehicle_no']);?>" />
							<span id="vehicle_no_error" class="text-danger"></span>

						    <label for="Paths">Path</label>
							<select name="paths" class="new-custom-select">
							    <?php if (count($dpaths)) : ?>
									<?php foreach ($dpaths as $dpath) : ?>
										<option value=<?php echo $dpath->path_id; ?>><?php echo $dpath->path_name; ?></option>
									<?php endforeach; ?>
								<?php else : ?>
								<?php endif; ?>
								<?php if (count($paths)) : ?>
									<?php foreach ($paths as $path) : ?>
										<option value=<?php echo $path->path_id; ?>><?php echo $path->path_name; ?></option>
									<?php endforeach; ?>
								<?php else : ?>
								<?php endif; ?>
							</select>
							<span id="paths_error" class="text-danger"></span>
						
						    <label for="password">Password</label>
							<input type="password" class="form-input" name="password" id="password" placeholder="Password"  value="<?php echo set_value('password',$driver['password']);?>"  />
							<span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
							<span id="password_error" class="text-danger"></span>
						
						    <label for="re_password">Confirm Password</label>
							<input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password"  value="<?php echo set_value('re_password',$driver['password']);?>" />
							<span id="re_password_error" class="text-danger"></span>
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
		$('#driver_registration_form').on('submit', function(event) {
			event.preventDefault();
			$('#driver_name_error').html('');
			$('#phone_error').html('');
			$('#NIC_error').html('');
			$('#user_name_error').html('');
			$('#license_no_error').html('');
			$('#vehicle_no_error').html('');
			$('#paths_error').html('');
			$('#password_error').html('');
			$('#re_password_error').html('');
			$.ajax({
				url: "<?php echo base_url().'driver/editDriverValidations/'.$driver['driver_id'];?>",
				method: "POST",
				data: $(this).serialize(),
				dataType: "json",
				beforeSend: function() {
					$('#register').attr('disabled', 'disabled');
				},
				success: function(data) {

					if (data.error) {
						if (data.driver_name_error != '') {
							$('#driver_name_error').html(data.driver_name_error);
						} else {
							$('#driver_name_error').html('');
						}
						if (data.phone_error != '') {
							$('#phone_error').html(data.phone_error);
						} else {
							$('#phone_error').html('');
						}
						if (data.NIC_error != '') {
							$('#NIC_error').html(data.NIC_error);
						} else {
							$('#NIC_error').html('');
						}
						if (data.user_name_error != '') {
							$('#user_name_error').html(data.user_name_error);
						} else {
							$('#user_name_error').html('');
						}
						if (data.license_no_error_error != '') {
							$('#license_no_error').html(data.license_no_error);
						} else {
							$('#license_no_error').html('');
						}
						if (data.vehicle_no_error_error != '') {
							$('#vehicle_no_error').html(data.vehicle_no_error);
						} else {
							$('#vehicle_no_error').html('');
						}
						if (data.paths_error != '') {
							$('#paths_error').html(data.paths_error);
						} else {
							$('#paths_error').html('');
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

						$('#driver_name_error').html('');
						$('#phone_error').html('');
						$('#NIC_error').html('');
						$('#user_name_error').html('');
						$('#license_no_error').html('');
						$('#vehicle_no_error').html('');
						$('#paths_error').html('');
						$('#password_error').html('');
						$('#re_password_error').html('');
						$('#driver_registration_form')[0].reset();
						window.location = "<?php echo base_url(); ?>home/<?php echo $this->session->userdata('url');?>";
					}
					$('#register').attr('disabled', false);
				}
			})

		});

	});
</script>