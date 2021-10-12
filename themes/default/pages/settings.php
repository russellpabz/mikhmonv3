<?php

$page = "register";





// printing(sizeof($val->errors));

$val = new Validation();
// die();


if(isset($_POST["submit"]) && $_POST["submit"] == "save"){
  
  
  $password = trim(encrypt($_POST["password"]));
  $account_password = trim(encrypt($_POST["account_password"]));


  $val->name('account_user')->value($_POST['account_user'])->required();
  $val->name('account_password')->value($_POST["account_password"])->required();

  $val->name('ip_address')->value($_POST['ip_address'])->required();
  $val->name('user')->value($_POST['user'])->required();
  $val->name('password')->value($password)->required();

  $val->name('dns')->value($_POST['dns'])->required();
  $val->name('currency')->value($_POST['currency'])->required();

  
  if($val->isSuccess()){
   
    $response = array(
      "user" => array(
        "account_user"     => $_POST["account_user"],
        "account_password" => $account_password
      ),
      "mikrotik" => array(
        "ip_address" => $_POST["ip_address"],
        "user"       => $_POST["user"],
        "password"   => $password
      ),
      "settings" => array(
        "currency" => $_POST["currency"],
        "dns"      => $_POST["dns"]
      )   
    );

    
    

    $fp = fopen(ROOT ."/include/config.php", 'w');
    fwrite($fp, "<?php " .'$config'. " = json_decode('".json_encode($response) ."');");
    fclose($fp);

    include("include/config.php");

  }
  else{
    //$val->showError();
  }

  
}





include(THEME ."partials/header.php");


?>

<style>
  html,
  body,
  header,
  .view {
    height: 100%;
  }
  @media (min-width: 560px) and (max-width: 740px) {
    html,
    body,
    header,
    .view {
      height: 650px;
    }
  }
  @media (min-width: 800px) and (max-width: 850px) {
    html,
    body,
    header,
    .view  {
      height: 650px;
    }
  }

  .view .mask {
  overflow-y: scroll;
  }

  form{
    margin-bottom: 10%;
  }

</style>



    <!-- Intro Section -->
    <section class="view">
      <div class="mask rgba-gradient">
        <div class="container justify-content-center align-items-center">

          <form method="post" class="needs-validation <?php echo sizeof($val->errors) ? "was-validated" : "" ?>" novalidate>

            <!-- Grid row -->
            <div class="row pt-5">

              <!-- Grid column -->
              <div class="col-md-12">

                <div class="card">
                  <div class="card-body">

                    <h2 class="font-weight-bold my-4 text-center mb-5 mt-4 font-weight-bold">
                      <strong>REGISTER</strong>
                    </h2>
                    <hr>

                    <?php  if ($connection) : ?>

                      <div class="alert alert-success" role="alert">
                        Connected!
                      </div>

                      <? else: ?>
                        <div class="alert alert-danger" role="alert">
                          Connection error!
                        </div>
                      <? endif; ?>

                    <!-- Grid row -->
                    <div class="row col-md-12 mt-5">

                      <!-- Grid column -->
                      <div class="col-md-6">

                        <!-- Grid row -->
                        <div class="row pb-4">
                          <div class="col-2 col-lg-1">
                            <i class="fas fa-university indigo-text fa-lg"></i>
                          </div>
                          <div class="col-10">

                            <h4 class="font-weight-bold mb-4">
                              <strong>Account</strong>
                            </h4>


                            <!-- Body -->
                            <div class="md-form ">
                              <input type="text" id="validation_account_user" name="account_user" value="<?= $config->user->account_user ?>" class="form-control" required>
                              <label for="validation_account_user">Username</label>
                              <div class="invalid-feedback">Please provide a username.</div>
                            </div>

                            <div class="md-form">
                              <input type="password" id="validation_account_password" value="<?= decrypt($config->user->account_password) ?>" name="account_password" class="form-control" required>
                              <label for="validation_account_passwords">Password</label>
                              <div class="invalid-feedback">Please provide a password.</div>
                            </div>

                            
                          </div>
                        </div>
                        <!-- Grid row -->

                        <!-- Grid row -->
                        <div class="row pb-4">
                          <div class="col-2 col-lg-1">
                            <i class="fas fa-desktop deep-purple-text fa-lg"></i>
                          </div>
                          <div class="col-10">
                            <h4 class="font-weight-bold mb-4">
                              <strong>Mikrotik</strong>
                            </h4>
                            


                            <!-- Body -->
                            <div class="md-form">
                              <input type="text" id="orangeForm-name" name="ip_address" value="<?= $config->mikrotik->ip_address?>"  class="form-control" required>
                              <label for="orangeForm-name">IP Address</label>
                              <div class="invalid-feedback">Please provide a IP address.</div>
                            </div>

                            <div class="md-form">
                              <input type="text" id="orangeForm-name" name="user" value="<?= $config->mikrotik->user?>" class="form-control" required>
                              <label for="orangeForm-name">User</label>
                              <div class="invalid-feedback">Please provide a user.</div>
                            </div>

                            <div class="md-form">
                              <input type="password" id="orangeForm-pass" name="password" value="<?= decrypt($config->mikrotik->password) ?>" class="form-control" required>
                              <label for="orangeForm-pass">Password</label>
                              <div class="invalid-feedback">Please provide a password.</div>
                            </div>

                          </div>
                        </div>
                        <!-- Grid row -->


                      </div>
                      <!-- Grid column -->

                      <!-- Grid column -->
                      <div class="col-md-6">

                        <!-- Grid row -->
                        <div class="row pb-4">

                        <div class="col-2 col-lg-1">
                            <i class="fas fa-university indigo-text fa-lg"></i>
                          </div>
                          <div class="col-10">
                            
                            <h4 class="font-weight-bold mb-4">
                              <strong>Settings</strong>
                            </h4>


                            <!-- Body -->
                            <div class="md-form">
                              <input type="text" id="orangeForm-name" value="<?= $config->settings->dns?>" name="dns" class="form-control" required>
                              <label for="orangeForm-name">DNS</label>
                              <div class="invalid-feedback">Please provide a DNS.</div>
                            </div>

                            <div class="md-form">
                              <input type="text" id="orangeForm-name" value="<?= $config->settings->currency?>" name="currency" class="form-control" required>
                              <label for="orangeForm-name">Currency</label>
                              <div class="invalid-feedback">Please provide a currency.</div>
                            </div>



                        </div>
                        <!-- /Grid row -->

                      </div>
                      <!-- Grid column -->

                    </div>
                    <!-- Grid row -->

                    <div class="col-md-12 text-right">
                      <a href="<?= url("?page=home") ?>" class="btn btn-info mt-5 waves-effect waves-light">Home Screen</a>
                      <button class="btn btn-indigo mt-5 waves-effect waves-light" name="submit" value="save" type="submit">Save Form</button>
                    </div>

                  </div>
                </div>

              </div>
              <!-- Grid column -->

            </div>
            <!-- Grid row -->

          </form>

        </div>
      </div>
    </section>
    <!-- Intro Section -->



<?php include(THEME ."partials/footer.php"); ?>
