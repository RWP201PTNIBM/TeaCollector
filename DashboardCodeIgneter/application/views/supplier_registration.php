<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Land Owner Registration</title>

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
					<form method="POST" id="supplier_registration_form" class="signup-form" action="">
						<h2 class="form-title">Land Owner Registration</h2>
						<div class="form-group">
							<input type="text" class="form-input" name="supplier_name" id="supplier_name" placeholder="Enter suppliers's name" />
							<span id="supplier_name_error" class="text-danger"></span>
						</div>
						<div class="form-group">
							<input type="text" class="form-input" name="address" id="address" placeholder="Enter supplier's address" />
							<span id="address_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
							<input type="text" class="form-input" name="phone" id="phone" placeholder="Enter supplier's phone" />
							<span id="phone_error" class="text-danger"></span>
						</div>
						<div class="form-group">
							<select name="paths" class="new-custom-select" id="paths">
								<option value="">Select Path</option>
								<?php if (count($paths)) : ?>
									<?php foreach ($paths as $path) : ?>
										<option value=<?php echo $path->path_id; ?>><?php echo $path->path_name; ?></option>
									<?php endforeach; ?>
								<?php else : ?>
								<?php endif; ?>
							</select>
							<span id="paths_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
							<select name="points" class="new-custom-select" id="points">
								<option value="0" class="new-custom-select">Please Select Path First</option>
							</select>
							<span id="points_error" class="text-danger"></span>
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
	<script>
		$(document).ready(function(){
			/* Populate data to state dropdown */
			$('#paths').on('change',function(){
				var pathId = $(this).val();
				if(pathId){
					$.ajax({
						type:'POST',
						url:'<?php echo base_url('supplier/getCollectionPoints'); ?>',
						data:'path_id='+pathId,
						success:function(data){
							$('#points').html('<option value="">Select Collection Point</option>'); 
							var dataObj = jQuery.parseJSON(data);
							if(dataObj){
								$(dataObj).each(function(){
									var option = $('<option />');
									option.attr('value', this.cp_id).text(this.cp_name);           
									$('#points').append(option);
								});
							}else{
								$('#points').html('<option value="">Collection points not available</option>');
							}
						}
					}); 
				}else{
					$('#points').html('<option value="">Please Select Path First</option>');
				
				}
			});
		});
	</script>
</body>
</html>
<script>
	$(document).ready(function() {
		$('#supplier_registration_form').on('submit', function(event) {
			event.preventDefault();
			$('#supplier_name_error').html('');
			$('#address_error').html('');
			$('#phone_error').html('');
			$('#paths_error').html('');
			$('#points_error').html('');
			$.ajax({
				url: "<?php echo base_url(); ?>supplier/supplier_registration_validation",
				method: "POST",
				data: $(this).serialize(),
				dataType: "json",
				beforeSend: function() {
					$('#register').attr('disabled', 'disabled');

				},
				success: function(data) {

					if (data.error) {
						if (data.supplier_name_error != '') {
							$('#supplier_name_error').html(data.supplier_name_error);
						} else {
							$('#supplier_name_error').html('');
						}
						if (data.address_error != '') {
							$('#address_error').html(data.address_error);
						} else {
							$('#address_error').html('');
						}
						if (data.phone_error != '') {
							$('#phone_error').html(data.phone_error);
						} else {
							$('#phone_error').html('');
						}
						if (data.paths_error != '') {
							$('#paths_error').html(data.paths_error);
						} else {
							$('#paths_error').html('');
						}
						if (data.points_error != '') {
							$('#points_error').html(data.points_error);
						} else {
							$('#points_error').html('');
						}
					} else {
						$('#supplier_name_error').html('');
						$('#address_error').html('');
						$('#phone_error').html('');
					    $('#paths_error').html('');
						$('#points_error').html('');
						$('#supplier_registration_form')[0].reset();
						$('#success_message').html(data.success);
                       
					}
					$('#register').attr('disabled', false);
				}
			})

		});

	});
</script>

