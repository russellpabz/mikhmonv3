<?php


$page = "generate";

$body_class = "fixed-sn white-skin";

//$testt = $API->connect($config->mikrotik->ip_address, $config->mikrotik->user, decrypt($config->mikrotik->password));

// $getData = $API->comm("/system/script/print", array(
//     "?comment" => "sales",
// ));

$profile = $API->comm("/ip/hotspot/user/profile/print", array(
  //"?name" => "$genprof",
));

// foreach($profile as $item){
//   if(strpos($item["on-logout"], '#public') !== false){
//     printing($item);
//   }
// }



if(isset($_POST["submit"]) && trim($_POST["comment"]) != ""){

  $val = new Validation();

  $comment = trim($_POST["comment"]);

  $val->name('comment')->value($comment)->required();

  if($val->isSuccess()){


    $ticket = substr(str_shuffle("0123456789"), 0, 8);

    $date = date('m/d/Y h:i:s a', time());

    $profile = $_POST["profile"];

    $price = explode(':', $profile)[0];

    $result = array( 
      "server"            => $_POST["server"],
      "name"              => $ticket,
      "password"          => $ticket,
      "profile"           => $_POST["profile"],
      "limit-uptime"      => $_POST["timelimit"],
      "comment"           => $config->mikrotik->user .'|'. $date .'|'. $comment,
    );

    
    $API->comm("/ip/hotspot/user/add", $result);

    $API->comm("/system/script/add", array(
      "name" => $ticket .'|'. $_POST["profile"] .'|'. $price .'|'. $comment,
      "owner" => $config->mikrotik->user,
      "source" => $date,
      "comment" => "sales"
    ));



    //system script add name="$date-|-$time-|-$user-|-10-|-$address-|-$mac-|-1d-|-GameOn-1Day-|-$comment" owner="$month$year" source=$date comment=mikhmon; 

  }


}
else{
  header("Location:". url("/?page=generate"));
}



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
  <main>

    <div class="container-fluid" style="margin-bottom: 100px;">

      <!-- Section heading -->
      <div class="mt-lg-5 mb-5">

        <h4 class="text-left font-weight-bold dark-grey-text">Generate Ticket</h4>

        <hr>

      </div>


      <div class="card card-cascade cascading-admin-card">

        <!-- Card Data -->
        <div class="admin-up">
          <i class="far fa-money-bill-alt red  mr-3 z-depth-2"></i>
          <div class="data">
            <p class="text-uppercase">Ticket</p>
            <h4 class="font-weight-bold dark-grey-text"><?= explode(':', $result["profile"])[0]; ?></h4>
          </div>
        </div>

        <!-- Card content -->
        <div class="card-body card-body-cascade">
          <h3 class="text-center text-success font-weight-bold dark-grey-text"><?= $ticket ; ?></h3>
          <hr>
          <h5 class="text-center dark-grey-text"><?= $result["profile"]; ?></h5>
          <h6 class="text-center dark-grey-text"><?= $_POST["comment"]; ?></h6>
          <div class="text-center">
            <a href="<?= url("?page=generate") ?>" class="btn btn-primary mt-3 mb-3">Generate</a>
          </div>
        </div>

      </div>


    
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
  
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

  <?php 
  
  
  unset($_POST);
  $_POST = array();

  include(THEME ."partials/footer.php"); 
  
  ?>