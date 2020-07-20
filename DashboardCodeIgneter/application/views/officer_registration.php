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
</head>

<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container ">
                <div class="signup-content">
                    <form method="POST" id="officer_registration_form" class="signup-form" action="">
                        <h2 class="form-title">Officer Registration</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="officer_name" id="officer_name" placeholder="Enter officer's name" value="<?php echo set_value('officer_name'); ?>" />
                            <?php echo form_error('officer_name'); ?>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Enter officer's email" value="<?php echo set_value('email'); ?>" />
                            <?php echo form_error('email'); ?>
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