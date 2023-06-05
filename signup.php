<?php session_start() ?>
<?php require "./includes/header.php"; ?>
<section class="min-vh-100" style="background-color: #2d0e11;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                <?php if (isset($_SESSION['errors'])) foreach ($_SESSION['errors'] as $error) {
                    $_SESSION['message'] = $error;
                    $_SESSION['message_type'] = 'danger';
                    require "./includes/message.php";
                  } unset($_SESSION['errors']) ?>
                <form
                  novalidate
                  class="needs-validation"
                  method="post"
                  action="./operations/register_user.php"
                  oninput='passwordConfirm.setCustomValidity(passwordConfirm.value != password.value ? "Passwords do not match." : "")'
                >
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h4 fw-bold mb-0">Manage your inventory like a pro</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Create an account</h5>

                  <!-- nome -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="name">Name * </label>
                    <input pattern="^[A-Za-z\s']+$" required type="text" id="name" autocomplete="off" name="name" class="form-control" />
                    <span class="form-text">Don't include special characters</span>
                  </div>

                  <!-- lastname -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="lastname">Last name *</label>
                    <input pattern="^[A-Za-z\s']+$" required type="text" id="lastname" autocomplete="off" name="lastname" class="form-control" />
                    <span class="form-text">Don't include special characters</span>
                  </div>

                  <!-- username -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="username">Username *</label>
                    <input pattern="^[A-Za-z0-9_]{4,}$" required type="text" id="username" autocomplete="off" name="username" class="form-control" />
                    <span class="form-text">Don't include special characters. Must be at least 4 characters long</span>
                  </div>

                  <!-- email -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example17">Email address *</label>
                    <input pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required type="email" id="form2Example17" name="email" autocomplete="off" class="form-control" />
                  </div>

                  <!-- password -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="password">Password *</label>
                    <input minlength="4" required type="password" id="password" name="password" autocomplete="off" class="form-control" />
                    <span class="form-text">Must be at least 4 characters long</span>
                  </div>

                  <!-- confirm password -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="id_passwordConfirm">Confirm password *</label>
                    <input minlength="4" name="passwordConfirm" required type="password" id="id_passwordConfirm" autocomplete="off" class="form-control" />
                    <div class="invalid-feedback">
                      Passwords don't match
                    </div>

                  </div>

                  <div class="pt-1 mb-4">
                    <button name="signup" class="btn btn-dark btn-block">Sign up</button>
                  </div>

                  <p class="pb-lg-2 mb-0" style="color: #393f81;"><a href="./signin.php" style="color: #393f81;">Sigin here</a></p>
                </form>

              </div>
            </div>
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="./assets/img/login-bg.jpg" alt="form" class="img-fluid h-100" style="border-radius: 0 1rem 1rem 0; object-fit: cover;" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require "./includes/footer.php" ?>