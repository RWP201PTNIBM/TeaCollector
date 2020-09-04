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
    <link class="second" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;
            /* The height is 400 pixels */
            width: 100%;
            /* The width is the width of the web page */
            margin-bottom: 20px;
        }

        .test {
            height: 100px;
            width: 100px;
            color: black;
            background-color: black;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert {
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
    </style>
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
                    <form method="POST" id="CollectionPoint_registration_form" class="signup-form" action="">

                        <h2 class="form-title">Collection Point Registration</h2>
                        <div class="form-group">
                            <?php
                            $success = $this->session->userdata('success');
                            if ($success != "") {
                            ?>
                                <div class="alert alert-success"><?php echo $success; ?></div>
                            <?php
                            }
                            ?>

                            <?php
                            $failure = $this->session->userdata('failure');
                            if ($failure != "") {
                            ?>
                                <div class="alert alert-success"><?php echo $failure; ?></div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="form-group">
							<select name="path_id" class="new-custom-select">
								<option value="0">Select</option>
								<?php if (count($paths)) : ?>
									<?php foreach ($paths as $path) : ?>
										<option value=<?php echo $path->path_id; ?>><?php echo $path->path_name; ?></option>
									<?php endforeach; ?>
								<?php else : ?>
								<?php endif; ?>
							</select>
							<span id="path_id_error" class="text-danger"></span>
						</div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="cp_name" id="cp_name" placeholder="Enter Collection Point name"/>
                            <span id="cp_name_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="latitude" id="latitude" readonly/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="longitude" id="longitude" readonly/>
                            <span id="latlng_error" class="text-danger"></span>
                        </div>

                        <div id="map"></div>

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
    <script>
        function initMap() {
            var myLatlng = {
                lat: 7.899329,
                lng: 80.846130
            };

            var map = new google.maps.Map(
                document.getElementById('map'), {
                    zoom: 7,
                    center: myLatlng
                });

            // Create the initial InfoWindow.
            var infoWindow = new google.maps.InfoWindow({
                content: 'Click the map to get Lat/Lng!',
                position: myLatlng
            });
            infoWindow.open(map);

            //Setup textboxes
            var latTxt = document.getElementById('latitude');
            var lngTxt = document.getElementById('longitude');
            // Configure the click listener.
            map.addListener('click', function(mapsMouseEvent) {
                // Close the current InfoWindow.
                infoWindow.close();

                // Create a new InfoWindow.
                infoWindow = new google.maps.InfoWindow({
                    position: mapsMouseEvent.latLng
                });
                infoWindow.setContent(mapsMouseEvent.latLng.toString());
                infoWindow.open(map);
                latTxt.value = mapsMouseEvent.latLng.lat();
                lngTxt.value = mapsMouseEvent.latLng.lng();
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtgdMlDHzRzzvGCpEPfdAna_4gprbT_xE&callback=initMap">
    </script>
</body>
<script>
	$(document).ready(function() {
		$('#CollectionPoint_registration_form').on('submit', function(event) {
			event.preventDefault();
			$('#path_id_error').html('');
			$('#cp_name_error').html('');
			$('#latlng_error').html('');
			$.ajax({
				url: "<?php echo base_url(); ?>CollectionPoint/CollectionPoint_registration_validation",
				method: "POST",
				data: $(this).serialize(),
				dataType: "json",
				beforeSend: function() {
					$('#register').attr('disabled', 'disabled');
				},
				success: function(data) {

					if (data.error) {
						if (data.path_id_error != '') {
							$('#path_id_error').html(data.path_id_error);
						} else {
							$('#path_id_error').html('');
						}
                        if (data.cp_name_error != '') {
							$('#cp_name_error').html(data.cp_name_error);
						} else {
							$('#cp_name_error').html('');
						}
                        if (data.latlng_error != '') {
							$('#latlng_error').html(data.latlng_error);
						} else {
							$('#latlng_error').html('');
						}
					} else {
                        $('#path_id_error').html('');
						$('#cp_name_error').html('');
						$('#latlng_error').html('');
					    $('#CollectionPoint_registration_form')[0].reset();
						$('#success_message').html(data.success);
						
					}
					$('#register').attr('disabled', false);
				}
			})

		});

	});
</script>
</html>