<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>New Visit</title>

	<!-- Font Icon -->
	<link  rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/material-icon/css/material-design-iconic-font.min.css">

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
					<form method="POST" id="add_visit_form" class="signup-form" action="">
						<h2 class="form-title">New Visit</h2>
					    <div class="form-group">
                            <label>Supplier</label>
							<select name="suppliers" class="new-custom-select">
								<option value="0">Select Supplier</option>
								<?php if (count($suppliers)) : ?>
									<?php foreach ($suppliers as $supplier) : ?>
										<option value=<?php echo $supplier->supplier_id; ?>><?php echo $supplier->supplier_name; ?></option>
									<?php endforeach; ?>
								<?php else : ?>
								<?php endif; ?>
							</select>
							<span id="supplier_name_error" class="text-danger"></span>
						</div>
						<div class="form-group">
							<input type="submit" name="add" id="add" class="form-submit" value="ADD" />
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
		$('#add_visit_form').on('submit', function(event) {
			event.preventDefault();
			$('#supplier_name_error').html('');
			$.ajax({
				url: "<?php echo base_url(); ?>visit/addVisitValidation",
				method: "POST",
				data: $(this).serialize(),
				dataType: "json",
				beforeSend: function() {
					$('#add').attr('disabled', 'disabled');

				},
				success: function(data) {

					if (data.error) {
						if (data.supplier_name_error != '') {
							$('#supplier_name_error').html(data.supplier_name_error);
						} else {
							$('#supplier_name_error').html('');
						}
						
					} else {

						$('#supplier_name_error').html('');
						$('#add_visit_form')[0].reset();
						$('#success_message').html(data.success);
					}
					$('#add').attr('disabled', false);
				}
			})

		});

	});
</script>