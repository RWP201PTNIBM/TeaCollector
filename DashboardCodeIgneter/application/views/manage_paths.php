<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Manage Paths</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link class="one" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link class="second" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
</head>

<body>
    <div class="main">

        <section class="signup">
            <div class="container2">

                <div class="signup-content">
                    <form method="POST" id="patht_registration_form" class="signup-form" action="">

                        <h2 class="form-title">Add Paths</h2>
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
                            <input type="text" class="form-input" name="path_name" id="path_name" placeholder="Enter Path name" />
                            <span id="path_name_error" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="register" id="register" class="form-submit" value="Register" />
                        </div>
                    </form>
                </div>

                <div class="table-content">
                    <h2 class="form-title">Manage Paths</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <tr>
                                    <th>Path Name</th>
                                    <th>No. of Collection Points</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                <div class="overflow-auto">
                                    <?php if (!empty($paths)) {
                                        foreach ($paths as $path) { ?>
                                            </tr>
                                            <td><?php echo $path['path_name'] ?></td>
                                            <td><?php echo $path['cp_count'] ?></td>
                                            <td>
                                            <?php if($path['cp_count'] > 0) { ?> 
                                                <a href="<?php echo base_url() . 'Path/viewPath/' . $path['path_id'] ?>" class="btn btn-primary">View
                                            
                                                <?php }?>
                                                
                                            </td>
                                            <td> <a href="<?php echo base_url() . 'Path/deletePath/' . $path['path_id'] ?>" class="btn btn-danger">Delete</td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="5">Records not found</td>
                                        </tr>
                                    <?php } ?>
                                </div>
                            </table>

                        </div>
                    </div>
                </div>
        </section>

    </div>

    <!-- JS -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>

    <script>
        $(document).ready(function() {
            $('#patht_registration_form').on('submit', function(event) {
                event.preventDefault();
                $('#path_name_error').html('');
                $.ajax({
                    url: "<?php echo base_url(); ?>Path/Path_registration_validation",
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

                            $('#success_message').html(data.success);
                            window.location = "<?php echo base_url(); ?>Path/Path_ViewAll";
                        }
                        $('#register').attr('disabled', false);
                    }
                })

            });

        });
    </script>
</body>

</html>