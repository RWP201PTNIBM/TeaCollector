<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Collection Log</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link class="one" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link class="second" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
</head>

<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container2">
                <div class="table-content">
                <h2 class="form-title">Collection Log</h2>
                <div class="row">
                    <div class="col-md-12">
                    
                        <table class="table table-striped">
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Supplier</th>
                                <th>Weight</th>
                                <th>Quantity(Bags)</th>
                                <th>Driver</th>
                            </tr>
                            <div class="overflow-auto">
                            <?php if(!empty($logs)){foreach ($logs as $log){?>
                            </tr>
                                <td><?php echo $log['date(cl.date)']?></td>
                                <td><?php echo $log['time(cl.date)']?></td>
                                <td><?php echo $log['supplier_name']?></td>
                                <td><?php echo $log['weight']?></td>
                                <td><?php echo $log['no_of_bags']?></td>
                                <td><?php echo $log['name']?></td>
                            </tr>
                            <?php } }else {?>
                            <tr>
                               <td colspan="5">Records not found</td>
                            </tr>
                            <?php } ?>
                            </div>
                        </table>
                     
                    </div>
                   
                </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
</body>

</html>