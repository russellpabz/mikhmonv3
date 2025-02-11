<?php

$failed = false;

if(isset($_POST["submit"]) && $_POST["submit"] == "login"){

  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);

  if($config->user->account_user == $username && decrypt($config->user->account_password) == $password){
    
    $_SESSION["login"] = true;

    // if(!isset($config->mikrotik)){
    //   header("Location:". url("/?page=settings"));
    // }
    // else{
      header("Location:". url("/?page=home"));
    //}

  }
  else{
    $failed = true;
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
</style>

<!-- Intro Section -->
<section class="view intro-2">
  <div class="mask rgba-stylish-strong h-100 d-flex justify-content-center align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-5">

          <!-- Form with header -->
          <form method="post">
            <div class="card wow fadeIn" data-wow-delay="0.3s">
              <div class="card-body">

                <!-- Header -->
                <div class="form-header purple-gradient">
                  <h3 class="font-weight-500 my-2 py-1"></i> Login Screen</h3>
                </div>

                <?php  if ($failed) : ?>
                  
                  <div class="alert alert-danger" role="alert">
                    Invalid credentials!
                  </div>

                <? endif; ?>

                <!-- Body -->
                <div class="md-form">
                  <i class="fas fa-user prefix white-text"></i>
                  <input type="text" name="username" id="orangeForm-name" class="form-control">
                  <label for="orangeForm-name">Username</label>
                </div>


                <div class="md-form">
                  <i class="fas fa-lock prefix white-text"></i>
                  <input type="password" name="password" id="orangeForm-pass" class="form-control">
                  <label for="orangeForm-pass">Password</label>
                </div>

                <div class="text-center">
                  <button class="btn btn-primary" name="submit" value="login" type="submit">Login</button>
                </div>

              </div>
            </div>
          </form>
          <!-- Form with header -->

        </div>
      </div>
    </div>
  </div>
</section>
<!-- Intro Section -->

  

<?php include(THEME ."partials/footer.php"); ?>
