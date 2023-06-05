<?php
session_start();
require "./includes/header.php";
require "./includes/message.php"
?>
  <section class="min-vh-100" style="background-color: #2d0e11;">
  <div class="container py-5 h-100 login">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="./assets/img/login-bg.jpg"
                alt="login form" class="img-fluid h-100" style="border-radius: 1rem 0 0 1rem; object-fit: cover;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form class="needs-validation" novalidate method="post" action="<?= $_SERVER['PHP_SELF'] ?>">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h4 fw-bold mb-0">Manage your inventory like a pro</span>
                  </div>
                  
                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                  <p class="text-danger" ><?php require_once "./operations/login_validation.php";?></p>

                  <div class="form-outline mb-3">
                    <label class="form-label" for="username">Username</label>
                    <input required id="username" type="text" name="user" autocomplete="off" class="form-control form-control-lg" />
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="password">Password</label>
                    <input required type="password" name="password" id="password" autocomplete="off" class="form-control form-control-lg" />
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-block" >Login</button>
                  </div>

                  <p class="pb-lg-2 mb-0" style="color: #393f81;">
                    <a href="signup.php" style="color: #393f81;">Register here</a>
                  </p>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php if (isset($_SESSION['new_user_data'])) { ?>
<script src="./js/sendEmail.js"> </script>
<?php } ?>
<?php require "./includes/footer.php";?>