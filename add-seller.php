<?php
session_start();

// verify if any user is logged in
require "./includes/is_logged.php";

require "./db/db.php";

// $sql = "SELECT id, concat(name, ' ', lastname) as fullname FROM seller;";

// $result = $conn->query($sql);
$conn->close();

?>
<?php require_once "./includes/panel/dashboard_header.php"; ?>
<?php require_once "./includes/panel/dashborad_nav.php"; ?>

<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <?php require_once "./includes/siderbar.php"; ?>
  </div>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4">
        <h1 class="mt-4">Add product</h1>
        <div class="row">
          <?php require "./includes/message.php";?>
          <div class="col-lg-12 col-md-12 mt-5">
            <div class="col-lg-12 col-md-12">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <form method="post" class="p-2" action="./operations/insert_seller.php">

                        <!-- name -->
                        <div class="mb-3">
                          <label for="id_name" class="form-label requiredField"> Name<span class="asteriskField">*</span> </label>
                          <input autocomplete="off" type="text" name="name" maxlength="50" class="textinput form-control" required="" id="id_name">
                          <!-- <div class="form-text"></div> -->
                        </div>

                        <!-- last name -->
                        <div class="mb-3">
                          <label for="id_lastname" class="form-label requiredField">Last Name<span class="asteriskField">*</span></label>
                          <input autocomplete="off" type="text" name="lastname" maxlength="50" class="textinput form-control" required="" id="id_lastname">
                        </div>

                        <!-- age -->
                        <div class="mb-3">
                          <label for="id_age" class="form-label requiredField">Age<span class="asteriskField">*</span></label>
                          <input autocomplete="off" type="number" maxlength="50" name="age" max="90" min="18" class="numberinput form-control" required id="id_age">
                          <!-- <div class="form-text"></div> -->
                        </div>

                        <div class="mt-5">
                          <button name="add_seller" class="btn btn-success px-4">Add</button>
                          <a href="sellers.php" class="btn btn-secondary px-4">Cancel</a>
                        </div>

                      </form>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </main>
    <?php require_once "./includes/panel/dashboard_footer.php"; ?>