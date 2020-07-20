<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Driver Registration</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link class="second" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
</head>

<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container ">
                <div class="signup-content">
                    <form method="POST" id="officer_registration_form" class="signup-form" action="">
                        <h2 class="form-title">Driver Registration</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="driver_name" id="driver_name" placeholder="Enter driver's name" value="<?php echo set_value('driver_name'); ?>" />
                            <?php echo form_error('driver_name'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="phone" id="phone" placeholder="Enter driver's phone" value="<?php echo set_value('phone'); ?>" />
                            <?php echo form_error('phone'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="NIC" id="NIC" placeholder="Enter NIC(national identity card)number" value="<?php echo set_value('NIC'); ?>" />
                            <?php echo form_error('NIC'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="user_name" id="user_name" placeholder="Enter user name" value="<?php echo set_value('user_name'); ?>" />
                            <?php echo form_error('user_name'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="license_no" id="license_no" placeholder="Enter driver's license number" value="<?php echo set_value('license_no'); ?>" />
                            <?php echo form_error('license_no'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="vehicle_no" id="vehicle_no" placeholder="Enter vehicle license plate number" value="<?php echo set_value('vehicle_no'); ?>" />
                            <?php echo form_error('vehicle_no'); ?>
                        </div>
                        <div class="form-group">
                            <select name="paths" class="custom-select">
                                <option>Select</option>
                                <?php if (count($paths)) : ?>
                                    <?php foreach ($paths as $path) : ?>
                                        <option value=<?php echo $path->path_id; ?>><?php echo $path->path_name; ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="password" id="password" placeholder="Password" value="<?php echo set_value('password'); ?>" />
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                            <?php echo form_error('password'); ?>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password" value="<?php echo set_value('re_password'); ?>" />
                            <?php echo form_error('re_password'); ?>
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
    <script src="<?php echo base_url(); ?>assets/vendor/jquery1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
</body>

</html>