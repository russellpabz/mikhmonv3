<?php


$page = "version";

$body_class = "fixed-sn white-skin";



include(THEME ."partials/header.php");

?>

<style>

.side-nav a {
    height: auto;
}

</style>


  <!-- Main Navigation -->
  <header>

    <!-- Sidebar navigation -->
    <div id="slide-out" class="side-nav sn-bg-4 fixed">
      <ul class="custom-scrollbar">

        <!-- Logo -->
        <li class="logo-sn waves-effect py-3">
          <div class="text-center">
            <a href="#" class="pl-0"><img src="<?php echo "themes/default/assets/img/logo.png"; ?>"></a>
          </div>
        </li>

        <!-- Search Form -->
        <li>
          <hr style="margin:0;">
        </li>

        <!-- Side navigation links -->
        <li>
          <ul class="collapsible collapsible-accordion">

            <li>
              <a href="<?= url("?page=home") ?>" class="collapsible-header waves-effect">
                <i class="w-fa fas fa-tachometer-alt"></i>Reports
              </a>
            </li>
            <!-- Simple link -->
            <li>
              <a href="<?= url("?page=generate") ?>" class="collapsible-header waves-effect">
                <i class="w-fa far fa-money-bill-alt"></i>Generate
              </a>
            </li>

          </ul>
        </li>
        <!-- Side navigation links -->

      </ul>
      <div class="sidenav-bg mask-strong"></div>
    </div>
    <!-- Sidebar navigation -->

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">

      <!-- SideNav slide-out button -->
      <div class="float-left">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="fas fa-bars"></i></a>
      </div>

      <!-- Breadcrumb -->
      <div class="breadcrumb-dn mr-auto">
        
      </div>

      <div class="d-flex change-mode">

        <!-- Navbar links -->
        <ul class="nav navbar-nav nav-flex-icons ml-auto">

          <!-- Dropdown -->
       
          <li class="nav-item">
            <a class="nav-link waves-effect"><i class="far fa-comments"></i> <span
                class="clearfix d-none d-sm-inline-block">Support</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect" href="#" id="userDropdown" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i> <span class="clearfix d-none d-sm-inline-block">Account</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= url("?page=logout") ?>">Log Out</a>
                <a class="dropdown-item" href="<?= url("?page=settings") ?>">Settings</a>
            </div>
          </li>

        </ul>
        <!-- Navbar links -->

      </div>

    </nav>
    <!-- Navbar -->

  </header>
  <!-- Main Navigation -->

  <!-- Main layout -->
  <main >

    <div class="container-fluid" style="margin-bottom: 100px;">

      <!-- Section heading -->
      <div class="mt-lg-5 mb-3">

        <h4 class="text-left font-weight-bold dark-grey-text">Verson</h4>

        <hr>

      </div>

      <section class="mb-5">

          <?= phpversion() ?>
        
      </section>

    
    </div>
  </main>
  <!-- Main layout -->

  <!-- Footer -->
  <footer class="page-footer fixed-bottom pt-0 mt-5 rgba-stylish-light">
    <!-- Copyright -->
    <div class="footer-copyright py-3 text-center">
      <div class="container-fluid">
        © 2021 Copyright: <a href="" target="_blank"> Russell Pabon </a>
      </div>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->


  <?php include(THEME ."partials/footer.php"); ?>