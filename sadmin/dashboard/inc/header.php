<?php
session_start();
if (!isset($_SESSION['userId'])) {
  header("Location: ../index.php");
}
$userId = $_SESSION['userId'];
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SAFI - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="shortcut icon" href="img/favicon.ico">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/custom-styles.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="vendor/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="vendor/bootstrap-datepicker/locales/bootstrap-datepicker-en-CA.min.js"></script>
  <script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

  <script type="text/javascript" src="vendor/ckeditor/ckeditor.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center mb-2" style="margin-top:6px;" href="index.php">
        <div class="sidebar-brand-icon">
          <img src="img/logo.png" width="80" alt="">
        </div>

      </a>
      <!-- <h3 class="text-center" style ="color:#fff; font-size:14pt; font-weight:600">School of Agriculture for Family Independence</h3> -->

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- <li class="nav-item active">
        <a class="nav-link" href="menu.php">
          <i class="fas fa-fw fa-bars"></i>
          <span>Menu</span></a>
      </li> -->
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Site Pages
      </div>
      <!-- <li class="nav-item">
        <a class="nav-link" href="home-page.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span>
        </a>
      </li> -->

      <!-- Nav Item - About -->
      <li class="nav-item">
        <a class="nav-link" href="about.php">
          <i class="fas fa-fw fa-info-circle"></i>
          <span>About info</span>
        </a>
      </li>
      <!-- Nav Item - Events -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#events" aria-expanded="true" aria-controls="events">
          <i class="fas fa-fw fa-calendar-alt"></i>
          <span>Events</span>
        </a>
        <div id="events" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="events.php">Events List</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Posts -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#PostsPages" aria-expanded="true" aria-controls="PostsPages">
          <i class="fas fa-fw fa-tasks"></i>
          <span>Projects</span>
        </a>
        <div id="PostsPages" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="projects.php">Projects List</a>
            <a class="collapse-item" href="project_categories.php">Project Categories</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapseProgrammes">
          <i class="fas fa-fw fa-map-marker-alt"></i>
          <span>Impact Areas</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Impact Areas</h6>
            <a class="collapse-item" href="impact_areas.php">View List</a>
          </div>
        </div>
      </li>
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePartners" aria-expanded="true" aria-controls="collapsePartners">
          <i class="fas fa-fw fa-handshake"></i>
          <span>Partners</span>
        </a>
        <div id="collapsePartners" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="impact_areas.php">Partners List</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVacancy" aria-expanded="true" aria-controls="collapseVacancy">
          <i class="fas fa-fw fa-user"></i>
          <span>Work with us</span>
        </a>
        <div id="collapseVacancy" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="vacancy.php">Work with us</a>
            <a class="collapse-item" href="vacancy_categories.php">Vacancy Categories</a>
          </div>
        </div>
      </li>      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDonations" aria-expanded="true" aria-controls="collapseDonations">
          <i class="fas fa-fw fa-donate"></i>
          <span>Donations</span>
        </a>
        <div id="collapseDonations" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Donations</h6>
            <a class="collapse-item" href="donations.php">Donations List</a>
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Nav Item - Manage Users -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
          <i class="fas fa-fw fa-users"></i>
          <span>Manage Users</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Users</h6>
            <a class="collapse-item" href="users-page.php">View List</a>
            <a class="collapse-item" href="user-roles.php">Roles & Permissions</a>
          </div>
        </div>
      </li>
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

          <!-- Organisation Title -->
          <h2>CPanel</h2>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <span class="mr-2 my-4 d-none d-lg-inline text-gray-600 small">
              <i class="fas fa-globe">&nbsp;</i><a href="https://mzuzucity.org.mw"> Visit site</a>
            </span>
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?= $username; ?>
                  <input type="hidden" id="userAccountId" value=<?= $userId; ?>>
                </span>
                <img class="img-profile rounded-circle" src="../../images/profiles/empty.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="user-profile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">