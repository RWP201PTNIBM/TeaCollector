<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Collection Point Edit</title>

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
                    <form method="POST" id="Path_edit_form" class="signup-form" action="">

                        <h2 class="form-title">Collection Point Edit</h2>
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
							<input type="text" class="form-input" name="path_id" id="path_id" value="<?php echo set_value('path_id',$path['path_id']);?>" readonly hidden="true"/>
							<span id="path_id_error" class="text-danger"></span>
						</div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="path_name" id="path_name" placeholder="Enter Path name" value="<?php echo set_value('path_name',$path['path_name']);?>" />
                            <span id="path_name_error" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="register" id="register" class="form-submit" value="Save" />
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtgdMlDHzRzzvGCpEPfdAna_4gprbT_xE&callback=initMap">
    </script>
</body>
<script>
    $(document).ready(function() {
        $('#Path_edit_form').on('submit', function(event) {
            event.preventDefault();
            $('#path_name_error').html('');
            $.ajax({
                url: "<?php echo base_url().'Path/Path_edit_validation/'.$path['path_id'];?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#register').attr('disabled', 'disabled');
                },
                success: function(data) {

                    if (data.error) {
                        if (data.path_name_error != '') {
                            $('#path_name_error').html(data.path_name_error);
                        } else {
                            $('#path_name_error').html('');
                        }
                    } else {
                        window.location = "<?php echo base_url().'Path/viewPath/'.$path['path_id'];?>";
                    }
                    $('#register').attr('disabled', false);
                }
            })

        });

    });
</script>

</html>