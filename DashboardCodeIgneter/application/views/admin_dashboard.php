<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Driver Assitance</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <style>
    .green-bg-image{
      background-image: linear-gradient(180deg, #26d346 10%, #224abe 100%);
    }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion green-bg-image" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-leaf"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Tea Factory</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Officer
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseFour">
          <i class="fas fa-fw material-icons">supervisor_account</i>
          <span>Officers</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Officer Details</h6>
            <hr class="sidebar-divider">
            <a class="collapse-item" href="<?php echo base_url(); ?>officer/officer_registration">Add Officer</a>
            <hr class="sidebar-divider">
            <a class="collapse-item" href="<?php echo base_url(); ?>officer/viewAllOfficers">Manage Officers</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Driver
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw material-icons">local_shipping</i>
          <span>Drivers</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Driver Details</h6>
            <hr class="sidebar-divider">
            <a class="collapse-item" href="<?php echo base_url(); ?>Driver/driver_registration">Add Driver</a>
            <hr class="sidebar-divider">
            <a class="collapse-item" href="<?php echo base_url(); ?>Driver/viewAllDrivers">Manage Drivers</a>
          </div>
        </div>
      </li>



      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Tea Plucker
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw material-icons">eco</i>
          <span>Tea Pluckers</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="<?php echo base_url(); ?>Supplier/supplier_registration">Register</a>
            <a class="collapse-item" href="<?php echo base_url(); ?>Supplier/viewAllSuppliers">Manage Suppliers</a>
          </div>
        </div>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Path
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw material-icons">edit_road</i>
          <span>Paths</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Path Details</h6>
            <hr class="sidebar-divider">
            <a class="collapse-item" href="<?php echo base_url(); ?>Path/Path_ViewAll">Manage Paths</a>
          </div>
        </div>
      </li>



      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Collection Point
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw material-icons">room</i>
          <span>Collection Points</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Collection Point Details</h6>
            <hr class="sidebar-divider">
            <a class="collapse-item" href="<?php echo base_url(); ?>CollectionPoint/CollectionPoint_registration">Add Collection Point</a>
            <a class="collapse-item" href="<?php echo base_url(); ?>CollectionPoint/CollectionPoint_ViewAll">Manage Collection Points</a>
          </div>
        </div>
      </li>



      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Visit
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw material-icons">luggage</i>
          <span>Visits</span>
        </a>
        <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Visit Details</h6>
            <hr class="sidebar-divider">
            <a class="collapse-item" href="<?php echo base_url(); ?>Visit/addVisit">Add Visit</a>
            <a class="collapse-item" href="<?php echo base_url(); ?>Visit/viewAllVisits">View All Visits</a>
            <a class="collapse-item" href="<?php echo base_url(); ?>Visit/viewPendingVisits">View Pending Visits</a>
          </div>
        </div>
      </li>



      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Collection Log
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw material-icons">library_books</i>
          <span>Collection Logs</span>
        </a>
        <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Collection Log Details</h6>
            <hr class="sidebar-divider">
            <a class="collapse-item" href="<?php echo base_url(); ?>CollectionLog/viewCollectionLog">View Collection Log</a>
          </div>
        </div>
      </li>



      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>




            <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $this->session->userdata('name'); ?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <?php $this->view('dashboardcontent'); ?>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Team Green Creations </span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url(); ?>home/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url(); ?>assets/js/demo/chart-area-demo.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>