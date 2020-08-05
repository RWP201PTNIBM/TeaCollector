<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Collection Point</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link class="one" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link class="second" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

    <?php echo $map['js']; ?>
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;
            /* The height is 400 pixels */
            width: 100%;
            /* The width is the width of the web page */
            margin-bottom: 20px;
        }

        .bottom-margin {
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
                    <form method="POST" id="CollectionPoint_registration_form" class="signup-form" action="">


                        <h2 class="form-title">Collection Point</h2>
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
                            <?php if (count($dpaths)) : ?>
                                <?php foreach ($dpaths as $dpath) : ?>
                                    <input type="text" class="form-input" name="path" value="<?php echo $dpath->path_name; ?>" readonly />
                                <?php endforeach; ?>
                            <?php else : ?>
                            <?php endif; ?>
                            <span id="paths_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="cp_name" id="cp_name" placeholder="Enter Collection Point name" required value="<?php echo set_value('cp_name', $cp['cp_name']); ?>" readonly />
                            <span id="cp_name_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="latitude" id="latitude" value="<?php echo set_value('latitude', $cp['latitude']); ?>" readonly />
                            <?php echo form_error('latitude'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="longitude" id="longitude" value="<?php echo set_value('longitude', $cp['longitude']); ?>" readonly />
                            <?php echo form_error('longitude'); ?>
                        </div>

                        <div class="bottom-margin"><?php echo $map['html']; ?></div>

                        <div class="form-group">
                            <a href="<?php echo base_url() . 'CollectionPoint/editCollectionPoint/' . $cp['cp_id'] ?>" class="btn btn-primary">Edit</a>
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

</html>