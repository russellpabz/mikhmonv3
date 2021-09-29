<?php


$page = "home";

$body_class = "fixed-sn white-skin";

if(!$API->connect($config->mikrotik->ip_address, $config->mikrotik->user, decrypt($config->mikrotik->password))){
  header("Location:". url("/?page=settings"));
}


// $getData = $API->comm("/system/script/print", array(
//     "?comment" => "sales",
// ));

// printing($getData);

// die();


$user = $config->mikrotik->user;

if(isset($_POST["user"]) && $config->mikrotik->user == "admin"){
  $user = $_POST["user"];
}

$result = $API->comm("/system/script/print", array(
    "?owner" => $user,
));

$date = isset($_POST["date"]) ? $_POST["date"] : date('d F, Y');


//$TotalReg = count($getData);



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

        <h4 class="text-left font-weight-bold dark-grey-text">Reports</h4>

        <hr>

      </div>

      <section class="mb-5">

        <form method="post" novalidate>

            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="md-form">
                        <input placeholder="Selected date" name="date" value="<?= $date; ?>" type="text" class="form-control datepicker">
                        <label for="date-picker-example">From</label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="md-form">
                      <select class="mdb-select md-form" name="user">
                        <option value="" disabled selected>Choose your option</option>
                        <option <?php ($_POST["user"] == "admin") ? "selected" : "" ?> value="admin">Admin</option>
                        <option <?php ($_POST["user"] == "julian") ? "selected" : "" ?> value="julian">Julian</option>
                        <option <?php ($_POST["user"] == "jeselle") ? "selected" : "" ?> value="jeselle">Jeselle</option>
                      </select>
                    </div>
                </div>
            </div>



            <input  type="submit" id="filter" class="btn d-none" name="filter">

        </form>


        <div class="card mb-0">
            <div class="card-body">
                <div class="table-responsive">
                
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="font-weight-bold "><strong>#</strong></th>
                                <th class="font-weight-bold "><strong>Date</strong></th>
                                <th class="font-weight-bold "><strong>Ticket#</strong></th>
                                <th class="font-weight-bold "><strong>Profile</strong></th>
                                <th class="font-weight-bold "><strong>Comment</strong></th>
                                <th class="font-weight-bold "><strong>Price</strong></th>
                            </tr>
                        </thead>
                        <tbody>



                            <?php $total = 0; ?>
                            <?php $id = 1; ?>


                            <?php foreach($result as $row): ?>
                        
                            <?php $data = explode('|', $row['name']); ?>

                            <?php if(date("d", strtotime($row['source'])) == date("d", strtotime($date))): ?>

                            <?php $price = str_replace("Php","", $data[2]); ?>

                            <tr>
                                <td><?= $id++; ?></td>
                                <td><?= $row['source']; ?></td>
                                <td><strong><?= checkAdmin($config) ? $data[0] : substr($data[0], 0, 4) ."...."; ?></strong></td>
                                <td><?= explode(' : ', $data[1])[1]; ?></td>
                                <td><?= $data[3]; ?></td>
                                <td><?= $price; ?></td>
                            </tr>

                            <?php $total += $price; ?>
                            
                            <?php endif; ?>

                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>

                <hr class="my-0 mb-4">

                <div class="justify-content-between">
                
                    <h6 class="dark-grey-text  text-right">
                        <span class="font-weight-bold dark-grey-text text-primary">Total: <?= $total; ?>Php </span><br>
                        <span class="font-weight-bold dark-grey-text text-danger">Net: <?= $total - (($id - 1) * 5); ?>Php</span>
                    </h6>

                </div>

            </div>
        </div>
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